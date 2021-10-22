@extends('web.support.regMaster')
@section('title', 'Registration Rule 1')

@section('content')

<section class="p-t-60 p-b-80">
   <div class="container">
      <div class="row">
         <div class="col-md-3 col-lg-3 col-sm-12 col-xs-12 rule-sec-left">
            <div class="trophy-image">
               <img alt="trophy-award" src="{{URL::to('/')}}/assets/images/trophy-award.png">
            </div>
         </div>
         <div class="col-md-9 col-lg-9 col-sm-12 col-xs-12 rule-sec-right">
            <div class="trophy-text">
               <h3 class="col-black"> Make your search for a great helper quick and easy! </h3>
               <p> Compare helpers from every single agency in your country </p>
            </div>
            <div class="row">
               <div class="col-md-6 col-lg-6 col-sm-6 col-xs-12">
                  <div class="agency-box">
                     <img alt="agency-icon" src="{{URL::to('/')}}/assets/images/agency-icon6.jpg">
                     <p> No more vague and misleading helper resumes, only clear concise information  </p>
                  </div>
               </div>
               <div class="col-md-6 col-lg-6 col-sm-6 col-xs-12">
                  <div class="agency-box">
                     <img alt="agency-icon" src="{{URL::to('/')}}/assets/images/agency-icon1.jpg">
                     <p> Check the ratings and reviews to make your next choice an easy one </p>
                  </div>
               </div>
            </div>
            <div class="row">
               <div class="col-md-6 col-lg-6 col-sm-6 col-xs-12">
                  <div class="agency-box">
                     <img alt="agency-icon" src="{{URL::to('/')}}/assets/images/agency-icon7.jpg">
                     <p> Don't worry about being bombarded with messages! We are keeping the initiative in your hands, it's up to you to reach out to the helper or agency that you're interested in. </p>
                  </div>
               </div>
               <div class="col-md-6 col-lg-6 col-sm-6 col-xs-12">
                  <div class="agency-box">
                     <img alt="agency-icon" src="{{URL::to('/')}}/assets/images/agency-icon4.jpg">
                     <p> Need an expert's help? Find the highest rated agency in your area and leave it their capable hands </p>
                  </div>
               </div>
            </div>
            <div class="rules-buttons">
               <a href="{{URL::to('/employer/rule_2')}}" class="bg-primary col-white normal-btn"> Continue </a>
            </div>
         </div>
      </div>
   </div>
</section>

@endsection