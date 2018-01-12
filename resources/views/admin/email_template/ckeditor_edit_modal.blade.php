<div id="ckeditorModal" class="modal fade" role="dialog">
  <div class="modal-dialog modal-lg">
    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Edit Template</h4>
      </div>
      <div class="modal-body">

        <section class="content">
          <div class="row">
            <div class="col-md-12">

              <h2></h2>
            </div>
            <div class="box-body">
              <form id="edit_email">
                <div class="form-group">
                  <input type="text" class="hidden" id="id">
                </div>
                <div class="form-group">
                  <label for="Name">Template Name</label>
                  <input type="text" class="form-control" id="Name" aria-describedby="emailHelp" placeholder="Enter template name">
                </div>
                <div class="form-group">
                  <label for="Subject">Template Subject</label>
                  <input type="text" class="form-control" id="Subject" placeholder="Enter template subject">
                </div>
                <label for="Content">Template Content</label>
                <textarea id="Content" name="editor1" rows="10" cols="80" value="">
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