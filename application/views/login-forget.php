

<div class="container w-100 h-100">
	<div class="row w-100 h-100 d-flex justify-content-center">

		<div class="col-10 col-md-5 well bg-white align-self-center p-4 rounded">
			 <span class="text-danger"><?php  echo (isset($error))?$error:''; ?></span>
			 <span class="text-success"><?php  echo (isset($info))?$info:''; ?></span>
			<?php echo form_open(site_url().'login/doforget'); ?>
			<fieldset >
				<legend class="text-center">Reset password</legend>
				<!-- username -->
				<div class="form-group">
					<div class="row colbox">
						<div class="col-12">
							<label for="email" class="control-label"> Email</label>
							<input class="box form-control" type="text" id="email" name="email" />
						</div>
					</div>
				</div>

				<div class="form-group">
					<div class="row colbox ">
						<div class="col-12">
							<input type="submit" class="btn btn-primary" value="Reset" />
							<p class="d-inline float-right align-self-center"><a href="<?= site_url();?>">Back to login</a></p>
						</div>
					</div>
				</div>


			</fieldset>

			<?php echo form_close(); ?>
		</div>


	</div>
</div>
