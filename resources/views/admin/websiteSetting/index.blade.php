@extends('admin.support.master')
@section('title', 'Review Reports')
@section('page_title', 'Website Setting')
@section('content')

                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-body">
                            <h4 class="card-title">Website is live</h4>
                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="switch">
                                            <label>No
                                                <input type="checkbox" value="1" id="is_live" name="is_live" {{$web_setting->is_live == 1 ? 'checked' : '' }}><span class="lever"></span>Yes</label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="container">
                        <iframe class="responsive-iframe" src="{{URL::to('/maintenance')}}" style="width: 100%; height: 920px;"></iframe>
                </div>

@endsection
@section('addScript')
        <script type="text/javascript">
            $(document).ready(function(){
                $('#is_live').click(function(){
                    if($(this).prop("checked") == true){
                        var is_live = 1;
                    }
                    else if($(this).prop("checked") == false){
                        var is_live = 0;
                    }

                    $.get( "{{URL::to('/')}}/admin/websiteSetting/update/"+is_live, function( data ) {
                             $.toast({
                                heading: 'Success.!',
                                text: data,
                                position: 'top-center',
                                loaderBg:'#ff6849',
                                icon: 'success',
                                hideAfter: 3500, 
                                stack: 6
                              });
                    });
                })
            
            });
        </script>

@endsection