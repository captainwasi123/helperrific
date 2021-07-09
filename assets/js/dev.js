var host = '';


$(document).ready(function(){
    host = $("meta[name='host']").attr("content");  

    $(document).on('click', '.open-login', function(){
        $('.register-modal').modal('hide');
        $('.login-modal').modal('show'); 
    });
    $(document).on('click', '.open-join', function(){
        $('.login-modal').modal('hide');
        $('.register-modal').modal('show'); 
    });
    $(document).on('click', '.open-enquiry', function(){
        $('.enquiry-modal').modal('show'); 
    });
    $(document).on('click', '.open-order', function(){
        var id = $(this).data('id');
        $('#order_seller').val(id);
        $('.order-modal').modal('show'); 
    });


    $(document).on('click', '#addlang', function(){
        $('#lang_block').append('<tr><td><input type="text" class="noboder" name="lang[]" required></td><td><select name="langlevel[]"><option> Basic </option><option> Intermediate </option><option> Expert </option></select></td></tr>'); 
    });

    $('#profile_pic').change(function() {
      $('#profile_form').submit();
    });
    $('#cover_pic').change(function() {
      $('#cover_form').submit();
    });


    $("#profile_pic").change(function() {
        var pre = $(this).data('preview');
        readURL(this, pre);
    });

    $("#cover_pic").change(function() {
        var pre = $(this).data('preview');
        readURL(this, pre);
    });

    $(document).on('change', '.makeFavorite', function() {
        // this will contain a reference to the checkbox
        var id = $(this).data('id');
        var element = $(this);   
        if (this.checked) {
            $.get(host+"/favorite/add/"+id, function(data, status){
                if(status == 'success'){
                }else{
                    console.log('Something went wrong.');
                }
            });
        } else {
            $.get(host+"/favorite/remove/"+id, function(data, status){
                if(status == 'success'){
                }else{
                    console.log('Something went wrong.');
                }
            });
        }
    });

    $(document).on('change', '#order_status', function() {
        // this will contain a reference to the checkbox
        var id = $(this).data('id');
        var val = $(this).val();
        
        if (confirm('Are you sure want to change order status?')) {
            $.get(host+"/orders/status/"+id+"/"+val, function(data, status){
                if(status == 'success'){
                }else{
                    console.log('Something went wrong.');
                }
            });
        }
    });

    $(document).on('change', '#availability_status', function() {
        var val = $(this).val();
        
        if (confirm('Are you sure want to change your status?')) {
            $.get(host+"/helper/availability_status/"+val, function(data, status){
                if(status == 'success'){
                }else{
                    console.log('Something went wrong.');
                }
            });
        }
    });

    $(document).on('focus', 'textarea[name="message"]', function(){
        $('#newMessInd').css({display: 'none'});

    });

    $(document).on('click', '.emojies', function(){
        $('.emoji-menu').toggle(); 
    });

    $(document).on('change', '#fileAttach', function() {
      var file = $('#fileAttach')[0].files[0].name;
      $('#fileAttachName').text(file);
    });



    //Write a review
     $(document).on('click', '.writeReview', function() {
        var id = $(this).data('id');
        var name = $(this).data('name');
        $('#seller_name2').html(name);
        $('#seller_id2').val(id);

        $('.review-modal2').modal('show');
    });



    //Gallery Image Delete
    $(document).on('click', '.deletePhoto', function() {
        if(confirm('Are you sure want to delete this photo?')){
            var href = $(this).data('href');
            window.location.href = href;
        }
    });

    //Delete Account
    $(document).on('click', '.del-account-btn', function() {
        if(confirm('Are you sure want to delete this account?')){
            var href = $(this).data('href');
            window.location.href = href;
        }
    });


    //Premium Account
    $(document).on('click', '.premium_account', function() {
        $('.modal').modal('hide');
        $('.premium-modal').modal({
            backdrop: 'static',
            keyboard: false
        });
        $('.premium-modal').modal('show');
        $('#premium_content').html('<img src="'+host+'/assets/images/loader.gif" style="width: 200px;"/>');
        
        $.get(host+"/premium/getPrice", function(data, status){
            if(status == 'success'){
                $('#premium_content').html(data);
            }else{
                console.log('Something went wrong.');
            }
        });
    });


    //null profile
    $(document).on('click', '.null-profile', function() {
      //  var cont = 'Please <a href="javascript:void(0)" class="open-login">login</a> to view profile';
      var cont = 'You have viewed 5 profiles, please wait 30 days or upgrade to a premium account';
     $('.alert-modal').modal({
            backdrop: 'static',
            keyboard: false
        });
        $('.alert-modal').modal('show');
        $('#alert_content').html('<div class="r_success_block"><img src="'+host+'/assets/images/error-loader.gif" class="success_gif" /><br><h4>Alert.! </h4><p> '+cont+'.</p>');
        
    });

    //limit reached
    $(document).on('click', '.limit-reached', function() {
        var cont = 'You have viewed 5 profiles, please wait 30 days or upgrade to a <a href="javascript:void(0)" class="premium_account">premium account</a>';
        $('.alert-modal').modal({
            backdrop: 'static',
            keyboard: false
        });
        $('.alert-modal').modal('show');
        $('#alert_content').html('<div class="r_success_block"><img src="'+host+'/assets/images/error-loader.gif" class="success_gif" /><br><h4>Alert.! </h4><p> '+cont+'.</p>');
        
    });

    //null star
    $(document).on('click', '.null-star', function() {
        var cont = 'Upgrade to a <a href="javascript:void(0)" class="premium_account">premium account</a>d to be able to display your current and star helpers:';
        $('.alert-modal').modal({
            backdrop: 'static',
            keyboard: false
        });
        $('.alert-modal').modal('show');
        $('#alert_content').html('<div class="r_success_block"><img src="'+host+'/assets/images/error-loader.gif" class="success_gif" /><br><h4>Sorry! </h4><p> '+cont+'.</p>');
        
    });


    //Review Invitation
    $(document).on('click', '.sendInvite', function() {
        var id = $(this).data('id');
        if(confirm('Are you sure want to send review invitation.?')){
            window.location.href = host+'/reviewInvitation/send/'+id;
        }
    });


    //Review Report
    $(document).on('click', '.reportReview', function() {
        var id = $(this).data('id');
        if(confirm('Are you sure want to report this review.?')){
            window.location.href = host+'/reportReview/'+id;
        }
    });

 });

