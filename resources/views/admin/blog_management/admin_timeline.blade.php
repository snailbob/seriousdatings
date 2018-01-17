 @include('admin.inc.header')

 {{-- dd($post) --}}

 <div class="content-wrapper">
 	<section class="content-header">
 		<ul class="timeline">

 			<!-- timeline time label -->
 			<li class="time-label">
 				<span class="bg-red">
 					{{$post->created_at}}
 				</span>
 			</li>
 			<!-- /.timeline-label -->

 			<!-- timeline item -->
 			<li>
 				<!-- timeline icon -->
 				<i class="fa fa-envelope bg-blue"></i>
 				<div class="timeline-item">
 					<span class="time"><i class="fa fa-clock-o"></i> 12:05</span>

 					<h3 class="timeline-header"><a href="#">Support Team</a> ...</h3>

 					<div class="timeline-body">
 						...
 						Content goes here
 					</div>

 					<div class="timeline-footer">
 						<a class="btn btn-primary btn-xs">...</a>
 					</div>
 				</div>
 			</li>
 			<!-- END timeline item -->

 			...

 		</ul>
 	</section>
 </div>
 @include('admin.blog_management.ckeditor_edit_modal')
 @include('admin.inc.footer')

 <meta name="csrf-token" content="{{ csrf_token() }}">
 <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
 {!! HTML::script('public/js/admin/blog_management/bloglists_actions.js') !!}
</body>
</html>
