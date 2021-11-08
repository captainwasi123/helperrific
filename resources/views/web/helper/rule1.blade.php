@extends('web.support.regMaster')
@section('title', 'Registration Rules 1')

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
               <h3 class="col-black"> Get Noticed by the Best Employers! </h3>
               <p> Create a profile to stand out from the crowd and put your best self forward </p>
            </div>
            <div class="row">
               <div class="col-md-4 col-lg-4 col-sm-6 col-xs-12">
                  <div class="agency-box">
                     <img alt="agency-icon" src="{{URL::to('/')}}/assets/images/agency-icon6.jpg">
                     <p> Make a great first impression. Upload a profile picture that is clear and inviting  </p>
                  </div>
               </div>
               <div class="col-md-4 col-lg-4 col-sm-6 col-xs-12">
                  <div class="agency-box">
                     <img alt="agency-icon" src="{{URL::to('/')}}/assets/images/agency-icon1.jpg">
                     <p> Highlight your talents. Describe yourself well and pick your best skill to showcase </p>
                  </div>
               </div>
               <div class="col-md-4 col-lg-4 col-sm-6 col-xs-12">
                  <div class="agency-box">
                     <img alt="agency-icon" src="{{URL::to('/')}}/assets/images/agency-icon4.jpg">
                     <p> Broadcasting your experience is your best bet. List your employment history. </p>
                  </div>
               </div>
               <div class="col-md-4 col-lg-4 col-sm-6 col-xs-12">
                  <div class="agency-box">
                     <img alt="agency-icon" src="{{URL::to('/')}}/assets/images/agency-icon7.jpg">
                     <p> Let the stars do the talking. Ask past employers to post reviews and ratings to get people knocking on your door </p>
                  </div>
               </div>

               <div class="col-md-4 col-lg-4 col-sm-6 col-xs-12">
                  <div class="agency-box">
                     <img alt="agency-icon" src="{{URL::to('/')}}/assets/images/agency-icon2.jpg">
                     <p> A picture speaks a thousand words. Post photographs of your delicious meals or the happy pets and plants that you care for.  </p>
                  </div>
               </div>

            </div>
            <div class="rules-buttons">
               <a href="{{URL::to('/helper/rule_2')}}" class="bg-primary col-white normal-btn"> Continue </a>
            </div>
         </div>
      </div>
   </div>
</section>

@endsection