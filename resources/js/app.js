require('./bootstrap');

import Alpine from 'alpinejs';

window.Alpine = Alpine;

Alpine.start();


$(document).ready(function () {
    $('[name="all_permission"]').on('click', function () {

        if ($(this).is(':checked')) {
            $.each($('.permission'), function () {
                $(this).prop('checked', true);
            });
        } else {
            $.each($('.permission'), function () {
                $(this).prop('checked', false);
            });
        }

    });
});

