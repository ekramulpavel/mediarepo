
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper bg-white p-4 mt-5" style="padding-bottom:100px!important">
  <!-- Content Header (Page header) -->
<div class="alert-container">

</div>
  <div class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1 class="m-0 text-dark">All Files</h1>
        </div><!-- /.col -->
        <div class="col-3 ">
          <button type="button" class="btn btn-primary float-right" data-toggle="modal"  data-target="#newfolder"><i class="fa fa-plus mr-1"></i>New Folder</button>

        </div>
        <div class="col-3 ">
          <!-- <button type="button" class="btn btn-primary mr-1 fileinput-button ">Upload</button> -->
          <form id="fileupload"  action="" method="POST" enctype="multipart/form-data">
            <!-- Redirect browsers with JavaScript disabled to the origin page -->

            <!-- The fileupload-buttonbar contains buttons to add/delete files and start/cancel the upload -->
            <div class="row fileupload-buttonbar">

                <!-- The fileinput-button span is used to style the file input field as button -->
                <span class="btn btn-primary fileinput-button">
                  <i class="fa fa-plus"></i>
                  <span>Add files...</span>
                  <input type="file" name="files[]" multiple>
                </span>
                <!-- <button type="button" class="btn btn-danger delete">
                  <i class="glyphicon glyphicon-trash"></i>
                  <span>Delete</span>
                </button> -->
<!-- <input type="checkbox" class="toggle"> -->

            </div>
            <!-- The table listing the files available for upload/download -->

            <table role="presentation" class="table table-striped fixed-bottom upload-files" ><tbody class="files"></tbody></table>

          </form>
        </div>
      </div><!-- /.row -->
    </div><!-- /.container-fluid -->
  </div>

  <!-- /.content-header -->
  <!-- /.content-header -->

  <!-- Modal -->
  <div class="modal" id="newfolder" tabindex="-1" role="dialog" aria-labelledby="newfolderVerticalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="newfolderVerticalLabel">Add New Folder</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <form id="new-folder" class="form-horizontal needs-validation" action="<?= site_url();?>user/addnewfolder" method="post" novalidate>
            <fieldset>

              <div class="form-group">
                <div class="row">
                  <div class="col-12">
                    <label for="folder_name" class="control-label">New Folder Name</label>
                    <input class="form-control" id="folder_name" name="folder_name" required placeholder="Name" type="text" value="" />
                  </div>
                </div>
              </div>


              <div class="form-group">
                <div class="row">
                  <div class="col-12">
                    <!-- <label for="txt_email" class="control-label"> Email</label> -->
                    <input class="form-control" id="txt_type" name="txt_type"  value="user" type="hidden" />
                  </div>
                </div>
              </div>

              <br>
              <!-- sigup button -->
              <div class="form-gruop">
                <div class="row">
                  <div class="col-12">
                    <input id="btn_signup" name="btn_signup" type="submit" class="btn btn-primary" value="Add New Folder" />

                    <button type="button" class="btn btn-secondary float-right" data-dismiss="modal">Close</button>
                  </div>
                </div>
              </div>
            </fieldset>

          </form>
        </div>
      </div>
    </div>
  </div>

  <!-- create floder -->


  <!-- create floder -->
  <!-- Main content -->

  <nav aria-label="breadcrumb">
    <ol class="breadcrumb" style="font-size:20px;">
    </ol>
  </nav>
  <section class="content"><div class="container-fluid table-container">

    <table class="table" id="all-files" style="width:100%">
      <thead>
        <tr>
          <th class="no-sort"></th>
          <th class="item_name" data-filter="text">Name</th>
          <th class="item_name" data-filter="text">Uploaded By</th>
          <th class="item_date" data-filter="select">Date</th>
          <th class="no-sort"></th>
        </tr>
      </thead>
      <tbody>
        <!-- Handlebars Template Appends Here -->
      </tbody>
    </table>
  </div>
</section>
<!-- /.content -->



</div>
<!-- /.content-wrapper -->
