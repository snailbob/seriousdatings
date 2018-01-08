<?php include'../admin/classes/settings.php';
$sql = "SELECT * FROM user_blogs WHERE id='".$_REQUEST['id']."'";
$query = mysqli_query($con,$sql);
$row = mysqli_fetch_object($query);

$sql_recent = "SELECT * FROM user_blogs WHERE id!='".$_REQUEST['id']."' ORDER BY id DESC LIMIT 5";
$query_recent = mysqli_query($con,$sql_recent);


$sql_category="select * from blog_category WHERE cat_id!='".$_REQUEST['id']."' order by cat_id desc";
$query_category=mysqli_query($con,$sql_category) or die(mysqli_error());
?>
<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Serious Dating! Blogs</title>
<link rel="stylesheet" type="text/css" href="../public/blog/css/newstyleuserprofile.css">
<link rel="stylesheet" type="text/css" href="../public/blog/css/bootstrap.min.css">
<link rel="stylesheet" type="text/css" href="../public/blog/css/font-awesome.css">
<!--<script type="text/javascript">
function googleTranslateElementInit() {
new google.translate.TranslateElement({pageLanguage: '',includedLanguages: 'en,de,es,fr,it,pt,ar,ja,ko,zh,nl,cs,hr,eo,et,ka,el,hu,id,ga,ja,ko,pt,ru,sv,th,uk,ur,uz,sr,iw,fy,da,kk,hy,tl,fi,hi,lv,lt,fa,pl,ro,tr,sk,sl,af,da',  layout: google.translate.TranslateElement.InlineLayout.SIMPLE}, 'google_translate_element');
}

window.setInterval(function(){
     var lang = $(".goog-te-menu-value span:first").text();
    
},5000);
</script>
<script type="text/javascript" src="//translate.google.com/translate_a/element.js?cb=googleTranslateElementInit"></script>-->
<style>
.goog-te-gadget-simple {display: block;
    width: 100%;
    height: 30px;
    padding: 6px 12px;
    font-size: 13px;
    line-height: 1.42857143;
    color: #666666;
    background-color: #fff;
    background-image: none;
   border-color: #ccc;
    border-radius: 4px;
    -webkit-box-shadow: inset 0 1px 1px rgba(0,0,0,0.075);
    box-shadow: inset 0 1px 1px rgba(0,0,0,0.075);
    -webkit-transition: border-color ease-in-out .15s, box-shadow ease-in-out .15s;
    -o-transition: border-color ease-in-out .15s, box-shadow ease-in-out .15s;
    transition: border-color ease-in-out .15s, box-shadow ease-in-out .15s;}
	
	.goog-te-gadget-simple .goog-te-menu-value {
    color: #666666;
	}
</style>

</head>

<body>
<div class="top">
    <div class="container">
    <div class="row">
    <div class="col-md-8">
    <!--<div class="right">Translate to your language</div>
     -->
      
      </div>
      <div class="col-md-4">
       <div class="left">
        <div class="language"> <span id="google_translate_element" style="height:38px;font-size: 13px;color: #666;border-color: #ccc;">
            <div class="skiptranslate goog-te-gadget" dir="ltr" style="">
              <div id=":0.targetLanguage" class="goog-te-gadget-simple" style="white-space: nowrap;"><img src="https://www.google.com/images/cleardot.gif" class="goog-te-gadget-icon" alt="" style="background-image: url(&quot;https://translate.googleapis.com/translate_static/img/te_ctrl3.gif&quot;); background-position: -65px 0px;"><span style="vertical-align: middle;"><a aria-haspopup="true" class="goog-te-menu-value" href="javascript:void(0)"><span>Select Language</span><img src="https://www.google.com/images/cleardot.gif" alt="" width="1" height="1"><span style="border-left: 1px solid rgb(187, 187, 187);">&#8203;</span><img src="https://www.google.com/images/cleardot.gif" alt="" width="1" height="1"><span aria-hidden="true" style="color: rgb(155, 155, 155);">▼</span></a></span></div>
            </div>
            <div class="skiptranslate goog-te-gadget" dir="ltr" style=""><div id=":0.targetLanguage"></div></div></span> </div>
        
      </div>
      
      </div>
      </div>
    </div>
  </div>
  
  <div class="header-botom">

    <div class="container">

        <div class="row">

            <div class="col-md-2 col-xs-2">

                <div class="logo-bg"><a href="http://seriousdatings.com" title="Seriousdatings"><img src="http://seriousdatings.com/public/images/logo_serios_dating_peq.png" alt="logo"></a></div>

            </div>

            <div class="col-md-6">

                <!-- Site menu -->

                                
                <nav class="navbar navbar-inverse">
