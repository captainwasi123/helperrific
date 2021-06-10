@extends('web.support.regMaster')
@section('title', 'Registration Rule 2')

@section('content')

<section class="p-t-60 p-b-80">
   <div class="container">
      <div class="row">
         <div class="col-md-3 col-lg-3 col-sm-12 col-xs-12 rule-sec-left">
            <div class="trophy-image">
               <img alt="cleaning-desk" src="{{URL::to('/')}}/assets/images/cleaning-desk.jpg">
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
                     <img alt="agency-icon" src="{{URL::to('/')}}/assets/images/agency-icon3.jpg">
                     <p> Do not provide any false or misleading information about your identity  </p>
                  </div>
               </div>
               <div class="col-md-6 col-lg-6 col-sm-6 col-xs-12">
                  <div class="agency-box">
                     <img alt="agency-icon" src="{{URL::to('/')}}/assets/images/agency-icon4.jpg">
                     <p> Do not use the site in any way that violates the work and employment laws in your country  </p>
                  </div>
               </div>
               <div class="col-md-6 col-lg-6 col-sm-6 col-xs-12">
                  <div class="agency-box">
                     <img alt="agency-icon" src="{{URL::to('/')}}/assets/images/agency-icon5.jpg">
                     <p> When you upload photos, make sure you do not violate anyone's privacy. No faces should be shown without obtaining prior permission!  </p>
                  </div>
               </div>
            </div>
            <div class="rules-buttons">
               <a href="{{URL::to('/agency/form')}}" class="bg-primary col-white normal-btn"> Continue </a>
               <a href="{{URL::to('/agency/rule_1')}}" class="bg-white col-black normal-btn"> Back </a>
            </div>
         </div>
      </div>
   </div>
</section>

@endsection