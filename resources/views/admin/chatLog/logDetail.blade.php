@extends('admin.support.master')
@section('title', 'Chat Log Details')
@section('page_title', 'Chat Log Details')
@section('content')

<div class="row">
    <div class="col-12">
        <div class="card m-b-0">
            <!-- .chat-row -->
            <div class="chat-main-box">
                <!-- .chat-left-panel -->
                <!-- .chat-right-panel -->
                <div class="chat-right-aside">
                    <div class="chat-main-header">
                        <div class="p-20 b-b">
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="chat-log-profile float-left">
                                        <img src="{{URL::to('/')}}/public/profile_img/{{$sender->profile_img}}" onerror="this.onerror=null;this.src='{{URL::to('/')}}/public/user-placeholder.jpg';" alt="user" width="35" class="img-circle">
                                        <p>
                                            <span>{{empty($sender->company) ? $sender->fname.' '.$sender->lname : $sender->company}}</span>
                                            <br>
                                            {{$sender->email}}
                                            <span class="badge badge-info">
                                                @switch($sender->type)
                                                    @case('1')
                                                            Employer
                                                        @break

                                                    @case('2')
                                                            Helper
                                                        @break

                                                    @case('3')
                                                            Agency
                                                        @break
                                                @endswitch
                                            </span>
                                        </p>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <h4 class="chat-log-heading">< Conversation ></h4>
                                </div>
                                <div class="col-md-4">
                                    <div class="chat-log-profile float-right">
                                        <img src="{{URL::to('/')}}/public/profile_img/{{$receiver->profile_img}}" onerror="this.onerror=null;this.src='{{URL::to('/')}}/public/user-placeholder.jpg';" alt="user" width="35" class="img-circle">
                                        <p>
                                            <span>{{empty($receiver->company) ? $receiver->fname.' '.$receiver->lname : $receiver->company}}</span>
                                            <br>
                                            {{$sender->email}}
                                            <span class="badge badge-info">
                                                @switch($receiver->type)
                                                    @case('1')
                                                            Employer
                                                        @break

                                                    @case('2')
                                                            Helper
                                                        @break

                                                    @case('3')
                                                            Agency
                                                        @break
                                                @endswitch
                                            </span>
                                        </p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="chat-rbox">
                        <ul class="chat-list p-20">

                            @foreach($databelt as $val)
                               @if($val->receiver_id == $receiver->id)
                                   <li class="reverse">
                                        <div class="chat-content">
                                            <h5>{{$val->sender->type == '3' ? $val->sender->company : $val->sender->fname.' '.$val->sender->lname}}</h5>
                                            <div class="box bg-light-inverse">{{$val->message}}</div>
                                            @if(!empty($val->file_attach))
                                               <div class="chatAttach">
                                                    <a href="{{URL::to('/public/file_attached/'.$val->file_attach)}}" download="{{$val->file_name}}" data-toggle="tooltip" data-original-title="Click to Download">
                                                        <span>{{$val->file_name}}</span>
                                                        <i class="fa fa-download"></i>
                                                    </a>
                                               </div>
                                            @endif
                                        </div>
                                        <div class="chat-img"><img src="{{URL::to('/')}}/public/profile_img/{{$val->sender->profile_img}}" onerror="this.onerror=null;this.src='{{URL::to('/')}}/public/user-placeholder.jpg';" alt="user" /></div>
                                        <div class="chat-time">{{date('d-M-Y | h:i a', strtotime($val->created_at))}}</div>
                                    </li>
                               @else
                                    <li>
                                        <div class="chat-img"><img src="{{URL::to('/')}}/public/profile_img/{{$val->sender->profile_img}}" onerror="this.onerror=null;this.src='{{URL::to('/')}}/public/user-placeholder.jpg';" alt="user" /></div>
                                        <div class="chat-content">
                                            <h5>{{$val->sender->type == '3' ? $val->sender->company : $val->sender->fname.' '.$val->sender->lname}}</h5>
                                            <div class="box bg-light-info">{{$val->message}}</div>
                                            @if(!empty($val->file_attach))
                                                <div class="chatAttach">
                                                    <a href="{{URL::to('/public/file_attached/'.$val->file_attach)}}" download="{{$val->file_name}}" data-toggle="tooltip" data-original-title="Click to Download">
                                                        <span>{{$val->file_name}}</span>
                                                        <i class="fa fa-download"></i>
                                                    </a>
                                                </div>
                                            @endif
                                        </div>
                                        <div class="chat-time">{{date('d-M-Y | h:i a', strtotime($val->created_at))}}</div>
                                    </li>
                               @endif
                            @endforeach
                        </ul>
                    </div>
                </div>
                <!-- .chat-right-panel -->
            </div>
            <!-- /.chat-row -->
        </div>
    </div>
</div>

@endsection
@section('addScript')

<script type="text/javascript">
    $(document).ready(function(){
        $('.chat-rbox').scrollTop($('.chat-rbox')[0].scrollHeight);
    });
</script>

@endsection
