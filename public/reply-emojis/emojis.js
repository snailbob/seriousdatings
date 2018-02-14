var responseEmojis;

var emojisReply = function (SenderID) {
   responseEmojis = $.confirm({
    title: false,
    content: 'url:'+base_url+'/public/reply-emojis/list-emojis.html',
    lazyOpen: true,
    onContentReady: function () {
        var base_urlPath = base_url+'/public/images/GIF-NOTI/';
        var listOFimg = ['gif-wink.gif','kissmack.gif','love-u.gif'];

        var self = this;
            $.each(listOFimg,function(i){
                var imgSrc = base_urlPath+listOFimg[i];
                var emojiSrc = listOFimg[i];
                   self.$content.find('#listOfemojis').append('<img class="img-thumbnail gif-emojis" style="height: 90px"'+
                                                              'src="'+imgSrc+'"'+
                                                              'onclick="sendTo(\''+SenderID+'\',\''+emojiSrc+'\','+i+')">');
            });
         
    }
    });
   responseEmojis.open();
}

var emojistDesc = ['wink','Smack kiss','Love']
var sendTo = function(to,emojiType,i){

    var emojistDescText = emojistDesc[i];
    sendNotification(getMyId(),getMyFullName(),to,'replyemoji',{ src:emojiType,desc:emojistDescText });
    responseEmojis.close();
}

