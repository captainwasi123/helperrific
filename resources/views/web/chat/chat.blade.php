@extends('web.support.master')
@section('title', 'Chat')

@section('content')
@php $list_item = array(); @endphp

<section class="p-t-60 p-b-60 bg-inbox">
   <div class="container">
      <div class="row bg-white">
         <div class="col-md-12 col-lg-12 col-sm-12 col-xs-12 no-pad">
            <div class="all-messages">
               <div class="conversation-head" style="padding: 15px 11px;">
               <div class="listing-filters">
                   <select class="chat_filter" name="chattype" id="chattype" style="width:auto;background:none;color:#1f1d1d">
                      <option value="1"> All Conversations </option>
                        <option value="2"> Unread </option>
                        <option value="3"> Starred </option>
                  </select>
               </div>
                  <!-- <h3> All Conversations  <button class="chat-toggle"> <i class="fa fa-angle-down"> </i> </button> </h3> -->
               </div>
               <div class="conversations-all max-height1" id="content_chat_type">
                  @foreach($chat_list as $val)
                     @if($val->sender_id != Auth::id())
                        @if(!in_array($val->sender_id, $list_item))
                           <div>
                              <a href="{{URL::to('/inbox/chat/'.base64_encode($val->sender->id))}}/{{$val->sender->type == '3' ? $val->sender->company : $val->sender->fname }}">
                                 <img alt="user-profile-avatar" src="{{URL::to('/')}}/public/profile_img/{{$val->sender->profile_img}}" onerror="this.onerror=null;this.src='{{URL::to('/')}}/public/user-placeholder.jpg';"/>
                                 <h6> {{$val->sender->type == '3' ? $val->sender->company : $val->sender->fname}}  </h6>
                                 <p title="{{$val->message}}"> {{$val->message}} </p>
                                 <span class="time-tag"> {{$val->created_at->diffForHumans()}} </span>
                              </a>
                           </div>
                           @php array_push($list_item, $val->sender_id); @endphp
                        @endif
                     @else
                        @if(!in_array($val->receiver_id, $list_item))
                           <div>
                              <a href="{{URL::to('/inbox/chat/'.base64_encode($val->receiver->id))}}/{{$val->receiver->type == '3' ? $val->receiver->company : $val->receiver->fname }}">
                                 <img alt="user-profile-avatar" src="{{URL::to('/')}}/public/profile_img/{{$val->receiver->profile_img}}" onerror="this.onerror=null;this.src='{{URL::to('/')}}/public/user-placeholder.jpg';"/>
                                 <h6> {{$val->receiver->type == '3' ? $val->receiver->company : $val->receiver->fname}}  </h6>
                                 <p title="{{$val->message}}">{{$val->message}} </p>
                                 <span class="time-tag"> {{$val->created_at->diffForHumans()}} </span>
                              </a>
                           </div>
                           @php array_push($list_item, $val->receiver_id); @endphp
                        @endif
                     @endif
                  @endforeach  
                  @if(count($chat_list) == '0')
                     <div>
                        No Chats Found.
                     </div>
                  @endif                
               </div>
            </div>
            <div class="message-wrapper-top">
               <div class="chat-person-name">
                  <h5> {{$user->type == '3' ? $user->company : $user->fname}} </h5>
                  <p> Last seen 15m ago </p>
               </div>
               <div class="chat-actions">
               <a type="button" class="follow_up" data-chat_type="3" data-receiver="{{$receiver}}"> <i class="far fa-star"></i> </a>
               <!-- <a type="button" class="follow_up" data-chat_type="2" data-receiver="{{$receiver}}"> <i class="far fa-envelope-open"></i> </a>
               <a type="button" class="follow_up" data-chat_type="4" data-receiver="{{$receiver}}"> <i class="fas fa-inbox"></i> </a> -->
               <a type="button" id="delete_chat" data-receiver="{{$receiver}}"> <i class="far fa-trash-alt"></i> </a>
               <!-- <a type="button" class="follow_up" data-chat_type="5" data-receiver="{{$receiver}}"> <i class="fas fa-tag"></i> </a> -->
               </div>
            </div>
            <div class="message-wrapper-bottom">
               <div class="chat-wrapper" id="chatScroll">
                  <div class="chattings">
                     <div class="chat-open-head">
                        <h5> <b> We have your back </b> </h5>
                        <p> For Added Safety and your protection, keep payments and comunications within Helperrific </p>
                     </div>
                     <div class="talks-all" id="talksall">
                        @foreach($chat as $val)
                           @if($val->receiver_id == Auth::id())
                              <div class="sender-message1">
                                 <img alt="user-profile-avatar" src="{{URL::to('/')}}/public/profile_img/{{$val->sender->profile_img}}" onerror="this.onerror=null;this.src='{{URL::to('/')}}/public/user-placeholder.jpg';"/>
                                 <h5> {{$val->sender->type == '3' ? $val->sender->company : $val->sender->fname }} <span class="col-grey"> {{$val->created_at->diffForHumans()}} </span> </h5>
                                 <div class="chat-message-1">
                                    @if(!empty($val->file_attach))
                                       <div class="chatAttach">
                                          <span>{{$val->file_name}}</span>
                                          <a href="{{URL::to('/public/file_attached/'.$val->file_attach)}}" download="{{$val->file_name}}"><i class="fa fa-download"></i></a>
                                       </div>
                                    @endif
                                    <p> {{$val->message}} </p>
                                    <div class="report-dropdown">
                                       <div class="dropdown">
                                          <button class="btn btn-default dropdown-toggle" type="button" id="dropdownMenu1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
                                          <i class="fas fa-ellipsis-v"></i>
                                          </button>
                                          <ul class="dropdown-menu" aria-labelledby="dropdownMenu1">
                                             <li><a href="javascript:void(0)" data-id="{{base64_encode($val->id)}}"> Report  </a> </li>
                                          </ul>
                                       </div>
                                    </div>
                                 </div>
                              </div>
                           @else
                              <div class="sender-message2">
                                 <img alt="user-profile-avatar" src="{{URL::to('/')}}/public/profile_img/{{$val->sender->profile_img}}" onerror="this.onerror=null;this.src='{{URL::to('/')}}/public/user-placeholder.jpg';"/>
                                 <h5> {{$val->sender->type == '3' ? $val->sender->company : $val->sender->fname }} <span class="col-grey"> {{$val->created_at->diffForHumans()}} </span> </h5>
                                 @if(!empty($val->file_attach))
                                    <div class="chatAttach">
                                       <span>{{$val->file_name}}</span>
                                       <a href="{{URL::to('/public/file_attached/'.$val->file_attach)}}" download="{{$val->file_name}}"><i class="fa fa-download"></i></a>
                                    </div>
                                 @endif
                                 <p> {{$val->message}} </p>
                              </div>
                           @endif
                        @endforeach
                     </div>
                  </div>
                  <div class="send-box">
                     <form id="sendchat" enctype="multipart/form-data">
                        {{csrf_field()}}
                        <input type="hidden" name="msg_id" value="{{base64_encode($user->id)}}">
                        <input type="file" name="attachment" id="fileAttach">
                        <label id="fileAttachName"></label>
                        <textarea placeholder="Write your message..." name="message" data-emojiable="true" required></textarea>
                        <div class="send-actions">
                           <div>
                              <a href="javascript:void(0)" class="emojies"> <i class="far fa-smile"></i> </a> 
                              <label for="fileAttach"> <i class="fa fa-paperclip"> </i> </label>   
                           </div>
                           <button> Send </button>
                        </div>
                     </form>
                  </div>
               </div>
               <div class="about-welcome max-height1">
                  <h3> About </h3>
                  <h5> <img alt="user-profile-avatar" src="{{URL::to('/')}}/public/profile_img/{{$user->profile_img}}" onerror="this.onerror=null;this.src='{{URL::to('/')}}/public/user-placeholder.jpg';"/> {{$user->type == '3' ? $user->company : $user->fname}} </h5>
                  <table>
                     <tbody>
                        <tr>
                           <td> From </td>
                           <td> {{empty($user->details) ? '-' : $user->details->count->country}} </td>
                        </tr>
                        <tr><td colspan="2"><br><span class="badge badge-info">Languages</span></td></tr>
                        @foreach($user->langs as $val)
                           <tr>
                              <td> {{$val->language}} </td>
                              <td> {{$val->level}} </td>
                           </tr>
                        @endforeach
                        @if(count($user->langs) == '0')
                           <tr><td colspan="2">Undefined</td></tr>
                        @endif
                     </tbody>
                  </table>
               </div>
            </div>
         </div>
         <div class="col-md-3 col-lg-3 col-sm-12 col-xs-12 no-pad">
         </div>
      </div>
   </div>
