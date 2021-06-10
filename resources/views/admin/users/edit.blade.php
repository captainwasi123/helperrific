@extends('admin.support.master')
@section('title', 'Edit User')
@section('page_title', 'Edit User')
@section('content')

	<!-- Row -->
                <div class="row">
                    <div class="col-lg-12">
                        <div class="card card-outline-info">
                            <div class="card-header">
                                <h4 class="m-b-0 text-white">Edit User</h4>
                            </div>
                            <div class="card-body">
                                <form method="post" action="{{URL::to('/admin/users/update')}}">
                                	{{csrf_field()}}
                                    <input type="hidden" name="u_id" value="{{base64_encode($data->id)}}">
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
                                            <div class="col-md-2"></div>
                                            <div class="col-md-8">
                                                <div class="row">
                                                    <div class="col-md-8">
                                                        <div class="form-group">
                                                            <label class="control-label">Full Name *</label>
                                                            <input type="text" class="form-control" name="fullname" value="{{$data->fullname}}" required>
        												</div>
                                                    </div>
                                                    <div class="col-md-4">
                                                        <div class="form-group">
                                                            <label class="control-label">Contact#</label>
                                                            <input type="text" class="form-control" name="phone" value="{{$data->phone}}">
                                                        </div>
                                                    </div>

                                                    <div class="col-md-7">
                                                        <div class="form-group">
                                                            <label class="control-label">Email</label>
                                                            <input type="email" class="form-control" name="email" value="{{$data->email}}">
                                                        </div>
                                                    </div>
                                                    <div class="col-md-5">
                                                        <div class="form-group">
                                                            <label class="control-label">User Role *</label>
                                                            <select class="form-control" name="role_id" required>
                                                                @foreach($roles as $val)
                                                                    <option value="{{$val->id}}"
                                                                        {{$val->id == $data->role_id ? 'selected' : ''}}
                                                                    >{{$val->role}}</option>
                                                                @endforeach
                                                            </select>
                                                        </div>
                                                    </div>

                                                    <div class="col-md-4">
                                                        <div class="form-group">
                                                            <label class="control-label">Username</label>
                                                            <input type="text" class="form-control" disabled value="{{$data->username}}">
                                                        </div>
                                                    </div>
                                                    <div class="col-md-8"></div>

                                                    <div class="col-md-8"></div>
                                                    <div class="col-md-4">
                                                        <br>
                                                        <div class="form-actions mt-1">
                                                            <button type="submit" class="btn btn-success"> <i class="fa fa-check"></i> Update</button>&nbsp;&nbsp;
                                                            <button type="reset" class="btn btn-inverse">Cancel</button>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-2"></div>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- Row -->

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
