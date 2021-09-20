@extends('web.support.master')
@section('title', 'Account Settings')

@section('content')

<!-- Breadcrumbs Section Starts Here -->
      <section class="breadcrumb-custom">
         <div class="container">
            <ul>
               <li> <a href="{{URL::to('/')}}"> Home </a> </li>
               <li> <a href="javascript:void(0)"> Account Settings </a> </li>
            </ul>
         </div>
      </section>
      <!-- Breadcrumbs Section Ends Here -->

      <!-- Page Content Starts Here -->
      <section class="p-t-60 p-b-60">
         <div class="container">
            <div class="account-settings-main">
               <div class="account-sett-head">
                  <h3> Account Settings </h3>
                  @if(session()->has('success'))
                    <br>
                    <div class="alert alert-success">
                        {{ session()->get('success') }}
                    </div>
                  @endif

                  @if(session()->has('error'))
                    <br>
                    <div class="alert alert-danger">
                        {{ session()->get('error') }}
                    </div>
                  @endif

                  <hr>
               </div>
               <div class="account-block">
                  <div class="account-block-data">
                     <form method="post" action="{{route('change.password')}}">
                        @csrf
                        <div class="form-field2">
                           <p> Old Password </p>
                           <input type="password"  name="old_password" required>
                        </div>
                        <div class="form-field2">
                           <p> New Password </p>
                           <input type="password"  name="new_password" required>
                        </div>
                        <div class="form-field2">
                           <p> Confirm New Password </p>
                           <input type="password"  name="confirmation_password" required>
                        </div>
                        <div class="form-field2">
                           <button  class="change-password-btn"> CHANGE PASSWORD </button>
                        </div>
                     </form>
                  </div>
               </div>
               <div class="account-block">
                  <div class="account-block-head">
                     <h4> Account subscription </h4>
                  </div>
                  <div class="account-block-data">
                     @if(empty(Auth::user()->premium))
                        <p>You are currently using a free account.  <a href="javascript:void(0)" class="premium_account"> Premium Account </a></p>
                     @else
                        <p>
                           You are currently using a premium account which expires on ({{date('d-M-Y', strtotime(Auth::user()->premium->end_date))}}). <a href="javascript:void(0)" class="premium_account">Click here</a> to extend your premium account subscription.
                        </p>
                     @endif
                  </div>
               </div>
               <div class="account-block">
                  <div class="account-block-head">
                     <h4> Account Private </h4>
                  </div>
                  <div class="account-block-data">
                     <div class="toggle-button-cover">
                        <div class="button-cover">
                           <div class="button b2" id="button-10">
                              <input type="checkbox" class="checkbox" {{empty(Auth::user()->private_account) ? '' : 'checked'}}>
                              <div class="knobs">
                                 <span>NO</span>
                              </div>
                              <div class="layer"></div>
                           </div>
                        </div>
                     </div>
                  </div>
               </div>
               <div class="account-block" style="margin-bottom: 0px !important">
                  <div class="account-block-head">
                     <h4> Delete Your Account </h4>
                  </div>
                  <div class="account-block-data">
                     <a href="javascript:void(0)" data-href="{{route('account.delete')}}" class="del-account-btn"> Delete Account </a>
                  </div>
               </div>
            </div>
         </div>
      </section>
      <!-- Page Content Ends Here -->

@endsection
@section('addScript')
<script type="text/javascript">
  var host = $("meta[name='host']").attr("content");
  $('.checkbox').click(function() {
    var $listSort = $('.checkbox');
    if ($listSort.attr('checked')) {
      $listSort.removeAttr('checked');
      $.get(host+"/private/status/0", function(data, status){
      });
    } else {
      $listSort.attr('checked', 'checked');
      $.get(host+"/private/status/1", function(data, status){
      });
    }
  });
</script>
@endsection