


<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper bg-white p-4 mt-5">
  <!-- Content Header (Page header) -->
  <div class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1 class="m-0 text-dark">User List </h1>
        </div><!-- /.col -->
      </div><!-- /.row -->
    </div><!-- /.container-fluid -->
  </div>

  <!-- /.content-header -->

  <!-- Main content -->
  <section class="content">
    <div class="container-fluid">
      <!-- Info boxes -->
      <div class="row">
        <div class="col-12">
          <!-- Button trigger modal -->
          <button type="button" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#ModalLoginForm">
            <i class="fa fa-user-plus"></i>
            Add User
          </button>


          <!-- Modal -->

          <!-- Modal HTML Markup -->
          <div id="ModalLoginForm" class="modal fade">
            <div class="modal-dialog" role="document">
              <div class="modal-content">
                <div class="modal-header">
                  <h1 class="modal-title">Add User</h1>
                </div>
                <div class="modal-body">
                  <!-- form start -->

                  <?php //echo form_open('User/signup') ?>
                  <form id="new-user-form" class="form-horizontal needs-validation" action="<?= site_url();?>user/signup" method="post" novalidate>
                  <fieldset>
                    <!-- <legend class="text-center">User Registration</legend> -->

                    <?php echo $this->session->flashdata('msg'); ?>

                    <div class="form-group">
                      <div class="row">
                        <div class="col-12">
                          <label for="txt_name" class="control-label">Username</label>
                          <input class="form-control" id="txt_name" name="txt_name" required placeholder="Name" type="text" value="" />
                        </div>
                      </div>
                    </div>
                    <!-- user email -->
                    <div class="form-group">
                      <div class="row">
                        <div class="col-12">
                          <label for="txt_email" class="control-label"> Email</label>
                          <input class="form-control" id="txt_email" name="txt_email" required placeholder="Email" value="" type="email" />
                        </div>
                      </div>
                    </div>
                    <!-- user password -->
                    <div class="form-group">
                      <div class="row">
                        <div class="col-12">
                          <label for="txt_password" class="control-label"> Password</label>
                          <input class="form-control" id="txt_password" name="txt_password" required placeholder="Password" type="password" value=""/>
                        </div>
                      </div>
                    </div>

                    <!-- user confirm password -->
                    <div class="form-group">
                      <div class="row">
                        <div class="col-12">
                          <label for="txt_confirm_password" class="control-label">Confirm Password</label>
                          <input class="form-control" id="txt_confirm_password" name="txt_confirm_password" required placeholder="Confirm Password" type="password" value=""/>
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
                          <input id="btn_signup" name="btn_signup" type="submit" class="btn btn-primary" value="Add New User" />

                          <button type="button" class="btn btn-secondary float-right" data-dismiss="modal">Close</button>
                        </div>
                      </div>
                    </div>
                  </fieldset>
                  <?php //echo form_close(); ?>

                </form>

                  <!-- form end -->
                </div>
              </div><!-- /.modal-content -->
            </div><!-- /.modal-dialog -->
          </div><!-- /.modal -->

          <!-- Modal -->

          <!-- ============================================= Edit User Information Modal =================================================== -->
            <!-- Modal HTML Markup -->
            <div id="EditFormModal" class="modal fade">
              <div class="modal-dialog" role="document">
                <div class="modal-content">
                  <div class="modal-header">
                    <h1 class="modal-title">Edit User Information</h1>
                  </div>
                  <div class="modal-body">                    <!-- form start -->

                    <form id="edit-user-form" class="form-horizontal needs-validation" action="<?= site_url();?>user/update" method="post" novalidate>

                    <fieldset>
                      <!-- <legend class="text-center">User Registration</legend> -->
                      <input id="user_id" name="user_id" type="hidden" value=""/>
                      <?php  ?>

                      <div class="form-group">
                        <div class="row">
                          <div class="col-12">
                            <label for="edit_txt_name" class="control-label">Username</label>
                            <input class="form-control" id="edit_txt_name" name="edit_txt_name" required placeholder="Name" type="text" value="" />
                          </div>
                        </div>
                      </div>
                      <!-- user email -->
                      <div class="form-group">
                        <div class="row">
                          <div class="col-12">
                            <label for="edit_txt_email" class="control-label"> Email</label>
                            <input class="form-control" id="edit_txt_email" name="edit_txt_email" required placeholder="Email" value="" type="email" />
                          </div>
                        </div>
                      </div>
                      <!-- user password -->
                      <div class="form-group">
                        <div class="row">
                          <div class="col-12">
                            <label for="edit_txt_password" class="control-label"> Password</label>
                            <input class="form-control" id="edit_txt_password" name="edit_txt_password"  placeholder="Password" type="password" value=""/>
                          </div>
                        </div>
                      </div>

                      <br>
                      <!-- sigup button -->
                      <div class="form-group">
                        <div class="row">
                          <div class="col-12">
                            <input id="btn_edit" name="btn_edit" type="submit" class="btn btn-primary" value="Update" />

                            <button type="button" class="btn btn-secondary float-right" data-dismiss="modal">Close</button>
                          </div>
                        </div>
                      </div>
                    </fieldset>
                    <?php //echo form_close(); ?>

                  </form>

                    <!-- form end -->
                  </div>
                </div><!-- /.modal-content -->
              </div><!-- /.modal-dialog -->
            </div><!-- /.modal -->

            <!-- Modal -->







    <div class="table-responsive mt-5">
      <table id="userlist" class="table table-striped table-bordered" style="width:100%">
        <thead>
          <tr>
            <th>Id</th>
            <th>Name</th>
            <th>Email</th>
            <th></th>
          </tr>
        </thead>
      </table>
    </div>
  </div>
</div>
</div>
</div><!--/. container-fluid -->
</section>
<!-- /.content -->
</div>
<!-- /.content-wrapper -->