<div class="navbar-header">
      <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#myNavbar">
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span> 
      </button>
     
    </div>

                <div class="new_navbar collapse nav navbar-collapse" id="myNavbar">

                    <ul class=" nav-pills">

                        <li><a href="http://seriousdatings.com">Home</a></li>

                        <li>

                            <a href="#">View</a>

                            <ul class="hiddens">

                                
                                <li><a href="http://seriousdatings.com/profile">User Home</a></li>

                                <li><a href="http://seriousdatings.com/users/arun">Profile</a></li>

                                
                                <li><a href="http://seriousdatings.com/success_story">Success Story</a></li>

                                <li><a href="http://seriousdatings.com/pages/news">News</a></li>

                                <li><a href="http://seriousdatings.com/pages/policy">Privacy Policy</a></li>

                                <li><a href="http://seriousdatings.com/pages/Terms and condiitions">Terms of Use</a></li>

                            </ul>

                        </li>

                        <li><a href="http://seriousdatings.com/pages/about us">About</a></li>

                        <li><a href="http://seriousdatings.com/profile/photo">Gallery</a>

                            <ul class="hiddens">

                                <li><a href="http://seriousdatings.com/profile/photo">Photo</a></li>

                                <li><a href="http://seriousdatings.com/profile/video">Videos</a></li>

                                <li><a href="http://seriousdatings.com/profile/music">Music</a></li>

                            </ul>

                        </li>

                        <li><a href="#">Services</a>

                            <ul class="hiddens">

                                <li><a href="http://seriousdatings.com/profile/datingPlan">Dating Plans</a></li>

                                <li><a href="http://seriousdatings.com/paidServices">Paid Services</a></li>

                                <li><a href="http://seriousdatings.com/readyToDate">Ready to Date</a></li>

                                <li><a href="http://seriousdatings.com/meetPeople">Meet People</a></li>

                                <li><a href="http://seriousdatings.com/videoChat">Video Chat</a></li>

                            </ul>

                        </li>

                        <li><a href="http://seriousdatings.com/groups">Groups</a></li>

                        <li><a href="http://seriousdatings.com/events">Events</a>

                            <ul class="hiddens">

                                <li><a href="http://seriousdatings.com/events">All Events</a></li>

                            </ul>

                        </li>

                        <li><a href="http://seriousdatings.com/contact">Contact </a></li>

                        
                        <input type="hidden" name="logged_in" id="logged_in" value="118">

                        
                    </ul>



                </div>

</nav>
                <!-- End site menu -->

                
            </div>



          <!-- <div class="col-md-4">



                
                <div style="padding-top: 28px" class="text_center_sm flt_right_md">

                    <div class="btn-group">

                        <a href="http://seriousdatings.com/profile" class="btn btn-default">arunsharma </a>

                        <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">

                            <span class="caret"></span>

                            <span class="sr-only">Toggle Dropdown</span>

                        </button>

                        <ul class="dropdown-menu">

                            <li><a href="http://seriousdatings.com/logout">Logout</a></li>

                        </ul>

                    </div>

                    
                    <li id="notification_li" class="notifica_li">

                        <span id="notification_count" class="badge" style="display:none">0</span>

                        <a href="#" id="notificationLink">

                            <button type="button" class="btn btn-danger">Notifications <span class="badge">0</span></button>

                        </a>



                        <div id="notificationContainer" style="display: none;">

                            <div id="notificationTitle">Notifications</div>

                            <div id="notificationsBody" class="notifications" style="padding:0px !important;" title="Click on notification to see details">

                            </div>

                            <div id="notificationFooter"><a href="#">See All</a></div>

                        </div>

                    </li>

                </div>

                
            </div>-->

        </div>

    </div>

    <!--<div class="container" style="margin-bottom: 4%; margin-top: 1%;">

        <div class="row">

            <div class="col-md-12">

    <!-- Here was the menu--

    </div>

</div>

</div>-->

</div>


<div class="middle inner-middle">

  <div class="inner-header calendar-event-banner">

    <div class="container">

<div class="row">
<div class="col-md-12">
      <h1>
Blog</h1>

    

        </div>
    </div>
    </div>

  </div>

  

  <div class="inner-contendbg">

