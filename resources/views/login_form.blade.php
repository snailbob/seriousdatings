

      <div class="login-formbg" style="width:760px ;">
         {!! Form::open(array('url' => 'login')) !!}
          <div class="input-cols">
            <input type="text" name="username" placeholder="User Name"/>
            <a href="#" class="input-icon"><i class="user-icon"></i></a> </div>
          <div class="input-cols">
            <input type="password" name="password" placeholder="Password"/>
            <a href="#" class="input-icon"><i class="password-icon"></i></a> </div>
            <input type="submit" value="Login" class="button"/>
           <a class="btn btn-default" href="{!! url() !!}/users/create" role="button" style="margin-left: 1%; line-height: 25px;font-weight: bold; text-decoration: none;color: #FFF;background: #e0262c;">Join Now</a>
         
          <div class="row">
            <div class="input-cols">
               <input type="checkbox" id="remember" name="check"/>
                 <label for="remember"><span></span>Remember me!</label>
            </div>
            
            <div class="input-cols"> 
             <a href="{!! url() !!}/forgotPassword">Forgot Password ? </a>
            </div>
            
            <div class="input-cols" style="margin-left: 5%;">
            <a href="https://www.facebook.com/"><img src="{!! url() !!}/images/fb_signup.png" class="img-responsive" alt="group memberadmin image"/> </a>
            </div>
            
          </div>
         {!! Form::close() !!}
    </div>
      
      
     