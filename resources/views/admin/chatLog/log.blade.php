@extends('admin.support.master')
@section('title', 'Chat Logs')
@section('page_title', 'Chat Logs')
@section('content')

                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-body">
                                <h4 class="card-title">Logs</h4>
                                <hr>
                                <div class="table-responsive">
                                    <table class="table">
                                        <thead>
                                            <tr>
                                                <th>#</th>
                                                <th>Sender</th>
                                                <th>Receiver</th>
                                                <th style="width: 10%">Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @php $s=1; @endphp
                                            @foreach($databelt as $val)
                                                <tr>
                                                    <td>{{$s}}</td>
                                                    <td>
                                                        <div class="chat-log-profile">
                                                            <img src="{{URL::to('/')}}/public/profile_img/{{$val->sender->profile_img}}" onerror="this.onerror=null;this.src='{{URL::to('/')}}/public/user-placeholder.jpg';" alt="user" width="35" class="img-circle">
                                                            <p>
                                                                <span>{{empty($val->sender->company) ? $val->sender->fname.' '.$val->sender->lname : $val->sender->company}}</span>
                                                                <br>
                                                                {{$val->sender->email}}
                                                                <span class="badge badge-info">
                                                                    @switch($val->sender->type)
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
                                                    </td>
                                                    <td>
                                                        <div class="chat-log-profile">
                                                            <img src="{{URL::to('/')}}/public/profile_img/{{$val->sender->profile_img}}" onerror="this.onerror=null;this.src='{{URL::to('/')}}/public/user-placeholder.jpg';" alt="user" width="35" class="img-circle">
                                                            <p>
                                                                <span>{{empty($val->receiver->company) ? $val->receiver->fname.' '.$val->receiver->lname : $val->receiver->company}}</span>
                                                                <br>
                                                                {{$val->receiver->email}}
                                                                <span class="badge badge-info">
                                                                    @switch($val->receiver->type)
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
                                                    </td>
                                                    <td>
                                                        <a href="{{URL::to('/admin/chat-log/detail/'.base64_encode($val->sender_id).'/'.base64_encode($val->receiver_id))}}" class="btn btn-primary">Details ></a>
                                                    </td>
                                                </tr>
                                                @php $s++; @endphp
                                            @endforeach
                                            @if(count($databelt) == '0')
                                                <tr>
                                                    <td colspan="4">No Logs Found.</td>
                                                </tr>
                                            @endif
                                            <tr>
                                                <td colspan="2"></td>
                                                <td colspan="2">{{$databelt->links()}}</td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

@endsection
