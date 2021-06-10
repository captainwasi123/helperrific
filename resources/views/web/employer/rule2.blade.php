@extends('web.support.regMaster')
@section('title', 'Registration Rules 2')

@section('content')

<section class="p-t-60 p-b-80">
   <div class="container">
      <div class="row">
         <div class="col-md-3 col-lg-3 col-sm-12 col-xs-12 rule-sec-left">
            <div class="trophy-image">
               <img alt="trophy-award" src="{{URL::to('/')}}/assets/images/cleaning-desk.jpg">
            </div>
         </div>
         <div class="col-md-9 col-lg-9 col-sm-12 col-xs-12 rule-sec-right">
            <div class="trophy-text">
               <h3 class="col-black"> Be careful not to violate site rules. </h3>
               <p> To ensure the site's standards, there are several rules you need to follow </p>
            </div>
            <div class="row">
               <div class="col-md-6 col-lg-6 col-sm-6 col-xs-12">
                  <div class="agency-box">
                     <img alt="agency-icon" src="{{URL::to('/')}}/assets/images/agency-icon9.jpg">
                     <p> Do not give false or misleading reviews  </p>
                  </div>
               </div>
               <div class="col-md-6 col-lg-6 col-sm-6 col-xs-12">
                  <div class="agency-box">
                     <img alt="agency-icon" src="{{URL::to('/')}}/assets/images/agency-icon10.jpg">
                     <p> Be respectful in your communication </p>
                  </div>
               </div>
               <div class="col-md-6 col-lg-6 col-sm-6 col-xs-12">
                  <div class="agency-box">
                     <img alt="agency-icon" src="{{URL::to('/')}}/assets/images/agency-icon11.jpg">
                     <p> Do not engage helpers illegally, make sure you follow the employment rules set by the countries in which you intend to work. </p>
                  </div>
               </div>
               <div class="col-md-6 col-lg-6 col-sm-6 col-xs-12">
                  <div class="agency-box">
                     <img alt="agency-icon" src="{{URL::to('/')}}/assets/images/agency-icon12.jpg">
                     <p> Do not download or screenshot someone else's photographs </p>
                  </div>
               </div>
            </div>
            <div class="rules-buttons">
               <a href="{{URL::to('employer/form_1')}}" class="bg-primary col-white normal-btn"> Continue </a>
               <a href="{{URL::to('/employer/rule_1')}}" class="bg-white col-black normal-btn"> Back </a>
            </div>
         </div>
      </div>
   </div>
</section>


@endsection