@extends('web.support.master')
@section('title', $data->company.' | Agency Profile')

@section('content')
    @php $rating_avg = empty($data->avgRating) ? '0' : $data->avgRating[0]->aggregate; @endphp

<section class="p-t-60 p-b-80">
 <div class="container">
    <div class="row">
       <div class="col-md-9 col-lg-9 col-sm-12 col-xs-12">
          <div class="about-profile">
             <div class="about-profile-image">
                <img  src="{{URL::to('/')}}/public/profile_img/{{$data->profile_img}}" onerror="this.onerror=null;this.src='{{URL::to('/')}}/public/user-placeholder.jpg';">
             </div>
             <div class="about-profile-name">
                <h4> {{$data->company}} </h4>
                <h6> {{!empty($data->details) && !empty($data->details->count) ? $data->details->count->country : '-'}}  </h6>
                @if(in_array($data->id, $favors))
                  <a href="{{URL::to('/favorite/remove/'.base64_encode($data->id))}}" class="normal-btn bg-primary col-white"> Remove from favourites </a> 
                @else
                  <a href="{{URL::to('/favorite/add/'.base64_encode($data->id))}}" class="normal-btn bg-primary col-white"> Save to favourites </a>
                @endif <br> <br>
                @if(Auth::check())
                    @if(empty($invite->id))
                      <a href="javascript:void(0)" class="normal-btn bg-primary col-white sendInvite" data-id="{{base64_encode($data->id)}}"> Send Invitation to review me </a>
                    @else
                      <div class="alert alert-warning">
                        You have sent review invitaion {{$invite->created_at->diffForHumans()}}
                      </div>
                    @endif
                  @endif
                @if(Auth::check() && Auth::user()->type == '2')
                  <a href="javascript:void(0)" data-id="{{base64_encode($data->id)}}" class="normal-btn bg-primary col-white joinAgency"> Join </a>
                @endif
                @if(Auth::check() && Auth::user()->type == '1')
                  <a href="javascript:void(0)" class="normal-btn bg-primary col-white open-order" data-id="{{base64_encode($data->id)}}"> Hire Me </a>
                @endif

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
                <li role="presentation"><a href="#tabs-2" aria-controls="tabs-2" role="tab" data-toggle="tab">CURRENT HELPERS</a></li>
                <li role="presentation"><a href="#tabs-3" aria-controls="tabs-3" role="tab" data-toggle="tab">STAR HELPERS</a></li>
                <li role="presentation"><a href="#tabs-4" aria-controls="tabs-4" role="tab" data-toggle="tab">AGENCY REVIEWS</a></li>
             </ul>
             <a href="{{URL::to('/inbox/chat/'.base64_encode($data->id).'/'.$data->company)}}" class="send-msg-btn bg-primary"> <i class="fa fa-comments"> </i> SEND MESSAGE  </a>
          </div>
          <div class="profile-content">
             <div class="tab-content">
                <div class="tab-pane active" id="tabs-1" role="tabpanel">
                   <div class="row">
                      <div class="col-md-6 col-lg-6 col-sm-12 col-xs-12">
                         <div class="profile-about-text">
                            <h3> Description </h3>
                            <p> 
                              {{empty($data->details->description) ? '-' : $data->details->description}} 
                            </p>
                         </div>
                      </div>
                      <div class="col-md-3 col-lg-3 col-sm-6 col-xs-12">
                         <div class="profile-about-text">
                            <h3> Country </h3>
                            <p> {{!empty($data->details) && !empty($data->details->count) ? $data->details->count->country : '-'}} </p>
                         </div>
                         <div class="profile-about-text">
                            <h3> Email </h3>
                            <p> {{empty($data->details) ? '-' : $data->details->c_email}} </p>
                         </div>
                      </div>
                      <div class="col-md-3 col-lg-3 col-sm-6 col-xs-12">
                         <div class="profile-about-text">
                            <h3> Address </h3>
                            <p> {{empty($data->details) ? '-' : $data->details->c_address}} </p>
                         </div>
                         <div class="profile-about-text">
                            <h3> Contact </h3>
                            <p> {{empty($data->details) ? '-' : $data->details->c_phone}} </p>
                         </div>
                      </div>
                   </div>
                </div>
                <div class="tab-pane" id="tabs-2" role="tabpanel">
                   <div class="row">
                     @if(!empty($data->premium))
                        @foreach($curr_helper as $val)
                           @if(!empty($val->helper->fname))
                             <div class="col-md-3 col-lg-3 col-sm-6 col-xs-6">
                                <div class="helper-box">
                                   <img alt="agency-avatar" class="h_profile" width="100" src="{{URL::to('/')}}/public/profile_img/{{$val->helper->profile_img}}" onerror="this.onerror=null;this.src='{{URL::to('/')}}/public/user-placeholder.jpg';">
                                   <h4> {{$val->helper->fname}} {{$val->helper->lname}} </h4>
                                   <h5> {{!empty($val->helper->details) && !empty($val->helper->details->count) ? $val->helper->details->count->country : '-'}} </h5>
                                   <h6> <b class="star-onn"> <i class="fa fa-star star-onn"> </i> {{empty($val->helper->avgRating) ? '0.0' : number_format($val->helper->avgRating[0]->aggregate, 1)}} </b> ({{count($val->helper->reviews)}}) </h6>
                                   
                                </div>
                             </div>
                           @endif
                       @endforeach
                       @if(count($curr_helper) == '0')
                          <div class="col-md-12">
                             <h5>No Helpers Found.</h5>
                          </div>
                       @endif
                     @else
                       <div class="col-md-12">
                          <h5>This agency does not have premium membership.</h5>
                       </div>
                     @endif
                  </div>
                </div>
                <div class="tab-pane" id="tabs-3" role="tabpanel">
                   <div class="row">
                     @if(!empty($data->premium))
                       @foreach($star_helper as $val)
                           @if(!empty($val->helper->fname))
                             <div class="col-md-3 col-lg-3 col-sm-6 col-xs-6">
                                <div class="helper-box">
                                   <img alt="agency-avatar" class="h_profile" width="100" src="{{URL::to('/')}}/public/profile_img/{{$val->helper->profile_img}}" onerror="this.onerror=null;this.src='{{URL::to('/')}}/public/user-placeholder.jpg';">                                 <span class="star-helper-icon"> <img src="{{URL::to('/')}}/assets/images/star-helper-icon.png"> </span>
                                   <h4> {{$val->helper->fname}} {{$val->helper->lname}} </h4>
                                   <h5> {{!empty($val->helper->details) && !empty($val->helper->details->count) ? $val->helper->details->count->country : '-'}}  </h5>
                                   <h6> <b class="star-onn"> <i class="fa fa-star star-onn"> </i> {{empty($val->helper->avgRating) ? '0.0' : number_format($val->helper->avgRating[0]->aggregate, 1)}} </b> ({{count($val->helper->reviews)}}) </h6>
                                   
                                </div>
                             </div>
                           @endif
                       @endforeach
                       @if(count($star_helper) == '0')
                          <div class="col-md-12">
                             <h5>No Helpers Found.</h5>
                          </div>
                       @endif
                     @else
                       <div class="col-md-12">
                          <h5>This agency does not have premium membership.</h5>
                       </div>
                     @endif
                  </div>
                </div>
                <div class="tab-pane" id="tabs-4" role="tabpanel">
                   <div class="agency-reviews">
                        <div class="row">
                          <div class="col-md-6">
                            <!-- if Auth: : check () & & Auth :: user ()-> type == '1' -->
                            @if(Auth::check())
                              <a href="javascript:void(0);" class="normal-btn bg-primary col-white writeReview" data-id="{{base64_encode($data->id)}}" data-name="{{$data->fname}} {{$data->lname}}"> Write review </a>
                            @endif
                          </div>
                          <div class="col-md-6">
                            <div class="agency-reviews-head">
                               <h4> <b> {{number_format($rating_avg, 1)}} </b> Average </h4>
                               <h4> <b> {{count($data->reviews)}} </b> Reviews </h4>
                            </div>
                          </div>
                        </div>
                      @foreach($data->reviews as $val)
                         <div class="agency-review-box">
                             <div>
                                <h5> {{@$val->buyer->fname.' '.@$val->buyer->lname}} </h5>
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
             <a href="javascript:void(0)" class="normal-btn bg-white col-black premium_account"> GO PREMIUM  </a>
          </div>
       </div>
    </div>
 </div>
</section>

@endsection
@section('addScript')

<script type="text/javascript">
  $(document).ready(function(){

    $(document).on('click', '.joinAgency', function(){
      var id = $(this).data('id');
      swal({
         title: "Are you sure you want to join this agency?",
         text: "",
         icon: "warning",
         buttons: true,
         dangerMode: true,
         })
         .then((willDelete) => {
         if (willDelete) {
            window.location.href = '../../../agency/join/'+id;
         }
      });
       
      
     
    });

  });
</script>

@endsection