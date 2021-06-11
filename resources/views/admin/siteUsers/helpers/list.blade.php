@extends('admin.support.master')
@section('title', 'Helpers | Users')
@section('page_title', 'Helpers | Users')
@section('content')

                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-body">
                                <h4 class="card-title">Helpers</h4>
                                <hr>
                                <div class="table-responsive">
                                    <table id="exporTable" class="table">
                                        <thead>
                                            <tr>
                                                <th>S#</th>
                                                <th>Full Name</th>
                                                <th>Email</th>
                                                <th>Country</th>
                                                <!-- Language -->
                                                @for($x=0; $x<5; $x++)
                                                    <th class="export_fields">Language-{{$x+1}}</th>
                                                @endfor

                                                <!-- Expertise Area -->
                                                @for($x=0; $x<5; $x++)
                                                    <th class="export_fields">Expertise-{{$x+1}}</th>
                                                @endfor

                                                <!-- Skills -->
                                                @for($x=0; $x<8; $x++)
                                                    <th class="export_fields">Skills-{{$x+1}}</th>
                                                @endfor

                                                <!-- Qualification -->
                                                @for($x=0; $x<4; $x++)
                                                    <th class="export_fields">Qualification-{{$x+1}}</th>
                                                @endfor

                                                <!-- Education -->
                                                @for($x=0; $x<5; $x++)
                                                    <th class="export_fields">Education/Certificate-{{$x+1}}</th>
                                                @endfor

                                                <!-- Experience -->
                                                @for($x=0; $x<5; $x++)
                                                    <th class="export_fields">Experience-{{$x+1}}</th>
                                                @endfor

                                                <th>Starting Salary</th>
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
                                                        {{$data->fname.' '.$data->lname}}
                                                    </td>
                                                    <td>{{$data->email}}</td>
                                                    <td>{{empty($data->details) ? '-' : $data->details->count->country}}</td>
                                                    
                                                    <!-- Language -->
                                                    @for($x=0; $x<5; $x++)
                                                        <td class="export_fields">
                                                            {{empty($data->langs[$x]) ? '' : $data->langs[$x]->language}}
                                                        </td>
                                                    @endfor


                                                    <!-- Expertise Area -->
                                                    @for($x=0; $x<5; $x++)
                                                        <td class="export_fields">
                                                            {{empty($data->expertise[$x]) ? '' : $data->expertise[$x]->skills->skill}}
                                                        </td>
                                                    @endfor


                                                    <!-- Skills -->
                                                    @for($x=0; $x<8; $x++)
                                                        <td class="export_fields">
                                                            {{empty($data->skills[$x]) ? '' : $data->skills[$x]->skills->skill}}
                                                        </td>
                                                    @endfor


                                                    <!-- Qualification -->
                                                    @for($x=0; $x<4; $x++)
                                                        <td class="export_fields">
                                                            {{empty($data->qualification[$x]) ? '' : $data->qualification[$x]->qual->qualification}}
                                                        </td>
                                                    @endfor


                                                    <!-- Education -->
                                                    @for($x=0; $x<5; $x++)
                                                        <td class="export_fields">
                                                            {{empty($data->education[$x]->certificate) ? '' : $data->education[$x]->certificate}}
                                                        </td>
                                                    @endfor


                                                    <!-- Experience -->
                                                    @for($x=0; $x<5; $x++)
                                                        <td class="export_fields">
                                                            {{empty($data->experience[$x]->employer) ? '' : 'Emp:'.$data->experience[$x]->employer.' | From:'.$data->experience[$x]->start_year.' | To:'.$data->experience[$x]->end_year}}
                                                        </td>
                                                    @endfor

                                                    <td>{{empty($data->startingSalary) ? 'NA' : $data->startingSalary->curr->symbol.' '.number_format($data->startingSalary->price, 1)}}</td>
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
                        title: 'Helpers user data | Helperrific',
                        exportOptions: {
                            columns: "thead th:not(.noExport)"
                        }
                    }, {
                        extend: 'csv',
                        title: 'Helpers user data | Helperrific',
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
