jQuery(function($) {
    $(document).on('click', '.pagination a', function(e) {
        e.preventDefault();
        var link = $(this).attr('href');
        ajax_pagination(link);
    });

    function ajax_pagination(link) {
        $.ajax({
            type: 'GET',
            url: link,
            success: function(response) {
                $('.products').html(response);
            }
        });
    }
});
