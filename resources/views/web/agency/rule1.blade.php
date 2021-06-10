@extends('web.support.regMaster')
@section('title', 'Registration Rule 1')

@section('content')

<section class="p-t-60 p-b-80">
   <div class="container">
      <div class="row">
         <div class="col-md-3 col-lg-3 col-sm-12 col-xs-12 rule-sec-left">
            <div class="trophy-image">
               <img alt="trophy-award" src="{{URL::to('/')}}/assets/images/trophy-award.jpg">
            </div>
         </div>
         <div class="col-md-9 col-lg-9 col-sm-12 col-xs-12 rule-sec-right">
            <div class="trophy-text">
               <h3 class="col-black"> Get Your Agency Noticed </h3>
               <p> Create an agency profile and gain control over your reputation </p>
            </div>
            <div class="row">
               <div class="col-md-6 col-lg-6 col-sm-6 col-xs-12">
                  <div class="agency-box">
                     <img alt="agency-icon" src="{{URL::to('/')}}/assets/images/agency-icon1.jpg">
                     <p> Reviews are everything. Show that you're a cut above the rest. </p>
                  </div>
               </div>
               <div class="col-md-6 col-lg-6 col-sm-6 col-xs-12">
                  <div class="agency-box">
                     <img alt="agency-icon" src="{{URL::to('/')}}/assets/images/agency-icon2.jpg">
                     <p> Put your best foot forward by showcasing your best rated people  </p>
                  </div>
               </div>
            </div>
            <div class="rules-buttons">
               <a href="{{URL::to('/agency/rule_2')}}" class="bg-primary col-white normal-btn"> Continue </a>
            </div>
         </div>
      </div>
   </div>
</section>

@endsection