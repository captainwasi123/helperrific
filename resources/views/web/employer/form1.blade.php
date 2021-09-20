@extends('web.support.regMaster')
@section('title', 'Registration Form')

@section('content')

  <section class="p-t-60 p-b-80">
    <div class="container">
      <div class="registration-form-triggers">
         <div class="active">
            <a href=""> <b> 1 </b> Personal Info <i class="fa fa-angle-right"> </i> </a>
         </div>
         <div>
            <a href=""> <b> 2 </b> Professional Info <i class="fa fa-angle-right"> </i> </a>
         </div>
      </div>
      <div class="registration-form-content">
        <form method="post" enctype="multipart/form-data">
          {{csrf_field()}}
          <input type="hidden" name="input_type" value="{{empty(Auth::user()->details) ? '0' : Auth::user()->details->id}}">
          <div class="registration-form-part1">
            <div class="regis-info1">
               <h5> Personal Info </h5>
               <h6 class="col-grey text-right"> * Mandatory Fields </h6>
            </div>
            <div class="row">
               <div class="col-md-3 col-lg-3 col-sm-12 col-xs-12">
                  <div class="field-label1">
                     <h4> Full Name* </h4>
                  </div>
               </div>
               <div class="col-md-9 col-lg-9 col-sm-12 col-xs-12">
                  <div class="row">
                     <div class="col-md-5 col-lg-5 col-sm-6 col-xs-12">
                        <div class="form-field1">
                           <input type="text" placeholder="First Name" name="fname" value="{{Auth::user()->fname}}" required>
                        </div>
                     </div>
                     <div class="col-md-5 col-lg-5 col-sm-6 col-xs-12">
                        <div class="form-field1">
                           <input type="text" placeholder="last Name" name="lname" value="{{Auth::user()->lname}}" required>
                        </div>
                     </div>
                  </div>
                  <div class="row">
                     <div class="col-md-5 col-lg-5 col-sm-6 col-xs-12">
                        <div class="form-field1">
                           <input type="text" placeholder="Username" name="username" value="{{Auth::user()->username}}" required>
                        </div>
                     </div>
                  </div>
               </div>
            </div>
            <div class="row">
               <div class="col-md-3 col-lg-3 col-sm-12 col-xs-12">
                  <div class="field-label1">
                     <h4> Country* </h4>
                  </div>
               </div>
               <div class="col-md-4 col-lg-4 col-sm-12 col-xs-12">
                  <div class="form-field1" style="max-width: 93%">
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
                     <h4 style="margin-top: 60px;"> Profile Picture </h4>
                  </div>
               </div>
               <div class="col-md-4 col-lg-4 col-sm-12 col-xs-12">
                  <div class="form-field1">
                    <div class="avatar-upload">
                      <div class="avatar-edit avatar-edit2">
                          <input type='file' id="profile_pic" data-preview="profilePreview" accept=".png, .jpg, .jpeg" name="profileImage" />                            
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
                    </div>
                  </div>
                </div>
            </div>
            <div class="row">
               <div class="col-md-3 col-lg-3 col-sm-12 col-xs-12">
                  <div class="field-label1">
                     <h4> Description </h4>
                  </div>
               </div>
               <div class="col-md-9 col-lg-9 col-sm-12 col-xs-12">
                  <div class="form-field1">
                     <textarea placeholder="Share a little about yourself, your personality and your aspirations" name="description">{{empty(Auth::user()->details) ? '' : Auth::user()->details->description}}</textarea>
                  </div>
               </div>
            </div>
            <div class="row">
               <div class="col-md-3 col-lg-3 col-sm-12 col-xs-12">
                  <div class="field-label1">
                     <h4> Current Status* </h4>
                  </div>
               </div>
               <div class="col-md-3 col-lg-3 col-sm-12 col-xs-12">
                  <div class="form-field1">
                     <select name="looking_status" required>
                        <option selected disabled value=""> Select Status </option>
                        <option value="1"
                           @if(!empty(Auth::user()->details) && Auth::user()->details->e_looking_status == '1')
                              selected
                           @endif
                        > Looking for Helpers </option>
                        <option value="2"
                           @if(!empty(Auth::user()->details) && Auth::user()->details->e_looking_status == '2')
                              selected
                           @endif
                        > Looking for Agencies </option>
                        <option value="3"
                           @if(!empty(Auth::user()->details) && Auth::user()->details->e_looking_status == '3')
                              selected
                           @endif
                        > Just Browsing </option>
                     </select>
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
          </div>
        </div>
      </form>
    </div>
  </section>


@endsection