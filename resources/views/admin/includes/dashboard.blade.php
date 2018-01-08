<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta name="description" content="">
<meta name="author" content="">
<title>Serious Dating | Control Panel</title>
<!-- jQuery --> 
{!! HTML::script('public/js/jquery.min.js') !!}
<!-- Bootstrap Core JavaScript --> 
{!! HTML::script('public/js/bootstrap.min.js') !!}
<!-- Metis Menu Plugin JavaScript --> 
{!! HTML::script('public/plugins/metisMenu/dist/metisMenu.js') !!}
{!! HTML::script('public/plugins/summernote/summernote.min.js') !!}
<!-- Custom Theme JavaScript --> 
{!! HTML::script('public/plugins/perfect-scrollbar/perfect-scrollbar.jquery.min.js') !!}
{!! HTML::script('public/js/admin.js') !!}

<!-- Bootstrap Core CSS -->
{!! HTML::style('public/css/bootstrap.css') !!}
<!-- dashboard  CSS -->
<!-- Custom Fonts -->
{!! HTML::style('public/css/font-awesome.css') !!}
            <!-- dashboard -->

    {!! HTML::style('public/plugins/summernote/summernote.css') !!}
    {!! HTML::style('public/plugins/perfect-scrollbar/perfect-scrollbar.min.css') !!}
<!-- Custom CSS -->
{!! HTML::style('public/css/admin-style.css') !!}

    @yield('customCSS')

<script src="{!! url() !!}/public/js/vendor/tinymce/js/tinymce/tinymce.min.js"></script>
<link rel="apple-touch-icon" href="//mindmup.s3.amazonaws.com/lib/img/apple-touch-icon.png" />
    <link rel="shortcut icon" href="https://mindmup.s3.amazonaws.com/lib/img/favicon.ico" >
    

    <link href="https://netdna.bootstrapcdn.com/twitter-bootstrap/2.3.1/css/bootstrap-responsive.min.css" rel="stylesheet">
    <link href="https://netdna.bootstrapcdn.com/font-awesome/3.0.2/css/font-awesome.css" rel="stylesheet">
    {!! HTML::style('public/css/fullcalendar.css') !!}
    

<script>
  var editor_config = {
    path_absolute : "{!! url() !!}/",
    selector: "textarea",
    plugins: [
      "advlist autolink lists link  charmap print preview hr anchor pagebreak",
      "searchreplace wordcount visualblocks visualchars code fullscreen",
      "insertdatetime media nonbreaking save table contextmenu directionality",
      "emoticons template paste textcolor colorpicker textpattern"
    ],
    toolbar: "insertfile undo redo | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link  ",
    relative_urls: false,
    file_browser_callback : function(field_name, url, type, win) {
      var x = window.innerWidth || document.documentElement.clientWidth || document.getElementsByTagName('body')[0].clientWidth;
      var y = window.innerHeight|| document.documentElement.clientHeight|| document.getElementsByTagName('body')[0].clientHeight;

       var cmsURL = editor_config.path_absolute+'filemanager?field_name='+field_name+'&lang='+ tinymce.settings.language;
      if (type == 'image') {
        cmsURL = cmsURL + "&type=Images";
      } else {
        cmsURL = cmsURL + "&type=Files";
      }

      tinyMCE.activeEditor.windowManager.open({
        file : cmsURL,
        title : 'Filemanager',
        width : x * 0.8,
        height : y * 0.8,
        resizable : "yes",
        close_previous : "no"
      });
    }
  };

  tinymce.init(editor_config);
</script>

<!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
<!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
<!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->

</head>
<body class="admin-body">
<div id="wrapper">
<nav class="navbar navbar-inverse navbar-static-top">
    @include('admin.includes.header')
    @include('admin.includes.sidebar')
  </nav>  
<div id="page-wrapper" class="clearfix">
   @yield('content')
  <!-- /#page-wrapper --> 
</div>
<!-- /#wrapper --> 
</div>


<script>
jQuery(document).ready(function(){
siteDashBoard.init();
$('.summernote').summernote({
	  height: 200,   //set editable area's height
	});
});
</script>

<!-- map support -->

        <!-- dashboard email box support -->
<script src="{!! url() !!}/public/js/jquery.hotkeys.js"></script>
    

    <script src="{!! url() !!}/public/js/bootstrap-wysiwyg.js"></script>
   
