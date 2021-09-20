<div class="modal fade register-modal" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel">
   <div class="modal-dialog modal-lg" role="document" style="max-width: 500px;">
      <div class="modal-content" id="r_content">
         <div class="join-pop-head">
            <h3> Join Helperrific <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button> </h3>
         </div>
         <div id="r_social">
            <div class="join-social">
               <a href="{{ url('auth/facebook') }}"> <i class="fab fa-facebook-f"> </i> Continue with Facebook </a>
               <a href="{{ url('auth/google') }}"> <i class="fab fa-google-plus-g"> </i> Continue with Google </a>
            </div>
            <div class="join-or">
               <p> <b> OR </b> </p>
            </div>
         </div>
         <div class="join-form">
            <form id="register-form" action="{{URL::to('/register')}}">
               {{csrf_field()}}
               <input type="email" placeholder="Enter your email" name="email" required>
               <span id="r_error" class="error_span">Email already exists.</span>
               <div id="r_fields">
                  
               </div>
               <button type="submit"> Continue  </button>
               <p> By joining I agree to receive emails from Helperrific </p>
            </form>
         </div>
         <div class="join-already">
            <p> Already a member? <a href="javascript:void(0)" class="open-login" data-dismiss="modal"> Sign In </a> </p>
         </div>
      </div>
   </div>
</div>

<div class="modal fade login-modal" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel">
   <div class="modal-dialog modal-lg" role="document" style="max-width: 500px;">
      <div class="modal-content" id="l_content">
         <div class="join-pop-head">
            <h3> Sign In Helperrific <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button> </h3>
         </div>
         <div class="join-social">
            <a href="{{ url('auth/facebook') }}"> <i class="fab fa-facebook-f"> </i> Continue with Facebook </a>
            <a href="{{ url('auth/google') }}"> <i class="fab fa-google-plus-g"> </i> Continue with Google </a>
         </div>
         <div class="join-or">
            <p> <b> OR </b> </p>
         </div>
         <div class="join-form">
            <form id="login-form" action="{{URL::to('/login')}}">
               {{csrf_field()}}
               <input type="email" placeholder="Enter your email" name="email" required>
               <input type="password" placeholder="Enter your password" name="password" required>
               <span id="l_error" class="error_span">Email already exists.</span>
               <button type="submit"> Sign In  </button>
            </form>
         </div>
         <div class="join-already">
            <p> Don`t have an account? <a href="javascript:void(0)" class="open-join"> Sign Up </a> </p>
         </div>
      </div>
   </div>
</div>


<div class="modal fade enquiry-modal" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel">
   <div class="modal-dialog modal-lg" role="document" style="max-width: 500px;">
      <div class="modal-content" id="e_content">
         <div class="join-pop-head">
            <h3> Send us your enquiry <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button> </h3>
         </div>
         <div class="join-form">
            <form id="enquiryForm" action="{{URL::to('/enquiry')}}">
               {{csrf_field()}}
               <input type="hidden" name="is_user" value="{{Auth::check() ? Auth::id() : '0'}}">
               <input type="text" placeholder="Enter your Full Name" name="fullname"
                  @if(Auth::check())
                     value="{{Auth::user()->fname.' '.Auth::user()->lname}}"
                     readonly 
                  @endif
               required>
               <input type="email" placeholder="Enter your email" name="email"
                  @if(Auth::check())
                     value="{{Auth::user()->email}}"
                     readonly
                  @endif 
               required>
               <select name="category" required>
                  <option value="">Select Category</option>
                  <option value="Premium features">Premium features</option>
                  <option value="Report a user">Report a user</option>
                  <option value="Help for technical issues">Help for technical issues</option>
                  <option value="Other">Other</option>
               </select>
               <textarea name="description" required rows="5" placeholder="Type Description Here..."></textarea>
               <span id="e_error" class="error_span">Email already exists.</span>
               <button type="submit"> Submit  </button>
            </form>
         </div>
      </div>
   </div>
</div>


<div class="modal fade order-modal" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel">
   <div class="modal-dialog modal-lg" role="document" style="max-width: 500px;">
      <div class="modal-content" id="o_content">
         <div class="join-pop-head">
            <h3> Request to hire <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button> </h3>
            <hr>
         </div>
         <div class="join-form">
            <p>You are now sending a request to this helper / agency. This is only to show your intention to hire and you will need to complete all legal paperwork and logistical arrangements off this website. We do not provide these services at this point of time. </p>
            <form id="orderForm" action="{{URL::to('/orders/book')}}">
               {{csrf_field()}}
               <input type="hidden" name="seller" value="" id="order_seller">
               <input type="hidden" name="description" value="I want to hire you." required>
               <button type="submit"> Send request  </button>
            </form>
         </div>
      </div>
   </div>
</div>

@if(Auth::check() && Auth::user()->type == '0')
   <div class="modal fade type-modal" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel">
      <div class="modal-dialog modal-lg" role="document" style="max-width: 500px;">
         <div class="modal-content" id="o_content">
            <div class="join-pop-head">
               <h3> Select User Type </h3>
               <hr>
            </div>
            <div class="type-form">
               <form method="post" action="{{URL::to('/users/type/setup')}}">
                  {{csrf_field()}}
                     
                     I am a / an: <br>
                     <label class="form-check-label" for="employer">
                        <div class="form-check">
                           <input class="form-check-input" type="radio" name="usertype" value="1" id="employer" checked>
                           Employer
                        </div>
                     </label>

                     <label class="form-check-label" for="helper">
                        <div class="form-check">
                           <input class="form-check-input" type="radio" name="usertype" value="2" id="helper">
                           Helper
                        </div>
                     </label>

                     <label class="form-check-label" for="agency">
                        <div class="form-check">
                           <input class="form-check-input" type="radio" name="usertype" value="3" id="agency">
                           Agency
                        </div>
                     </label>

                  <button type="submit"> Submit  </button>
               </form>
            </div>
         </div>
      </div>
   </div>
@endif