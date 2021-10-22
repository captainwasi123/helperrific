@extends('web.support.master')
@section('title', 'Domestic Helpers')

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
         <h3> Agencies </h3>
      </div>
      <div class="block-element m-b-20">
         <input type="hidden" name="_token" id="token" value="{{csrf_token()}}">
         <div class="row">
            <div class="col-md-9 col-lg-9 col-sm-12 col-xs-12">
               <div class="listing-filters">
                   <select class="agency_filter" name="location" id="location">
                      <option value=""> Country of origin </option>
                      @foreach($countries as $val)
                         <option value="{{$val->id}}"> {{$val->country}} </option>
                      @endforeach
                   </select>
               </div>
            </div>
            <div class="col-md-3 col-lg-3 col-sm-12 col-xs-12">
               <div class="listing-filters">
                  <select style="width: 200px;float: right;">
                     <option> Sort By </option>
                     <option> Star Ratings </option>
                     <option> Number of Helpers </option>
                  </select>
               </div>
            </div>
         </div>
      </div>
      <div class="listing-blocks" id="content_block">
         <div class="row">
            @foreach($agencies as $data)
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
                        <div class="listing-head">
                           <img alt="listings-thumbnail" src="{{URL::to('/')}}/public/cover_img/{{$data->cover_img}}" onerror="this.onerror=null;this.src='{{URL::to('/')}}/public/cover-placeholder.jpg';">
                        </div>
                        <div class="listing-info">
                           <h5> <img alt="user-profile-picture" src="{{URL::to('/')}}/public/profile_img/{{$data->profile_img}}" onerror="this.onerror=null;this.src='{{URL::to('/')}}/public/user-placeholder.jpg';"> {{$data->company}} </h5>
                           <p title="{{empty($data->details) ? '-' : $data->details->description}}"> 
                              {{empty($data->details) ? '-' : $data->details->description}} 
                           </p>
                           <h4> <i class="fa fa-star star-onn"> </i> <b class="star-onn"> {{empty($data->avgRating) ? '0.0' : number_format($data->avgRating[0]->aggregate, 1)}}   </b> <span class="col-grey"> ({{count($data->reviews)}})</span> </h4>
                        </div>
                        <div class="listing-detail">
                           <table>
                              <tbody>
                                 <tr>
                                    <td> Agency address </td>
                                    <td> <strong>{{empty($data->details) ? '-' : $data->details->c_address}}</strong></td>
                                 </tr>
                                 <tr>
                                    <td> No of Available Helper </td>
                                    <td class="col-blue"> <input type="number" value="{{count($data->curr_helpers)}}" readonly="" name=""> </td>
                                 </tr>
                              </tbody>
                           </table>
                        </div>
                        @if(Auth::check() && Auth::user()->type != '3')
                           <div class="listing-actions">
                                 <div> 
                                  @if(in_array($data->id, $favors))
                                      <span class="wishlist-box wishlist-selected"> <input type="checkbox" class="makeFavorite" name="wishlist-add" value="1" data-id="{{base64_encode($data->id)}}" checked>   </span> 
                                  @else
                                      <span class="wishlist-box"> <input type="checkbox" class="makeFavorite" name="wishlist-add" value="1" data-id="{{base64_encode($data->id)}}">   </span> 
                                  @endif
                                </div>
                           </div>
                        @endif
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