@include('admin.inc.header')
<div class="content-wrapper">
  <section class="content-header">
   <div class="blog-header">
    <div class="container">
      <h1 class="blog-title">{!! $post->blogTitle !!}</h1>
      <p class="lead blog-description">blog description</p>
    </div>
  </div>

  <div class="container">
    <div class="blog-post">
      <p class="blog-post-meta">Created_at {!! $post->created_at !!} by <a href="#">{!! $post->blogBy !!}</a></p>
      <div class="row">
        <div class="col-sm-8 blog-main">
          <div class="blog-post">
            <h3>CONTENT</h3>
            <div>
              {!! $post->blogContent !!}
            </div>
          </div><!-- /.blog-post -->
          <footer class="blog-footer">
            <p>Tags: status, type, category</p>
            <p>
              <a href="#">Back to top</a>
            </p>
          </footer>
        </div>
      </div>
    </div>
  </section>
</div>
@include('admin.blog_management.ckeditor_edit_modal')
@include('admin.inc.footer')

<meta name="csrf-token" content="{{ csrf_token() }}">
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
{!! HTML::script('public/js/admin/blog_management/bloglists_actions.js') !!}
</body>
</html>
