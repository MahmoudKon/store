// For Products
$(".images").change(function () {

    $('#images-preview').html("");
    for(var i = 0; i < this.files.length; i++){
    if (this.files && this.files[i]) {
        var reader = new FileReader();
        reader.onload = function (e) {
            $('#images-preview').prepend("<div class='img-thumbnail remove-img'><span class='remove'>X</span><img src='"+e.target.result+"' style='width: 150px'></div>");
            }
    }
    reader.readAsDataURL(this.files[i]);
}

});

$('#images-preview .remove-img span').click(function(){
    $(this).parent('div').fadeOut();
});


// For Customers and Users
$(".image").change(function () {

    if (this.files && this.files[0]) {
        var reader = new FileReader();

        reader.onload = function (e) {
            $('.image-preview').attr('src', e.target.result);
        }

        reader.readAsDataURL(this.files[0]);
    }

});
