@extends('web.support.regMaster')
@section('title', 'Registration Form')

@section('content')

<section class="p-t-60 p-b-80">
   <div class="container">
      <div class="registration-form-triggers">
         <div class="active">
            <a href="javascript:void(0)"> <b> 1 </b> Personal Info <i class="fa fa-angle-right"> </i> </a>
         </div>
         <div>
            <a href="javascript:void(0)"> <b> 2 </b> Skills & Work Experience <i class="fa fa-angle-right"> </i> </a>
         </div>
      </div>
      <div class="registration-form-content">
         <div class="registration-form-part1">
            <form method="post">
               {{csrf_field()}}
               <input type="hidden" name="input_type" value="{{empty(Auth::user()->details) ? '0' : Auth::user()->details->id}}">
               <div class="regis-info1">
                  <h5> Personal Info </h5>
                  <p style="max-width: 450px;"><br>
                  </p>
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
                              <input type="text" placeholder="Username" value="{{Auth::user()->username}}" name="username">
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
                        <h4> Country* </h4>
                     </div>
                  </div>
                  <div class="col-md-4 col-lg-4 col-sm-12 col-xs-12">
                     <div class="form-field1">
                        <select name="country" required>
                           <option value="" disabled selected>Select</option>
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
                        <h4> Languages * </h4>
                     </div>
                  </div>
                  <div class="col-md-6 col-lg-6 col-sm-12 col-xs-12">
                     <div class="form-field1">
                       <table>
                          <thead>
                             <tr>
                                <th> Language </th>
                                <th> Level </th>
                             </tr>
                          </thead>
                          <tbody id="lang_block">
                              @foreach(Auth::user()->langs as $key => $val)
                                 <tr>
                                   <td><input type="text" class="noboder" value="{{$val->language}}" name="lang[]" required></td>
                                  <td> 
                                    <select name="langlevel[]">
                                       <option {{$val->level == 'Basic' ? 'selected' : ''}}> Basic </option>
                                       <option {{$val->level == 'Intermediate' ? 'selected' : ''}}> Intermediate </option>
                                       <option {{$val->level == 'Expert' ? 'selected' : ''}}> Expert </option>
                                    </select>
                                   </td>
                                 </tr>
                              @endforeach

                              @if(count(Auth::user()->langs) == 0)
                                <tr>
                                   <td><input type="text" class="noboder" name="lang[]" required></td>
                                  <td> 
                                    <select name="langlevel[]">
                                       <option> Basic </option>
                                       <option> Intermediate </option>
                                       <option> Expert </option>
                                    </select>
                                   </td>
                                </tr>
                              @endif
                           </tbody>
                       </table>
                     </div>
                  </div>
                  <div class="col-md-3 col-lg-3 col-sm-12 col-xs-12">
                    <div class="skill-add-button" id="addlang">
                        <button type="button"> Add another</button>
                     </div> 
                  </div>
               </div>
               <div class="row">
                  <div class="col-md-12 col-lg-12 col-sm-12 col-xs-12">
                     <div class="form-field1">
                        <input type="submit" value="Continue" name="" >
                     </div>
                  </div>
               </div>
            </form>
         </div>
      </div>
   </div>
</section>


@endsection