<div id="ckeditorModal" class="modal fade" role="dialog">
  <div class="modal-dialog modal-lg">
    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Edit Post</h4>
      </div>
      <div class="modal-body">
        <section class="content">
          <div class="row">
            <div class="box-body">
              <form id="post_modal">
                <div class="form-group">
                  <input type="text" class="hidden" id="id">
                </div>
                <div class="form-group">
                  <label for="blogTitle">Title</label>
                  <input type="text" class="form-control" id="blogTitle" placeholder="Enter title name">
                </div>
                <div class="form-group">
                  <label for="blogType">Type</label>
                  <input type="text" class="form-control" id="blogType" placeholder="Enter post type">
                </div>
                <div class="form-group">
                  <label for="blogStatus">Status</label>
                  <input type="text" class="form-control" id="blogStatus" placeholder="Enter post status">
                </div>
                 <div class="form-group">
                  <label for="blogCategory">Category</label>
                  <input type="text" class="form-control" id="blogCategory" placeholder="Enter post category">
                </div>
                <div class="form-group">
                  <label for="blogBy">By</label>
                  <input type="text" class="form-control" id="blogBy" placeholder="Enter post by">
                </div>
                <div class="form-group">
                  <label for="blogImage">Image</label>
                  <input type="text" class="form-control" id="blogImage" placeholder="Enter post image">
                </div>
                <label for="blogContent">Content</label>
                <textarea id="blogContent" name="editor1" rows="10" cols="80" value="">
                </textarea>
              </form>
              <div class="box-footer">
                <button id="saveBtn" class="btn btn-primary pull-right">Save</button>
              </div>
            </div>
          </div>
        </div>
      </section>
    </div>
  </div>

</div>
</div>