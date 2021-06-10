@extends('admin.support.master')
@section('title', 'Pending | Enquiries')
@section('page_title', 'Pending | Enquiries')
@section('content')

                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-body">
                                <h4 class="card-title">Pending Enquiries</h4>
                                <hr>
                                <div class="table-responsive">
                                    <table id="exporTable" class="table">
                                        <thead>
                                            <tr>
                                                <th>S#</th>
                                                <th>Full Name</th>
                                                <th>Email</th>
                                                <th>Category</th>
                                                <th>Description</th>
                                                <th>Is_user</th>
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
                                                        {{$data->fullname}}
                                                    </td>
                                                    <td>{{$data->email}}</td>
                                                    <td>{{$data->category}}</td>
                                                    <td><p class="cut-text" title="{{$data->description}}">{{$data->description}}</p></td>
                                                    <td>{{$data->is_user == '0' ? 'NO' : 'YES'}}</td>
                                                    <td>
                                                        @switch($data->status)
                                                            @case('1')
                                                                    <label class="badge badge-primary">Pending</label>
                                                                @break

                                                            @case('2')
                                                                    <label class="badge badge-success">Replied</label>
                                                                @break
                                                        @endswitch
                                                    </td>
                                                    <td>{{date('d-M-Y | H:i A', strtotime($data->created_at))}}</td>
                                                    <td class="text-nowrap">
                                                        <a href="javascript:void(0)" class="btn btn-sm btn-primary openDetail" data-id="{{base64_encode($data->id)}}">Details ></a>
                                                    </td>
                                                </tr>
                                                @php $s++; @endphp
                                            @endforeach
                                            @if(count($databelt) == '0')
                                                <tr>
                                                    <td colspan="9">No Users Found.</td>
                                                </tr>
                                            @endif
                                            <tr>
                                                <td colspan="9">{{$databelt->links()}}</td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- sample modal content -->
                <div class="modal fade detailmodal" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true" style="display: none;">
                    <div class="modal-dialog modal-lg">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h4 class="modal-title" id="myLargeModalLabel">Enquiry Details</h4>
                                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                            </div>
                            <div class="modal-body" id="detail_content">
                            </div>
                        </div>
                        <!-- /.modal-content -->
                    </div>
                    <!-- /.modal-dialog -->
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


            $(document).on('click', '.openDetail', function(){
                var id = $(this).data('id');
                $('.detailmodal').modal('show');

                var xhttp = new XMLHttpRequest();
                xhttp.onreadystatechange = function() {
                    if (this.readyState == 4 && this.status == 200) {
                       // Typical action to be performed when the document is ready:
                       document.getElementById("detail_content").innerHTML = xhttp.responseText;
                    }else{
                       document.getElementById("detail_content").innerHTML = '<img src="{{URL::to('/')}}/assets/images/loader.gif">';
                    }
                };
                xhttp.open("GET", "{{URL::to('/admin/enquiries/detail/')}}/"+id, true);
                xhttp.send();
            });
        });
    </script>
@endsection
