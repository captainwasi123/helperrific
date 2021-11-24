@extends('web.support.master')
@section('title', 'Agency Profile')

@section('content')
    @php $rating_avg = empty(Auth::user()->avgRating) ? '0' : Auth::user()->avgRating[0]->aggregate; @endphp

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
                            <label for="profile_pic"> <i class="fa fa-pencil-alt"> </i> </label>
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
                  <h4> {{Auth::user()->company}} </h4>
                  <h6> {{empty(Auth::user()->details) ? '-' : Auth::user()->details->count->country}} </h6>
                  <a href="{{URL::to('/agency/form')}}" class="normal-btn bg-primary col-white"> Update Info </a>

                   @if(session()->has('success'))
                     <br><br>
                       <div class="alert alert-success">
                           {{ session()->get('success') }}
                       </div>
                   @endif
                   @if(session()->has('error'))
                     <br><br>
                       <div class="alert alert-danger">
                           {{ session()->get('error') }}
                       </div>
                   @endif
               </div>
               <div class="about-profile-review">
                  <h4> {{number_format($rating_avg, 1)}} </h4>
                  <h5> 
                    @for($i=1; $i<=5; $i++)
                      @if($i <= $rating_avg)
                        <i class="fa fa-star star-onn"> </i>
                      @else
                        <i class="fa fa-star star-off"> </i>
                      @endif
                    @endfor
                  </h5>
               </div>
            </div>
            <div class="profile-triggers">
               <ul class="nav nav-tabs" role="tablist">
                  <li role="presentation" class="active"><a href="#tabs-1" aria-controls="tabs-1" role="tab" data-toggle="tab">ABOUT</a></li>
                  <li role="presentation"><a href="#request_tab" aria-controls="request_tab" role="tab" data-toggle="tab">JOIN REQUEST</a></li>
                  <li role="presentation"><a href="#tabs-2" aria-controls="tabs-2" role="tab" data-toggle="tab">CURRENT HELPERS</a></li>
                  <li role="presentation"><a href="#tabs-3" aria-controls="tabs-3" role="tab" data-toggle="tab">STAR HELPERS</a></li>
                  <li role="presentation"><a href="#tabs-4" aria-controls="tabs-4" role="tab" data-toggle="tab">AGENCY REVIEWS</a></li>
                  <li role="presentation"><a href="#tabs-5" aria-controls="tabs-5" role="tab" data-toggle="tab">INVITES</a></li>
               </ul>
            </div>
            <div class="profile-content">
               <div class="tab-content">
                  <div class="tab-pane active" id="tabs-1" role="tabpanel">
                     <div class="row">
                        <div class="col-md-6 col-lg-6 col-sm-12 col-xs-12">
                           <div class="profile-about-text">
                              <h3> Description </h3>
                              <p> 
                                 {{empty(Auth::user()->details) ? '-' : Auth::user()->details->description}} 
                              </p>
                           </div>
                        </div>
                        <div class="col-md-3 col-lg-3 col-sm-6 col-xs-12">
                           <div class="profile-about-text">
                              <h3> Country </h3>
                              <p> {{empty(Auth::user()->details) ? '-' : Auth::user()->details->count->country}} </p>
                           </div>
                           <div class="profile-about-text">
                              <h3> Email </h3>
                              <p> {{empty(Auth::user()->details) ? '-' : Auth::user()->details->c_email}} </p>
                           </div>
                        </div>
                        <div class="col-md-3 col-lg-3 col-sm-6 col-xs-12">
                           <div class="profile-about-text">
                              <h3> Address </h3>
                              <p> {{empty(Auth::user()->details) ? '-' : Auth::user()->details->c_address}} </p>
                           </div>
                           <div class="profile-about-text">
                              <h3> Contact </h3>
                              <p> {{empty(Auth::user()->details) ? '-' : Auth::user()->details->c_phone}} </p>
                           </div>
                        </div>
                     </div>
                  </div>
                  <div class="tab-pane" id="request_tab" role="tabpanel">
                     <div class="row">
                        <div class="col-md-12 col-lg-12 col-sm-12 col-xs-12">
                           <div class="table-responsive">
                              <table class="table">
                                 <thead>
                                    <tr>
                                       <th>#</th>
                                       <th>Helper Name</th>
                                       <th>Request at</th>
                                       <th>Action</th>
                                    </tr>
                                 </thead>
                                 <tbody>
                                    @php $s=1; @endphp
                                    @foreach($request as $val)
                                       <tr>
                                          <td>{{$s}}</td>
                                          <td><a href="{{URL::to('/helpers/detail/'.base64_encode($val->helper->id).'/'.$val->helper->fname.' '.$val->helper->lname)}}" target="_blank">{{$val->helper->fname.' '.$val->helper->lname}}</a></td>
                                          <td>{{$val->created_at->diffForHumans()}}</td>
                                          <td>
                                             <a href="javascript:void(0)" data-id="{{base64_encode($val->helper_id)}}" title="Approve" class="btn btn-sm btn-success approveRequest">
                                                <span class="fa fa-check"></span>
                                             </a>
                                             <a href="javascript:void(0)" data-id="{{base64_encode($val->helper_id)}}" title="Reject" class="btn btn-sm btn-danger rejectRequest">
                                                <span class="fa fa-ban"></span>
                                             </a>
                                          </td>
                                       </tr>
                                       @php $s++; @endphp
                                    @endforeach
                                    @if(count($request) == 0)
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
                        @foreach($curr_helper as $val)
                           <div class="col-md-3 col-lg-3 col-sm-6 col-xs-6">
                              <div class="helper-box">
                                 <img alt="agency-avatar" class="h_profile" width="100" src="{{URL::to('/')}}/public/profile_img/{{$val->helper->profile_img}}" onerror="this.onerror=null;this.src='{{URL::to('/')}}/public/user-placeholder.jpg';">
                                 <h4> {{$val->helper->fname}} {{$val->helper->lname}} </h4>
                                 <h5> {{empty($val->helper->details) ? '-' : $val->helper->details->country}}  </h5>
                                 <h6> <b class="star-onn"> <i class="fa fa-star star-onn"> </i> {{empty($val->helper->avgRating) ? '0.0' : number_format($val->helper->avgRating[0]->aggregate, 1)}} </b> ({{count($val->helper->reviews)}})  </h6>
                                 
                                 <div class="dropdown">
                                    <button class="dropdown-toggle" type="button" id="dropdownMenu1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
                                       <span class="fa fa-ellipsis-v"></span>
                                    </button>
                                    <ul class="dropdown-menu" aria-labelledby="dropdownMenu1">
                                       @if(!empty(Auth::user()->premium))
                                          <li><a href="javascript::void(0)" class="makeStar" data-id="{{base64_encode($val->helper_id)}}">Star Helper</a></li>
                                       @else
                                          <li><a href="javascript::void(0)" class="null-star">Star Helper</a></li>
                                       @endif
                                       <li role="separator" class="divider"></li>
                                       <li><a href="javascript::void(0)" class="terminateHelper" data-id="{{base64_encode($val->helper_id)}}">Terminate</a></li>
                                    </ul>
                                 </div>
                              </div>
                           </div>
                        @endforeach
                        @if(count($curr_helper) == '0')
                           <div class="col-md-12">
                              <h5>No Helpers Found.</h5>
                           </div>
                        @endif
                     </div>
                  </div>
                  <div class="tab-pane" id="tabs-3" role="tabpanel">
                     <div class="row">
                        @foreach($star_helper as $val)
                           <div class="col-md-3 col-lg-3 col-sm-6 col-xs-6">
                              <div class="helper-box">
                                 <img alt="agency-avatar" class="h_profile" width="100" src="{{URL::to('/')}}/public/profile_img/{{$val->helper->profile_img}}" onerror="this.onerror=null;this.src='{{URL::to('/')}}/public/user-placeholder.jpg';">                                 <span class="star-helper-icon"> <img src="{{URL::to('/')}}/assets/images/star-helper-icon.png"> </span>
                                 <h4> {{$val->helper->fname}} {{$val->helper->lname}} </h4>
                                 <h5> {{empty($val->helper->details) ? '-' : $val->helper->details->country}}  </h5>
                                 <h6> <b class="star-onn"> <i class="fa fa-star star-onn"> </i> {{empty($val->helper->avgRating) ? '0.0' : number_format($val->helper->avgRating[0]->aggregate, 1)}} </b> ({{count($val->helper->reviews)}}) </h6>
                                 
                                 <div class="dropdown">
                                    <button class="dropdown-toggle" type="button" id="dropdownMenu1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
                                       <span class="fa fa-ellipsis-v"></span>
                                    </button>
                                    <ul class="dropdown-menu" aria-labelledby="dropdownMenu1">
                                       <li><a href="javascript::void(0)" class="removeStar" data-id="{{base64_encode($val->helper_id)}}">Remove Star</a></li>
                                       <li role="separator" class="divider"></li>
                                       <li><a href="javascript::void(0)" class="terminateHelper" data-id="{{base64_encode($val->helper_id)}}">Terminate</a></li>
                                    </ul>
                                 </div>
                              </div>
                           </div>
                        @endforeach
                        @if(count($star_helper) == '0')
                           <div class="col-md-12">
                              <h5>No Helpers Found.</h5>
                           </div>
                        @endif
                     </div>
                  </div>
                  <div class="tab-pane" id="tabs-4" role="tabpanel">
                     <p class="InvitationM">
                     To get more reviews, search for your past clients and click on the button  
                        <strong>"Send Invitation to review me"</strong>
                     </p>
                     <div class="agency-reviews">
                        <div class="agency-reviews-head">
                           <h4> <b> {{number_format($rating_avg, 1)}} </b> Average </h4>
                           <h4> <b> {{count(Auth::user()->reviews)}} </b> Reviews </h4>
                        </div>
                        @foreach(Auth::user()->reviews as $val)
                           <div class="agency-review-box">
                               <div>
                                  <h5> {{$val->buyer->fname.' '.$val->buyer->lname}} </h5>
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
                  <div class="tab-pane" id="tabs-5" role="tabpanel">
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
                                                      <a href="{{URL::to('/agencies/detail/'.base64_encode(@$val->requestBy->id).'/'.$val->requestBy->company)}}" target="_blank">
                                                   @else
                                                      <a href="{{URL::to('/helpers/detail/'.base64_encode($val->requestBy->id).'/'.$val->requestBy->fname.' '.$val->requestBy->lname)}}" target="_blank">
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
@section('addScript')