function readURL(input, pre) {
    if (input.files && input.files[0]) {
        var reader = new FileReader();
        reader.onload = function(e) {
            $('#'+pre).css('background-image', 'url('+e.target.result +')');
            $('#'+pre).hide();
            $('#'+pre).fadeIn(650);
        }
        reader.readAsDataURL(input.files[0]);
    }
}

function chatScrollDown(){
    $('#chatScroll').scrollTop($('#chatScroll')[0].scrollHeight);
}


function notiSound() {
  $('#newMessInd').css({display: 'inline-block'});
  const audio = new Audio(host+'/assets/audio/noti.mp3');
  audio.play();
}

//Ajax

$( "#register-form" ).submit(function( event ) {
 
  // Stop form from submitting normally
  event.preventDefault();
 
  // Get some values from elements on the page:
  var $form = $( this ),
    em = $form.find( "input[name='email']" ).val(),
    token = $form.find( "input[name='_token']" ).val(),
    url = $form.attr( "action" );
    var datastrings = $(this).serialize();
    // Send the data using post
    var posting = $.post( url, datastrings );
 
    // Put the results in a div
    posting.done(function( data ) {
        if(data == 'exist'){
            $('#r_error').html('Email already exists.');
            $('#r_error').css({display: 'block'});
        }else if(data == 'success'){
            $('#r_content').html('<div class="r_success_block"><img src="'+host+'/assets/images/success-gif.gif" class="success_gif" /><br><p> Account created. Please <a href="javascript:void(0)" class="open-login" data-dismiss="modal"> Sign In </a> here.</p></div>');
        }else if(data == 'nomatch'){
            $('#r_error').html('Password does not match.');
            $('#r_error').css({display: 'block'});
        }else{
            $('#r_social').remove();
            $('#r_error').css({display: 'none'});
            var elements    = '<input type="password" placeholder="New Password" name="password" required>';
            elements        += '<input type="password" placeholder="Confirm Password" name="confirmation_password" required>';
            elements        += 'I am a / an: <input type="radio" class="radio-button" name="user_type" value="1" checked> Employer';
            elements        += '<input type="radio" class="radio-button" name="user_type" value="2" > Helper';
            elements        += '<input type="radio" class="radio-button" name="user_type" value="3" > Agency';
            $('#r_fields').html(elements);
        }

        console.log(data);
    })
    .fail(function(error) {
        $('#r_error').html('Something went wrong.');
        $('#r_error').css({display: 'block'});
        console.log(error);
    });
});

