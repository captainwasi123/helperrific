var host = 'https://dnpprojects.com/demo/helperrific';

function getNotification(id, key){
  var pusher = new Pusher(key, {
    cluster: 'ap2'
  });
 
  var channel = pusher.subscribe('noti-chatChannel.'+id);
  channel.bind('notiChat', function(data) {
    notiSound();
  });
}

function getMessage(id1, id2, key){
  var pusher = new Pusher(key, {
    cluster: 'ap2'
  });

  var channel = pusher.subscribe('send-chatChannel.'+id1+'.'+id2);
  channel.bind('sendChat', function(data) {
     notiSound();
     var response = data;
     var chat_block = '<div class="sender-message1"><img alt="user-profile-avatar" src="'+host+'/public/profile_img/'+response.image+'" onerror="this.onerror=null;this.src='+host+'/public/user-placeholder.jpg;"/><h5> '+response.name+' <span class="col-grey"> '+response.timestamp+'  </span> </h5><div class="chat-message-1"><p class="newMessage"> '+response.message+'  </p><div class="report-dropdown"><div class="dropdown"><button class="btn btn-default dropdown-toggle" type="button" id="dropdownMenu1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true"><i class="fas fa-ellipsis-v"></i></button><ul class="dropdown-menu" aria-labelledby="dropdownMenu1"><li><a href="javascript:void(0)" data-id=""> Report  </a> </li></ul></div></div></div></div>';

     $('#talksall').append(chat_block);
     chatScrollDown();

  });
}