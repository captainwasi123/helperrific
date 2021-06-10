@extends('web.support.master')
@section('title', 'Saved')

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
         <h3> Saved Profiles: </h3>
      </div>
      <div class="listing-blocks">
         <div class="row">
            @foreach($databelt as $data)
               @if($data->user->type == '3')
                  <div class="col-md-3 col-lg-3 col-sm-6 col-xs-12">
                     <a href="{{URL::to('/agencies/detail/'.base64_encode($data->user->id).'/'.$data->user->company)}}" target="_blank">
                        <div class="listing-box">
                           <span class="feat_label">Agency</span>
                           <div class="listing-head">
                              <img alt="listings-thumbnail" src="{{URL::to('/')}}/public/cover_img/{{$data->user->cover_img}}" onerror="this.onerror=null;this.src='{{URL::to('/')}}/public/cover-placeholder.jpg';">
                           </div>
                           <div class="listing-info">
                              <h5> <img alt="user-profile-picture" src="{{URL::to('/')}}/public/profile_img/{{$data->user->profile_img}}" onerror="this.onerror=null;this.src='{{URL::to('/')}}/public/user-placeholder.jpg';"> {{$data->user->company}} </h5>
                              <p title="{{empty($data->user->details) ? '-' : $data->user->details->description}}"> 
                                 {{empty($data->user->details) ? '-' : $data->user->details->description}} 
                              </p>
                              <h4> <i class="fa fa-star star-onn"> </i> <b class="star-onn"> {{empty($data->user->avgRating) ? '0.0' : number_format($data->user->avgRating[0]->aggregate, 1)}}  </b> <span class="col-grey"> ({{count($data->user->reviews)}})</span> </h4>
                           </div>
                           <div class="listing-detail">
                              <table>
                                 <tbody>
                                    <tr>
                                       <td> Agency address </td>
                                       <td> <strong>{{empty($data->user->details) ? '-' : $data->user->details->c_address}}</strong></td>
                                    </tr>
                                    <tr>
                                       <td> No of Available Helper </td>
                                       <td class="col-blue"> <input type="number" value="2" readonly="" name=""> </td>
                                    </tr>
                                 </tbody>
                              </table>
                           </div>
                           @if(Auth::check())
                              <div class="listing-actions">
                                  <div> 
                                    <span class="wishlist-box wishlist-selected"> <input type="checkbox" class="makeFavorite" name="wishlist-add" value="1" data-id="{{base64_encode($data->user->id)}}" checked>   </span> 
                                  </div>  
                                 @if(!empty($data->user->startingSalary))
                                    <p> Starting at: &nbsp;&nbsp;&nbsp;<b> {{$data->user->startingSalary->currency.' '.$data->user->startingSalary->price.' /'.$data->user->startingSalary->renewal}} </b> </p>
                                  @else
                                    <p> Starting at: &nbsp;&nbsp;&nbsp;<b>NA</b></p>
                                  @endif
                              </div>
                           @endif
                        </div>
                     </a>
                  </div>
               @elseif($data->user->type == '2')
                  <div class="col-md-3 col-lg-3 col-sm-6 col-xs-12">
                    <a href="{{URL::to('/helpers/detail/'.base64_encode($data->user->id).'/'.$data->user->fname.' '.$data->user->lname)}}" target="_blank">
                       <div class="listing-box">
                           <span class="feat_label">Helper</span>
                          <div class="listing-head">
                             <img alt="listings-thumbnail" src="{{URL::to('/')}}/public/cover_img/{{$data->user->cover_img}}" onerror="this.onerror=null;this.src='{{URL::to('/')}}/public/cover-placeholder.jpg';">
                          </div>
                          <div class="listing-info">
                             <h5> <img alt="user-profile-picture" src="{{URL::to('/')}}/public/profile_img/{{$data->user->profile_img}}" onerror="this.onerror=null;this.src='{{URL::to('/')}}/public/user-placeholder.jpg';"> {{$data->user->fname}} {{$data->user->lname}} </h5>
                             <p title="{{empty($data->user->details) ? '-' : $data->user->details->description}}"> 
                                {{empty($data->user->details) ? '-' : $data->user->details->description}} 
                             </p>
                             <h4> <i class="fa fa-star star-onn"> </i> <b class="star-onn"> {{empty($data->user->avgRating) ? '0.0' : number_format($data->user->avgRating[0]->aggregate, 1)}}   </b> <span class="col-grey"> ({{count($data->user->reviews)}})</span> </h4>
                          </div>
                          <div class="listing-detail">
                             <table>
                                <tbody>
                                   <tr>
                                      <td> Current Location </td>
                                      <td class="col-blue"> {{!empty($data->user->details) && !empty($data->user->details->count) ? $data->user->details->count->country : '-'}} </td>
                                   </tr>
                                   <tr>
                                      <td> Current Agency </td>
                                      <td class="col-blue"> - </td>
                                   </tr>
                                </tbody>
                             </table>
                          </div>
                          <div class="listing-actions">
                              @if(Auth::check())
                                <div> 
                                  <span class="wishlist-box wishlist-selected"> <input type="checkbox" class="makeFavorite" name="wishlist-add" value="1" data-id="{{base64_encode($data->user->id)}}" checked>   </span> 
                                </div>  
                              @endif
                              @if(!empty($data->user->startingSalary))
                                <p> Starting at: &nbsp;&nbsp;&nbsp;<b> {{$data->user->startingSalary->currency.' '.$data->user->startingSalary->price.' /'.$data->user->startingSalary->renewal}} </b> </p>
                              @else
                                <p> Starting at: &nbsp;&nbsp;&nbsp;<b>NA</b></p>
                              @endif
                          </div>
                       </div>
                    </a>
                  </div>
               @endif
            @endforeach
            @if(count($databelt) == '0') 
              <div class="col-md-12 col-lg-12 col-sm-12 col-xs-12">
                <h4>No Saved Profile.</h4>
              </div>
            @endif        
         </div>
      </div>
   </div>
</section>
<!-- Page Content Ends Here -->

@endsection