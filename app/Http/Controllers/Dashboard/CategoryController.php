<?php

namespace App\Http\Controllers\Dashboard;

use App\Category;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Validation\Rule;

class CategoryController extends Controller
{
    public function __construct()
    {
        foreach (Category::all() as $category) {
            $category->update([
                'hasCount' => $category->products()->count(),
            ]);
        }
    }// end of __construct

    public function index(Request $request)
    {
        $categories = Category::when($request->search, function ($q) use ($request) {

            return $q->whereTranslationLike('name', '%' . $request->search . '%');

        })->latest()->paginate(5);

        return view('dashboard.categories.index', compact('categories'));

    }//end of index

    public function create()
    {
        return view('dashboard.categories.create');

    }//end of create

    public function store(Request $request)
    {
        $rules = [];

        foreach (config('translatable.locales') as $locale) {

            $rules += [$locale . '.name' => ['required', Rule::unique('category_translations', 'name')]];

        }//end of for each

        $request->validate($rules);

        Category::create($request->all());
        session()->flash('success', __('site.added_successfully'));
        return redirect()->route('dashboard.categories.index');

    }//end of store

    public function edit(Category $category)
    {
        return view('dashboard.categories.edit', compact('category'));

    }//end of edit

    public function update(Request $request, Category $category)
    {
        $rules = [];

        foreach (config('translatable.locales') as $locale) {

            $rules += [$locale . '.name' => ['required', Rule::unique('category_translations', 'name')->ignore($category->id, 'category_id')]];

        }//end of for each

        $request->validate($rules);

        $category->update($request->all());
        session()->flash('success', __('site.updated_successfully'));
        return redirect()->route('dashboard.categories.index');

    }//end of update

    public function destroy(Category $category)
    {
        $category->delete();
        foreach($category->products as $product):
            $product->delete();
        endforeach;
        session()->flash('success', __('site.deleted_successfully'));
        return redirect()->route('dashboard.categories.index');
    }//end of destroy

    public function restore($id)
    {
        Category::onlyTrashed()->find($id)->restore();
        $category = Category::find($id);
        foreach($category->productsOnlyTrashed as $product) :
            $product->restore();
        endforeach;
        session()->flash('success', __('site.restore_successfully'));
        return redirect()->back();
    }//end of destroy

    public function deleted(Request $request)
    {
        $categories = Category::onlyTrashed()->when($request->search, function ($q) use ($request) {

            return $q->whereTranslationLike('name', '%' . str_replace('_', ' ', $request->search) . '%');

        })->latest()->paginate(5);

        return view('dashboard.categories.deleted', compact('categories'));

    }//end of index

}//end of controller
