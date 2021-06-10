@extends('web.support.master')
@section('title', $data->fname.' '.$data->lname.' | Helpers Profile')

@section('content')
    @php $rating_avg = empty($data->avgRating) ? '0' : $data->avgRating[0]->aggregate; @endphp

<section class="p-t-60 p-b-80">
   <div class="container">
      <div class="row">
         <div class="col-md-9 col-lg-9 col-sm-12 col-xs-12">
            <div class="about-profile">
               <div class="about-profile-image">
                  <img src="{{URL::to('/')}}/public/profile_img/{{$data->profile_img}}" onerror="this.onerror=null;this.src='{{URL::to('/')}}/public/user-placeholder.jpg';">
               </div>
               <div class="about-profile-name">
                  <h4> {{$data->fname}} {{$data->lname}}</h4>
                  <h6> {{!empty($data->details) && !empty($data->details->count) ? $data->details->count->country : '-'}} </h6>
                  @if(in_array($data->id, $favors))
                      <a href="{{URL::to('/favorite/remove/'.base64_encode($data->id))}}" class="normal-btn bg-primary col-white"> Remove from favourites </a> 
                  @else
                      <a href="{{URL::to('/favorite/add/'.base64_encode($data->id))}}" class="normal-btn bg-primary col-white"> Save to favourites </a>
                  @endif
                  @if(Auth::check() && Auth::user()->type == '1')
                    <a href="javascript:void()" class="normal-btn bg-primary col-white open-order" data-id="{{base64_encode($data->id)}}"> Hire Me </a>
                  @endif
                    <div class="row">
                      <div class="col-md-12">
                        <p style="margin-top:10px">
                          <label>Expertise:</label> 
                          @foreach($data->expertise as $val)
                            {{$val->skills->skill.', '}}
                          @endforeach
                          @if(count($data->expertise) == '0')
                            N/A
                          @endif
                        </p>
                      </div>
                    </div>
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
                 <div class="about-profile-startingPrice">
                   Starting Price:<br>
                   <label>{{empty($data->startingSalary) ? 'N/A' : $data->startingSalary->curr->symbol.$data->startingSalary->price.' /'.$data->startingSalary->renewal}}</label>
                 </div>
            </div>
            <div class="profile-triggers">
               <ul class="nav nav-tabs" role="tablist">
                  <li role="presentation" class="active"><a href="#tabs-1" aria-controls="tabs-1" role="tab" data-toggle="tab">SKILLS & EXPERIENCE</a></li>
                  <li role="presentation"><a href="#tabs-2" aria-controls="tabs-2" role="tab" data-toggle="tab">PHOTOS</a></li>
                  <li role="presentation"><a href="#tabs-3" aria-controls="tabs-3" role="tab" data-toggle="tab">REVIEWS</a></li>
               </ul>
               <a href="{{URL::to('/inbox/chat/'.base64_encode($data->id).'/'.$data->fname.' '.$data->lname)}}" class="send-msg-btn bg-primary"> <i class="fa fa-comments"> </i> SEND MESSAGE  </a>
            </div>
            <div class="profile-content">
               <div class="tab-content">
                  <div class="tab-pane active" id="tabs-1" role="tabpanel">
                    <div class="row">
                        <div class="col-md-6 col-lg-6 col-sm-12 col-xs-12">
                           <div class="profile-about-text">
                              <h3> Description </h3>
                              <p> 
                                {{empty($data->details) ? '-' : $data->details->description}}
                              </p>
                           </div>
                        </div>
                        <div class="col-md-6 col-lg-6 col-sm-12 col-xs-12">
                           <div class="profile-about-text">
                              <h3> Skills </h3>
                              <ul>
                                @foreach($data->skills as $val)
                                  <li> <b> . </b> {{$val->skills->skill}} </li>
                                @endforeach

                              </ul>
                           </div>
                        </div>
                        <div class="col-md-6 col-lg-6 col-sm-12 col-xs-12">
                           <div class="profile-about-text">
                              <h3> Qualification </h3>
                              @foreach($data->qualification as $val)
                                <p> {{$val->qual->qualification}} </p>
                              @endforeach
                           </div>
                        </div>

                        <div class="col-md-6 col-lg-6 col-sm-12 col-xs-12">
                           <div class="profile-about-text">
                              <h3> Education </h3>
                              @foreach($data->education as $val)
                                <p> {{$val->certificate}} </p>
                                <p> {{$val->country}} </p>
                                <br>
                              @endforeach
                           </div>
                        </div>

                        <div class="col-md-12 col-lg-12 col-sm-12 col-xs-12">
                           <div class="profile-about-text">
                              <h3> Experience </h3>
                              @foreach($data->experience as $val)
                                <p> 
                                  <span> Name:{{$val->employer}} </span> 
                                  <span> Start Year: {{$val->start_year}} </span>
                                  <span> End Year: {{$val->end_year}} </span>
                                  <span> Agency: {{$val->agency}} </span>
                                  <br>
                                </p>
                              @endforeach
                           </div>
                        </div>


                     </div>
                  </div>
                  <div class="tab-pane" id="tabs-2" role="tabpanel">
                     <div class="photos-content">  
                      <section id="gallery">
                        <div class="container">
                          <div id="image-gallery">
                            <div class="row">
                              @foreach($data->gallery as $val)
                              <div class="col-lg-3 col-md-6 col-sm-6 col-xs-12 image">
                                <div class="img-wrapper">
                                  <a href="{{URL::to('/public/gallery_img/'.$val->id.'-'.$val->image)}}"><img src="{{URL::to('/public/gallery_img/'.$val->id.'-'.$val->image)}}" class="img-responsive"></a>
                                  <div class="img-overlay">
                                    <i class="fa fa-plus-circle" aria-hidden="true"></i>
                                  </div>
                                </div>
                              </div>
                              @endforeach
                              @if(count($data->gallery) == '0')
                                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                  <h5>No Data Found.</h5>
                                </div>
                              @endif
                            </div><!-- End row -->
                          </div><!-- End image gallery -->
                        </div><!-- End container --> 
                      </section>    
                    </div>
                  </div>
                  <div class="tab-pane" id="tabs-3" role="tabpanel">
                    <div class="agency-reviews">
                        <div class="row">
                          <div class="col-md-6">
                            @if(Auth::check() && Auth::user()->type == '1')
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