<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
   <head>
      <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
      <meta name="viewport" content="width=device-width, initial-scale=1">
      <meta name="host" content="{{URL::to('/')}}">
      <title> @yield('title') - Helperrific </title>

      @include('web.support.style')
      @yield('addStyle')
   </head>
   <body>
      <!-- Header Starts Here -->
         @include('web.support.header')
      <!-- Header Ends Here -->
      

      @yield('content')

      <!-- Footer Section Starts Here -->
         @include('web.support.footer')
      <!-- Footer Section Ends Here -->
      

      <!-- Modals -->
         @include('web.support.modal')

      <!-- Bootstrap Javascript -->
      <!-- Jquery Library -->
         @include('web.support.script')
         <script type="text/javascript">
            $(document).ready(function(){
               getNotification('{{Auth::id()}}', '{{env("PUSHER_APP_KEY")}}');
            });
         </script>
         @if(Auth::check() && Auth::user()->type == '0')
          <script type="text/javascript">
              $(document).ready(function(){
                $('.type-modal').modal({
                    backdrop: 'static',
                    keyboard: false
                });
              });
          </script>
         @endif
         @if(Auth::check() && Auth::user()->type == '1')
            <script src="https://use.fontawesome.com/5ac93d4ca8.js"></script>
            <script src="{{URL::to('/')}}/assets/js/bootstrap4-rating-input.js"></script>
            <script type="text/javascript">
              $(document).ready(function(){
                var u_id = '{{base64_encode(Auth::id())}}';
                $.get("{{URL::to('/')}}/orders/review/"+u_id, function(data, status){
                    if(status == 'success'){
                      if(data != 'nothing'){
                        $('#seller_name').html(data.name);
                        $('#order_id').val(data.order_id);
                        $('#seller_id').val(data.seller_id);

                        setTimeout(function(){
                          $('.review-modal').modal('show');
                        }, 2000);
                      }
                    }else{
                        console.log('Something went wrong.');
                    }
                });
              });
            </script>
         @endif
         @yield('addScript')

   </body>
</html>