<div class="container">

  <div class="row">

    <div class="col-md-8">

   <div class="cont_box_blog">
   
   <div class="row">
   
   <div class="col-md-12">
   <div class="blog_detail_box">
   
   <div class="blog_detail_box_inner">
   <h3><?php echo ucfirst($row->blogTitle);?></h3>
   <label><span>By <?php echo ucfirst($row->blogby);?> / <?php echo date("M d,Y",strtotime($row->createdat));?></span></label>
   
   <img src="../public/assets/<?php echo $row->blogImage?>" style=" margin: 5px 0px; width:100%;" />
   
   <?php echo $row->blogContent;?>
   
   </div>
   
   
   </div>
   </div>
   
   
   
   </div>   
   
   
   
   </div>     
        </div>        
        
        
        
        <div class="col-md-4">
        <div class="blog_popular_outer">
        <div class="blog_popular_outer">
            <div class="blog_popular_inner">
              <h3>Categories</h3>
              <ul>
			  <?php 
				while($row_category = mysqli_fetch_object($query_category))
				{
					$sel="select COUNT(id) as TOTAL_RECORDS from user_blogs where blog_category='$row_category->cat_id'";
					$qry=mysqli_query($con,$sel) or die(mysqli_error());
					$run=mysqli_fetch_object($qry);?>
					
					<li><a href="index.php?id=<?php echo ucfirst($row_category->cat_id);?>"><?php echo $row_category->category_name." (".$run->TOTAL_RECORDS.")";?></a></li>
               
					
			<?php 	}
			 ?>
                
			
              </ul>
            </div>
          </div>
        <div class="blog_popular_inner">
        <h3>Recent Blogs</h3>
        <ul>
         <?php while($recent_blogs = mysqli_fetch_object($query_recent)){
			 #print_r($row);
			 ?>
                <li><a href="blog_detail.php?id=<?php echo ucfirst($recent_blogs->id);?>"><?php echo ucfirst($recent_blogs->blogTitle);?></a></li>
               
			<?php }?>	
        
        
        </ul>
        
        
        </div>
        
        
        </div>
        
        
        
        <div class="blog_facebook_box">
        <h3>Facebook</h3>
        
        <div class="facebook-find">

                <div class="fb-page fb_iframe_widget" data-href="https://www.facebook.com/SeriousDating" data-width="293" data-height="293" data-small-header="false" data-adapt-container-width="false" data-hide-cover="true" data-show-facepile="true" data-show-posts="true" fb-xfbml-state="rendered" fb-iframe-plugin-query="adapt_container_width=false&amp;app_id=1544055289192431&amp;container_width=0&amp;height=293&amp;hide_cover=true&amp;href=https%3A%2F%2Fwww.facebook.com%2FSeriousDating&amp;locale=en_US&amp;sdk=joey&amp;show_facepile=true&amp;show_posts=true&amp;small_header=false&amp;width=293"><span style="vertical-align: bottom; width: 293px; height: 293px;"><iframe name="f2c21c6c6e3fdf4" width="293px" height="293px" frameborder="0" allowtransparency="true" allowfullscreen="true" scrolling="no" title="fb:page Facebook Social Plugin" src="https://www.facebook.com/plugins/page.php?adapt_container_width=false&amp;app_id=1544055289192431&amp;channel=http%3A%2F%2Fstaticxx.facebook.com%2Fconnect%2Fxd_arbiter%2Fr%2F5oivrH7Newv.js%3Fversion%3D42%23cb%3Dfc0f7ccea37b7c%26domain%3Dseriousdatings.com%26origin%3Dhttp%253A%252F%252Fseriousdatings.com%252Ff2fa6bb52e4f538%26relation%3Dparent.parent&amp;container_width=0&amp;height=293&amp;hide_cover=true&amp;href=https%3A%2F%2Fwww.facebook.com%2FSeriousDating&amp;locale=en_US&amp;sdk=joey&amp;show_facepile=true&amp;show_posts=true&amp;small_header=false&amp;width=293" style="border: none; visibility: visible; width: 293px; height: 293px;" class=""></iframe></span></div>

            </div>
        
        </div>
        
        
        </div>        
        
        
        

       </div>

</div>
    </div>

    </div>
<footer>
<div class=" footer-top">
    <div class="container" style="margin:auto;">
    
    <div style="background: #eee; margin-right:-1px;" class="hidden-sm hidden-md hidden-lg">
    <strong style="float: left; padding: 8px 15px 6px; color: #000; font-size: 26px; font-family: 'Conv_sacramento.regular';">Serious Datings</strong>
      <button type="button" class="navbar-toggle footer_btm" data-toggle="collapse" style="background: #000;">
        <span class="icon-bar" style="background: #fff;"></span> <span class="icon-bar" style="background: #fff;"></span> <span class="icon-bar" style="background: #fff;"></span> 
        </button>
</div>
        <div class="footer-bottom footer_hid">
            <div>
                <div class="row">
                    <div class="col-md-12">
                        <ul>
                            <li><a href="http://seriousdatings.com">Home</a></li>
                            <li><a href="http://seriousdatings.com/pages/about us">About</a></li>
   <li><a href="http://seriousdatings.com/pages/policy">Policy</a></li>

      <li><a href="http://seriousdatings.com/pages/Terms and condiitions">Terms and Conditions</a></li>
                            <li><a href="#">Locations</a></li>
                            <li><a href="http://seriousdatings.com/pages/news">News</a></li>
                            <li><a href="#">Gallery </a></li>
                            <li><a href="http://seriousdatings.com/contact">Contact Us</a></li>
							<li><a href="http://seriousdatings.com/blog">Blog</a></li>
                          </ul>
                      <div class="copyright">Copyright © 2016, Serious Dating. All Rights Reserved.</div>
                  </div>
              </div>
           </div>
        </div>
    </div>
    </div>
</footer>
</body>
</html>
