<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<div class="container-fluid content">
	<div>
		<div class="file-icon">
			<span class="glyphicon glyphicon-user"></span>
		</div>
	</div>
	<div role="tabpanel">

	<!-- Nav tabs -->
		<ul class="nav nav-tabs " role="tablist">
			<li role="presentation" class="active"><a href="#tab-username" aria-controls="tab-username" role="tab" data-toggle="tab">Change Username</a></li>
			<li role="presentation"><a href="#tab-password" aria-controls="tab-password" role="tab" data-toggle="tab">Change Password</a></li>
			
		</ul>

		<!-- Tab panes -->
		<div class="tab-content">
			<div role="tabpanel" class="tab-pane fade in active" id="tab-username">
				<?php echo form_open('admin/user/'.$id.'?edit=1', array('id'=>'form-username')); ?>
					<input type="hidden" name="modify" value="username" />
					<div class="form-group">
						<label for="username">Username</label>
						<input type="text" class="form-control" id="username" name="username" placeholder="Username" value="<?= $username ?>" required />
						<small><i>Alpha-numeric</i></small>
					</div>
					<button type="submit" id="modify-username-btn" class="btn btn-success btn-bg" disabled>Modify</button>
				</form>
			</div>
			<div role="tabpanel" class="tab-pane fade" id="tab-password">
				<?php echo form_open('admin/user/'.$id.'?edit=1', array('id'=>'form-password')); ?>
				<input type="hidden" name="modify" value="password" />
				<div id="password-group" class="form-group">
					<label for="password">Password</label>
					<input type="password" class="form-control" id="password" name="password" placeholder="New Password" required />
					<small><i>Password length min. 6 characters</i></small>
				</div>
				<div id="re-password-group" class="form-group">
					<label for="re-password">Retype Password</label>
					<input type="password" class="form-control" id="re-password" rel="tooltip-manual-left" title="New Password Mismatch" name="re-password" placeholder="New Password" required />
				</div>
				<button type="submit" id="modify-password-btn" class="btn btn-success btn-bg">Modify</button>
				</form>
			</div>
		</div>
	</div>

</div>
<script type="text/javascript">
$(document).ready(function (){
	$("#form-password").submit(function (e){
		if($('#password').val()!=$('#re-password').val() || $('#password').val().length < 6){
			e.preventDefault();
		}
	});
	$("#form-username").submit(function (e){
		if($(this).val()=='<?= $username ?>'){
			e.preventDefault();
		}
	});
	$('#username').keyup(function () {
		if($(this).val()=='<?= $username ?>'){
			$('#modify-username-btn').prop('disabled', true);
		} else {
			$('#modify-username-btn').prop('disabled', false);
		}
	});
	$('#re-password').keyup(function () {
		if($('#password').val()==$('#re-password').val()){
			$('#re-password-group').removeClass('has-error').addClass('has-success');
		} else {
			$('#re-password-group').removeClass('has-success').addClass('has-error');
		}
	});
	$('#password').keyup(function () {
		if($('#password').val().length >= 6){
			$('#password-group').removeClass('has-error').addClass('has-success');
		} else {
			$('#password-group').removeClass('has-success').addClass('has-error');
		}
	});
});
</script>