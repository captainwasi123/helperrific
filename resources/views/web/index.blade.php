@extends('web.support.master')
@section('title', 'Home')

@section('content')


<!-- Banner Section Starts Here -->
<section class="banner-sec">
 <div class="container">
    <div class="banner-text">
       <h3> I am looking for </h3>
       <h6> 
         <a href="{{URL::to('/helpers')}}"> <img alt="helper-icon" src="{{URL::to('/')}}/assets/images/banner-icon1.jpg"> A Domestic Helper  </a>
         <a href="{{URL::to('/agencies')}}"> <img alt="agency-icon" src="{{URL::to('/')}}/assets/images/banner-icon2.jpg">  An Agency </a>  
         <a href="{{URL::to('/employers')}}"> <img alt="agency-icon" src="{{URL::to('/')}}/assets/images/emp-Icon .png">  Employers </a>  
      </h6>
    </div>
 </div>
</section>
<!-- Banner Section Ends Here -->
<!-- Partner Logos Section Starts Here -->
<section class="partner-logo-sec">
 <div class="container">
    <span> <img alt="company-logo" src="{{URL::to('/')}}/assets/images/partner-logo1.jpg"> </span>   
    <span> <img alt="company-logo" src="{{URL::to('/')}}/assets/images/partner-logo2.jpg"> </span>   
    <span> <img alt="company-logo" src="{{URL::to('/')}}/assets/images/partner-logo3.jpg"> </span>   
    <span> <img alt="company-logo" src="{{URL::to('/')}}/assets/images/partner-logo4.jpg"> </span>   
    <span> <img alt="company-logo" src="{{URL::to('/')}}/assets/images/partner-logo5.jpg"> </span>   
    <span> <img alt="company-logo" src="{{URL::to('/')}}/assets/images/partner-logo6.jpg"> </span>   
 </div>
</section>
<!-- Partner Logos Section Ends Here -->
<!-- The Best Helper Section Starts Here -->
<section class="helper-sec p-b-80">
 <div class="container">
    <div class="row">
       <div class="col-md-6 col-lg-6 col-sm-12 col-xs-12 pull-right">
          <div class="helper-video">
             <img alt="helper-intro-video" src="{{URL::to('/')}}/assets/images/close-up-woman-s-hand-holding-bucket-with-cleaning-supplies-pink-napkin.jpg">
          </div>
       </div>
       <div class="col-md-6 col-lg-6 col-sm-12 col-xs-12">
          <div class="helper-text">
             <h3> The Best Helper For Your Home Is At Your Fingertips </h3>
             <ul>
                <li> <i class="fa fa-check"> </i>  <b> Do your research to get the right fit for your 
                   home and your family </b> <br/> Don't leave it up to faith, your family deserves a 
                   reliable and capable helper 
                </li>
                <li> <i class="fa fa-check"> </i>  <b> Not sure where to start? </b> <br/> Just contact the highest rated agencies near you and let them recommend their best people </li>
                <li> <i class="fa fa-check"> </i>  <b> How reliable is it? </b> <br/> CVs can be just pretty words on a page but ratings and reviews from other employers like you are far more trustworthy </li>
                <li> <i class="fa fa-check"> </i>  <b> Do I have to do the employment / helper 
                   Application process on this website? </b> <br/> We do not offer these services at the moment. We are here to assist in your search for the perfect helper and agency only, all legal employment application procedures needs to be performed off-site. Simplify this process by selecting one of our agencies
                </li>
             </ul>
          </div>
       </div>
    </div>
 </div>
</section>
<!-- The Best Helper Section Ends Here -->


@endsection