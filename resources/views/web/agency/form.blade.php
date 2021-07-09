@extends('web.support.regMaster')
@section('title', 'Registration Form')

@section('content')

<section class="p-t-60 p-b-80">
         <div class="container">
            <div class="registration-form-content">
               <div class="registration-form-part1">
                  <form method="post" enctype="multipart/form-data">
                     {{csrf_field()}}
                     <input type="hidden" name="input_type" value="{{empty(Auth::user()->details) ? '0' : Auth::user()->details->id}}">
                     <div class="regis-info1">
                        <h5> Personal Info </h5>
                        <h6 class="col-grey text-right"> * Mandatory Fields </h6>
                     </div>
                     <div class="row">
                        <div class="col-md-3 col-lg-3 col-sm-12 col-xs-12">
                           <div class="field-label1">
                              <h4> Company Name* </h4>
                           </div>
                        </div>
                        <div class="col-md-4 col-lg-4 col-sm-12 col-xs-12">
                           <div class="form-field1">
                              <input type="text" name="company"  value="{{Auth::user()->company}}" required>
                           </div>
                        </div>
                     </div>
                     <div class="row">
                        <div class="col-md-3 col-lg-3 col-sm-12 col-xs-12">
                           <div class="field-label1">
                              <h4> Country of origin* </h4>
                           </div>
                        </div>
                        <div class="col-md-4 col-lg-4 col-sm-12 col-xs-12">
                           <div class="form-field1">
                              <select name="country" required>
                                @foreach($country as $val)
                                  <option value="{{$val->id}}"
                                    {{!empty(Auth::user()->details) && Auth::user()->details->country == $val->id ? 'selected' : ''}}
                                  > {{$val->country}} </option>
                                @endforeach
                              </select>
                           </div>
                        </div>
                     </div>
                     <div class="row">
                        <div class="col-md-3 col-lg-3 col-sm-12 col-xs-12">
                           <div class="field-label1">
                              <h4 style="margin-top: 60px;"> Profile Picture* </h4>
                           </div>
                        </div>
                        <div class="col-md-4 col-lg-4 col-sm-12 col-xs-12">
                           <div class="form-field1">
                              <div class="avatar-upload">
                                   <div class="avatar-edit avatar-edit2">
                                       <input type='file' id="profile_pic" data-preview="profilePreview" accept=".png, .jpg, .jpeg" name="profileImage"  {{empty(Auth::user()->profile_img) ? 'required' : ''}}/>                                       
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
                               </div>
                           </div>
                        </div>

                        <!-- <div class="col-md-5 col-lg-5 col-sm-12 col-xs-12">
                           <div class="form-field1">
                              <div class="avatar-upload cover-upload">
                                   <div class="avatar-edit  cover-uploader">
                                       <input type='file' id="cover_pic" data-preview="coverPreview" accept=".png, .jpg, .jpeg" name="coverImage"  {{empty(Auth::user()->cover_img) ? 'required' : ''}}/>                                       
                                       <label for="cover_pic"> <i class="fa fa-pencil-alt"> </i> </label>
                                   </div>
                                   <div class="cover-preview">
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
                        </div> -->

                     </div>
                     <div class="row">
                        <div class="col-md-3 col-lg-3 col-sm-12 col-xs-12">
                           <div class="field-label1">
                              <h4 style="margin-top: 60px;"> Cover Picture* </h4>
                           </div>
                        </div>
                        <!-- <div class="col-md-4 col-lg-4 col-sm-12 col-xs-12">
                           <div class="form-field1">
                              <div class="avatar-upload">
                                   <div class="avatar-edit avatar-edit2">
                                       <input type='file' id="profile_pic" data-preview="profilePreview" accept=".png, .jpg, .jpeg" name="profileImage"  {{empty(Auth::user()->profile_img) ? 'required' : ''}}/>                                       
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
                               </div>
                           </div>
                        </div> -->

                        <div class="col-md-5 col-lg-5 col-sm-12 col-xs-12">
                           <div class="form-field1">
                              <div class="avatar-upload cover-upload">
                                   <div class="avatar-edit  cover-uploader">
                                       <input type='file' id="cover_pic" data-preview="coverPreview" accept=".png, .jpg, .jpeg" name="coverImage"  {{empty(Auth::user()->cover_img) ? 'required' : ''}}/>                                       
                                       <label for="cover_pic"> <i class="fa fa-pencil-alt"> </i> </label>
                                   </div>
                                   <div class="cover-preview">
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
                        </div>

                     </div>
                     <div class="row">
                        <div class="col-md-3 col-lg-3 col-sm-12 col-xs-12">
                           <div class="field-label1">
                              <h4> Description* </h4>
                           </div>
                        </div>
                        <div class="col-md-9 col-lg-9 col-sm-12 col-xs-12">
                           <div class="form-field1">
                              <textarea placeholder="Share a description of your agency, your services and your values" name="description" required>{{empty(Auth::user()->details) ? '' : Auth::user()->details->description}}</textarea>
                           </div>
                        </div>
                     </div>
                     <div class="row">
                        <div class="col-md-3 col-lg-3 col-sm-12 col-xs-12">
                           <div class="field-label1">
                              <h4> Company Information* </h4>
                           </div>
                        </div>
                        <div class="col-md-3 col-lg-3 col-sm-12 col-xs-12">
                           <div class="form-field1">
                              <textarea placeholder="Type your Address" name="c_address" required>{{empty(Auth::user()->details) ? '' : Auth::user()->details->c_address}}</textarea>
                           </div>
                        </div>
                        <div class="col-md-3 col-lg-3 col-sm-12 col-xs-12">
                           <div class="form-field1">
                              <textarea placeholder="Type your Email Address" name="c_email"  required>{{empty(Auth::user()->details) ? '' : Auth::user()->details->c_email}}</textarea>
                           </div>
                        </div>
                        <div class="col-md-3 col-lg-3 col-sm-12 col-xs-12">
                           <div class="form-field1">
                              <textarea placeholder="Type your Contact Number:" name="c_phone" required>{{empty(Auth::user()->details) ? '' : Auth::user()->details->c_phone}}</textarea>
                           </div>
                        </div>
                     </div>
                     <div class="row">
                        <div class="col-md-12 col-lg-12 col-sm-12 col-xs-12">
                           <div class="form-field1">
                              <input type="submit" value="Continue" name=""  >
                           </div>
                        </div>
                     </div>
                  </form>
               </div>
            </div>
         </div>
      </section>

@endsection