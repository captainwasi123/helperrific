@extends('web.support.master')
@section('title', 'Helper Profile')

@section('content')
    @php $rating_avg = empty(Auth::user()->avgRating) ? '0' : Auth::user()->avgRating[0]->aggregate; @endphp
      <section class="p-t-60 p-b-80 ">
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
                        <h4> {{Auth::user()->fname}} {{Auth::user()->lname}}</h4>
                        <h6> {{!empty(Auth::user()->details) && !empty(Auth::user()->details->count) ? Auth::user()->details->count->country : '-'}}   
                        @if($check_a != 0)
                          <strong style=" margin-left: 27px; ">{{Auth::user()->agency->agency->company}}</strong> 
                        @endif
                        </h6> 
                        <a href="{{URL::to('/helper/form_1')}}" class="normal-btn bg-primary col-white"> Update Info </a>
                        <br><br>
                        @if($check_a == 0)
                        <div class="alert alert-warning">
                        If you are affiliated with you an agency, you should invite them to display you affiliation by searching for them and clicking on the button that says "Join".
                        </div>
                        <br><br>
                        @endif
                        <div class="row">
                          <div class="col-md-6">
                            <label>Availability:</label><br>
                            <select class="form-control" id="availability_status">
                               <option value=""> Select  </option>
                               @foreach($availability as $val)
                                  <option value="{{$val->id}}"
                                    {{Auth::user()->availibility_status == $val->id ? 'selected' : ''}}
                                  > {{$val->status}} </option>
                               @endforeach
                            </select>
                          </div>
                          <div class="col-md-12">
                            <p style="margin-top:10px">
                              <label>Expertise:</label> 
                              @foreach(Auth::user()->expertise as $val)
                                {{$val->skills->skill.', '}}
                              @endforeach
                              @if(count(Auth::user()->expertise) == '0')
                                N/A
                              @endif
                            </p>

                            @if(session()->has('success'))
                              <div class="alert alert-success">
                                {{ session()->get('success') }}
                              </div>
                            @endif
                          </div>
                        </div>
                        
                        @if(!empty(Auth::user()->agency) && Auth::user()->agency->status == '1')
                          <br><br>
                            <div class="alert alert-warning">
                                Your joining request is in review by Agency <strong>({{Auth::user()->agency->agency->company}})</strong>.
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
                     <div class="about-profile-startingPrice">
                       Starting Price:<br>
                       <label>{{empty(Auth::user()->startingSalary) ? 'N/A' : Auth::user()->startingSalary->curr->symbol.Auth::user()->startingSalary->price.' /'.Auth::user()->startingSalary->renewal}}</label>
                     </div>
                  </div>
                  <div class="profile-triggers">
                     <ul class="nav nav-tabs" role="tablist">
                        <li role="presentation" class="active"><a href="#tabs-1" aria-controls="tabs-1" role="tab" data-toggle="tab">SKILLS & EXPERIENCE</a></li>
                        <li role="presentation"><a href="#tabs-2" aria-controls="tabs-2" role="tab" data-toggle="tab">PHOTOS</a></li>
                        <li role="presentation"><a href="#tabs-3" aria-controls="tabs-3" role="tab" data-toggle="tab">REVIEWS</a></li>
                        <li role="presentation"><a href="#tabs-4" aria-controls="tabs-4" role="tab" data-toggle="tab">INVITES</a></li>
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
                              <div class="col-md-6 col-lg-6 col-sm-12 col-xs-12">
                                 <div class="profile-about-text">
                                    <h3> Skills </h3>
                                    <ul>
                                      @foreach(Auth::user()->skills as $val)
                                        <li> <b> . </b> {{$val->skills->skill}} </li>
                                      @endforeach

                                    </ul>
                                 </div>
                              </div>
                              <div class="col-md-6 col-lg-6 col-sm-12 col-xs-12">
                                 <div class="profile-about-text">
                                    <h3> Qualification </h3>
                                    @foreach(Auth::user()->qualification as $val)
                                      <p> {{@$val->qual->qualification}} </p>
                                    @endforeach
                                 </div>
                              </div>

                              <div class="col-md-6 col-lg-6 col-sm-12 col-xs-12">
                                 <div class="profile-about-text">
                                    <h3> Education </h3>
                                    @foreach(Auth::user()->education as $val)
                                      <p> {{$val->certificate}} </p>
                                      <p> {{$val->country}} </p>
                                      <br>
                                    @endforeach
                                 </div>
                              </div>

                              <div class="col-md-12 col-lg-12 col-sm-12 col-xs-12">
                                 <div class="profile-about-text">
                                    <h3> Experience </h3>
                                    @foreach(Auth::user()->experience as $val)
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
                            <div class="row">
                              <div class="col-md-6 col-lg-6 col-sm-6 col-xs-12">
                                <div class="uploader-title">
                                   <h3> Cover Image </h3>
                                </div>  
                                 <div class="avatar-upload cover-uploader">
                                    <form method="post" action="{{URL::to('/coverPic/upload')}}" id="cover_form" enctype="multipart/form-data">
                                      {{csrf_field()}}
                                       <div class="avatar-edit avatar-edit2">
                                           <input type='file' id="cover_pic" data-preview="coverPreview"  name="coverImage"  />
                                           <label for="cover_pic"> <i class="fa fa-pencil-alt"> </i> </label>
                                       </div>
                                       <div class="avatar-preview">
                                           <div id="coverPreview" style="
                                              @if(empty(Auth::user()->cover_img))
                                                background-image: url('{{URL::to('/')}}/public/cover-placeholder.jpg');
                                              @else
                                                background-image: url('{{URL::to('/')}}/public/cover_img/{{Auth::user()->cover_img}}');
                                              @endif
                                            ">
                                           </div>
                                       </div>
                                 </div>
                              </div>
                              <div class="col-md-12">  
                                <div class="file-uploader">
                                 <input type="file" 
                                  class="filepond filepond-uploader"
                                  name="galleryImage"
                                  multiple
                                  data-max-file-size="3MB"
                                  data-max-files="3" />
                                </div>
                              </div> 
                            </div>   
                            <section id="gallery">
                              <div class="container">
                                <div id="image-gallery">
                                  <div class="row">
                                    @foreach(Auth::user()->gallery as $val)
                                    <div class="col-lg-3 col-md-6 col-sm-6 col-xs-12 image">
                                      <div class="img-wrapper">
                                        <a href="{{URL::to('/public/gallery_img/'.$val->id.'-'.$val->image)}}"><img src="{{URL::to('/public/gallery_img/'.$val->id.'-'.$val->image)}}" class="img-responsive"></a>
                                        <div class="img-overlay">
                                          <i class="fa fa-plus-circle" aria-hidden="true"></i>
                                        </div>

                                        <a href="javascript:void(0)" data-href="{{URL::to('/helper/gallery/image/delete/'.base64_encode($val->id))}}" class="btn btn-sm btn-danger deletePhoto"><i class="fa fa-trash"></i></a>
                                      </div>
                                    </div>
                                    @endforeach
                                  </div><!-- End row -->
                                </div><!-- End image gallery -->
                              </div><!-- End container --> 
                            </section>    
                          </div>
                        </div>
                        <div class="tab-pane" id="tabs-3" role="tabpanel">
                         <p class="InvitationM">
                            To get more reviews, search for your past employers and agencies and click on the button 
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
                                      @if(empty($val->report))
                                        <a href="javascript:void(0)" class="reportReview" data-id="{{base64_encode($val->id)}}">Report</a>
                                      @else
                                        <a href="javascript:void(0)" style="color:red; float: right;">Reported</a>
                                      @endif
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
                                          <th>Invitations to review</th>
                                          <th>Invited at</th>
                                       </tr>
                                    </thead>
                                    <tbody>
                                       @php $s=1; @endphp
                                       @foreach(Auth::user()->reviewInvitation as $val)
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
                                                      <h4>{{$val->requestBy->type == '3' ? $val->requestBy->company : $val->requestBy->fname.' '.$val->requestBy->lname}}</h4>
                                                      <span class="label label-warning">{{$val->requestBy->type == '3' ? 'Agency' : 'Helper'}}</span>
                                                   </div>
                                                </a>
                                             </td>
                                             <td>{{$val->created_at->diffForHumans()}}</td>
                                          </tr>
                                          @php $s++; @endphp
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
@section('addStyle')
  <link rel="stylesheet" type="text/css" href="https://unpkg.com/filepond-plugin-image-preview/dist/filepond-plugin-image-preview.min.css">
  <link rel="stylesheet" type="text/css" href="https://unpkg.com/filepond/dist/filepond.min.css">
