@extends('admin.support.master')
@section('title', 'Add User')
@section('page_title', 'Add User')
@section('content')

	<!-- Row -->
                <div class="row">
                    <div class="col-lg-12">
                        <div class="card card-outline-info">
                            <div class="card-header">
                                <h4 class="m-b-0 text-white">Add User</h4>
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
                                            <div class="col-md-2"></div>
                                            <div class="col-md-8">
                                                <div class="row">
                                                    <div class="col-md-8">
                                                        <div class="form-group">
                                                            <label class="control-label">Full Name *</label>
                                                            <input type="text" class="form-control" name="fullname" required>
        												</div>
                                                    </div>
                                                    <div class="col-md-4">
                                                        <div class="form-group">
                                                            <label class="control-label">Contact#</label>
                                                            <input type="text" class="form-control" name="phone">
                                                        </div>
                                                    </div>

                                                    <div class="col-md-7">
                                                        <div class="form-group">
                                                            <label class="control-label">Email</label>
                                                            <input type="email" class="form-control" name="email">
                                                        </div>
                                                    </div>
                                                    <div class="col-md-5">
                                                        <div class="form-group">
                                                            <label class="control-label">User Role *</label>
                                                            <select class="form-control" name="role_id" required>
                                                                @foreach($roles as $val)
                                                                    <option value="{{$val->id}}">{{$val->role}}</option>
                                                                @endforeach
                                                            </select>
                                                        </div>
                                                    </div>

                                                    <div class="col-md-4">
                                                        <div class="form-group">
                                                            <label class="control-label">Username *</label>
                                                            <input type="text" class="form-control" name="username" required>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-4">
                                                        <div class="form-group">
                                                            <label class="control-label">Password *</label>
                                                            <input type="password" class="form-control" name="password" required>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-4">
                                                        <div class="form-group">
                                                            <label class="control-label">Confirm Password *</label>
                                                            <input type="password" class="form-control" name="password_confirmation" required>
                                                        </div>
                                                    </div>


                                                    <div class="col-md-8"></div>
                                                    <div class="col-md-4">
                                                        <br>
                                                        <div class="form-actions mt-1">
                                                            <button type="submit" class="btn btn-success"> <i class="fa fa-check"></i> Save</button>&nbsp;&nbsp;
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
