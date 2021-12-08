@extends('web.support.master')
@section('title', $data->fname.' '.$data->lname.' | Employer Profile')

@section('content')

<section class="p-t-60 p-b-80">
   <div class="container">
      <div class="row">
         <div class="col-md-9 col-lg-9 col-sm-12 col-xs-12">
            <div class="about-profile">
               <div class="about-profile-image" style="width: 20% !important;margin-bottom: 15px;">
                  <img src="{{URL::to('/')}}/public/profile_img/{{$data->profile_img}}" onerror="this.onerror=null;this.src='{{URL::to('/')}}/public/user-placeholder.jpg';">
               </div>
               <div class="about-profile-name">
                  <h4> {{$data->fname}} {{$data->lname}}</h4>
                  <h6> <strong>{{!empty($data->details) && !empty($data->details->count) ? $data->details->count->country : '-'}}</strong> 
                    @if(!empty($data->details))
                     |
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
                  </h6>
                  @if(Auth::check() && Auth::user()->type != '1')
                    @if(empty($invite->id))
                      <a href="javascript:void(0)" class="normal-btn bg-primary col-white sendInvite" data-id="{{base64_encode($data->id)}}"> Send Invitation to review me </a>
                    @else
                      <div class="alert alert-warning">
                        You have sent review invitaion {{$invite->created_at->diffForHumans()}}
                      </div>
                    @endif
                  @endif
               </div>
            </div>
            <div class="profile-triggers">
               <ul class="nav nav-tabs" role="tablist">
                    <li role="presentation" class="active"><a href="#tabs-1" aria-controls="tabs-1" role="tab" data-toggle="tab">SUBMITTED REVIEWS</a></li>               
                </ul>
               <a href="{{URL::to('/inbox/chat/'.base64_encode($data->id).'/'.$data->fname.' '.$data->lname)}}" class="send-msg-btn bg-primary"> <i class="fa fa-comments"> </i> SEND MESSAGE  </a>
            </div>
            <div class="profile-content">
               <div class="tab-content">
                  <div class="tab-pane active" id="tabs-1" role="tabpanel">
                   <div class="agency-reviews">
                      @foreach($data->ereviews as $val)
                        <div class="agency-review-box">
                           <div>
                              <h5> {{@$val->seller->type == '3' ? @$val->seller->company : @$val->seller->fname.' '.@$val->seller->lname}} </h5>
                              <h6> {{$val->created_at->diffForHumans()}}  </h6>
                              <p> 
                                <strong>{{$val->description}}</strong>
                              </p>
                           </div>
                           <div>
                              @for($i=1; $i<=5; $i++)
                                @if($i <= $val->rating)
                                  <i class="fa fa-star star-onn"> </i>
                                @else
                                  <i class="fa fa-star star-off"> </i>
                                @endif
                              @endfor
                           </div>
                        </div>
                      @endforeach
                   </div>
                </div>

               </div>
            </div>
         </div>
         <div class="col-md-3 col-lg-3 col-sm-12 col-xs-12">
            <div class="adds-block-top">
               <a href=""> <i class="fa fa-times"> </i> </a>
               <p> Lorem ipsum dolor sit amet, consectetur adipisicing elit </p>
            </div>
            <div class="adds-block-bottom">
               <h3> CURRENT AGENCY </h3>
               <p> It is a long established fact that a reader will be distracted by the readable content of a page when looking at its layout. The point of using Lorem Ipsum is that it has a more-or-less normal  </p>
               <a href="javascript:void(0)" class="normal-btn bg-white col-black premium_account"> GO PREMIUM </a>
            </div>
         </div>
      </div>
   </div>
</section>


@endsection