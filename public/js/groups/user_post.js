$(document).ready(function () {

    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    $(document).on('click', '#imgBtn', function () {
        $(this).removeClass().addClass('btn btn-danger');
        $('#txtBtn, #vidBtn').removeClass().addClass('btn btn-secondary');
        $('#video').hide();
        $('#text').hide();
        $('#image').show();
    });

    $(document).on('click', '#txtBtn', function () {
        $(this).removeClass().addClass('btn btn-danger');
        $('#imgBtn, #vidBtn').removeClass().addClass('btn btn-secondary');
        $('#video').hide();
        $('#text').show();
        $('#image').hide();
    });

    $(document).on('click', '#vidBtn', function () {
        $(this).removeClass().addClass('btn btn-danger');
        $('#imgBtn, #txtBtn').removeClass().addClass('btn btn-secondary');
        $('#video').show();
        $('#text').hide();
        $('#image').hide();
    });

    $(document).on('click', '#vidSaveBtn', function () {
        var message = {
            type_id: 3,
            group_name: $('.groupName').text(),
            link: $('#videoLink').val()
        };


        $.ajax({
            type: 'POST',
            url: base_url + '/groupMemberPostVideo',
            data: message,
            cache: false,
            success: function (value) {
                if (value.status) {
                    $.each(value.message, function (key, value) {
                        toastr.error(value);
                    });
                } else {
                    toastr.info('Success!');
                    setTimeout(
                        function()
                        {
                            location.reload();
                        }, 2500);
                }

            },
            error: function (data) {
                $.each(data.responseJSON, function (key, value) {
                    toastr.error(value);
                });
            }
        });
    });


    $(document).on('click', '#txtSaveBtn', function () {
        var message = {
            type_id: 1,
            group_name: $('.groupName').text()
        };

        message['post'] = $.trim(CKEDITOR.instances['editor1'].getData());

        if (!message.post) {
            toastr.error('Your post is empty.');
        } else {
            $.ajax({
                type: 'POST',
                url: base_url + '/groupMemberPostTxt',
                data: message,
                cache: false,
                success: function (value) {
                    console.log(value);
                    toastr.info('Success!');
                    setTimeout(
                        function()
                        {
                            location.reload();
                        }, 2500);
                },
                error: function (data) {
                    $.each(data.responseJSON, function (key, value) {
                        toastr.error(value);
                    });
                }
            });
        }

    });

    /* POST IMAGE */
    // Variable to store your files
    var files;

    // Add events
    $('input[type=file]').on('change', prepareUpload);

    function prepareUpload(event) {
        files = event.target.files;
        $('#imgSaveBtn').prop('disabled', false);
    }

    // Grab the files and set them to our variable
    $(document).on('click', '#imgSaveBtn', uploadFiles);


    function uploadFiles(event) {
        event.stopPropagation(); // Stop stuff happening
        event.preventDefault(); // Totally stop stuff happening

        var data = new FormData();
        $.each(files, function (key, value) {
            data.append('image', value);
        });
        data.append('groupName', $('.groupName').text());
        data.append('type_id', 2);

        console.log(data)
        $.ajax({
            type: 'POST',
            url: base_url + '/groupMemberPostImg',
            data: data,
            cache: false,
            dataType: 'json',
            processData: false, // Don't process the files
            contentType: false, // Set content type to false as jQuery will tell the server its a query string request
            success: function (data) {
                toastr.info('Success!');
                setTimeout(
                    function()
                    {
                        location.reload();
                    }, 2500);
            },
            error: function (value) {
                $.each(value.responseJSON, function (key, value) {
                    toastr.error(value);
                });
            }
        });
        /* END POST IMAGE */
    }

    toastr.options =
        {
            "closeButton": false,
            "debug": false,
            "newestOnTop": false,
            "progressBar": false,
            "positionClass": "toast-top-center",
            "preventDuplicates": false,
            "onclick": null,
            "showDuration": "300",
            "hideDuration": "1000",
            "timeOut": "2500",
            "extendedTimeOut": "1000",
            "showEasing": "swing",
            "hideEasing": "linear",
            "showMethod": "fadeIn",
            "hideMethod": "fadeOut"
        }
});