@yield('customJS')
<script src="{!! url() !!}/public/js/mapdata.js"></script>
		<script src="{!! url() !!}/public/js/worldmap.js"></script>
        <!-- dashboard email box support -->
        <script>
  $(function(){
    function initToolbarBootstrapBindings() {
      var fonts = ['Serif', 'Sans', 'Arial', 'Arial Black', 'Courier', 
            'Courier New', 'Comic Sans MS', 'Helvetica', 'Impact', 'Lucida Grande', 'Lucida Sans', 'Tahoma', 'Times',
            'Times New Roman', 'Verdana'],
            fontTarget = $('[title=Font]').siblings('.dropdown-menu');
      $.each(fonts, function (idx, fontName) {
          fontTarget.append($('<li><a data-edit="fontName ' + fontName +'" style="font-family:\''+ fontName +'\'">'+fontName + '</a></li>'));
      });
      $('a[title]').tooltip({container:'body'});
    	$('.dropdown-menu input').click(function() {return false;})
		    .change(function () {$(this).parent('.dropdown-menu').siblings('.dropdown-toggle').dropdown('toggle');})
        .keydown('esc', function () {this.value='';$(this).change();});

      $('[data-role=magic-overlay]').each(function () { 
        var overlay = $(this), target = $(overlay.data('target')); 
        overlay.css('opacity', 0).css('position', 'absolute').offset(target.offset()).width(target.outerWidth()).height(target.outerHeight());
      });
      if ("onwebkitspeechchange"  in document.createElement("input")) {
        var editorOffset = $('#editor').offset();
        $('#voiceBtn').css('position','absolute').offset({top: editorOffset.top, left: editorOffset.left+$('#editor').innerWidth()-35});
      } else {
        $('#voiceBtn').hide();
      }
	};
	function showErrorAlert (reason, detail) {
		var msg='';
		if (reason==='unsupported-file-type') { msg = "Unsupported format " +detail; }
		else {
			console.log("error uploading file", reason, detail);
		}
		$('<div class="alert"> <button type="button" class="close" data-dismiss="alert">&times;</button>'+ 
		 '<strong>File upload error</strong> '+msg+' </div>').prependTo('#alerts');
	};
    initToolbarBootstrapBindings();  
	$('#editor').wysiwyg({ fileUploadError: showErrorAlert} );
    window.prettyPrint && prettyPrint();
  });
</script>
<script type="text/javascript" src="https://www.jqueryscript.net/demo/Full-Size-Drag-Drop-Calendar-Plugin-FullCalendar/jquery/jquery-1.8.1.min.js"></script>
<script type='text/javascript' src='{!! url() !!}/public/js/jquery-ui-1.8.23.custom.min.js'></script>
<script type='text/javascript' src='{!! url() !!}/public/js/fullcalendar.min.js'></script>
<script type='text/javascript'>

	$(document).ready(function() {
	
		var date = new Date();
		var d = date.getDate();
		var m = date.getMonth();
		var y = date.getFullYear();
		
		$('#calendar').fullCalendar({
			editable: true,
			events: [
				{
					title: 'All Day Event',
					start: new Date(y, m, 1)
				},
				{
					title: 'Long Event',
					start: new Date(y, m, d-5),
					end: new Date(y, m, d-2)
				},
				{
					id: 999,
					title: 'Repeating Event',
					start: new Date(y, m, d-3, 16, 0),
					allDay: false
				},
				{
					id: 999,
					title: 'Repeating Event',
					start: new Date(y, m, d+4, 16, 0),
					allDay: false
				},
				{
					title: 'Meeting',
					start: new Date(y, m, d, 10, 30),
					allDay: false
				},
				{
					title: 'Lunch',
					start: new Date(y, m, d, 12, 0),
					end: new Date(y, m, d, 14, 0),
					allDay: false
				},
				{
					title: 'Birthday Party',
					start: new Date(y, m, d+1, 19, 0),
					end: new Date(y, m, d+1, 22, 30),
					allDay: false
				},
				{
					title: 'Click for Google',
					start: new Date(y, m, 28),
					end: new Date(y, m, 29),
					url: 'http://google.com/'
				}
			]
		});
		
	});

</script>

</body>
</html>
