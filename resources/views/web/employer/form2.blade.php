@extends('web.support.regMaster')
@section('title', 'Registration Form 2')

@section('content')

<section class="p-t-60 p-b-80">
   <div class="container">
      <div class="registration-form-triggers">
         <div>
            <a href=""> <b> 1 </b> Personal Info <i class="fa fa-angle-right"> </i> </a>
         </div>
         <div  class="active">
            <a href=""> <b> 2 </b> Professional Info <i class="fa fa-angle-right"> </i> </a>
         </div>
      </div>
      <div class="registration-form-content">
         <div class="registration-form-part1">
            <form method="post">
              {{csrf_field()}}
              <div class="regis-info1">
                 <h5 style="max-width: 500px;"> The Helper you are looking for needs to be Experienced in </h5>
                 <h6 class="col-grey text-right"> * Mandatory Fields </h6>
              </div>
              <div class="row" id="skill_block">
                <div class="col-md-12 nopadding">
                  <div class="col-md-3 col-lg-3 col-sm-12 col-xs-12">
                    <div class="field-label1">
                       <h4> Skills* </h4>
                    </div>
                  </div>
                  <div class="col-md-3 col-lg-3 col-sm-12 col-xs-12">
                    <div class="form-field1">
                       <select name="skills[]" required>
                          <option value=""> Select Skill  </option>
                          @foreach($skills as $val)
                            <option value="{{$val->id}}">{{$val->skill}}</option>
                          @endforeach
                       </select>
                    </div>
                  </div>
                  <div class="col-md-6 col-lg-6 col-sm-6 col-xs-12">
                    <div class="skill-add-button">
                       <button type="button" id="addSkill"> Add another</button>
                    </div>
                  </div>
                </div>
              </div>
              <br>
              <div class="row" id="qual_block">
                <div class="col-md-12 nopadding">
                   <div class="col-md-3 col-lg-3 col-sm-12 col-xs-12">
                      <div class="field-label1">
                         <h4> Qualifications* </h4>
                      </div>
                   </div>
                   <div class="col-md-3 col-lg-3 col-sm-12 col-xs-12">
                      <div class="form-field1">
                         <select name="qual[]" required>
                            <option value=""> Click to Select </option>
                            @foreach($qual as $val)
                              <option value="{{$val->id}}"> {{$val->qualification}}  </option>
                            @endforeach
                         </select>
                      </div>
                   </div>
                   <div class="col-md-3 col-lg-3 col-sm-12 col-xs-12">
                      <div class="form-field1">
                        <select name="qualstatus[]" required>
                          <option value=""> Select</option>
                          <option value="1">Required</option>
                          <option value="2">Nice to have</option>
                       </select>
                      </div>
                   </div>
                   <div class="col-md-3 col-lg-3 col-sm-12 col-xs-12">
                      <div class="skill-add-button">
                         <button type="button" id="addQual"> Add another</button>
                      </div>
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
  $(document).ready(function(){

    $(document).on('click', '#addSkill', function(){
        $('#skill_block').append('<div class="col-md-12 nopadding"><div class="col-md-3 col-lg-3 col-sm-12 col-xs-12"></div><div class="col-md-3 col-lg-3 col-sm-12 col-xs-12"><div class="form-field1"><select name="skills[]" required><option> Select Skill  </option>@foreach($skills as $val)<option value="{{$val->id}}">{{$val->skill}}</option>@endforeach</select></div></div><div class="col-md-6 col-lg-6 col-sm-6 col-xs-12"></div></div>'); 
    });

    $(document).on('click', '#addQual', function(){
        $('#qual_block').append('<div class="col-md-12 nopadding"><div class="col-md-3 col-lg-3 col-sm-12 col-xs-12"></div><div class="col-md-3 col-lg-3 col-sm-12 col-xs-12"><div class="form-field1"><select name="qual[]" required><option> Click to Select </option>@foreach($qual as $val)<option value="{{$val->id}}"> {{$val->qualification}}  </option>@endforeach</select></div></div><div class="col-md-3 col-lg-3 col-sm-12 col-xs-12"><div class="form-field1"><select name="qualstatus[]" required><option> Select Status </option><option value="1">Required</option><option value="2">Nice to have</option></select></div></div><div class="col-md-3 col-lg-3 col-sm-12 col-xs-12"></div></div>'); 
    });

  });
</script>

@endsection