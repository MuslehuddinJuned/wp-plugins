jQuery(document).ready(function ($) {
    $(document.getElementsByClassName('hide-admin-cb')).click(function (event) {
        var data = {
            action: 'our-ajax-action-name',
            security: LearnWPAjax.security
        };

        $.ajax({
            type: "POST",
            url: ajaxurl,
            data: data,
            success: function (response) {
                // alert('Success !');
            },
            error: function (response) {
                // alert('Error !');
            },
            dataType: 'json'

        });
    });
});
