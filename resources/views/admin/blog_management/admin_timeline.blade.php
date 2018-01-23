 @include('admin.inc.header')

 {{-- dd($post) --}}

 <div class="content-wrapper">
 	<section class="content-header">
 		<h1>
 			Timeline
 			<small>by {{$post->blogby}}</small>
 		</h1>
 		<ol class="breadcrumb">
 			<li><a href="{{url()}}/admin"><i class="fa fa-dashboard"></i> Home</a></li>
 			<li><a href="{{url()}}/admin/blog_management/post_lists">Blog Management</a></li>
 			<li class="active">Timeline</li>
 		</ol>
 	</section>
 	<section class="content">
 		<ul class="timeline">
 			<!-- start loop for each post  -->
 			<li class="time-label">
 				<span class="bg-red">
 					{{$post->created_at}}
 				</span>
 			</li>
 			<li>
 				<i class="fa fa-star bg-yellow"></i>

 				<div class="timeline-item">
 					<h3 class="timeline-header"><a href="#">Title</a></h3>
 					<div class="timeline-body">
 						{{ $post->blogTitle }}
 					</div>
 				</div>
 			</li>
 			<li>
 				<i class="fa fa-envelope bg-blue"></i>
 				<div class="timeline-item">
 					<h3 class="timeline-header"><a href="#">Post Content</a> ...</h3>
 					<div class="timeline-body">
 						<div id="intro">
 						</div>
 						<div id="demo" class="collapse" >
 							{!! $post->blogContent !!}
 						</div>
 						<div class="timeline-footer">
 							<a type="button"  class="btn btn-primary btn-xs"  data-toggle="collapse" data-target="#demo">Read more</a>
 						</div>
 					</div>
 				</div>
 			</li>
 			<li>
 				<i class="fa fa-tags bg-aqua"></i>
 				<div class="timeline-item">
 					<h3 class="timeline-header"><a href="#">Post Tags</a></h3>
 					<div class="timeline-body">
 						<h5>Type: <a href="#">{{ $post->blogType->name }}</a></h5>
 						<h5>Status: <a href="#">{{ $post->blogStatus->name }}</a></h5>
 						<h5>Category: <a href="#">{{ $post->blogCategory->name }}</a></h5>
 					</div>
 				</div>
 			</li>

 			<!-- end loop for each post -->
 			<li>
 				<i class="fa fa-clock-o bg-gray"></i>
 			</li>
 		</ul>
 	</section>
 </div>
 @include('admin.blog_management.ckeditor_edit_modal')
 @include('admin.inc.footer')

 <meta name="csrf-token" content="{{ csrf_token() }}">
 <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
 {!! HTML::script('public/js/admin/blog_management/timeline.js') !!}
</body>
</html>