<script type="text/javascript">
  $(document).ready(function(){

    $(document).on('click', '.approveRequest', function(){
      var id = $(this).data('id');
      swal({
         title: "Are you sure your want to confirm this request?",
         text: "",
         icon: "warning",
         buttons: true,
         dangerMode: true,
         })
         .then((willDelete) => {
         if (willDelete) {
            window.location.href = 'request/accept/'+id;
         }
      });
    });

    $(document).on('click', '.rejectRequest', function(){
      var id = $(this).data('id');
      swal({
         title: "Are you sure your want to reject this request?",
         text: "",
         icon: "warning",
         buttons: true,
         dangerMode: true,
         })
         .then((willDelete) => {
         if (willDelete) {
            window.location.href = 'request/reject/'+id;
         }
      });
    });

    $(document).on('click', '.makeStar', function(){
      var id = $(this).data('id');
      swal({
         title: "Are you sure?",
         text: "want to make star helper!",
         icon: "warning",
         buttons: true,
         dangerMode: true,
         })
         .then((willDelete) => {
         if (willDelete) {
            window.location.href = 'helper/star/'+id;
         }
      });
    });
    $(document).on('click', '.removeStar', function(){
      var id = $(this).data('id');
      swal({
         title: "Are you sure?",
         text: "want to remove from star helper!",
         icon: "warning",
         buttons: true,
         dangerMode: true,
         })
         .then((willDelete) => {
         if (willDelete) {
            window.location.href = 'helper/removeStar/'+id;
         }
      });
    });

    $(document).on('click', '.terminateHelper', function(){
      var id = $(this).data('id');
      swal({
         title: "Are you sure?",
         text: "want to terminate this helper!",
         icon: "warning",
         buttons: true,
         dangerMode: true,
         })
         .then((willDelete) => {
         if (willDelete) {
            window.location.href = 'helper/terminate/'+id;
         }
      });
    });


  });
</script>

@endsection