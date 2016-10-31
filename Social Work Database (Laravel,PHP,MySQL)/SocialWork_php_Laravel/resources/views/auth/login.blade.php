<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <title>Social Work | Login</title>

    <!-- Bootstrap Core -->
    <link href="/vendors/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom styles for this template 
    <link href="offcanvas.css" rel="stylesheet">-->

    <!-- Custom styles for this template -->
    <link href="/css/custom.css" rel="stylesheet" type="text/css">
    <link href="css/custom_login.css" rel="stylesheet" type="text/css">
    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
    
  </head>
  <body>
  <!--
      you can substitue the span of reauth email for a input with the email and
      include the remember me checkbox
  -->
     <div class="container body">
        <div class="main_container">
          <div class="card card-container">
              <!-- <img class="profile-img-card" src="//lh3.googleusercontent.com/-6V8xOA6M7BA/AAAAAAAAAAI/AAAAAAAAAAA/rzlHcD0KYwo/photo.jpg?sz=120" alt="" /> -->
              <img id="profile-img" class="profile-img-card" src="//ssl.gstatic.com/accounts/ui/avatar_2x.png" />
              <p id="profile-name" class="profile-name-card"></p>
                    <form class="form-signin" role="form" method="POST" action="{{ url('/login') }}">
                    <span id="reauth-email" class="reauth-email"></span>
                        {{ csrf_field() }}

                        <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                            <input type="email" name="email" id="inputEmail" class="form-control" placeholder="Email address" required autofocus>
                                @if ($errors->has('email'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                                @endif
                        </div> <!-- end form-group -->

                        <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
                            <input type="password" name="password" id="inputPassword" class="form-control" placeholder="Password" required>

                                @if ($errors->has('password'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                                @endif
                        </div> <!-- end form-grouClosure  $next
     * @param  string|null  $guard
     * @return mixed
     */
    public function p -->

                        <div id="remember" class="checkbox">
                          <label>
                          <!-- TODO: create a cookie via JS if id=remember isset... blah blah blah -->
                            <input type="checkbox" value="remember-me"> Remember me
                          </label>
                        </div> <!-- end remember-me chkbox -->
                        <button class="btn btn-lg btn-primary btn-block btn-signin" type="submit">Sign in</button>
                      </form><!-- /form -->
                    <a href="{{ url('/password/reset') }}">Forgot Your Password?</a> 
                </div>
            </div>
        </div><!--/.container-->
 	<!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>
    <!-- Include all compiled plugins (below), or include individual files as needed -->
    <script src="http://synapticservers.com/vendors/bootstrap/dist/js/bootstrap.min.js"></script>
  </body>
</html>