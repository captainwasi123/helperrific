@extends('admin.support.master')
@section('title', 'Filter | Chat Log')
@section('page_title', 'Filter | Chat Log')
@section('content')

	<!-- Row -->
                <div class="row">
                    <div class="col-lg-12">
                        <div class="card card-outline-info">
                            <div class="card-header">
                                <h4 class="m-b-0 text-white">Chat Filter</h4>
                            </div>
                            <div class="card-body">
                                <form method="post">
                                	{{csrf_field()}}
                                    <div class="form-body">
                                        <div class="row p-t-20">
                                            @if ($errors->any())
                                                <div class="col-md-12">
                                                    <div class="alert alert-danger">
                                                        <ul>
                                                            @foreach ($errors->all() as $error)
                                                                <li>{{ $error }}</li>
                                                            @endforeach
                                                        </ul>
                                                    </div>
                                                </div>
                                            @endif
                                            <div class="col-md-12">
                                                <div class="row">
                                                    <div class="col-md-3">
                                                        <div class="form-group">
                                                            <label class="m-t-10">From</label>
                                                            <input type="date" class="form-control" name="date_from" value="{{isset($searchData['date_from']) ? $searchData['date_from'] : ''}}">
        												</div>
                                                    </div>
                                                    <div class="col-md-3">
                                                        <div class="form-group">
                                                            <label class="m-t-10">To</label>
                                                            <input type="date" class="form-control mdate" name="date_to" value="{{isset($searchData['date_to']) ? $searchData['date_to'] : ''}}">
                                                        </div>
                                                    </div>
                                                    <div class="col-md-4">
                                                        <div class="form-group">
                                                            <label class="m-t-10">Keyword</label>
                                                            <input type="text" class="form-control" name="keyword" value="{{isset($searchData['keyword']) ? $searchData['keyword'] : ''}}">
                                                        </div>
                                                    </div>

                                                    <div class="col-md-2">
                                                        <br>
                                                        <div class="form-actions mt-3">
                                                            <button type="submit" class="btn btn-success"> <i class="fa fa-search"></i> Search</button>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- Row -->

                @if(isset($searchData))
                    <div class="row">
                        <div class="col-12">
                            <div class="card">
                                <div class="card-body">
                                    <h4 class="card-title">Search Result</h4>
                                    <hr>
                                    <div class="table-responsive">
                                        <table class="table">
                                            <thead>
                                                <tr>
                                                    <th>#</th>
                                                    <th>Sender</th>
                                                    <th>Receiver</th>
                                                    <th>Message</th>
                                                    <th>Time</th>
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
                                                        <td>{{$val->message}}</td>
                                                        <td>
                                                            <p class="created_at">
                                                                {{date('d-M-Y | h:i a', strtotime($val->created_at))}}
                                                            </p>
                                                        </td>
                                                        <td>
                                                            <a href="{{URL::to('/admin/chat-log/detail/'.base64_encode($val->sender_id).'/'.base64_encode($val->receiver_id))}}" class="btn btn-primary" target="_blank">Details ></a>
                                                        </td>
                                                    </tr>
                                                    @php $s++; @endphp
                                                @endforeach
                                                @if(count($databelt) == '0')
                                                    <tr>
                                                        <td colspan="6">No Chat Found.</td>
                                                    </tr>
                                                @endif
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                @endif

@endsection
@section('addScript')
    @if(session()->has('success'))
        <script type="text/javascript">
            $(document).ready(function(){
               $.toast({
                heading: 'Success.!',
                text: "{{ session()->get('success') }}",
                position: 'top-center',
                loaderBg:'#ff6849',
                icon: 'success',
                hideAfter: 3500, 
                stack: 6
              });
            });
        </script>
    @endif
    @if(session()->has('error'))
    <script type="text/javascript">
        $(document).ready(function(){
           $.toast({
            heading: 'Error.!',
            text: "{{ session()->get('error') }}",
            position: 'top-center',
            loaderBg:'#ff6849',
            icon: 'error',
            hideAfter: 3500
            
          });
        });
    </script>
    @endif
@endsection
