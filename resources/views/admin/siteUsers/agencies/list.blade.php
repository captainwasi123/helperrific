@extends('admin.support.master')
@section('title', 'Agencies | Users')
@section('page_title', 'Agencies | Users')
@section('content')

                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-body">
                                <h4 class="card-title">Agencies</h4>
                                <hr>
                                <div class="table-responsive">
                                    <table id="exporTable" class="table">
                                        <thead>
                                            <tr>
                                                <th>S#</th>
                                                <th>Full Name</th>
                                                <th>Email</th>
                                                <th>Address</th>
                                                <th>Country</th>
                                                <th>Email</th>
                                                <th>Phone</th>
                                                <th>Rating</th>
                                                <th>Status</th>
                                                <th>Created at</th>
                                                <th class="noExport">Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @php $s=1; @endphp
                                            @foreach($databelt as $data)
                                                <tr>
                                                    <td>{{$s}}</td>
                                                    <td> 
                                                        {{$data->company}}
                                                    </td>
                                                    <td>{{$data->email}}</td>
                                                    <td>{{empty($data->details) ? '' : $data->details->e_address}}</td>
                                                    <td>{{empty($data->details) ? '-' : $data->details->count->country}}</td>
                                                    <td>
                                                        {{empty($data->details) ? '-' : $data->details->c_email}}
                                                    </td>
                                                    <td>
                                                        {{empty($data->details) ? '-' : $data->details->c_phone}}
                                                    </td>
                                                    <td>{{empty($data->reviews) ? '0.0' : number_format($data->avgRating[0]->aggregate, 1)}}</td>
                                                    <td>
                                                        @if($data->status == '1')
                                                            <span class="badge badge-info">Active</span>
                                                        @else
                                                            <span class="badge badge-danger">Suspended</span>
                                                        @endif
                                                    </td>
                                                    <td>{{date('d-M-Y | H:i A', strtotime($data->created_at))}}</td>
                                                    <td class="text-nowrap">
                                                        <div class="btn-group">
                                                          <button type="button" class="btn btn-sm btn-info dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                            Action
                                                          </button>
                                                          <div class="dropdown-menu">
                                                            @if($data->status == '1')
                                                            <a class="dropdown-item inactivate" href="javascript:void(0)" data-href="{{URL::to('/admin/site-user/suspend/'.base64_encode($data->id))}}">Suspend</a>

                                                            @else
                                                            <a class="dropdown-item activate" href="javascript:void(0)" data-href="{{URL::to('/admin/site-user/active/'.base64_encode($data->id))}}">Active</a>
                                                            @endif
                                                            <div class="dropdown-divider"></div>
                                                            <a class="dropdown-item terminate trash" href="javascript:void(0)" data-href="{{URL::to('/admin/site-user/terminate/'.base64_encode($data->id))}}">Terminate</a>
                                                          </div>
                                                        </div>
                                                    </td>
                                                </tr>
                                                @php $s++; @endphp
                                            @endforeach
                                            @if(count($databelt) == '0')
                                                <tr>
                                                    <td colspan="9">No Users Found.</td>
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
@section('addStyle')
    
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.24/css/jquery.dataTables.min.css">
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/buttons/1.7.0/css/buttons.dataTables.min.css">
@endsection
@section('addScript')
    <!-- This is data table -->

    <script type="text/javascript" src="https://cdn.datatables.net/1.10.24/js/jquery.dataTables.min.js"></script>
    <script type="text/javascript" src="https://cdn.datatables.net/buttons/1.7.0/js/dataTables.buttons.min.js"></script>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>
    <script type="text/javascript" src="https://cdn.datatables.net/buttons/1.7.0/js/buttons.html5.min.js"></script>
    <script type="text/javascript" src="https://cdn.datatables.net/buttons/1.7.0/js/buttons.print.min.js"></script>

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

            $('#exporTable').DataTable({
                dom: 'Bfrtip',
                buttons: [{
                        extend: 'excel',
                        title: 'Agencies user data | Helperrific',
                        exportOptions: {
                            columns: "thead th:not(.noExport)"
                        }
                    }, {
                        extend: 'csv',
                        title: 'Agencies user data | Helperrific',
                        exportOptions: {
                            columns: "thead th:not(.noExport)"
                        }
                    }
                ]
            });

            $(document).on('click', '.inactivate', function(){
                var href = $(this).data('href');
                if(confirm('Are you sure want to Suspend this.?')){
                    window.location.href = href;
                }
            });

            $(document).on('click', '.activate', function(){
                var href = $(this).data('href');
                if(confirm('Are you sure want to Activate this.?')){
                    window.location.href = href;
                }
            });

            $(document).on('click', '.terminate', function(){
                var href = $(this).data('href');
                if(confirm('Are you sure want to Terminate this.?')){
                    window.location.href = href;
                }
            });
		});
	</script>
@endsection
