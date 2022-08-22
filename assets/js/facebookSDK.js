/**
* Template Name: Mohan Gyawali
* Template URL: https://mohangyawali.com.np
* Author: Mohan Gyawali
* License: https://bootstrapmade.com/license/
*/

window.fbAsyncInit = function() {
    FB.init({
      appId      : '746331266461178',
      xfbml      : true,
      version    : 'v14.0'
    });
    FB.AppEvents.logPageView();
  };

  (function(d, s, id){
     var js, fjs = d.getElementsByTagName(s)[0];
     if (d.getElementById(id)) {return;}
     js = d.createElement(s); js.id = id;
     js.src = "https://connect.facebook.net/en_US/sdk.js";
     fjs.parentNode.insertBefore(js, fjs);
   }(document, 'script', 'facebook-jssdk'));