</section>



@endsection
@section('addStyle')
     <link href="{{URL::to('/')}}/assets/emojies/css/emoji.css" rel="stylesheet">
@endsection
@section('addScript')
   <script src="{{URL::to('/')}}/assets/emojies/js/config.js"></script>
   <script src="{{URL::to('/')}}/assets/emojies/js/util.js"></script>
   <script src="{{URL::to('/')}}/assets/emojies/js/jquery.emojiarea.js"></script>
   <script src="{{URL::to('/')}}/assets/emojies/js/emoji-picker.js"></script>
   <script>
      $(document).ready(function(){
         chatScrollDown();

         getMessage('{{Auth::id()}}', '{{$user->id}}', '{{env("PUSHER_APP_KEY")}}');
      });
      $(function() {
        // Initializes and creates emoji set from sprite sheet
        window.emojiPicker = new EmojiPicker({
          emojiable_selector: '[data-emojiable=true]',
          assetsPath: '{{URL::to('/')}}/assets/emojies/img',
          popupButtonClasses: 'fa fa-smile-o'
        });
        // Finds all elements with `emojiable_selector` and converts them to rich emoji input fields
        // You may want to delay this step if you have dynamically created input fields that appear later in the loading process
        // It can be called as many times as necessary; previously converted input fields will not be converted again
        window.emojiPicker.discover();
      }); 
   </script>

