@extends('admin.support.master')
@section('title', 'Website Maintenace')
@section('page_title', 'Website Maintenace')
@section('content')

	<!-- Row -->
                <div class="row">
                    <div class="col-lg-12">
                        <div class="card card-outline-info">
                            <div class="card-body">
                                <div class="form-body">
                                    <div class="row p-t-20">
                                        <div class="col-md-12" id="alert_success">
                                        </div>
                                        <div class="col-md-3">
                                            <h5 class="pull-left nav-small-cap p-10"><strong>SITE PUBLISH</strong></h5>
                                            <div class="switch pull-right mt-2">
                                                <label>
                                                    <input type="checkbox" id="siteMainten" value="1" {{$mainten->status == '1' ? 'checked' : ''}}>
                                                    <span class="lever"></span>
                                                </label>
                                            </div>
                                        </div>
                                        <div class="col-md-9">
                                            
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- Row -->

@endsection
@section('addScript')
    <script type="text/javascript">
        $(document).ready(function(){

            $(document).on('change', '#siteMainten', function(){
                var val = '';
                if($(this).is(':checked')){
                    val = '1';
                }else{
                    val = '0';
                }
                $.get("{{URL::to('/admin/site_maintenance')}}/"+val, function(data, status){
                    if(data == 'done'){
                        $.toast({
                            heading: 'Success.!',
                            text: "Website status updated.",
                            position: 'top-center',
                            loaderBg:'#ff6849',
                            icon: 'success',
                            hideAfter: 3500, 
                            stack: 6
                        });
                    }else{
                         $.toast({
                            heading: 'Error.!',
                            text: "{{ session()->get('error') }}",
                            position: 'top-center',
                            loaderBg:'#ff6849',
                            icon: 'error',
                            hideAfter: 3500
                            
                          });
                    }
                });
            });
           
        });
    </script>
@endsection
