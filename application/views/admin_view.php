<div class="container">
    <div class="row">
        <div class="col-xs-12 .col-md-8-centered well">
            <?php echo $this->session->flashdata('login_msg'); ?>
            <table class="table">
                <tr>
                    <td></td>
                    <td></td>
                    <td>
                        <?php echo form_open('admin_controller/logout'); ?>
                        <input type="submit" class="btn btn-primary" id="btn_logout" name="btn_logout" value="LOGOUT"/>
                        <?php echo form_close(); ?>
                    </td>
                </tr>
            </table>
            
            hi from admin
        </div>
    </div>
</div>