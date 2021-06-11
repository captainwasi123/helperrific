@extends('admin.support.master')
@section('title', 'Review Reports')
@section('page_title', 'Review Reports')
@section('content')

                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table id="exporTable" class="table">
                                        <thead>
                                            <tr>
                                                <th>S#</th>
                                                <th>Helper/Agency</th>
                                                <th>Employer</th>
                                                <th>Review</th>
                                                <th>Rating</th>
                                                <th>Created at</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @php $s=1; @endphp
                                            @foreach($databelt as $data)
                                                <tr>
                                                    <td>{{$s}}</td>
                                                    <td>
                                                        {{$data->review->seller->type == '3' ? $data->review->seller->company : $data->review->seller->fname.' '.$data->review->seller->lname}}
                                                    </td>
                                                    <td>{{$data->review->buyer->fname.' '.$data->review->buyer->lname}}</td>
                                                    <td><p class="cut-text" title="{{$data->review->description}}">{{$data->review->description}}</p></td>
                                                    <td>{{$data->review->rating.' star'}}</td>
                                                    <td>{{date('d-M-Y | H:i A', strtotime($data->created_at))}}</td>
                                                    <td class="text-nowrap" style="text-align:right;">
                                                        @if($data->review->status == '1')
                                                            <a href="javascript:void(0)" class="btn btn-sm btn-warning hideReview" data-id="{{base64_encode($data->id)}}" title="hide"><i class="mdi mdi-eye-off"></i></a>
                                                        @endif
                                                        <a href="javascript:void(0)" class="btn btn-sm btn-danger deleteReview" data-id="{{base64_encode($data->id)}}" title="Delete"><i class="fa fa-trash"></i></a>
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
@endsection