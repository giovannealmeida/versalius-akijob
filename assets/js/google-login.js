
var googleUser = {};
var startApp = function() {
  gapi.load('auth2', function(){
	// Retrieve the singleton for the GoogleAuth library and set up the client.
	auth2 = gapi.auth2.init({
	  client_id: '243431131541-5kucnu1qbtlitl9lofqpua2v8profdju.apps.googleusercontent.com',
	  cookiepolicy: 'single_host_origin',
	  // Request scopes in addition to 'profile' and 'email'
	  //scope: 'additional_scope'
	});
	attachSignin(document.getElementById('google_login'));
  });
};

function attachSignin(element) {
  auth2.attachClickHandler(element, {},
	  function(googleUser) {
		  var id_token = googleUser.getAuthResponse().id_token;
          window.location = base_url.url + "login/callback_google/"+id_token;
	  }, function(error) {
	  });
}

startApp();