@endsection
@section('addScript')

<script type="text/javascript" src="https://unpkg.com/filepond-plugin-file-encode/dist/filepond-plugin-file-encode.min.js"></script>
<script type="text/javascript" src="https://unpkg.com/filepond-plugin-file-validate-size/dist/filepond-plugin-file-validate-size.min.js"></script>
<script type="text/javascript" src="https://unpkg.com/filepond-plugin-image-exif-orientation/dist/filepond-plugin-image-exif-orientation.min.js"></script>
<script type="text/javascript" src="https://unpkg.com/filepond-plugin-image-preview/dist/filepond-plugin-image-preview.min.js"></script>
<script type="text/javascript" src="https://unpkg.com/filepond/dist/filepond.min.js"></script>
<script type="text/javascript">
        $(document).ready(function(){
          FilePond.registerPlugin(

          FilePondPluginFileEncode,

          FilePondPluginFileValidateSize,

          FilePondPluginImageExifOrientation,

          FilePondPluginImagePreview
          );

          FilePond.create(
            document.querySelector('.filepond-uploader')
          );
          FilePond.setOptions({
            server: {
              url:'gallery/upload',
              headers:{
                'X-CSRF-TOKEN' : '{{csrf_token()}}'
              }
            }
          });
        });
      
      </script>

@endsection