<meta name="description" content="">
<meta name="author" content="">
<meta name="google-signin-client_id" content="308482114921-342thij2130hla91jfvlfifbkt2rb7jr.apps.googleusercontent.com">
<link href="http://getbootstrap.com/dist/css/bootstrap.min.css" rel="stylesheet">
<!-- Custom styles for this template -->
<link href="http://getbootstrap.com/examples/signin/signin.css" rel="stylesheet">
<div class="container">
<div class="row">
<div class="col-sm-2"></div>
	 <div class="col-sm-4">
	  
       <button class="btn btn-sm btn-primary btn-block" onclick="_login();" type="submit">Sign Up using Facebook</button>
      
      <div class="userdata"></div>
	</div>
	
	  <!-- <div class="g-signin2" data-onsuccess="onSignIn"></div> -->
	 <div class="col-sm-6">
	 
 	<div id="gSignIn"></div>
 	<div class="userContent"></div>
 	
 	</div>
</div>
</div> 	
 <!-- Bootstrap core JavaScript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
    <script src="http://getbootstrap.com/dist/js/bootstrap.min.js"></script>

	
	<script>
  // Load the SDK asynchronously
 (function(thisdocument, scriptelement, id) {
    var js, fjs = thisdocument.getElementsByTagName(scriptelement)[0];
    if (thisdocument.getElementById(id)) return;
	
    js = thisdocument.createElement(scriptelement); js.id = id;
    js.src = "//connect.facebook.net/en_US/sdk.js";
    fjs.parentNode.insertBefore(js, fjs);
  }(document, 'script', 'facebook-jssdk'));
	
  window.fbAsyncInit = function() {
  FB.init({
    appId      : '1449392918617564', //Your APP ID
    cookie     : true,  // enable cookies to allow the server to access 
                        // the session
    xfbml      : true,  // parse social plugins on this page
    version    : 'v2.1' // use version 2.1
  });

  // These three cases are handled in the callback function.
  FB.getLoginStatus(function(response) {
    statusChangeCallback(response);
  });

  };
	
  // This is called with the results from from FB.getLoginStatus().
  function statusChangeCallback(response) {
    if (response.status === 'connected') {
      // Logged into your app and Facebook.
	  _i();
    } else if (response.status === 'not_authorized') {
      // The person is logged into Facebook, but not your app.
      document.getElementById('status').innerHTML = 'Please log ' +
        'into this app.';
    }
  }  
  
  function _login() {
	FB.login(function(response) {
	   // handle the response
	   if(response.status==='connected') {
		_i();
	   }
	 }, {scope: 'public_profile,email'});
 }
 
 function _i(){
	 FB.api('/me',{locale: 'en_US', fields: 'id,first_name,last_name,email,link,gender,locale,picture'}, function(response) {
   			var profileHTML = '<div class="profile"><div class="head">Welcome '+response.first_name+'! <a href="JavaScript:void();" onclick="fbLogout();">Sign out</a></div>';
            profileHTML += '<img src="'+response.picture.data.url+'"/><div class="proDetails"><p>'+response.first_name+' '+response.last_name+'</p><p>'+response.email+'</p><p>'+response.gender+'</p><p>'+response.id+'</p></div></div>';
            $('.userdata').html(profileHTML);
            $('.form-signin').slideUp('slow');
	});
 }

// Logout from facebook
function fbLogout() {
    FB.logout(function() {
      $('.userdata').html('');
       $('.form-signin').slideDown('slow');
    });
}
 

</script>



<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<script src="https://apis.google.com/js/client:platform.js?onload=renderButton" async defer></script>
<script>
function onSuccess(googleUser) {
	//alert('<?php echo $_SERVER['HTTP_HOST'];?>');
	var ur='<?php echo $_SERVER['HTTP_HOST'];?>';
    var profile = googleUser.getBasicProfile();
    gapi.client.load('plus', 'v1', function () {
        var request = gapi.client.plus.people.get({
            'userId': 'me'
        });
        //Display the user details
        request.execute(function (resp) {
            var profileHTML = '<div class="profile"><div class="head">Welcome '+resp.name.givenName+'! <a href="https://www.google.com/accounts/Logout?continue=https://appengine.google.com/_ah/logout?continue=http://<?php echo $_SERVER['HTTP_HOST'];?>/fb_and_google/facebook_and_google_login.php" onclick="signOut();">Sign out</a></div>';
            profileHTML += '<img src="'+resp.image.url+'"/><div class="proDetails"><p>'+resp.displayName+'</p><p>'+resp.emails[0].value+'</p><p>'+resp.gender+'</p><p>'+resp.id+'</p></div></div>';
            $('.userContent').html(profileHTML);
            $('#gSignIn').slideUp('slow');
        });
    });
}
function onFailure(error) {
    alert(error);
}
function renderButton() {
debugger;
    gapi.signin2.render('gSignIn', {
        'scope': 'profile email',
        'width': 240,
        'height': 50,
        'longtitle': true,
        'theme': 'dark',
        'onsuccess': onSuccess,
        'onfailure': onFailure
    });
}
function signOut() {
    var auth2 = gapi.auth2.getAuthInstance();
    auth2.signOut().then(function () {
        $('.userContent').html('');
        $('#gSignIn').slideDown('slow');
    });
}
</script>
<style type="text/css">
.profile{
    border: 3px solid #B7B7B7;
    padding: 10px;
    margin-top: 10px;
    width: 350px;
    background-color: #F7F7F7;
    height: 160px;
}
.profile p{margin: 0px 0px 10px 0px;}
.head{margin-bottom: 10px;}
.head a{float: right;}
.profile img{width: 100px;float: left;margin: 0px 10px 10px 0px;}
.proDetails{float: left;}
</style>
 
