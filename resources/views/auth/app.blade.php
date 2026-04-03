<!DOCTYPE html>
<html lang="en">
  <head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Cuba admin is super flexible, powerful, clean &amp; modern responsive bootstrap 5 admin template with unlimited possibilities.">
    <meta name="keywords" content="admin template, Cuba admin template, dashboard template, flat admin template, responsive admin template, web app">
    <meta name="author" content="pixelstrap">
    <link rel="icon" href="{{ asset(env('APP_FAVICON')) }}" type="image/x-icon">
    <title>@yield('title') - {{ env('APP_NAME') }}</title>
    <!-- Google font-->
    <link href="https://fonts.googleapis.com/css?family=Rubik:400,400i,500,500i,700,700i&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Roboto:300,300i,400,400i,500,500i,700,700i,900&display=swap" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/font-awesome.css') }}">
    <!-- ico-font-->
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/vendors/icofont.css') }}">
    <!-- Themify icon-->
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/vendors/themify.css') }}">
    <!-- Flag icon-->
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/vendors/flag-icon.css') }}">
    <!-- Feather icon-->
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/vendors/feather-icon.css') }}">
    <!-- Plugins css start-->
    <!-- Plugins css Ends-->
    <!-- Bootstrap css-->
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/vendors/bootstrap.css') }}">
    <!-- App css-->
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/style.css') }}">
    <link id="color" rel="stylesheet" href="{{ asset('assets/css/color-1.css') }}" media="screen">
    <!-- Responsive css-->
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/responsive.css') }}">
    <style>
       .button-loading {
    border: 1px solid #25aa71;
    cursor: default;
    text-shadow: none;
    color: transparent !important;
    position: relative;
    -webkit-transition: border-color .2s ease-out;
    transition: border-color .2s ease-out;
    background: #25aa71;
}

.button-loading, .button-loading:hover, .button-loading:focus, .button-loading:active {
    color: transparent
}

.button-loading:before {
    content: "";
    position: absolute;
    top: 50%;
    left: 50%;
    border-radius: 50%;
    border-width: 3px;
    border-style: solid;
    border-color: #fff;
    border-bottom-color: transparent;
    margin-top: -9px;
    margin-left: -9px;
    width: 18px;
    height: 18px;
    -webkit-animation: button-loading-spinner .7s linear infinite;
    animation: button-loading-spinner 1s linear infinite
}

.btn-info.button-loading:before {
    border-color: #ffffff;
    border-bottom-color: transparent
}

.btn-info.button-loading {
    background: #428bca;
    border-color: #357ebd
}

.btn-primary.button-loading:before {
    border-color: #ffffff;
    border-bottom-color: transparent
}
    </style>
  </head>
  <body>
    <!-- login page start-->
      @yield('content')
      <!-- latest jquery-->
      <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
      <!-- Bootstrap js-->
      <script src="{{ asset('assets/js/bootstrap/bootstrap.bundle.min.js') }}"></script>
      <!-- feather icon js-->
      <script src="{{ asset('assets/js/icons/feather-icon/feather.min.js') }}"></script>
      <script src="{{ asset('assets/js/icons/feather-icon/feather-icon.js') }}"></script>
      <!-- scrollbar js-->
      <!-- Sidebar jquery-->
      <script src="{{ asset('assets/js/config.js') }}"></script>
      <!-- Plugins JS start-->
      <!-- Plugins JS Ends-->
      <!-- Theme js-->
      <script src="{{ asset('assets/js/script.js') }}"></script>
      <script> 
        $('#check_otp').click(function(e){
          e.preventDefault();
          e.stopPropagation();
          var email = $('#email').val();
          var password = $('#password').val();
          $("#check_otp").addClass('button-loading');
          $.get("{{route('users.verify_otp')}}",{email:email,password:password,_token:"{{csrf_token() }}"},function(data){
            // console.log(data);
            if(data.login == 'need_otp'){
            $('#login_field').hide('300');
            $('#otp_input').show('300');
            $('#check_otp').hide('300');
            $('#verify_otp').show('300');
          
            
            }
            else if(data.login == 'sucess'){
          
            $('#login_form').submit();
            }
            else if(data.login == 'failed'){
          
            $('#login_form').submit();
            }
          });
        });
        $('#otp').keyup(function(){
          var otp = $('#otp').val();
          if(otp.length == 4){
            $('#verify_otp').removeAttr('disabled');
          }
          else{
            $('#verify_otp').prop('disabled',true);
          }
        });
        $('#verify_otp').click(function(e){
          e.preventDefault();
          e.stopPropagation();
          var email = $('#email').val();
          var otp = $('#otp').val();
          // $("#verify_otp").addClass('button-loading');
          $.get("{{route('users.check_otp')}}",{email:email,otp:otp,_token:"{{csrf_token() }}"},function(data){
            if(data.success == 0){
            $("#verify_otp").removeClass('button-loading');
            $('#invalid-otp').show(200);
            }
            else{
            $('#login_form').submit();
            }
          })
        });
        function resend_otp(user_id){
          // console.log('Test');
          $.get("{{route('resend_otp')}}",{user_id:user_id},function(data){
            if(data){
              $.notify('<i class="fa fa-bell-o"></i><strong>Sent</strong> OTP Sent Again', {
                type: 'success',
                allow_dismiss: true,
                delay: 3000,
                showProgressbar: true,
                timer: 300,
                animate:{
                  enter:'animated fadeInDown',
                  exit:'animated fadeOutUp'
                }
              });
            }
            else{
              $.notify('<i class="fa fa-bell-o"></i><strong>Failed</strong> Something Error !', {
                type: 'danger',
                allow_dismiss: true,
                delay: 3000,
                showProgressbar: true,
                timer: 300,
                animate:{
                  enter:'animated fadeInDown',
                  exit:'animated fadeOutUp'
                }
              });
            }
          })
        }
        
        </script>
      <!-- login js-->
      <!-- Plugin used-->
    </div>
  </body>
</html>