<script>
$('#delete_chat').click(function(){
 
 swal({
    title: "Are you sure?",
    text: "want to delete this chat!",
    icon: "warning",
    buttons: true,
    dangerMode: true,
    })
    .then((willDelete) => {
    if (willDelete) {
        var receiver = $(this).data('receiver');
        $.get( "{{URL::to('/')}}/inbox/chat_delete/"+receiver, function( data ) {
         swal({
            title: "success!",
            text: "This chat deleted Successfully.",
            icon: "success",
            button: "Ok",
         });
         window.setTimeout(function () {
            window.location.href = "{{URL::to('/')}}/inbox";
         }, 1000);
        });
    }
 });
});
$('.follow_up').click(function(){
   var receiver = $(this).data('receiver');
   var chat_type = $(this).data('chat_type');
      $.get( "{{URL::to('/')}}/inbox/chat_follow_up/"+receiver+"/"+chat_type, function( data ) {
         swal({
            title: "success!",
            text: data,
            icon: "success",
            button: "Ok",
         });
      });
});
$('#chattype').change(function(){
   receiver = $('#chattype').val();
   $('#content_chat_type').html('<div class="r_success_block"><img style="margin-left: 118px; margin-top: 46px;" src="'+host+'/assets/images/search-loader.gif" class="search_gif" />');
   
      $.get( "{{URL::to('/')}}/inbox/chat_user/"+receiver, function( data ) {
         $('#content_chat_type').html(data);
      });
   
})
</script>
@endsection