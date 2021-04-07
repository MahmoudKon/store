<?php

namespace App\Http\Controllers\Dashboard;

use App\Category;
use App\Product;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Rule;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Facades\File;
use DB;
use Carbon\Carbon;

class ProductController extends Controller
{
    public function __construct()
    {
        foreach (Product::all() as $product):
            if(date('d/m/Y', strtotime($product['end_discount'])) <= date('d/m/Y') || $product->end_discount == null || $product->discount == 0):
                $product->update([
                    'discount' => null,
                    'start_discount' => null,
                    'end_discount' => null,
                ]);
            endif;
        endforeach;
    }// end of __construct

    public function index(Request $request)
    {
        $categories = Category::all();
        if(isset($request->search) && $request->category_id){
            $products = Product::where('stock', '>', 0)
                                ->whereTranslationLike('name', '%' . $request->search . '%')
                                ->WhereTranslationLike('description', '%' . $request->search . '%')
                                ->where('category_id', $request->category_id)
                                ->orderBy('id', 'desc')->with('images')->paginate(5);
        }else{
            $products = Product::when($request->search, function ($q) use ($request) {

                return $q->where('stock', '>', 0)
                            ->whereTranslationLike('name', '%' . $request->search . '%')
                            ->orWhereTranslationLike('description', '%' . $request->search . '%');

            })->when($request->category_id, function ($q) use ($request) {

                return $q->where('stock', '>', 0)
                            ->where('category_id', $request->category_id);

            })->where('stock', '>', 0)
            ->orderBy('id', 'desc')->with('images')->paginate(5);
        }

        return view('dashboard.products.index', compact('categories', 'products'));

    }//end of index

    public function deleted(Request $request)
    {
        $categories = Category::withTrashed()->get();
        if(isset($request->search) && $request->category_id){
            $products = Product::onlyTrashed()
                                ->with('images')
                                ->whereTranslationLike('name', '%' . $request->search . '%')
                                ->WhereTranslationLike('description', '%' . $request->search . '%')
                                ->orderBy('id', 'desc')->paginate(5);
        }else{
            $products = Product::onlyTrashed()->with('images')->when($request->search, function ($q) use ($request) {

                return $q->whereTranslationLike('name', '%' . $request->search . '%')
                        ->orWhereTranslationLike('description', '%' . $request->search . '%');

            })->when($request->category_id, function ($q) use ($request) {

                return $q->where('category_id', $request->category_id);

            })->orderBy('id', 'desc')->paginate(5);
        }

        return view('dashboard.products.deleted', compact('categories', 'products'));
    }// End Of Deleted

    public function EndProducts(Request $request)
    {
        $categories = Category::all();
        if(isset($request->search) && $request->category_id){
            $products = Product::where('stock', '=', 0)
                                ->with('images')
                                ->whereTranslationLike('name', '%' . $request->search . '%')
                                ->WhereTranslationLike('description', '%' . $request->search . '%')
                                ->where('category_id', $request->category_id)
                                ->orderBy('id', 'desc')->paginate(5);
        }else{
            $products = Product::when($request->search, function ($q) use ($request) {

                return $q->where('stock', '==', 0)
                            ->whereTranslationLike('name', '%' . $request->search . '%')
                            ->orWhereTranslationLike('description', '%' . $request->search . '%');

            })->when($request->category_id, function ($q) use ($request) {

                return $q->where('stock', '==', 0)
                            ->where('category_id', $request->category_id);

            })->with('images')->where('stock', '==', 0)->orderBy('id', 'desc')->paginate(5);
        }

        return view('dashboard.products.EndProducts', compact('categories', 'products'));

    }//end of index



    public function create()
    {
        $categories = Category::all();
        return view('dashboard.products.create', compact('categories'));

    }//end of create



