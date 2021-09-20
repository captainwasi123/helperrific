@extends('web.support.master')
@section('title', 'Order Details')

@section('content')


      <div class="sec-7"> 
        <div class="container">
            <div class="row">
                 <div class="col-md-9">
                    <div class="sec-1">
                        <div class="row">
                          <div class="col-md-9">
                            <h1 class="sec-2"> Request# {{$data->id}} </h1>
                          </div>
                          <div class="col-md-3">
                              <div>
                                <label>Status:</label>
                                <select class="form-control" data-id="{{base64_encode($data->id)}}" id="order_status">
                                  @foreach($status as $val)
                                    <option value="{{$val->id}}"
                                      {{$val->id == $data->status ? 'selected' : ''}}
                                    >{{$val->status}}</option>
                                  @endforeach
                                </select>
                              </div>
                          </div>
                        </div>
                        <div class="row">
                          <div class="col-md-6">
                            <h5> <b>Employer </b></h5>
                            <div class="pro-sec1">
                                <div class="row">
                                  <div class="col-md-2">
                                    <img src="{{URL::to('/')}}/public/profile_img/{{$data->buyer->profile_img}}" onerror="this.onerror=null;this.src='{{URL::to('/')}}/public/user-placeholder.jpg';">
                                  </div>  
                                  <div class="col-md-10">
                                    <div class="sec-12">
                                      <h1 class="sec-11"> {{$data->buyer->type == '3' ? $data->buyer->company : $data->buyer->fname.' '.$data->buyer->lname}}</h1>
                                      <p class="sec-3"> {{empty($data->buyer->details) ? '-' : $data->buyer->details->country}} </p>
                                    </div>
                                  </div>
                                </div> 
                            </div>               
                          </div>
                        <div class="col-md-6">
                          <h5> <b>Helper/Agency</b></h5>
                            <div class="pro-sec1">
                                <div class="row">
                                  <div class="col-md-2">
                                    <img src="{{URL::to('/')}}/public/profile_img/{{$data->seller->profile_img}}" onerror="this.onerror=null;this.src='{{URL::to('/')}}/public/user-placeholder.jpg';">
                                  </div>  
                                  <div class="col-md-10">
                                    <div class="sec-12">
                                      <h1 class="sec-11"> {{$data->seller->type == '3' ? $data->seller->company : $data->seller->fname.' '.$data->seller->lname}} </h1>
                                      <p class="sec-3"> {{empty($data->seller->details) ? '-' : $data->seller->details->country}} </p>
                                    </div>
                                  </div>
                                </div> 
                            </div>               
                          </div>
                        </div>
                        <hr>
                        <h5> <b>Order Description:</b></h5>
                        <p class="sec-3"> {{$data->description}} </p>
                   </div>  
                </div>
                <div class="col-md-3">
                   <div class="sec-4"> 
                      <a href="javascript:void(0)" class="btn btn-primary custts open-enquiry">Send us Enquiry</a>
                   </div>   
                </div>                    
           </div>
        </div> 
      </div> 

      <div class="sec-8"> 
        <div class="container">
            <div class="row">
              <div class="col-md-9">
                <h4>Order Conversation</h4>
                <hr> 
              </div>                           
            </div>
        </div> 
      </div>

      @if(count($data->conversation) == '0')
        <div class="sec-8"> 
          <div class="container">
              <div class="row">
                <div class="col-md-9">
                  <div class="sec-1">
                    <div class="row">
                      <div class="col-md-12">
                          <h4 class=" align-center">No Conversation Found.</h4>
                      </div>
                    </div>
                  </div>  
                </div>                           
              </div>
          </div> 
        </div>  
      @endif

      @foreach($data->conversation as $val)
        <div class="sec-8"> 
          <div class="container">
              <div class="row">
                <div class="col-md-9">
                  <div class="sec-1">
                    <div class="row">
                      <div class="col-md-1">
                        <img src="{{URL::to('/')}}/public/profile_img/{{$val->users->profile_img}}" onerror="this.onerror=null;this.src='{{URL::to('/')}}/public/user-placeholder.jpg';">
                      </div>  
                      <div class="col-md-11">
                        <div class="sec-12">
                          <h1 class="sec-11"> {{$val->users->type == '3' ? $val->users->company : $val->users->fname.' '.$val->users->lname}} <small>{{$val->user_id == Auth::id() ? '(me)' : ''}}</small></h1>
                          <br>
                          <p class="sec-3">{{$val->message}}</p>
                        </div>
                        @if(!empty($val->file_attach))
                        <div class="attachment-file">
                          <p>
                            <span class="file1"> {{$val->file_name}} </span>
                            <span class="file2"><a href="{{URL::to('/public/order_file/'.$val->file_attach)}}" download="{{$val->file_name}}" title="Download"><i class="fa fa-download"></i></a></span>
                          </p>
                        </div>
                        @endif
                          <p class="sec-13" style="text-align: right;"> {{date('d-M-Y | h:i a', strtotime($val->created_at))}} </p>
                      </div>
                    </div>
                  </div>  
                </div>                           
              </div>
          </div> 
        </div>
      @endforeach 

      <div class="sec-8"> 
        <div class="container">
            <div class="row">
              <div class="col-md-9">
                <div class="sectionnnn">
                  <form method="post" action="{{URL::to('/orders/messageSend')}}" enctype="multipart/form-data">
                    {{csrf_field()}}
                    <input type="hidden" name="msg_id" value="{{base64_encode($data->id)}}">
                    <input type="file" name="attachment" id="fileAttach">
                    <label id="fileAttachName"></label>
                    <textarea placeholder="Write your message..." class="form-control" rows="6" name="message" data-emojiable="true" required></textarea>
                    <div class="main-sec">
                      <div class="sec-po">
                        <a href="javascript:void(0)" class="emojies"> <i class="far fa-smile"></i> </a> 
                        <label for="fileAttach"><i class="fa fa-paperclip" aria-hidden="true"></i></label>
                      </div>
                      <div class="sec-po1">
                        <button class="btn btn-primary custt">Submit</button>
                      </div>
                    </div>
                  </form>
                </div>
                <br> 
              </div>                           
            </div>
        </div> 
      </div> 
      


@endsection
@section('addStyle')
     <link href="{{URL::to('/')}}/assets/emojies/css/emoji.css" rel="stylesheet">
     <style type="text/css">
        .emoji-menu {
            bottom: -180px !important;
         }
        #fileAttachName {
            right: 40px !important;
            top: 45px !important;
        }
     </style>
@endsection
@section('addScript')
   <script src="{{URL::to('/')}}/assets/emojies/js/config.js"></script>
   <script src="{{URL::to('/')}}/assets/emojies/js/util.js"></script>
   <script src="{{URL::to('/')}}/assets/emojies/js/jquery.emojiarea.js"></script>
   <script src="{{URL::to('/')}}/assets/emojies/js/emoji-picker.js"></script>
   <script>
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


@endsection