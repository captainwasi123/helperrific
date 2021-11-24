@extends('admin.support.master')
@section('title', 'Dashboard')
@section('page_title', 'Dashboard')
@section('content')

<!-- ============================================================== -->
                <!-- Start Page Content -->
                <!-- ============================================================== -->
                <!-- Row -->
                <div class="card-group">
                    <div class="card">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-12">
                                    <h2 class="m-b-0"><i class="mdi mdi-account-multiple text-info"></i></h2>
                                    <h3 class="">{{$helper}}</h3>
                                    <h6 class="card-subtitle">Total Helpers</h6></div>
                                <div class="col-12">
                                    <div class="progress">
                                        <div class="progress-bar bg-info" role="progressbar" style="width: 85%; height: 6px;" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- Column -->
                    <!-- Column -->
                    <div class="card">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-12">
                                    <h2 class="m-b-0"><i class="mdi mdi-account-multiple text-success"></i></h2>
                                    <h3 class="">{{$agency}}</h3>
                                    <h6 class="card-subtitle">Total Agency</h6></div>
                                <div class="col-12">
                                    <div class="progress">
                                        <div class="progress-bar bg-success" role="progressbar" style="width: 40%; height: 6px;" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- Column -->
                    <!-- Column -->
                    <div class="card">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-12">
                                    <h2 class="m-b-0"><i class="mdi mdi-account-multiple text-purple"></i></h2>
                                    <h3 class="">{{$employer}}</h3>
                                    <h6 class="card-subtitle">Total Employers</h6></div>
                                <div class="col-12">
                                    <div class="progress">
                                        <div class="progress-bar bg-primary" role="progressbar" style="width: 56%; height: 6px;" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- Column -->
                    <!-- Column -->
                    <div class="card">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-12">
                                    <h2 class="m-b-0"><i class="mdi mdi-buffer text-warning"></i></h2>
                                    <h3 class="">{{$total_orders}}</h3>
                                    <h6 class="card-subtitle">Total Orders</h6></div>
                                <div class="col-12">
                                    <div class="progress">
                                        <div class="progress-bar bg-warning" role="progressbar" style="width: 26%; height: 6px;" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>


    <div class="card table-responsive">
     <div class="card-body">
     <h4 class="card-title">New Registration</h4>
         <table class="table table-hover ">
                <thead class="thead-dark">
                    <tr>
                    <th scope="col">User Type</th>
                    <th scope="col">Today</th>
                    <th scope="col">This Month</th>
                    <th scope="col">This Year</th>
                    </tr>
                </thead>
             <tbody>
                    <tr>
                    <th >Helper</th>
                    <td>{{ $helpertoday }}</td>
                    <td>{{ $helperMonth }}</td>
                    <td>{{ $helperYear }}</td>
                    
                    </tr>
                    <tr>
                    <th >Agency</th>
                    <td>{{ $agencytoday }}</td>
                    <td>{{ $agencyMonth }}</td>
                    <td>{{ $agencyYear }}</td>
                    
                    </tr>
                    <tr>
                    <th >Employee</th>
                    <td >{{ $employertoday }}</td>
                    <td>{{ $empMonth }}</td>
                    <td>{{ $empYear }}</td>

                    </tr>
                </tbody>
        </table>
    </div>
    </div>
                <div class="card-group">
                    
                    <div class="card">
                        <div class="card-body">
                            <h4 class="card-title">Free Account Subscription</h4>
                            <div id="freeMembers"></div>
                        </div>
                    </div>

                    <div class="card">
                        <div class="card-body">
                            <h4 class="card-title">Premium Account Subscription</h4>
                            <div id="paidMembers"></div>
                        </div>
                    </div>
                </div>
@endsection
@section('addStyle')
    <link href="{{URL::to('/')}}/assets/admin/plugins/morrisjs/morris.css" rel="stylesheet">
@endsection
@section('addScript')
    <script src="{{URL::to('/')}}/assets/admin/plugins/morrisjs/morris.js"></script>
    <script type="text/javascript">
        $(document).ready(function(){
            'use strict'

            Morris.Donut({
                element: 'freeMembers',
                data: [{
                    label: "Helpers",
                    value: {{$helper}},

                }, {
                    label: "Employers",
                    value: {{$employer-$paidAccount['employers']}}
                }, {
                    label: "Agencies",
                    value: {{$agency-$paidAccount['agencies']}}
                }],
                resize: true,
                colors:['#26dad2', '#7460ee', '#ffb22b']
            });


            Morris.Donut({
                element: 'paidMembers',
                data: [{
                    label: "Employers",
                    value: {{$paidAccount['employers']}},

                }, {
                    label: "Agencies",
                    value: {{$paidAccount['agencies']}}
                }],
                resize: true,
                colors:['#26dad2', '#7460ee']
            });



        });
    </script>
@endsection