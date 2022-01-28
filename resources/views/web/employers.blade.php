@extends('web.support.master')
@section('title', 'Domestic Helpers')

@section('content')

<!-- Breadcrumbs Section Starts Here -->
<section class="breadcrumb-custom">
   <div class="container">
      <ul>
         <li> <a href="{{URL::to('/helpers')}}"> Domestic Helpers </a> </li>
         <li> <a href="{{URL::to('/agencies')}}"> Agencies </a> </li>
         <li> <a href="{{URL::to('/employers')}}"> Employers </a> </li>
      </ul>
   </div>
</section>
<!-- Breadcrumbs Section Ends Here -->
<!-- Page Content Starts Here -->
<section class=" p-b-60 p-t-60">
   <div class="container">
      <div class="page-title">
         <h3> Employers </h3>
      </div>
      <div class="block-element m-b-20">
         <input type="hidden" name="_token" id="token" value="{{csrf_token()}}">
         <div class="row">
            <div class="col-md-9 col-lg-9 col-sm-12 col-xs-12">
               <div class="listing-filters">
                   <select class="employer_filter" name="location" id="location">
                      <option value=""> Country of origin </option>
                      @foreach($countries as $val)
                         <option value="{{$val->id}}"> {{$val->country}} </option>
                      @endforeach
                   </select>
               </div>
            </div>
            <!-- <div class="col-md-3 col-lg-3 col-sm-12 col-xs-12">
               <div class="listing-filters">
                  <select style="width: 200px;float: right;">
                     <option> Sort By </option>
                     <option> Star Ratings </option>
                     <option> Number of Helpers </option>
                  </select>
               </div>
            </div> -->
         </div>
      </div>
      <div class="listing-blocks" id="content_block">
         <div class="row">
            @foreach($agencies as $data)
            <div class="col-md-3 col-lg-3 col-sm-6 col-xs-12">
                     <a href="{{URL::to('/employer/detail/'.base64_encode($data->id).'/'.$data->fname.' '.$data->lname)}}">
                       <div class="listing-box">
                           <span class="feat_label">Employer</span>
                          <div class="listing-head">
                             <img alt="listings-thumbnail" src="{{URL::to('/')}}/public/cover_img/{{$data->cover_img}}" onerror="this.onerror=null;this.src='{{URL::to('/')}}/public/cover-placeholder.jpg';">
                          </div>
                          <div class="listing-info">
                             <h5> <img alt="user-profile-picture" src="{{URL::to('/')}}/public/profile_img/{{$data->profile_img}}" onerror="this.onerror=null;this.src='{{URL::to('/')}}/public/user-placeholder.jpg';"> <p class="cut-text">  {{$data->fname}} {{$data->lname}} </p> </h5>
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
            @endforeach  
            @if(count($agencies) == '0')
               <div class="col-lg-12">
                 <br><br>
                 <h4>No Result Found.</h4>
                 <br><br><br><br><br><br><br><br><br><br><br>
               </div>
            @endif       
         </div>
      </div>
   </div>
</section>
<!-- Page Content Ends Here -->

@endsection