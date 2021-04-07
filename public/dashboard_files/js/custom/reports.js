$(document).ready(function () {

    //list all order products
    $('.report-orders').on('click', function(e) {

        e.preventDefault();

        $('#loading').css('display', 'flex');

        var url = $(this).data('url');
        var method = $(this).data('method');
        var data = $('form').serialize();

        $.ajax({
            url: url,
            method: method,
            data: data,
            success: function(data) {

                $('#loading').css('display', 'none');
                $('#report-orders-list').empty();
                $('#report-orders-list').append(data);

            }
        })

    });//end of order products click

    //Print Reports
    $(document).on('click', '.print-btn', function() {
        $('#print-area').printThis();
    });//end of click function

});//end of document ready

