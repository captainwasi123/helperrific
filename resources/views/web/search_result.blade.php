@extends('web.support.master')
@section('title', 'Search Result')

@section('content')

<!-- Breadcrumbs Section Starts Here -->
<section class="breadcrumb-custom">
   <div class="container">
      <ul>
         <li> <a href="{{URL::to('/helpers')}}"> Domestic Helpers </a> </li>
         <li> <a href="{{URL::to('/agencies')}}"> Agencies </a> </li>
      </ul>
   </div>
</section>
<!-- Breadcrumbs Section Ends Here -->
<!-- Page Content Starts Here -->
<section class=" p-b-60 p-t-60">
   <div class="container">
      <div class="page-title">
         <h3> Search Result: {{isset($_GET['query']) ? $_GET['query'] : ''}} </h3>
      </div>
      <div class="listing-blocks">
         <div class="row">
            @foreach($databelt as $data)
               @if($data->type == '3')
                  <div class="col-md-3 col-lg-3 col-sm-6 col-xs-12">
                     @if(Auth::check())
                        @if(Auth::user()->type == '1')
                           @if(count(Auth::user()->viewCount) < 5 || !empty(Auth::user()->premium))
                              <a href="{{URL::to('/agencies/detail/'.base64_encode($data->id).'/'.$data->company)}}">
                           @else
                              <a href="javascript:void(0)" class="limit-reached">
                           @endif
                        @else
                           <a href="{{URL::to('/agencies/detail/'.base64_encode($data->id).'/'.$data->company)}}">
                        @endif
                     @else
                        <a href="javascript:void(0)" class="null-profile">
                     @endif
                        <div class="listing-box">
                           <span class="feat_label">Agency</span>
                           <div class="listing-head">
                              <img alt="listings-thumbnail" src="{{URL::to('/')}}/public/cover_img/{{$data->cover_img}}" onerror="this.onerror=null;this.src='{{URL::to('/')}}/public/cover-placeholder.jpg';">
                           </div>
                           <div class="listing-info">
                              <h5> <img alt="user-profile-picture" src="{{URL::to('/')}}/public/profile_img/{{$data->profile_img}}" onerror="this.onerror=null;this.src='{{URL::to('/')}}/public/user-placeholder.jpg';"> <p class="cut-text"> {{$data->company}} </p> </h5>
                              <p title="{{empty($data->details->description) ? '-' : $data->details->description}}"> 
                                 {{empty($data->details->description) ? '-' : $data->details->description}} 
                              </p>
                              <h4> <i class="fa fa-star star-onn"> </i> <b class="star-onn"> 5.0 </b> <span class="col-grey"> (28s) </span> </h4>
                           </div>
                           <div class="listing-detail">
                              <table>
                                 <tbody>
                                    <tr>
                                       <td style="width:45%;"> Agency address </td>
                                       <td  class="cut-text-descip" > <strong>{{empty($data->details->c_address) ? '-' : $data->details->c_address}}</strong></td>
                                    </tr>
                                    <tr>
                                       <td style="width:45%;"> No of Available Helper </td>
                                       <td class="col-blue"> <input type="number" value="2" readonly="" name=""> </td>
                                    </tr>
                                 </tbody>
                              </table>
                           </div>
                           @if(Auth::check())
                              <div class="listing-actions">
                                    <div>
                                       <a href="" class="col-primary"> <i class="fa fa-heart"> </i> </a> 
                                    </div>
                                 <p> Starting Salary at <b> $84 </b> </p>
                              </div>
                           @endif
                        </div>
                     </a>
                  </div>
               @elseif($data->type == '2')
                  <div class="col-md-3 col-lg-3 col-sm-6 col-xs-12">
                     @if(Auth::check())
                        @if(Auth::user()->type == '1')
                           @if(count(Auth::user()->viewCount) < 5 || !empty(Auth::user()->premium))
                              <a href="{{URL::to('/helpers/detail/'.base64_encode($data->id).'/'.$data->fname.' '.$data->lname)}}">
                           @else
                              <a href="javascript:void(0)" class="limit-reached">
                           @endif
                        @else
                           <a href="{{URL::to('/helpers/detail/'.base64_encode($data->id).'/'.$data->fname.' '.$data->lname)}}">
                        @endif
                     @else
                        <a href="javascript:void(0)" class="null-profile">
                     @endif
                       <div class="listing-box">
                           <span class="feat_label">Helper</span>
                          <div class="listing-head">
                             <img alt="listings-thumbnail" src="{{URL::to('/')}}/public/cover_img/{{$data->cover_img}}" onerror="this.onerror=null;this.src='{{URL::to('/')}}/public/cover-placeholder.jpg';">
                          </div>
                          <div class="listing-info">
                             <h5> <img alt="user-profile-picture" src="{{URL::to('/')}}/public/profile_img/{{$data->profile_img}}" onerror="this.onerror=null;this.src='{{URL::to('/')}}/public/user-placeholder.jpg';"> <p class="cut-text"> {{$data->fname}} {{$data->lname}} </p> </h5>
                             <p title="{{empty($data->details->description) ? '-' : $data->details->description}}"> 
                                {{empty($data->details->description) ? '-' : $data->details->description }} 
                             </p>
                             <h4> <i class="fa fa-star star-onn"> </i> <b class="star-onn"> 5.0 </b> <span class="col-grey"> (28s) </span> </h4>
                          </div>
                          <div class="listing-detail">
                             <table>
                                <tbody>
                                   <tr>
                                      <td style="width:45%;"> Current Location </td>
                                      <td class="col-blue"> {{empty($data->details) ? '-' : $data->details->count->country}} </td>
                                   </tr>
                                   <tr>
                                      <td style="width:45%;" > Current Agency </td>
                                      <td class="col-blue"> - </td>
                                   </tr>
                                </tbody>
                             </table>
                          </div>
                          <div class="listing-actions">
                              @if(Auth::check())
                               <div>
                                  <a href="" class="col-blue"> <i class="fa fa-bars"> </i> </a> 
                                  <a href="" class="col-blue"> <i class="fa fa-heart"> </i> </a>  
                               </div>
                              @endif
                             <p> Starting Salary at <b> $84 </b> </p>
                          </div>
                       </div>
                    </a>
                  </div>
               @elseif($data->type == '1')
                  <div class="col-md-3 col-lg-3 col-sm-6 col-xs-12">
                     <a href="{{URL::to('/employer/detail/'.base64_encode($data->id).'/'.$data->fname.' '.$data->lname)}}">
                       <div class="listing-box">
                           <span class="feat_label">Employer</span>
                          <div class="listing-head">
                             <img alt="listings-thumbnail" src="{{URL::to('/')}}/public/cover_img/{{$data->cover_img}}" onerror="this.onerror=null;this.src='{{URL::to('/')}}/public/cover-placeholder.jpg';">
                          </div>
                          <div class="listing-info">
                             <h5> <img alt="user-profile-picture" src="{{URL::to('/')}}/public/profile_img/{{$data->profile_img}}" onerror="this.onerror=null;this.src='{{URL::to('/')}}/public/user-placeholder.jpg';"><p class="cut-text">  {{$data->fname}} {{$data->lname}} </p> </h5>
                          </div>
                          <div class="listing-detail">
                             <table>
                                <tbody>
                                   <tr>
                                      <td> Current Location </td>
                                      <td class="col-blue"> {{empty($data->details) ? '-' : $data->details->count->country}} </td>
                                   </tr>
                                   <tr>
                                      <td colspan="2">
                                         @if(!empty($data->details))
                                             @switch($data->details->e_looking_status)
                                                @case('1')
                                                   Looking for Helpers
                                                   @break

                                                @case('2')
                                                   Looking for agencies
                                                   @break

                                                @case('3')
                                                   Just Browsing
                                                   @break

                                             @endswitch
                                          @endif
                                      </td>
                                   </tr>
                                </tbody>
                             </table>
                          </div>
                       </div>
                    </a>
                  </div>
               @endif
            @endforeach         
         </div>
      </div>
   </div>
</section>
<!-- Page Content Ends Here -->

@endsection