@extends('master')

@section('css-scripts')

@endsection

@section('javascript')
    {!! HTML::script('public/js/blog_page/create_page.js') !!}
    {!! HTML::script('bower_components/ckeditor/ckeditor.js') !!}
    <script type="text/javascript">
        CKEDITOR.replace("editor1");
    </script>
@endsection

@section('form_area')
    <div class="inner-header upcoming-banner">
        <div class="container">
            <h1>
                <i class="calendar-event-icon">
                    <img src="{{url()}}/public/images/upcoming-event-icon.png" alt="">
                </i>
                Create Blog
            </h1>
        </div>
    </div>
    <div class="container-services">
        <div class="container">
            <div class="page-header" id="services">
                <h1 class="text-secondary text-center">Create Your Own Blog</h1>
            </div>
            <div class="row">
                <div class="col-md-12 blog-main">
                    <div class="row">
                        <div class="box box-primary">
                            <div class="box-body">
                                <form id="create_post" role="form" action="{{URL::to('/saveBlog')}}"
                                      method="post" enctype="multipart/form-data">
                                    {{ csrf_field() }}
                                    <div class="form-group">
                                        <label for="postType">Type</label>
                                        <select class="form-control" name="postType" required>
                                            <option value="" disabled selected>Please select type</option>
                                            @foreach($types as $type)
                                                <option value="{{ $type->name }}">{{ $type->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label for="postCategory">Category</label>
                                        <select class="form-control" name="postCategory" required>
                                            <option value="" disabled selected>Please select category</option>
                                            @foreach($categories as $category)
                                                <option value="{{ $category->name }}">{{ $category->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label for="postTitle">Title</label>
                                        <input type="text" name="postTitle" class="form-control"
                                               placeholder="Enter title here." required>
                                    </div>
                                    <div class="form-group">
                                        <label>Cover Picture <span class="symbol required"></span></label>
                                        <div class="file-upload">
                                            <input type="file" class="file-input ImgeInput"
                                                   name="uploadpicture"
                                                   required/>

                                            {!! HTML::image('public/images/targetImage.png', 'alt', array( 'class' => 'targetImage')) !!}
                                        </div>
                                    </div>
                                    <label for="postContent">Content</label>
                                    <textarea name="editor1" rows="10" cols="80" value="" required></textarea>
                                    <div class="form-group">
                                        <button id="saveBtn" class="btn btn-primary pull-right">Save</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

