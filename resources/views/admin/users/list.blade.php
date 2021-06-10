@extends('admin.support.master')
@section('title', 'Users | Admin Panel')
@section('page_title', 'Users | Admin Panel')
@section('content')

                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-body">
                                <h4 class="card-title">Admin Panel Users</h4>
                                <a href="{{URL::to('/admin/users/add')}}" class="btn btn-primary pull-right addBtn">Add User</a>
                                <hr>
                                <div class="table-responsive">
                                    <table class="table table-bordered">
                                        <thead>
                                            <tr>
                                                <th>#</th>
                                                <th>Full Name</th>
                                                <th>Email</th>
                                                <th>Contact#</th>
                                                <th>Username</th>
                                                <th>Role</th>
                                                <th>Status</th>
                                                <th>Created at</th>
                                                <th class="text-nowrap">Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @php $s=1; @endphp
                                            @foreach($databelt as $data)
                                                <tr>
                                                    <td>{{$s}}</td>
                                                    <td>{{$data->fullname}}</td>
                                                    <td>{{$data->email}}</td>
                                                    <td>{{$data->phone}}</td>
                                                    <td>{{$data->username}}</td>
                                                    <td><span class="badge badge-primary">{{$data->role->role}}</span></td>
                                                    <td>
                                                        <span class="badge badge-info">
                                                            {{$data->status == '1' ? 'Active' : 'In-Active'}}
                                                        </span>
                                                    </td>
                                                    <td>{{date('d-M-Y | H:i A', strtotime($data->created_at))}}</td>
                                                    <td class="text-nowrap">
                                                        @if($data->id != '1')
                                                            <div class="btn-group">
                                                              <button type="button" class="btn btn-sm btn-info dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                                Action
                                                              </button>
                                                              <div class="dropdown-menu">
                                                                @if($data->status == '1')
                                                                <a class="dropdown-item inactivate" href="javascript:void(0)" data-href="{{URL::to('/admin/users/in-active/'.base64_encode($data->id))}}">In-Active</a>

                                                                @else
                                                                <a class="dropdown-item activate" href="javascript:void(0)" data-href="{{URL::to('/admin/users/active/'.base64_encode($data->id))}}">Active</a>
                                                                @endif
                                                                <div class="dropdown-divider"></div>
                                                                <a class="dropdown-item" href="{{URL::to('/admin/users/edit/'.base64_encode($data->id))}}">Edit</a>
                                                                <a class="dropdown-item trash" href="javascript:void(0)" data-href="{{URL::to('/admin/users/delete/'.base64_encode($data->id))}}">Delete</a>
                                                              </div>
                                                            </div>
                                                        @endif
                                                    </td>
                                                </tr>
                                                @php $s++; @endphp
                                            @endforeach
                                            @if(count($databelt) == '0')
                                                <tr>
                                                    <td colspan="9">No Counties Found.</td>
                                                </tr>
                                            @endif
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

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
	<script type="text/javascript">
		$(document).ready(function(){
			$(document).on('click', '.inactivate', function(){
				var href = $(this).data('href');
				if(confirm('Are you sure want to In-Activate this.?')){
					window.location.href = href;
				}
			});

            $(document).on('click', '.activate', function(){
                var href = $(this).data('href');
                if(confirm('Are you sure want to Activate this.?')){
                    window.location.href = href;
                }
            });

            $(document).on('click', '.trash', function(){
                var href = $(this).data('href');
                if(confirm('Are you sure want to Delete this.?')){
                    window.location.href = href;
                }
            });
		});
	</script>
@endsection
