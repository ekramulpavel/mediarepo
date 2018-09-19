
 <style type="text/css">
      a:hover {text-decoration: none;}
      .float-right{float: right;}
  </style>
<div class="container h-100 w-100">
    <div class="row h-100 w-100 d-flex justify-content-center">
        <div class="col-10 col-md-5 well bg-white align-self-center p-4 rounded">
            <?php echo $this->session->flashdata('login_msg'); ?>
            <?php echo form_open(site_url().'login/login'); ?>
            <fieldset >
                <legend class="text-center">Login Form</legend>
                <!-- username -->
                <div class="form-group">
                    <div class="row">
                      <div class="col-12">
                        <label for="txt_username" class="control-label">Username</label>
                        <input type="text" id="txt_username" class="form-control" name="txt_username" placeholder="username" value="<?php echo set_value('txt_username') ?>"/>
                        <span class="text-danger"><?php echo form_error('txt_username'); ?></span>
                      </div>
                    </div>
                </div>

                 <!-- password -->
                <div class="form-group">
                    <div class="row">
                      <div class="col-12">
                        <label for="txt_password" class="control-label">Password</label>
                        <input type="password" id="txt_password" class="form-control" name="txt_password" placeholder="password"/>
                        <span class="text-danger"><?php echo form_error('txt_password'); ?></span>
                      </div>
                    </div>
                </div>

                <div class="row">
                  <div class="col-12 mb-3">
                    <a href="<?php  echo site_url('login/forget'); ?>"
                        <span class="float-right text-danger"> forgot password?</span>
                    </a>
                  </div>
                 </div>

                <div class="form-group">
                    <div class="row text-center">
                      <div class="col-12">
                        <input type="submit" id="btn_login" name="btn_login" value="Login" class="btn btn-primary btn-block"/>
                      </div>
                    </div>
                </div>
            </fieldset>
            <?php echo form_close(); ?>

        </div>

    </div>
</div>
