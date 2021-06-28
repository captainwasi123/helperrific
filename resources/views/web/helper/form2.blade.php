@extends('web.support.regMaster')
@section('title', 'Registration Form')

@section('content')

<section class="p-t-60 p-b-80">
   <div class="container">
      <div class="registration-form-triggers">
         <div>
            <a href="javascript:void(0)"> <b> 1 </b> Personal Info <i class="fa fa-angle-right"> </i> </a>
         </div>
         <div  class="active">
            <a href="javascript:void(0)"> <b> 2 </b> Skills & Work Experience <i class="fa fa-angle-right"> </i> </a>
         </div>
      </div>
      <div class="registration-form-content">
         <div class="registration-form-part1">
            <form method="post">
              {{csrf_field()}}
              <div class="regis-info1">
                 <h5 style="max-width: 500px;"> Skills and Work Experience </h5>
                 <p style="max-width: 450px;"><br> 
                 </p>
                 <h6 class="col-grey text-right"> * Mandatory Fields </h6>
              </div>
              


              <div class="row">
                  <div class="col-md-12 nopadding" id="expertise_block">
                     <div class="col-md-3 col-lg-3 col-sm-12 col-xs-12">
                        <div class="field-label1">
                           <h4> Expertise Area* </h4>
                        </div>
                     </div>
                     <div class="col-md-3 col-lg-3 col-sm-12 col-xs-12">
                        <div class="form-field1">
                           <select name="expertise[]" required>
                              <option value="" disabled selected> Select Expertise  </option>
                              @foreach($expertise as $val)
                                <option value="{{$val->id}}">{{$val->skill}}</option>
                              @endforeach
                           </select>
                        </div>
                     </div>
                     <div class="col-md-3 col-lg-3 col-sm-6 col-xs-12">
                        <div class="form-field1">
                        <select name="expertise_exp[]" required>
                           <option value="" disabled selected> Years of Experience </option>
                           <option value="1"> 1 Year</option>
                           <option value="2"> 2 Years</option>
                           <option value="3"> 3 Years</option>
                           <option value="4"> 4 Years</option>
                           <option value="5"> 5 Years</option>
                           <option value="6"> 6 Years</option>
                           <option value="7"> 7 Years</option>
                           <option value="8"> 8 Years</option>
                           <option value="9"> 9 Years</option>
                           <option value="10"> 10 Years</option>
                           <option value="11"> 11 Years</option>
                           <option value="12"> 12 Years</option>
                           <option value="13"> 13 Years</option>
                           <option value="14"> 14 Years</option>
                           <option value="15"> 15 Years</option>
                        </select>
                        </div>
                     </div>

                     <div class="col-md-3 col-lg-3 col-sm-6 col-xs-12">
                        <div class="form-field1">
                        <input type="text" placeholder="Details" name="expertise_detail[]" required>
                        </div>
                     </div>
                  </div>
                  <!-- <div class="col-md-12">
                      <div class="skill-add-button" style="margin-top: -15px; margin-bottom: 25px;">
                        <button type="button" id="addExpertise"> Add another </button>
                      </div>
                  </div> -->
              </div>

              <div class="row">
                  <div class="col-md-12 nopadding" id="skill_block">
                     <div class="col-md-3 col-lg-3 col-sm-12 col-xs-12">
                        <div class="field-label1">
                           <h4> Skills </h4>
                        </div>
                     </div>
                     <div class="col-md-3 col-lg-3 col-sm-12 col-xs-12">
                        <div class="form-field1">
                           <select name="skills[]">
                              <option value="" disabled selected> Select Skill  </option>
                              @foreach($skills as $val)
                                <option value="{{$val->id}}">{{$val->skill}}</option>
                              @endforeach
                           </select>
                        </div>
                     </div>
                     <div class="col-md-3 col-lg-3 col-sm-6 col-xs-12">
                        <div class="form-field1">
                        <select name="skills_exp[]">
                           <option value="" disabled selected> Years of Experience </option>
                           <option value="1"> 1 Year</option>
                           <option value="2"> 2 Years</option>
                           <option value="3"> 3 Years</option>
                           <option value="4"> 4 Years</option>
                           <option value="5"> 5 Years</option>
                           <option value="6"> 6 Years</option>
                           <option value="7"> 7 Years</option>
                           <option value="8"> 8 Years</option>
                           <option value="9"> 9 Years</option>
                           <option value="10"> 10 Years</option>
                           <option value="11"> 11 Years</option>
                           <option value="12"> 12 Years</option>
                           <option value="13"> 13 Years</option>
                           <option value="14"> 14 Years</option>
                           <option value="15"> 15 Years</option>
                        </select>
                        </div>
                     </div>

                     <div class="col-md-3 col-lg-3 col-sm-6 col-xs-12">
                        <div class="form-field1">
                        <input type="text" placeholder="Details" name="skills_detail[]">
                        </div>
                     </div>
                  </div>
                  <div class="col-md-12">
                      <div class="skill-add-button" style="margin-top: -15px; margin-bottom: 25px;">
                        <button type="button" id="addSkill"> Add another </button>
                      </div>
                  </div>
              </div>


              <div class="row">
                <div class="col-md-12 nopadding" id="qual_block">
                   <div class="col-md-3 col-lg-3 col-sm-12 col-xs-12">
                      <div class="field-label1">
                         <h4> Qualifications </h4>
                      </div>
                   </div>
                   <div class="col-md-3 col-lg-3 col-sm-12 col-xs-12">
                      <div class="form-field1">
                         <select name="qual[]">
                         <option value="">select qualifications</option>
                            @foreach($qual as $val)
                              <option value="{{$val->id}}"> {{$val->qualification}}  </option>
                            @endforeach
                         </select>
                      </div>
                   </div>
                   <div class="col-md-6 col-lg-6 col-sm-6 col-xs-12">
                      <div class="form-field1">
                        <input type="text" placeholder="Name of Certificate" name="qual_certificate[]">
                      </div>
                   </div>
                 </div>
                  <div class="col-md-12">
                      <div class="skill-add-button" style="margin-top: -15px; margin-bottom: 25px;">
                        <button type="button" id="addQual"> Add another </button>
                      </div>
                  </div>
              </div>
              
              <div class="row">
                <div class="col-md-3 col-lg-3 col-sm-12 col-xs-12">
                    <div class="field-label1">
                       <h4> Education </h4>
                    </div>
                </div>
                <div class="col-md-9 col-lg-9 col-sm-12 col-xs-12">
                  <div class="row">
                    <div class="col-sm-12 nopadding" id="edu_block">
                      <div class="col-md-6 col-lg-6 col-sm-12 col-xs-12">
                        <div class="form-field1">
                            <input type="text" placeholder="Name of Certificate" name="edu_certificate[]">
                        </div>
                      </div>
                      <div class="col-md-6 col-lg-6 col-sm-12 col-xs-12">
                        <div class="form-field1">
                            <input type="text" placeholder="Certification obtained in from which country" name="edu_country[]">
                        </div>
                      </div>
                    </div>
                    <div class="col-sm-12">
                      <div class="skill-add-button" id="addEdu" style="margin-top: -15px; margin-bottom: 25px;">
                         <button type="button"> Add another </button>
                      </div>
                    </div> 
                 </div>
                </div>
              </div>


              <div class="row">
                 <div class="col-md-3 col-lg-3 col-sm-12 col-xs-12">
                    <div class="field-label1">
                       <h4> Experience </h4>
                    </div>
                 </div>

                  <div class="col-md-9 col-lg-9 col-sm-12 col-xs-12 nopadding">
                    <div class="col-md-12 nopadding" id="exp_block">                 
                      <div class="col-md-4 col-lg-4 col-sm-12 col-xs-12">
                        <div class="form-field1">
                           <input type="text" placeholder="Employer name" name="exp_employer[]">
                        </div>
                     </div>
                      <div class="col-md-2 col-lg-2 col-sm-12 col-xs-12">
                        <div class="form-field1">
                           <input type="text" placeholder="Start Year" name="exp_startYear[]">
                        </div>
                     </div>
                      <div class="col-md-2 col-lg-2 col-sm-12 col-xs-12">
                        <div class="form-field1">
                           <input type="text" placeholder="End Year" name="exp_endYear[]">
                        </div>
                     </div>
                      <div class="col-md-4 col-lg-4 col-sm-12 col-xs-12">
                        <div class="form-field1 autocomplete">
                           <input type="text" id="agency_field" placeholder="Agency" name="exp_agency[]">
                        </div>
                     </div>
                   </div>
                   <div class="col-md-12">
                      <div class="skill-add-button" style="margin-top: -15px; margin-bottom: 25px;">
                         <button type="button" id="addExp"> Add another </button>
                      </div>
                   </div> 
                 </div>

                
                

              </div>

               <div class="row">
                  <div class="col-md-3 col-lg-3 col-sm-12 col-xs-12">
                     <div class="field-label1">
                        <h4> Starting Salary* </h4>
                     </div>
                  </div>
                  <div class="col-md-3 col-lg-3 col-sm-6 col-xs-12">
                     <div class="form-field1">
                        <input type="number" placeholder="Amount" name="ss_price" value="{{empty(Auth::user()->startingSalary) ? 'no' : Auth::user()->startingSalary->price}}" required>
                     </div>
                  </div>
                  <div class="col-md-3 col-lg-3 col-sm-6 col-xs-12">
                     <div class="form-field1">
                        <select name="ss_renewal">
                           <option {{!empty(Auth::user()->startingSalary) && Auth::user()->startingSalary->renewal == 'Hourly' ? 'selected' : ''}}> Hourly </option>
                           <option {{!empty(Auth::user()->startingSalary) && Auth::user()->startingSalary->renewal == 'Weekly' ? 'selected' : ''}}> Weekly </option>
                           <option {{!empty(Auth::user()->startingSalary) && Auth::user()->startingSalary->renewal == 'Monthly' ? 'selected' : ''}}> Monthly </option>
                        </select>
                     </div>
                  </div>
                  <div class="col-md-3 col-lg-3 col-sm-6 col-xs-12">
                     <div class="form-field1">
                        <select name="ss_currency">
                        <option value="92"> SGD </option>
                           <!-- @foreach($currency as $val)
                           <option value="{{$val->id}}" {{!empty(Auth::user()->startingSalary) && Auth::user()->startingSalary->currency == $val->id ? 'selected' : ''}}> {{$val->code}} </option>
                           @endforeach -->
                        </select>
                     </div>
                  </div>
               </div>
           
              <div class="row" style="margin-top: 25px;">
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
@section('addScript')

