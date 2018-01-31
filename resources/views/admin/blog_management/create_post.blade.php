@include('admin.inc.header')

<div class="content-wrapper">
    <section class="content-header">
        <h1>
            Create Post
            <small>administration</small>
        </h1>
        <ol class="breadcrumb">
            <li><a href="{{url()}}/admin"><i class="fa fa-dashboard"></i> Home</a></li>
            <li><a href="{{url()}}/admin/blog_management/post_lists">Blog Management</a></li>
            <li class="active">Create Post</li>
        </ol>
    </section>
    <section class="content">
        <div class="row">
            <div class="col-md-12">
                <div class="box box-primary">
                    <div class="box-body">
                        <form id="create_post">
                            <div class="form-group">
                                <label for="postType">Type</label>
                                <select class="form-control" id="postType">
                                    <option value="" disabled selected>Please select type</option>
                                    @foreach($types as $type)
                                        <option value="{{ $type->name }}">{{ $type->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="postStatus">Status</label>
                                <select class="form-control" id="postStatus">
                                    <option value="" disabled selected>Please select status</option>
                                    @foreach($statuses as $status)
                                        <option value="{{ $status->name }}">{{ $status->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="postCategory">Category</label>
                                <select class="form-control" id="postCategory">
                                    <option value="" disabled selected>Please select category</option>
                                    @foreach($categories as $category)
                                        <option value="{{ $category->name }}">{{ $category->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="postTitle">Title</label>
                                <input type="text" id="postTitle" class="form-control" placeholder="Enter title here.">
                            </div>
                            <div class="form-group">
                                <label>Cover Picture <span class="symbol required"></span></label>
                                <div class="file-upload">
                                    <input type="file" class="file-input ImgeInput" name="uploadpicture"
                                           required/>

                                    {!! HTML::image('public/images/targetImage.png', 'alt', array( 'class' => 'targetImage')) !!}
                                </div>
                            </div>
                            <label for="postContent">Content</label>
                            <textarea id="postContent" name="editor1" rows="10" cols="80" value="">
              </textarea>
                        </form>
                    </div>
                </div>
                <div class="box-footer">
                    <button id="saveBtn" class="btn btn-primary pull-right">Save</button>
                </div>
            </div>
        </div>
    </section>
</div>

@include('admin.inc.footer')
<meta name="csrf-token" content="{{ csrf_token() }}">
<script type="text/javascript">
    $(function () {
        // Replace the <textarea id="editor1"> with a CKEditor
        // instance, using default configuration.
        CKEDITOR.replace('editor1')
    })
</script>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>

{!! HTML::script('public/js/admin/blog_management/create_post.js') !!}
</body>
</html>
