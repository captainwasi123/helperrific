@extends('web.support.master')
@section('title', 'Home')

@section('content')


<!-- Banner Section Starts Here -->
<section class="banner-sec">
 <div class="container">
    <div class="banner-text">
       <h3> I am Looking For </h3>
       <h6> <a href="{{URL::to('/helpers')}}"> <img alt="helper-icon" src="{{URL::to('/')}}/assets/images/banner-icon1.jpg"> A Domestic Helper  </a>  <a href="{{URL::to('/agencies')}}"> <img alt="agency-icon" src="{{URL::to('/')}}/assets/images/banner-icon2.jpg">  An Agency </a>  </h6>
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
             <img alt="helper-intro-video" src="{{URL::to('/')}}/assets/images/helper-video.jpg">
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
                   Application process on this website? </b> <br/> Do I have to do the employment / helper application 
                   process on this website? 
                </li>
             </ul>
          </div>
       </div>
    </div>
 </div>
</section>
<!-- The Best Helper Section Ends Here -->


@endsection