@php $list_item = array(); @endphp
@foreach($chat_list as $val)
                     @if($val->sender_id != Auth::id())
                        @if(!in_array($val->sender_id, $list_item))
                           <div>
                              <a href="{{URL::to('/inbox/chat/'.base64_encode($val->sender->id))}}/{{$val->sender->type == '3' ? $val->sender->company : $val->sender->fname}}">
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
                              <a href="{{URL::to('/inbox/chat/'.base64_encode($val->receiver->id))}}/{{$val->receiver->type == '3' ? $val->receiver->company : $val->receiver->fname}}">
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