<script type="text/javascript">
   var agencies = {!! $agencies !!};
   $(document).ready(function(){

      autocomplete('agency_field', agencies);

      $(document).on('click', '#addExpertise', function(){
         $('#expertise_block').append('<div class="col-md-3 col-lg-3 col-sm-12 col-xs-12"><div class="field-label1"></div></div><div class="col-md-3 col-lg-3 col-sm-12 col-xs-12"><div class="form-field1"><select name="expertise[]" required><option value="" disabled selected> Select Expertise  </option>@foreach($expertise as $val)<option value="{{$val->id}}">{{$val->skill}}</option>@endforeach</select></div></div><div class="col-md-3 col-lg-3 col-sm-6 col-xs-12"><div class="form-field1"><select name="expertise_exp[]" required><option value="" disabled selected> Years of Experience </option><option value="1"> 1 Year</option><option value="2"> 2 Years</option><option value="3"> 3 Years</option><option value="4"> 4 Years</option><option value="5"> 5 Years</option><option value="6"> 6 Years</option><option value="7"> 7 Years</option><option value="8"> 8 Years</option><option value="9"> 9 Years</option><option value="10"> 10 Years</option><option value="11"> 11 Years</option><option value="12"> 12 Years</option><option value="13"> 13 Years</option><option value="14"> 14 Years</option><option value="15"> 15 Years</option></select></div></div><div class="col-md-3 col-lg-3 col-sm-6 col-xs-12"><div class="form-field1"><input type="text" placeholder="Details" name="expertise_detail[]" required></div></div>'); 
      });

      $(document).on('click', '#addSkill', function(){
         $('#skill_block').append('<div class="col-md-3 col-lg-3 col-sm-12 col-xs-12"><div class="field-label1"></div></div><div class="col-md-3 col-lg-3 col-sm-12 col-xs-12"><div class="form-field1"><select name="skills[]" required><option value="" disabled selected> Select Skill  </option>@foreach($skills as $val)<option value="{{$val->id}}">{{$val->skill}}</option>@endforeach</select></div></div><div class="col-md-3 col-lg-3 col-sm-6 col-xs-12"><div class="form-field1"><select name="skills_exp[]" required><option value="" disabled selected> Years of Experience </option><option value="1"> 1 Year</option><option value="2"> 2 Years</option><option value="3"> 3 Years</option><option value="4"> 4 Years</option><option value="5"> 5 Years</option><option value="6"> 6 Years</option><option value="7"> 7 Years</option><option value="8"> 8 Years</option><option value="9"> 9 Years</option><option value="10"> 10 Years</option><option value="11"> 11 Years</option><option value="12"> 12 Years</option><option value="13"> 13 Years</option><option value="14"> 14 Years</option><option value="15"> 15 Years</option></select></div></div><div class="col-md-3 col-lg-3 col-sm-6 col-xs-12"><div class="form-field1"><input type="text" placeholder="Details" name="skills_detail[]" required></div></div>'); 
      });

    $(document).on('click', '#addQual', function(){
        $('#qual_block').append('<div class="col-md-3 col-lg-3 col-sm-12 col-xs-12"><div class="field-label1"></div></div><div class="col-md-3 col-lg-3 col-sm-12 col-xs-12"><div class="form-field1"><select name="qual[]" required>@foreach($qual as $val)<option value="{{$val->id}}"> {{$val->qualification}}  </option>@endforeach</select></div></div><div class="col-md-6 col-lg-6 col-sm-6 col-xs-12"><div class="form-field1"><input type="text" placeholder="Name of Certificate" name="skills_detail[]" required></div></div>'); 
    });

    $(document).on('click', '#addEdu', function(){
        $('#edu_block').append('<div class="col-md-6 col-lg-6 col-sm-12 col-xs-12"><div class="form-field1"><input type="text" placeholder="Name of Certificate" name="edu_certificate[]" required></div></div><div class="col-md-6 col-lg-6 col-sm-12 col-xs-12"><div class="form-field1"><input type="text" placeholder="Certification obtained in from which country" name="edu_country[]" required></div></div>'); 
    });

    $(document).on('click', '#addExp', function(){
         var rand = Math.random();
        $('#exp_block').append('<div class="col-md-4 col-lg-4 col-sm-12 col-xs-12"><div class="form-field1"><input type="text" placeholder="First name of Employer" name="exp_employer[]" required></div></div><div class="col-md-2 col-lg-2 col-sm-12 col-xs-12"><div class="form-field1"><input type="number" placeholder="Start Year" name="exp_startYear[]" required></div></div><div class="col-md-2 col-lg-2 col-sm-12 col-xs-12"><div class="form-field1"><input type="number" placeholder="End Year" name="exp_endYear[]" required></div></div><div class="col-md-4 col-lg-4 col-sm-12 col-xs-12"><div class="form-field1 autocomplete"><input type="text" id="agency_field'+rand+'" placeholder="Agency" name="exp_agency[]" required></div></div>');

         autocomplete('agency_field'+rand, agencies);
    });

  });
</script>

@endsection