
<div class="modal fade review-modal" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel">
   <div class="modal-dialog modal-lg" role="document" style="max-width: 500px;">
      <div class="modal-content" id="re_content">
         <div class="join-pop-head">
            <h3> Leave us a review <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button> </h3>
            <p style="padding: 0 11px;">You`ve recently hired <span id="seller_name"></span>, What do you think about it?
            <hr>
         </div>
         <div class="join-form">
            <form id="reviewForm" action="{{URL::to('/orders/review/submit')}}">
                {{csrf_field()}}
                <input type="hidden" name="order" value="" id="order_id">
                <input type="hidden" name="seller" value="" id="seller_id">
                <div class="rating_block">
                  <input type="number" name="rating" id="rating1" value="1" class="rating text-warning" required />
                </div>
                <textarea name="description" required rows="7" placeholder="Enter your review here..." required></textarea>
                <button type="submit"> Submit </button>
            </form>
         </div>
      </div>
   </div>
</div>

<div class="modal fade alert-modal" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel">
   <div class="modal-dialog modal-lg" role="document" style="max-width: 500px;">
      <div class="modal-content">
         <div id="alert_content">
         </div>
         <div>
            <a href="javascript:void(0)" class="skip_btn" data-dismiss="modal" aria-label="Close">Skip ></a>
         </div>
      </div>
   </div>
</div>

<div class="modal fade premium-modal" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel">
   <div class="modal-dialog modal-lg" role="document" style="max-width: 500px;">
      <div class="modal-content" id="pre_content">
         <div class="join-pop-head">
            <h3> Premium Account </h3>
            <p style="padding: 0 11px;">
            @if(Auth::check())
              @if(Auth::user()->type == '1')
                Free employer accounts are limited to 5 profile views a month. Get premium to view unlimited profiles.
              @endif
              @if(Auth::user()->type == '3')
                With premium accounts, potential employers will be able to see the helpers affiliated with your agency. You will also be able to promote your best helpers and get the most views from potential employers.
              @endif
            @endif  
            </p>
            <hr class="m-t-0 m-b-0">

         </div>
         <div id="premium_content">
         </div>
         <div>
            <a href="javascript:void(0)" class="skip_btn" data-dismiss="modal" aria-label="Close">Skip ></a>
         </div>
      </div>
   </div>
</div>

<div class="modal fade review-modal2" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel">
   <div class="modal-dialog modal-lg" role="document" style="max-width: 500px;">
      <div class="modal-content" id="ree_content">
         <div class="join-pop-head">
            <h3> Write a review <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button> </h3>
            <p style="padding: 0 11px;"><strong><span id="seller_name2"></span></strong>, What do you think about this Seller?
            <hr>
         </div>
         <div class="join-form">
            <form id="reviewForm2" action="{{URL::to('/orders/review/submit')}}">
                {{csrf_field()}}
                <input type="hidden" name="order" value="">
                <input type="hidden" name="seller" value="" id="seller_id2">
                <div class="rating_block">
                  <input type="number" name="rating" id="rating1" value="1" class="rating text-warning" required />
                </div>
                <textarea name="description" required rows="7" placeholder="Enter your review here..." required></textarea>
                <button type="submit"> Submit </button>
            </form>
         </div>
      </div>
   </div>
</div>



<footer>
   <div class="container">
      <div class="row">
         <div class="col-md-3 col-lg-3 col-sm-12 col-xs-12">
            <div class="footer-about">
               <a href=""> <img alt="footer-logo" src="{{URL::to('/')}}/assets/images/footer-logo.jpg"> </a>
               <!-- <h6> <a href=""> Email: info@Helperrific.com </a> </h6>
               <h6> <a href=""> Phone: 9256-654556 </a> </h6>
               <h6> <a href=""> Facebook: Helperrific </a> </h6> -->
            </div>
         </div>
         <div class="col-md-3 col-lg-3 col-sm-4 col-xs-12">
            <div class="footer-list">
               <h4> COMPANY </h4>
               <ul>
                  @if(Auth::check())
                      @if(Auth::user()->type == '3' || Auth::user()->type == '1')
                           @if(empty(Auth::user()->premium))
                              <li>
                                 <a href="javascript:void(0)" class="premium_account"> Premium Account </a>
                              </li>

                           @endif
                      @endif
                  @else
                      <li> <a href="javascript:void(0)" class="open-login"> Premium account </a></li>
                  @endif
                  <li> <a href="javascript:void(0)" class="open-login"> Sign in  </a></li>
                  <li> <a href="javascript:void(0)" class="open-join"> Join For free </a></li>
                  <li> <a href="javascript:void(0)" class="open-enquiry"> Send us Enquiry </a></li>
               </ul>
            </div>
         </div>
         <div class="col-md-3 col-lg-3 col-sm-4 col-xs-12">
            <div class="footer-list">
               <h4> SERVICES </h4>
               <ul>
                  <li> <a href="{{URL::to('/helpers/Cleaning')}}"> Cleaning Experts  </a></li>
                  <li> <a href="{{URL::to('/helpers/Child care')}}"> Child Care Experts </a></li>
                  <li> <a href="{{URL::to('/helpers/Elderly care')}}"> Elderly Care Experts  </a></li>
                  <li> <a href="{{URL::to('/helpers/Cooking (Other cusines)')}}"> Cooking Experts   </a></li>
                  <li> <a href="{{URL::to('/agencies')}}"> Agencies  </a></li>
               </ul>
            </div>
         </div>
         <div class="col-md-3 col-lg-3 col-sm-4 col-xs-12">
            <div class="footer-list">
               <h4> FOLLOW US </h4>
               <h6> 
                  <a href=""> <i class="fab fa-facebook-f"> </i> </a> 
                 <!--  <a href=""> <i class="fab fa-twitter"> </i> </a> 
                  <a href=""> <i class="fab fa-instagram"> </i> </a> --> 
                  <!-- <a href=""> <i class="fab fa-pinterest-p"> </i> </a>  -->
                  <a href=""> <i class="fab fa-linkedin-in"> </i> </a> 
               </h6>
            </div>
         </div>
      </div>
   </div>
</footer>

<!-- Copyrights Section Starts Here -->
   <section class="copyrights-sec">
      <span class="col-white"> © 2011 - 2020 helperrific | All rights reserved. </span>
   </section>
<!-- Copyrights Section Ends Here -->