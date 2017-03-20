window.fbAsyncInit = function() {
  FB.init({
    appId      : '1394434857244551',
    xfbml      : true,
    version    : 'v2.8'
  });
  FB.AppEvents.logPageView();
  FB.getLoginStatus(function(response) {
    if (response.status === "connected") {
      document.getElementById("status").innerHTML = "We Are Connected";
    } else if (response.status === "not_authorized") {
      document.getElementById("status").innerHTML = "We Are Not Logged In";
    } else {
      document.getElementById("status").innerHTML = "We Are Not Logged In Facebook";
    }
  });
};

(function(d, s, id){
  var js, fjs = d.getElementsByTagName(s)[0];
  if (d.getElementById(id)) {return;}
  js = d.createElement(s); js.id = id;
  js.src = "//connect.facebook.net/en_US/sdk.js";
  fjs.parentNode.insertBefore(js, fjs);
}(document, 'script', 'facebook-jssdk'));