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
               <div class="col-md-4 col-lg-4 col-sm-6 col-xs-12">
                  <div class="agency-box">
                     <img alt="agency-icon" src="{{URL::to('/')}}/assets/images/agency-icon9.jpg">
                     <p> Do not provide any false or misleading information about your identity  </p>
                  </div>
               </div>
               <div class="col-md-4 col-lg-4 col-sm-6 col-xs-12">
                  <div class="agency-box">
                     <img alt="agency-icon" src="{{URL::to('/')}}/assets/images/agency-icon10.jpg">
                     <p> Be respectful in your communication</p>
                  </div>
               </div>
               <div class="col-md-4 col-lg-4 col-sm-6 col-xs-12">
                  <div class="agency-box">
                     <img alt="agency-icon" src="{{URL::to('/')}}/assets/images/agency-icon11.jpg">
                     <p> Do not solicit for work illegally, make sure you follow the employment rules set by the countries in which you intend to work.</p>
                  </div>
               </div>
               <div class="col-md-4 col-lg-4 col-sm-6 col-xs-12">
                  <div class="agency-box">
                     <img alt="agency-icon" src="{{URL::to('/')}}/assets/images/agency-icon12.jpg">
                     <p> When you upload photos, make sure you do not violate your employer's privacy. No faces or homes should be shown without obtaining permission! </p>
                  </div>
               </div>



            </div>
            <div class="rules-buttons">
               <a href="{{URL::to('helper/form_1')}}" class="bg-primary col-white normal-btn"> Continue </a>
               <a href="{{URL::to('/helper/rule_1')}}" class="bg-white col-black normal-btn"> Back </a>
            </div>
         </div>
      </div>
   </div>
</section>


@endsection