    public function store(Request $request)
    {
        $rules = [ 'category_id' => 'required', ];

        foreach (config('translatable.locales') as $locale):
            $rules += [$locale . '.name' => 'required|unique:product_translations,name'];
            $rules += [$locale . '.description' => 'required'];
        endforeach;

        $rules += [
            'purchase_price' => 'required',
            'sale_price' => 'required',
            'stock' => 'required',
            'discount' => '',
            'end_discount' => '',
            'start_discount' => '',
        ];

        $request->validate($rules);
        $request_data = $request->except(['discount', 'start_discount', 'end_discount', 'image']);

        if($request->discount != null && $request->start_discount != null && $request->end_discount != null) :
            $request_data['discount'] = $request->discount;
            $request_data['start_discount'] = $request->start_discount;
            $request_data['end_discount'] = $request->end_discount;
        endif;

        if ($request->image) {
            for($i = 0; $i < count($request->image); $i++):
                Image::make($request->image[$i])
                ->resize(140, null, function ($constraint) {
                    $constraint->aspectRatio();
                })
                ->save(public_path('uploads/product_images/' . $request->image[$i]->hashName()));
                $imgName[$i] = $request->image[$i]->hashName();
            endfor;
            $images = array_filter($imgName);
        }else{
            $images = ['default.jpeg'];
        }//end of if

        $product = Product::create($request_data);
        foreach ($images as $image) :
            $product->images()->create(['image' => $image]);
        endforeach;
        Category::where('id', $request->category_id)->first()->update([
            'hasCount' => Category::where('id', $request->category_id)->first()->hasCount + 1,
        ]);
        session()->flash('success', __('site.added_successfully'));
        return redirect()->route('dashboard.products.index');

    }//end of store



    public function edit(Product $product)
    {
        $categories = Category::all();
        return view('dashboard.products.edit', compact('categories', 'product'));

    }//end of edit



    public function update(Request $request, Product $product)
    {
        $rules = ['category_id' => 'required',];

        foreach (config('translatable.locales') as $locale):
            $rules += [$locale . '.name' => ['required', Rule::unique('product_translations', 'name')->ignore($product->id, 'product_id')]];
            $rules += [$locale . '.description' => 'required'];
        endforeach;

        $rules += [
            'purchase_price' => 'required',
            'sale_price' => 'required',
            'stock' => 'required',
            'start_discount' => '',
            'end_discount' => '',
        ];

        $request->validate($rules);
        $request_data = $request->all();

    // Update Images
        if ($request->image) :

            // Delete Old Images
            foreach($product->images as $image):
                if ($image->image != 'default.jpeg') :
                    Storage::disk('public_uploads')->delete('/product_images/' . $image->image);
                endif;
                $image->destroy($image->id);
            endforeach;

            // Store New Images
            for($i = 0; $i < count($request->image); $i++):
                Image::make($request->image[$i])
                ->resize(140, null, function ($constraint) {
                    $constraint->aspectRatio();
                })->save(public_path('uploads/product_images/' . $request->image[$i]->hashName()));
                $imgName[$i] = $request->image[$i]->hashName();
            endfor;
            $images = array_filter($imgName);

            foreach ($images as $image) :
                $product->images()->create(['image' => $image]);
            endforeach;

        endif;
    // End Update Images

    $product->update($request_data);

        if(date('d-m-Y', strtotime($request_data['start_discount'])) != "01-01-1970"){
            $product->update([
                'start_discount' => $request_data['start_discount'],
                'end_discount' => $request_data['end_discount'],
            ]);
        }
        session()->flash('success', __('site.updated_successfully'));
        return redirect()->route('dashboard.products.index');

    }//end of update



    public function destroy(Product $product)
    {

        Category::where('id', $product->category_id)->first()->update([
            'hasCount' => Category::where('id', $product->category_id)->first()->hasCount - 1,
        ]);
        $product->delete();
        session()->flash('success', __('site.deleted_successfully'));
        return redirect()->back();

    }//end of destroy

    public function restore($id)
    {
        $product = Product::onlyTrashed()->find($id)->restore();
        session()->flash('success', __('site.restore_successfully'));
        return redirect()->back();

    }//end of destroy

}//end of controller
