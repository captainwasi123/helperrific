@extends('web.support.master')
@section('title', 'Inbox')

@section('content')
@php $list_item = array(); @endphp

<section class="p-t-60 p-b-60 bg-inbox">
   <div class="container">
      <div class="row bg-white">
         <div class="col-md-12 col-lg-12 col-sm-12 col-xs-12 no-pad">
            <div class="all-messages">
               <div class="conversation-head">
                  <h3> All Conversations  <button class="chat-toggle"> <i class="fa fa-angle-down"> </i> </button> </h3>
               </div>
               <div class="conversations-all max-height1">
                  @foreach($chat_list as $val)
                     @if($val->sender_id != Auth::id())
                        @if(!in_array($val->sender_id, $list_item))
                           <div>
                              <a href="{{URL::to('/inbox/chat/'.base64_encode($val->sender->id))}}/{{$val->sender->type == '3' ? $val->sender->company : $val->sender->fname }}">
                                 <img alt="user-profile-avatar" src="{{URL::to('/')}}/public/profile_img/{{$val->sender->profile_img}}" onerror="this.onerror=null;this.src='{{URL::to('/')}}/public/user-placeholder.jpg';"/>
                                 <h6> {{$val->sender->type == '3' ? $val->sender->company : $val->sender->fname }}  </h6>
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
                                 <h6> {{$val->receiver->type == '3' ? $val->receiver->company : $val->receiver->fname }}  </h6>
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
            <div class="empty-chat">
               <img src="{{URL::to('/')}}/assets/images/chat.PNG">
               <h2>Nothing to See Here yet</h2>
               <h5>Your conversations will appear here.</h5>
            </div>
         </div>
         <div class="col-md-3 col-lg-3 col-sm-12 col-xs-12 no-pad">
         </div>
      </div>
   </div>
</section>



@endsection