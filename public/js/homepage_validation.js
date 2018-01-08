// Wait for the DOM to be ready
$(function () {
    setTimeout(function(){
        $('body').removeClass('hidden');
    }, 500);

    console.log(window.location.hash, 'window.location.hash');
    
    if(window.location.hash == '#!#login' || window.location.hash == '#login'){
        console.log(window.location.hash, 'window.location.hash');
        $('.btn-login').closest('.dropdown').addClass('open');
    }
    
    // $("#login-nav").on('submit', (function (e) {

    //     var $self = $(this);
    //     var $btn = $self.find('[type="submit"]');
    //     $btn.button('loading');

    //     var name1 = $('#first_name').val();

    //     var fd = new FormData(this);

    //     fd.append("name", name1);

    //     console.log($("#login-nav").serializeArray(), 'fd');


    //     e.preventDefault();

    //     $.ajax({

    //         url: base_url + "/ajaxLogin",
    //         type: "POST",
    //         data: fd,
    //         contentType: false,
    //         cache: false,
    //         processData: false,
    //         respond: 'json',
    //         success: function (data) {
    //             console.log(data);

    //             if (data == '0') {
    //                 $btn.button('reset');
    //                 $('#errorMessageLog').html('<div class="alert alert-danger">Username or password did not match.</div>');
    //             } else {
    //                 $('#errorMessageLog').html('<div class="alert alert-success">You are now logged in!</div>');

    //                 setTimeout(function () {
    //                     if(uri_1 == ''){
    //                         window.location.href = base_url + '/profile';
    //                     }
    //                     else{
    //                         window.location.reload(true);
    //                     }
    //                 }, 1500);
    //                 //window.location.href = data;
    //             }
    //         },
    //         error: function (err) {
    //             console.log(err);
    //             $('#errorMessageLog').html('<div class="alert alert-danger">Something went wrong.</div>');
    //             $btn.button('reset');

    //         }
    //     });


    //     //window.location.href = '<?php echo url();?>/match'+'?name='+$('#first_name').val();

    //     return false;

    // }));


    $(".form-control-number").keypress(function (e) {
        //if the letter is not digit then display error and don't type anything
        if (e.which != 8 && e.which != 0 && (e.which < 48 || e.which > 57)) {
            return false;
        }
    });
    $(".topheading_btn").click(function () {
        $(".searchpeople-form_box").toggle(500);
    });
    $(".welcomebox_btm").click(function () {
        $(".welcomebox_hid").toggle(500);
    });

    var current_page = 1;

    $("#section1").validationEngine({
        promptPosition: "bottomLeft",
        scroll: false,
        onSuccess: function () {
            $('.section2').removeClass('vishidden');
            $('.section1').addClass('vishidden');
        }
    });

    $("#section2").validationEngine({
        promptPosition: "bottomLeft",
        scroll: false,
        onSuccess: function () {
            window.location.href = $('.findmatch').data('href') + '?name=' + $('#first_name').val();
        }
    });

    $('input[name="ima"]').change(function () {
        $('.ima_male,.ima_female').removeClass('active');
        if ($(this).is(':checked')) {
            $(this).parent('label').addClass('active');
        }
    });

    $('input[name="seek"]').change(function () {
        $('.seek_male,.seek_female').removeClass('active');
        if ($(this).is(':checked')) {
            $(this).parent('label').addClass('active');
        }
    });

    $('.letsgo').click(function () {
        $("#section1").validationEngine('validate')
    });

    $('.findmatch').click(function () {
        $("#section2").validationEngine('validate')
    });

    $('.goback').click(function () {
        $('.section2').addClass('vishidden');
        $('.section1').removeClass('vishidden');
    });

    $('.bxslider').bxSlider({
        mode: 'fade',
        pager: false,
    });

    $('.bxslider1').bxSlider({
        minSlides: 7,
        maxSlides: 8,
        slideWidth: 88,
        slideMargin: 33,
        pager: false,
    });

    $('.bxslider2').bxSlider({
        minSlides: 1,
        maxSlides: 1,
        slideWidth: 516,
        slideMargin: 17,
        pager: false,
    });

    $("#icon-fb").click(function (e) {
        e.preventDefault();
        FB.ui({
            method: 'send',
            link: 'http://seriousdatings.com',
        });
    });


    $('.bx-loading').hide();


    function getPrevUsers(callback) {

        $.ajax({
                type: "GET",
                dataType: 'json',
                url: base_url+'/user/paginate', // this is a variable that holds my route url
                data: {
                    'page': window.current_page - 1 // you might need to init that var on top of page (= 0)
                }
            })

            .done(function (response) {
                var usersObj = $.parseJSON(response.user);
                console.log(usersObj);
                window.current_page = usersObj.current_page;

                // hide the [load more] button when all pages are loaded

                if (usersObj.prev_page_url == null) {
                    $('#load-less-users').parents('li').addClass('disabled');
                    $('#load-more-users').parents('li').removeClass('disabled');
                }
                $(".just-registered-loading").hide();
                callback(usersObj);
            })

            .fail(function (response) {
                console.log("Error: " + response);
            });
    }

    function getUsers(callback) {

        $.ajax({
                type: "GET",
                dataType: 'json',
                url: base_url+ '/user/paginate', // this is a variable that holds my route url
                data: {
                    'page': window.current_page + 1 // you might need to init that var on top of page (= 0)
                }
            })

            .done(function (response) {
                var usersObj = $.parseJSON(response.user);
                console.log(usersObj);
                window.current_page = usersObj.current_page;

                // hide the [load more] button when all pages are loaded
                if (usersObj.next_page_url == null) {
                    $('#load-more-users').parents('li').addClass('disabled');
                    $('#load-less-users').parents('li').removeClass('disabled');
                }
                $(".just-registered-loading").hide();
                callback(usersObj);
            })
            .fail(function (response) {
                console.log("Error: " + response);
            });
    }

    /**
    
         * @param usersObj
    
         */
    function displayUsers(usersObj) {
        var options = '';
        $.each(usersObj.data, function (key, value) {
            options = options + "<li><a href='"+base_url+"/users/" + value.username + "'>";
            options = options + "<div class='img-container' style='background-image: url(\"public/images/users/" + value.username + "/" + value.photo + "\")'>";
            options = options + "</div><span>" + value.username + "</span></a></li>";
        });
        $('.just-registered-box').html(options);
    }

    // listener to the [load more] button

    $('#load-more-users').on('click', function (e) {
        e.preventDefault();
        $(".just-registered-loading").show();
        getUsers(function (usersObj) {
            displayUsers(usersObj);
        });
    });

    $('#load-less-users').on('click', function (e) {
        e.preventDefault();
        $(".just-registered-loading").show();
        getPrevUsers(function (usersObj) {
            displayUsers(usersObj);
        });
    });

    $("#section2").on('submit', (function (e) {
        // $("#section2").validationEngine('validate')
        var name1 = $('#first_name').val();
        var fd = new FormData(this);
        fd.append("name", name1);
        e.preventDefault();
        $.ajax({
            url: base_url+"/profileupload",
            type: "POST",
            data: fd,
            contentType: false,
            cache: false,
            processData: false,
            success: function (data) {},
            error: function () {}
        });
        window.location.href = base_url+'/match' + '?name=' + $('#first_name').val();
        return false;
    }));


});