$( "#login-form" ).submit(function( event ) {
 
  // Stop form from submitting normally
  event.preventDefault();
 
  // Get some values from elements on the page:
  var $form = $( this ),
    em = $form.find( "input[name='email']" ).val(),
    token = $form.find( "input[name='_token']" ).val(),
    url = $form.attr( "action" );

    var datastrings = $(this).serialize();
    // Send the data using post
    var posting = $.post( url, datastrings );

    // Put the results in a div
    posting.done(function( data ) {
        if(data == 'error'){
            $('#l_error').html('Account has been suspended, please contact site administrator.');
            $('#l_error').css({display: 'block'});
            return false;
        }if(data == 'incorrect'){
            $('#l_error').html('Email or Password is incorrect.');
            $('#l_error').css({display: 'block'});
        }else{
            $('#l_content').html('<div class="r_success_block"><img src="'+host+'/assets/images/success-gif.gif" class="success_gif" /><br><p> You are successfully Logged In.');
            setTimeout(function(){
                window.location.href = host+data;
            }, 2000);
        }
    })
    .fail(function(error) {
        $('#l_error').html('Something went wrong.');
        $('#l_error').css({display: 'block'});
        console.log(error);
    });
});

// Enquiry

$( "#enquiryForm" ).submit(function( event ) {
 
  // Stop form from submitting normally
  event.preventDefault();
 
  // Get some values from elements on the page:
  var $form = $( this ),
    em = $form.find( "input[name='email']" ).val(),
    token = $form.find( "input[name='_token']" ).val(),
    url = $form.attr( "action" );

    var datastrings = $(this).serialize();
    // Send the data using post
    var posting = $.post( url, datastrings );

    // Put the results in a div
    posting.done(function( data ) {
        $('#e_content').html('<div class="r_success_block"><img src="'+host+'/assets/images/success-gif.gif" class="success_gif" /><br><h4>Enquiry#: '+data+' </h4><p> Thank you for submitting your enquiry. Our concern will contact you in a while.');
        setTimeout(function(){
            window.location.href = host;
        }, 4000);
    })
    .fail(function(error) {
        $('#l_error').html('Something went wrong.');
        $('#l_error').css({display: 'block'});
        console.log(error);
    });
});


//Order Book
$( "#orderForm" ).submit(function( event ) {
 
  // Stop form from submitting normally
  event.preventDefault();
 
  // Get some values from elements on the page:
  var $form = $( this ),
    em = $form.find( "input[name='email']" ).val(),
    token = $form.find( "input[name='_token']" ).val(),
    url = $form.attr( "action" );

    var datastrings = $(this).serialize();
    // Send the data using post
    var posting = $.post( url, datastrings );

    // Put the results in a div
    posting.done(function( data ) {
        $('#o_content').html('<div class="r_success_block"><img src="'+host+'/assets/images/success-gif.gif" class="success_gif" /><br><p> Thank you for submitting your request.');
        setTimeout(function(){
            window.location.href = window.location.href;
        }, 4000);
    })
    .fail(function(error) {
        $('#l_error').html('Something went wrong.');
        $('#l_error').css({display: 'block'});
        console.log(error);
    });
});


//Review Submit
$( "#reviewForm" ).submit(function( event ) {
 
  // Stop form from submitting normally
  event.preventDefault();
 
  // Get some values from elements on the page:
  var $form = $( this ),
    em = $form.find( "input[name='email']" ).val(),
    token = $form.find( "input[name='_token']" ).val(),
    url = $form.attr( "action" );

    var datastrings = $(this).serialize();
    // Send the data using post
    var posting = $.post( url, datastrings );

    // Put the results in a div
    posting.done(function( data ) {
        $('#re_content').html('<div class="r_success_block"><img src="'+host+'/assets/images/success-gif.gif" class="success_gif" /><br><h4>Thank You.! </h4><p> Review Submitted.</p>');
        setTimeout(function(){
            window.location.href = window.location.href;
        }, 2000);
    })
    .fail(function(error) {
        $('#l_error').html('Something went wrong.');
        $('#l_error').css({display: 'block'});
        console.log(error);
    });
});

