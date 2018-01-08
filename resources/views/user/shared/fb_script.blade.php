<div id="fb-root"></div>
<script>
(function (d, s, id) {
    var js, fjs = d.getElementsByTagName(s)[0];
    if (d.getElementById(id)) return;
    js = d.createElement(s);
    js.id = id;
    js.src = 'https://connect.facebook.net/en_GB/sdk.js#xfbml=1&version=v2.11&appId=929102013908725';
    fjs.parentNode.insertBefore(js, fjs);
}(document, 'script', 'facebook-jssdk'));
</script>

<script>
  window.fbAsyncInit = function () {
      FB.init({
          appId: '929102013908725',
          autoLogAppEvents: true,
          xfbml: true,
          version: 'v2.11'
      });
  };

  (function (d, s, id) {
      var js, fjs = d.getElementsByTagName(s)[0];
      if (d.getElementById(id)) {
          return;
      }
      js = d.createElement(s);
      js.id = id;
      js.src = "https://connect.facebook.net/en_US/sdk.js";
      fjs.parentNode.insertBefore(js, fjs);
  }(document, 'script', 'facebook-jssdk'));


  // This is called with the results from from FB.getLoginStatus().
  function statusChangeCallback(response) {
      console.log('statusChangeCallback');
      console.log(response);
      // The response object is returned with a status field that lets the
      // app know the current login status of the person.
      // Full docs on the response object can be found in the documentation
      // for FB.getLoginStatus().
      if (response.status === 'connected') {
          // Logged into your app and Facebook.
          testAPI();
      } else {
          // The person is not logged into your app or we are unable to tell.
          goLogin();
      }
  }

  function goLogin() {
      FB.login(function (response) {
          if (response.authResponse) {
              testAPI(); 
          } else {
              console.log('User cancelled login or did not fully authorize.');
          }
      }, {scope: 'email,user_friends'});

  }

  // Here we run a very simple test of the Graph API after login is
  // successful.  See statusChangeCallback() for when this call is made.
  function testAPI() {
      console.log('Welcome! testAPI Fetching your information.... ');
      FB.api('/me', {
          fields: 'birthday,link,gender,age_range,name,friends{name,email}'
      }, function (response) {
          console.log(response, 'Successful login for: ' + response.name);

          //save to localstorage
          window.localStorage.setItem('fb_data', JSON.stringify(response));

          response.uri_1 = uri_1;
          response._token = csrf_token;
            $.post(
                base_url + '/login_facebook',
                response,
                function (res) {
                    if (uri_1 == '') {
                        if (typeof (res.id) !== 'undefined') {
                            window.location.reload(true);
                        } else {
                            $.alert({
                                title: 'Opps!!',
                                content: 'User not found.',
                            });
                        }
                    }
                    else{
                        $.alert({
                            title: 'Connected',
                            content: 'Your facebook account is now connected to your SeriousDatings profile.',
                        });
                    }
                    console.log('login yeah fb', res)
                },
                'json'
            );


      });
  }


  function checkLoginState() {
      FB.getLoginStatus(function (response) {
          statusChangeCallback(response);
      });
  }

</script>