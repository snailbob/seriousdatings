$(document).ready(function () {
    
    if(history.length > 2){
        $('.back-btn').removeClass('hidden');
        $('.back-btn').on('click', function(){
            history.back();
        });
    }

    // $("#mate-carousel").flipster({
    //     style: 'carousel',
    //     spacing: 1,
    //     nav: false,
    //     buttons: true,
    //     scrollwheel: false,
    //     touch: false
    // });

    function findGetParameter(parameterName) {
        var result = null,
            tmp = [];
        var items = location.search.substr(1).split("&");
        for (var index = 0; index < items.length; index++) {
            tmp = items[index].split("=");
            if (tmp[0] === parameterName) result = decodeURIComponent(tmp[1]);
        }
        return result;
    }

    // console.log('wow');
    setTimeout(function(){
        $('body').removeClass('hidden');
    }, 500);


    //my photos
    $('#multi_image').change(function () {

        var selection = document.getElementById('multi_image');
        for (var i = 0; i < selection.files.length; i++) {
            var ext = selection.files[i].name.substr(-3);
            if (ext !== "jpg" && ext !== "jpeg" && ext !== "png" && ext !== "gif") {
                alert('Please Upload Only Jpg, Png, Gif, Jpeg File.');
                $('#multi_image').val('');
                return false;
            }
        }
    });

    
    //my music
    $('#mp3_file').change(function () {
        var selection = document.getElementById('mp3_file');
        for (var i = 0; i < selection.files.length; i++) {
            var ext = selection.files[i].name.substr(-3);
            if (ext !== "mp3") {
                alert('Please Upload Only mp3 File.');
                $('#mp3_file').val('');
                return false;
            }
        }
    });

    //my video
    $('#offline').hide();
    $('#online').hide();

    $('#video_type').change(function () {
        if ($(this).find(':selected').val() === '0') {

            $('#online').hide();
            $('#offline').show();
        } else if ($(this).find(':selected').val() === '1') {

            $('#offline').hide();
            $('#online').show();
        } else {

            $('#offline').hide();
            $('#online').hide();
        }
        
    });

    
    $('#multi_video').change(function () {
        /* var ext = $('#multi_image').val().split('.').pop().toLowerCase();
    if($.inArray(ext, ['jpe','gif','png','jpeg']) == -1) {
        alert('You Can Only Upload Jpg, Png, Gif, Jpeg File.');
        $('#multi_image').val('');
    }*/

        var selection = document.getElementById('multi_video');
        for (var i = 0; i < selection.files.length; i++) {
            var ext = selection.files[i].name.substr(-3);
            if (ext !== "mp4" && ext !== "jpeg" && ext !== "png" && ext !== "gif") {
                alert(' Please Upload Only mp4 Video.');
                $('#multi_video').val('');
                return false;
            }
        }
        //your validation
    });


    function validateYouTubeUrl() {
        var url = $('#youTubeUrl').val();
        if (url != undefined || url != '') {
            var regExp = /^.*(youtu.be\/|v\/|u\/\w\/|embed\/|watch\?v=|\&v=|\?v=)([^#\&\?]*).*/;
            var match = url.match(regExp);
            //alert(match);
            if (match && match[2].length == 11) {
                // Do anything for being valid
                // if need to change the url to embed url then use below line            
                //$('#videoObject').attr('src', 'https://www.youtube.com/embed/' + match[2]);
            } else {
                alert('Video Url Is Not valid');
                $('#youTubeUrl').val('');
                return false;
                // Do anything for not being valid
            }

        }
    }


    $("#login-nav").on('submit', (function (e) {

        var $self = $(this);
        var $btn = $self.find('[type="submit"]');
        $btn.button('loading');

        var name1 = $('#first_name').val();

        var fd = new FormData(this);

        $('#errorMessageLog').html('');

        fd.append("name", name1);

        console.log($("#login-nav").serializeArray(), 'fd');

        e.preventDefault();

        $.ajax({

            url: base_url+"/ajaxLogin",
            type: "POST",
            data: fd,
            contentType: false,
            cache: false,
            processData: false,
            respond: 'json',
            success: function (data) {
                console.log(data);

                if (data == '0') {
                    $btn.button('reset');
                    $('#errorMessageLog').html('<div class="alert alert-danger">Username or password did not match.</div>');
                } else {
                    $('#errorMessageLog').html('<div class="alert alert-success">You are now logged in!</div>');
                    console.log(($('#username').val() == 'admin'), $('#username').val());
                    setTimeout(function () {
                        var rdr = findGetParameter('redirect');
                        console.log(rdr, (rdr !== null), 'rdr');
                        if($('#username').val() == 'admin'){
                            window.location.href = base_url + '/admin';
                        }
                        else if(rdr !== null){
                            window.location.href = rdr;
                        }

                        else{
                            window.location.reload(true);
                        }
                    }, 1500);
                    //window.location.href = data;
                }
            },
            error: function (err) {
                console.log(err);
                $('#errorMessageLog').html('<div class="alert alert-danger">Something went wrong.</div>');
                $btn.button('reset');

            }
        });


        //window.location.href = '<?php echo url();?>/match'+'?name='+$('#first_name').val();

        return false;

    }));

    $("#groupCreate").validate();
    

    // console.log($("#contactForm").length, '$("#contactForm")', $("#contactForm").validate());

    $(".form-control-number").keypress(function (e) {
        //if the letter is not digit then display error and don't type anything
        if (e.which != 8 && e.which != 0 && (e.which < 48 || e.which > 57)) {
            return false;
        }
    });

});

$(document).ready(function () {

    // console.log(window.location.hash, 'window.location.hash');
    
    if(window.location.hash == '#!#login' || window.location.hash == '#login'){
        console.log(window.location.hash, 'window.location.hash');
        $('.btn-login').closest('.dropdown').addClass('open');
    }
    
    var json = (typeof(calendar_events) !== 'undefined') ? $.parseJSON(calendar_events) : [];
    
    var date = new Date();
    var d = date.getDate();
    var m = date.getMonth();
    var y = date.getFullYear();


    setTimeout(function(){
        if($('#fullcalendar').length){
            $('#fullcalendar').fullCalendar({
                editable: true,
                height: 300,
                header: {
                    left: 'title',
                    center: '',
                    right: 'today prev,next'
                },
    
                eventClick: function (calEvent, jsEvent, view) {
    
                    console.log("Clicked");
                    var id = calEvent.title;
                    var url = "{!! url() !!}/events/" + id;
                    window.location.href = url;
    
    
                    $("#name").val(calEvent.id);
    
    
                    $("#title").val(calEvent.title);
                    $("#desc").val(calEvent.desc);
    
                    $('#dialog').dialog('open');
                },
    
                events: json
            });
        }
    }, 500);


});

$(document).ready(function(){

   
 
    //group add
    //set initial state.
    $('#checkAll').val($(this).is(':checked'));

    $('#checkAll').change(function() {

        if($(this).is(":checked")) {
              //$('members').attr('checked','checked');
              $("div.cell input[type='checkbox']").attr('checked','checked');
        }
        else{

         $("div.cell input[type='checkbox']").removeAttr('checked');        }
                
    });
    //group add
        
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    if(typeof(group_info) !== 'undefined'){

        var token = $('meta[name="csrf-token"]').attr('content');

        var groupID = group_info.groupID;

        var userID = group_info.logged_in;

        var url = base_url + '/groups/' + groupID;


        $('#unJoin').click(function () {

            var dataToSend = '{ "data" : [' + '{ "action":"unjoin" ,"_token":"' + token + '","groupID":"' + groupID + '" , "userID":"' + userID + '"}]}';

            var obj = JSON.parse(dataToSend);

            $.ajax({
                    url: base_url+'/ajax/group',
                    type: 'POST',
                    data: {
                        'data': obj
                    },
                    success: function (ajax_result) {
                        var result = (ajax_result);
                        window.location.href = url;
                    }
                })
                .done(function () {})
                .fail(function () {});
        });


        $('#joinNow').click(function () {

            var dataToSend = '{ "data" : [' + '{ "action":"join" ,"_token":"' + token + '","groupID":"' + groupID + '" , "userID":"' + userID + '"}]}';

            var obj = JSON.parse(dataToSend);

            $.ajax({
                    url: base_url+'/ajax/group',
                    type: 'POST',
                    data: {
                        'data': obj
                    },
                    success: function (ajax_result) {
                        var result = (ajax_result);
                        window.location.href = url;
                    }
                })
                .done(function () {})
                .fail(function () {});
        });
    }



});

/*view all messages info */

function viewFullMessages(id, m_id) {
    $('.remove-'+m_id).removeClass('animate-container');

    var data_link = base_url + '/api/messagesview';
    var user_FirstName,user_id;
    $.confirm({
        content: function () {
            var self = this;
            return $.ajax({
                url: data_link,
                dataType: 'json',
                data: {
                    'id': m_id
                },
                method: 'get'
            }).done(function (response) {
                console.log("view: SMS", response);
                self.setContent('Subject:<b> ' + response[0].m_subject + '</b>');
                self.setContentAppend('<br>Message: ' + response[0].m_message);
                self.setTitle("From: " + response[0].firstName);
                user_FirstName = response[0].firstName;
                user_id = response[0].m_from_id;
            }).fail(function () {
                self.setContent('Something went wrong.');
            });
        },
        icon: 'fa fa-user',
        theme: 'material',
        animation: 'rotateY',
        type: 'red',
        buttons: {
                 heyThere: {
                        text: 'Reply', // text for button
                        btnClass: 'btn-blue', // class for the button
                        keys: ['enter', 'a'], // keyboard event for button
                        isHidden: false, // initially not hidden
                        isDisabled: false, // initially not disabled
                        action: function(heyThereButton){
                            
                            var scope = angular.element(document.getElementById('plain-code')).scope();
                                    scope.createSMS(user_id,user_FirstName);
                        }
                    },
                close: function () {

                }
            },
    });
}

function parentCreatSMS(user_id,user_FirstName){
    var scope = angular.element(document.getElementById('plain-code')).scope();
    scope.createSMS(user_id,user_FirstName);
}