$( "#reviewForm2" ).submit(function( event ) {
 
  // Stop form from submitting normally
  event.preventDefault();
 
  // Get some values from elements on the page:
  var $form = $( this ),
    em = $form.find( "input[name='email']" ).val(),
    token = $form.find( "input[name='_token']" ).val(),
    url = $form.attr( "action" );

    var datastrings = $(this).serialize();
    // Send the data using post
    var posting = $.post( url, datastrings );

    // Put the results in a div
    posting.done(function( data ) {
        $('#ree_content').html('<div class="r_success_block"><img src="'+host+'/assets/images/success-gif.gif" class="success_gif" /><br><h4>Thank You.! </h4><p> Review Submitted.</p>');
        setTimeout(function(){
            window.location.href = window.location.href;
        }, 2000);
    })
    .fail(function(error) {
        $('#l_error').html('Something went wrong.');
        $('#l_error').css({display: 'block'});
        console.log(error);
    });
});



//Inbox Chat

$( "#sendchat" ).submit(function( event ) {
 
  // Stop form from submitting normally
  event.preventDefault();
 

    // Get form
        var form = $('#sendchat')[0];

        // Create an FormData object 
        var data = new FormData(form);

        // disabled the submit button
        $("#btnSubmit").prop("disabled", true);

        $.ajax({
            type: "POST",
            enctype: 'multipart/form-data',
            url: host+'/inbox/messageSend',
            data: data,
            processData: false,
            contentType: false,
            cache: false,
            timeout: 600000,
            success: function (data) {
                $("textarea[name='message']").val(null);
                $(".emoji-wysiwyg-editor").html(null);
                $('#fileAttachName').html(null);
                $('#talksall').append(data);
                chatScrollDown();

            },
            error: function (e) {
                $('#l_error').html('Something went wrong.');
                $('#l_error').css({display: 'block'});
                console.log(e);


            }
        });
});


//Helper Filter

$(document).on('change', '.helper_filter', function() {
    
  $('#content_block').html('<div class="r_success_block"><img src="'+host+'/assets/images/search-loader.gif" class="search_gif" />');
  // Get some values from elements on the page:
  
    var token = $("#token").val();
    var skills = $("#skills").val();
    var expertise = $("#expertise").val();
    var location = $("#location").val();
    var availability = $("#availability").val();

    var datastrings = {_token:token, eexpertise:expertise, eskills:skills, elocation:location, eavailability:availability};
    // Send the data using post
    var posting = $.post( host+'/helpers', datastrings );

    // Put the results in a div
    posting.done(function( data ) {
        $('#content_block').html(data);
    })
    .fail(function(error) {
        console.log(error);
    });
});


//Agency Filter

$(document).on('change', '.agency_filter', function() {
    
  $('#content_block').html('<div class="r_success_block"><img src="'+host+'/assets/images/search-loader.gif" class="search_gif" />');
  // Get some values from elements on the page:
  
    var token = $("#token").val();
    var location = $("#location").val();

    var datastrings = {_token:token, elocation:location};
    // Send the data using post
    var posting = $.post( host+'/agencies', datastrings );

    // Put the results in a div
    posting.done(function( data ) {
        $('#content_block').html(data);
    })
    .fail(function(error) {
        console.log(error);
    });
});

//employerFilter

$(document).on('change', '.employer_filter', function() {
    
    $('#content_block').html('<div class="r_success_block"><img src="'+host+'/assets/images/search-loader.gif" class="search_gif" />');
    // Get some values from elements on the page:
    
      var token = $("#token").val();
      var location = $("#location").val();
  
      var datastrings = {_token:token, elocation:location};
      // Send the data using post
      var posting = $.post( host+'/employers', datastrings );
  
      // Put the results in a div
      posting.done(function( data ) {
          $('#content_block').html(data);
      })
      .fail(function(error) {
          console.log(error);
      });
  });



//Premium Subscribe

$(document).on('submit', '#premium_formm', function( event ) {
 
    // Stop form from submitting normally
  event.preventDefault();
 
  // Get some values from elements on the page:
  var $form = $( this ),
    em = $form.find( "input[name='email']" ).val(),
    token = $form.find( "input[name='_token']" ).val(),
    url = $form.attr( "action" );

    var datastrings = $(this).serialize();
    // Send the data using post
    var posting = $.post( url, datastrings );

    // Put the results in a div
    posting.done(function( data ) {
        if(data == 'success'){
            $('#pre_content').html('<div class="r_success_block"><img src="'+host+'/assets/images/success-gif.gif" class="success_gif" /><br><h4>Thank You.! </h4><p> You successfully subscribed premium.</p>');
            setTimeout(function(){
                window.location.href = window.location.href;
            }, 1000);
        }else{
             $('#pre_content').html('<div class="r_success_block"><img src="'+host+'/assets/images/error-loader.gif" class="success_gif" /><br><h4>Alert.! </h4><p> Something went wrong.</p>');

        }
    })
    .fail(function(error) {
        console.log(error);
        $('#pre_content').html('<div class="r_success_block"><img src="'+host+'/assets/images/error-loader.gif" class="success_gif" /><br><h4>Alert.! </h4><p> Something went wrong.</p>');
    });

});



