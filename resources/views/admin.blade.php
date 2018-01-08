<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta name="description" content="">
<meta name="author" content="">
<meta name="csrf-token" content="{!!  csrf_token() !!}">
<title>Serious Dating | Admin Login </title>
<!-- Bootstrap Core CSS -->
{!! HTML::style('public/css/bootstrap.css') !!}
{!! HTML::style('public/css/admin-style.css') !!}
{!! HTML::style('public/css/login-style.css') !!}
<!-- Custom Fonts -->
{!! HTML::style('public/css/font-awesome.css') !!}
<!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
<!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
<!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->
<style>
 label.error {
    float: none; color: red;
    padding-left: .3em; vertical-align: top;  
}
.login-body{
    background-color: #101010 !important;
}
</style>
</head>
<body class="login-body2">
    <div class="login-wrapper">
        <div class="login-wrapper-inner">
            <div class="cover-container">
                <div class="login-inner">
                    <div class="login-logo">Serious Dating Admin</div>
                    <div class="login-panel">
                        <div class="login-heading">
                            <h4>
                                Sign In To Your Admin Account
                                
                            </h4>
                            <p>Please enter your name and password to log in. </p>
                            @if($data !=null)
                                <label class="error" style = "color:red;">
                                    {!! $data !!}
                                </label>
                            @endif
                        </div>
            		    {!! Form::open( array( 'url' => 'admindashboard', 'method' => 'post', 'role' => 'form', 'class' => 'form-login' )) !!}
                            <div class="successHandler alert alert-success no-display alert-dismissible fade in">
                                <button aria-label="Close" data-dismiss="alert" class="close" type="button"><span aria-hidden="true">×</span></button>
                                <strong>You have some form errors!</strong> Please check below. 
                            </div>
                            <div class="errorHandler alert alert-danger no-display alert-dismissible fade in">
                                <button aria-label="Close" data-dismiss="alert" class="close" type="button"><span aria-hidden="true">×</span></button>
                                <strong>You have some form errors!</strong> Please check below. 
                            </div>
                        
                            <fieldset>
                                <div class="form-group">
                                    <span class="input-icon">
                                        <input type="text" placeholder="Username" name="username" id="username" class="form-control" required>
                                        <i class="fa fa-user"></i> 
                                    </span> 
                                </div>
                                <div class="form-group"> 
                                    <span class="input-icon">
                                        <input type="password" placeholder="password" name="password" id="password" class="form-control" required>
                                        <i class="fa fa-lock"></i> 
                                    </span> 
                                </div>
                                <div class="clearfix ">
                                    <div class="checkbox pull-left">
                                        <label>
                                            <input name="remember" type="checkbox" value="Remember Me">
                                            Remember Me 
                                        </label>
                                    </div>
                                    
                                </div>
                                <!-- Change this to a button or input when using this as a form -->
                                <input type="submit" value="Login" class="btn btn-success btn-block">
                            </fieldset>
                        {!! Form::close() !!}
                    </div>
                    <div class="copyright">Copyright © 2015, Serious Dating. All Rights Reserved.</div>
                </div>
            </div>
        </div>
    </div>

<!-- jQuery --> 
{!! HTML::script('public/plugins/jquery/jquery.min.js') !!}
{!! HTML::script('public/js/bootstrap.min.js') !!}
{!! HTML::script('public/plugins/jquery-validation/dist/jquery.validate.min.js') !!}
{!! HTML::script('public/js/login-form.js') !!}
<!-- jquery-validation --> 
<script>
jQuery(document).ready(function(){
	//loginValidator.init();
});
</script>
</body>
</html>