(function ($) {
    $('.blazethemes-demo-importer-modal-button').on('click', function (e) {
        e.preventDefault();
        $('body').addClass('blazethemes-demo-importer-modal-opened');
        var modalId = $(this).attr('href');
        $(modalId).fadeIn();
    });

    $('.blazethemes-demo-importer-modal-back, .blazethemes-demo-importer-modal-cancel').on('click', function (e) {
        $('body').removeClass('blazethemes-demo-importer-modal-opened');
        $('.blazethemes-demo-importer-modal').hide();
        $("html, body").animate({scrollTop: 0}, "slow");
    });

    $('body').on('click', '.blazethemes-demo-importer-import-demo', function () {
        var $el = $(this);
        var demo = $(this).attr('data-demo-slug');
        var reset = $('#checkbox-reset-' + demo).is(':checked');
        var reset_message = '';

        if (reset) {
            reset_message = blazethemes_demo_importer_ajax_data.reset_database;
            var confirm_message = 'Are you sure to proceed? Resetting the database will delete all your contents.';
        } else {
            var confirm_message = 'Are you sure to proceed?';
        }

        $import_true = confirm(confirm_message);
        if ($import_true == false)
            return;

        $("html, body").animate({scrollTop: 0}, "slow");

        $('#blazethemes-demo-importer-modal-' + demo).hide();
        $('#blazethemes-demo-importer-import-progress').show();

        $('#blazethemes-demo-importer-import-progress .blazethemes-demo-importer-import-progress-message').html(blazethemes_demo_importer_ajax_data.prepare_importing).fadeIn();

        var info = {
            demo: demo,
            reset: reset,
            next_step: 'blazethemes_demo_importer_install_demo',
            next_step_message: reset_message
        };

        setTimeout(function () {
            do_ajax(info);
        }, 2000);
    });

    function do_ajax(info) {
        if (info.next_step) {
            var data = {
                action: info.next_step,
                demo: info.demo,
                reset: info.reset,
                security: blazethemes_demo_importer_ajax_data.nonce
            };

            jQuery.ajax({
                url: ajaxurl,
                type: 'post',
                data: data,
                beforeSend: function () {
                    if (info.next_step_message) {
                        $('#blazethemes-demo-importer-import-progress .blazethemes-demo-importer-import-progress-message').hide().html('').fadeIn().html(info.next_step_message);
                    }
                },
                success: function (response) {
                    var info = JSON.parse(response);

                    if (!info.error) {
                        if (info.complete_message) {
                            $('#blazethemes-demo-importer-import-progress .blazethemes-demo-importer-import-progress-message').hide().html('').fadeIn().html(info.complete_message);
                        }
                        setTimeout(function () {
                            do_ajax(info);
                        }, 2000);
                    } else {
                        $('#blazethemes-demo-importer-import-progress .blazethemes-demo-importer-import-progress-message').html(info.error_message);
                        $('#blazethemes-demo-importer-import-progress').addClass('import-error');

                    }
                },
                error: function (xhr, status, error) {
                    var errorMessage = xhr.status + ': ' + xhr.statusText
                    $('#blazethemes-demo-importer-import-progress .blazethemes-demo-importer-import-progress-message').html(blazethemes_demo_importer_ajax_data.import_error);
                    $('#blazethemes-demo-importer-import-progress').addClass('import-error');
                }
            });
        } else {
            $('#blazethemes-demo-importer-import-progress .blazethemes-demo-importer-import-progress-message').html(blazethemes_demo_importer_ajax_data.import_success);
            $('#blazethemes-demo-importer-import-progress').addClass('import-success');
        }
    }
})(jQuery);