function autocomplete(inpt, arr) {

  var inp = document.getElementById(inpt);
  /*the autocomplete function takes two arguments,
  the text field element and an array of possible autocompleted values:*/
  var currentFocus;
  /*execute a function when someone writes in the text field:*/
  inp.addEventListener("input", function(e) {
      var a, b, i, val = this.value;
      /*close any already open lists of autocompleted values*/
      closeAllLists();
      if (!val) { return false;}
      currentFocus = -1;
      /*create a DIV element that will contain the items (values):*/
      a = document.createElement("DIV");
      a.setAttribute("id", this.id + "autocomplete-list");
      a.setAttribute("class", "autocomplete-items");
      /*append the DIV element as a child of the autocomplete container:*/
      this.parentNode.appendChild(a);
      /*for each item in the array...*/
      for (i = 0; i < arr.length; i++) {
        /*check if the item starts with the same letters as the text field value:*/
        if (arr[i].substr(0, val.length).toUpperCase() == val.toUpperCase()) {
          /*create a DIV element for each matching element:*/
          b = document.createElement("DIV");
          /*make the matching letters bold:*/
          b.innerHTML = "<strong>" + arr[i].substr(0, val.length) + "</strong>";
          b.innerHTML += arr[i].substr(val.length);
          /*insert a input field that will hold the current array item's value:*/
          b.innerHTML += "<input type='hidden' value='" + arr[i] + "'>";
          /*execute a function when someone clicks on the item value (DIV element):*/
          b.addEventListener("click", function(e) {
              /*insert the value for the autocomplete text field:*/
              inp.value = this.getElementsByTagName("input")[0].value;
              /*close the list of autocompleted values,
              (or any other open lists of autocompleted values:*/
              closeAllLists();
          });
          a.appendChild(b);
        }
      }
  });
  /*execute a function presses a key on the keyboard:*/
  inp.addEventListener("keydown", function(e) {
      var x = document.getElementById(this.id + "autocomplete-list");
      if (x) x = x.getElementsByTagName("div");
      if (e.keyCode == 40) {
        /*If the arrow DOWN key is pressed,
        increase the currentFocus variable:*/
        currentFocus++;
        /*and and make the current item more visible:*/
        addActive(x);
      } else if (e.keyCode == 38) { //up
        /*If the arrow UP key is pressed,
        decrease the currentFocus variable:*/
        currentFocus--;
        /*and and make the current item more visible:*/
        addActive(x);
      } else if (e.keyCode == 13) {
        /*If the ENTER key is pressed, prevent the form from being submitted,*/
        e.preventDefault();
        if (currentFocus > -1) {
          /*and simulate a click on the "active" item:*/
          if (x) x[currentFocus].click();
        }
      }
  });
  function addActive(x) {
    /*a function to classify an item as "active":*/
    if (!x) return false;
    /*start by removing the "active" class on all items:*/
    removeActive(x);
    if (currentFocus >= x.length) currentFocus = 0;
    if (currentFocus < 0) currentFocus = (x.length - 1);
    /*add class "autocomplete-active":*/
    x[currentFocus].classList.add("autocomplete-active");
  }
  function removeActive(x) {
    /*a function to remove the "active" class from all autocomplete items:*/
    for (var i = 0; i < x.length; i++) {
      x[i].classList.remove("autocomplete-active");
    }
  }
  function closeAllLists(elmnt) {
    /*close all autocomplete lists in the document,
    except the one passed as an argument:*/
    var x = document.getElementsByClassName("autocomplete-items");
    for (var i = 0; i < x.length; i++) {
      if (elmnt != x[i] && elmnt != inp) {
        x[i].parentNode.removeChild(x[i]);
      }
    }
  }
  /*execute a function when someone clicks in the document:*/
  document.addEventListener("click", function (e) {
      closeAllLists(e.target);
  });
}

