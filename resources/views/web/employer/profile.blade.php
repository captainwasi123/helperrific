@extends('web.support.master')
@section('title', 'Profile | Employer')

@section('content')

  <section class="p-t-60 p-b-80">
     <div class="container">
        <div class="row">
           <div class="col-md-9 col-lg-9 col-sm-12 col-xs-12">
              <div class="about-profile">
                 <div class="about-profile-image">
                  <div class="avatar-upload">
                      <form method="post" action="{{URL::to('/profilePic/upload')}}" id="profile_form" enctype="multipart/form-data">
                        {{csrf_field()}}
                        <div class="avatar-edit avatar-edit2">
                            <input type='file' id="profile_pic" data-preview="profilePreview" accept=".png, .jpg, .jpeg" name="profileImage"  />
                            <label for="profile_pic"> <i class="fa fa-pencil"> </i> </label>
                        </div>
                        <div class="avatar-preview">
                            <div id="profilePreview" style="
                              @if(empty(Auth::user()->profile_img))
                                background-image: url('{{URL::to('/')}}/public/user-placeholder.jpg');
                              @else
                                background-image: url('{{URL::to('/')}}/public/profile_img/{{Auth::user()->profile_img}}');
                              @endif
                            ">
                            </div>
                        </div>
                      </form>
                  </div>
                 </div>
                 <div class="about-profile-name">
                    <h4 data-toggle="modal" data-target=".review-modal"> {{Auth::user()->fname}} {{Auth::user()->lname}}</h4>
                    <h6> <strong>{{!empty(Auth::user()->details) && !empty(Auth::user()->details->count) ? Auth::user()->details->count->country : '-'}}</strong>
                     @if(!empty(Auth::user()->details))
                     |
                        @switch(Auth::user()->details->e_looking_status)
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
                    <a href="{{URL::to('/employer/form_1')}}" class="normal-btn bg-primary col-white"> Update Info </a>
                 </div>
              </div>
              <div class="profile-triggers">
                 <ul class="nav nav-tabs" role="tablist">
                    <li role="presentation" class="active"><a href="#tabs-1" aria-controls="tabs-1" role="tab" data-toggle="tab">SUBMITTED REVIEWS</a></li>
                    <li role="presentation"><a href="#tabs-4" aria-controls="tabs-4" role="tab" data-toggle="tab">INVITES</a></li>
                    <li role="presentation"><a href="#tabs-2" aria-controls="tabs-2" role="tab" data-toggle="tab">HELPERS SAVED</a></li>
                    <li role="presentation"><a href="#tabs-3" aria-controls="tabs-3" role="tab" data-toggle="tab">AGENCY SAVED</a></li>
                 </ul>
              </div>
              <div class="profile-content">
                 <div class="tab-content">
                    <div class="tab-pane active" id="tabs-1" role="tabpanel">
                       <div class="agency-reviews">
                          @foreach(Auth::user()->ereviews as $val)
                            <div class="agency-review-box">
                               <div>
                                  <h5> {{$val->seller->type == '3' ? $val->seller->company : $val->seller->fname.' '.$val->seller->lname}} </h5>
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
                     <div class="tab-pane" id="tabs-4" role="tabpanel">
                        <div class="row">
                           <div class="col-md-12 col-lg-12 col-sm-12 col-xs-12">
                              <div class="table-responsive">
                                 <table class="table">
                                    <thead>
                                       <tr>
                                          <th>#</th>
                                          <th>Request</th>
                                          <th>Request at</th>
                                       </tr>
                                    </thead>
                                    <tbody>
                                       @php $s=1; @endphp
                                       @foreach(Auth::user()->reviewInvitation as $val)
                                          @if(!empty($val->requestBy->id))
                                             <tr>
                                                <td>{{$s}}</td>
                                                <td>
                                                   @if($val->requestBy->type == '3')
                                                     <a href="{{URL::to('/agencies/detail/'.base64_encode(@$val->requestBy->id))}}/{{empty($val->requestBy->company) ? 'New User' : $val->requestBy->company}}" target="_blank">
                                                  @else
                                                     <a href="{{URL::to('/helpers/detail/'.base64_encode($val->requestBy->id))}}/{{empty($val->requestBy->fname) ? 'New User' : $val->requestBy->fname.' '.$val->requestBy->lname}}" target="_blank">
                                                  @endif
                                                      <div class="profile-block">
                                                         <img src="{{URL::to('/')}}/public/profile_img/{{$val->requestBy->profile_img}}" onerror="this.onerror=null;this.src='{{URL::to('/')}}/public/user-placeholder.jpg';">
                                                         <h4>
                                                            @if($val->requestBy->type == '3')
                                                               {{empty($val->requestBy->company) ? 'New Agency' : $val->requestBy->company}}
                                                             @else
                                                               {{empty($val->requestBy->fname) ? 'New User' : $val->requestBy->fname.' '.$val->requestBy->lname}}
                                                             @endif
                                                         </h4>
                                                         <span class="label label-warning">{{$val->requestBy->type == '3' ? 'Agency' : 'Helper'}}</span>
                                                      </div>
                                                   </a>
                                                </td>
                                                <td>{{$val->created_at->diffForHumans()}}</td>
                                             </tr>
                                             @php $s++; @endphp
                                          @endif
                                       @endforeach
                                       @if(count(Auth::user()->reviewInvitation) == 0)
                                          <tr>
                                             <td colspan="4">No Request Found.</td>
                                          </tr>
                                       @endif
                                    </tbody>
                                 </table>
                              </div>
                           </div>
                        </div>
                     </div>
                    <div class="tab-pane" id="tabs-2" role="tabpanel">
                       <div class="row">
                          @foreach(Auth::user()->favorite as $val)
                            @if($val->user->type == '2')
                              <div class="col-md-3 col-lg-3 col-sm-6 col-xs-6">
                                 @if(Auth::user()->type == '1')
                                    @if(count(Auth::user()->viewCount) < 5 || !empty(Auth::user()->premium))
                                       <a href="{{URL::to('/helpers/detail/'.base64_encode($val->user->id).'/'.$val->user->fname.' '.$val->user->lname)}}" style="width:100%;">
                                    @else
                                       <a href="javascript:void(0)" class="limit-reached" style="width:100%;">
                                    @endif
                                 @else
                                    <a href="{{URL::to('/helpers/detail/'.base64_encode($val->user->id).'/'.$val->user->fname.' '.$val->user->lname)}}" style="width:100%;">
                                 @endif
                                    <div class="helper-box">
                                       <img alt="agency-avatar" width="100" src="{{URL::to('/')}}/public/profile_img/{{$val->user->profile_img}}" onerror="this.onerror=null;this.src='{{URL::to('/')}}/public/user-placeholder.jpg';">
                                       <h4> {{$val->user->fname}} {{$val->user->lname}} </h4>
                                       <h5> {{!empty($val->user->details) && !empty($val->user->details->count) ? $val->user->details->count->country : '-'}} </h5>
                                       <h6> <b class="star-onn"> <i class="fa fa-star star-onn"> </i> {{empty($val->user->avgRating) ? '0.0' : number_format($val->user->avgRating[0]->aggregate, 1)}} </b> ({{count($val->user->reviews)}})</h6>
                                    </div>
                                 </a>
                              </div>
                            @endif
                          @endforeach
                       </div>
                    </div>
                    <div class="tab-pane" id="tabs-3" role="tabpanel">
                       <div class="row">
                          @foreach(Auth::user()->favorite as $val)
                            @if($val->user->type == '3')
                              <div class="col-md-3 col-lg-3 col-sm-6 col-xs-6">
                                 @if(Auth::user()->type == '1')
                                    @if(count(Auth::user()->viewCount) < 5 || !empty(Auth::user()->premium))
                                       <a href="{{URL::to('/agencies/detail/'.base64_encode($val->user->id).'/'.$val->user->company)}}" style="width:100%">
                                    @else
                                       <a href="javascript:void(0)" class="limit-reached" style="width:100%">
                                    @endif
                                 @else
                                    <a href="{{URL::to('/agencies/detail/'.base64_encode($val->user->id).'/'.$val->user->company)}}" style="width:100%">
                                 @endif
                                    <div class="helper-box">
                                       <img alt="agency-avatar" width="100" src="{{URL::to('/')}}/public/profile_img/{{$val->user->profile_img}}" onerror="this.onerror=null;this.src='{{URL::to('/')}}/public/user-placeholder.jpg';">
                                       <h4> {{$val->user->company}}</h4>
                                       <h5> {{!empty($val->user->details) && !empty($val->user->details->count) ? $val->user->details->count->country : '-'}} </h5>
                                       <h6> <b class="star-onn"> <i class="fa fa-star star-onn"> </i> {{empty($val->user->avgRating) ? '0.0' : number_format($val->user->avgRating[0]->aggregate, 1)}} </b> ({{count($val->user->reviews)}})</h6>
                                    </div>
                                 </a>
                              </div>
                            @endif
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
                 <a href="" class="normal-btn bg-white col-black"> GO PREMIUM </a>
              </div>
           </div>
        </div>
     </div>
  </section>



@endsection
@section('addStyle')
  <style type="text/css">
    hr {
      margin-top: 10px;
      margin-bottom: 5px;
    }
  </style>
@endsection
@section('addScript')
@endsection