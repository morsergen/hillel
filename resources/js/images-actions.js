$(function () {
    $(document).on('click', '.close_preview_btn', function (e) {console.log(1111111111111111);
        e.preventDefault();
        let $btn = $(this);

        $.ajax({
            headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') },
            url: $btn.data('route'),
            type: 'DELETE',
            dataType: 'json',
            success: function (data) {
                $btn.parent().remove();
            },
            error: function (data) {
                console.log('Error: ', data);
            }
        });
    });
});
