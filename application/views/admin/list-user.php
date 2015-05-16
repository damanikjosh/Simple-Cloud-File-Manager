<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<div class="container-fluid content">
	<table class="table table-hover" id="table-user-list">
		<thead>
			<tr class="user-header">
				<th class="column-id">
					<a href="<?='?sort=id'.($sort=='id'?($asc==1 ?'&asc=0':'&asc=1'):'')?>">ID</a>
					<?php if($sort=='id'): ?>
					<span class="glyphicon glyphicon-chevron-<?=$asc==1 ?'up':'down'?>"></span>
					<?php endif ?>
				</th>
				<th class="column-username">
					<a href="<?='?sort=username'.($sort=='username'?($asc==1 ?'&asc=0':'&asc=1'):'')?>">Username</a>
					<?php if($sort=='username'): ?>
					<span class="glyphicon glyphicon-chevron-<?=$asc==1 ?'up':'down'?>"></span>
					<?php endif ?>
				</th>
				<th></th>
				<th class="column-date-created hidden-xs">
					<a href="<?='?sort=date_created'.($sort=='date_created'?($asc==1 ?'&asc=0':'&asc=1'):'')?>">Created</a>
					<?php if($sort=='date_created'): ?>
					<span class="glyphicon glyphicon-chevron-<?=$asc==1 ?'up':'down'?>"></span>
					<?php endif ?>
				</th>
				<th class="column-admin" nowrap="nowrap">
					<a href="<?='?sort=is_admin'.($sort=='is_admin'?($asc==1 ?'&asc=0':'&asc=1'):'')?>">Admin</a>
					<?php if($sort=='is_admin'): ?>
					<span class="glyphicon glyphicon-chevron-<?=$asc==1 ?'up':'down'?>"></span>
					<?php endif ?>
				</th>
			</tr>
		</thead>
		<tbody>
		<?php foreach ($users as $key => $user): ?>
			<tr class="user-content">
				<td class="content-id"><?= $user->id ?></td>
				<td class="content-username"><?= $user->username ?></td>
				<td class="content-actions">
				<?php if($this->session->userdata('user_id')!=$user->id||!($user->is_admin)): ?>
					<a href="<?= site_url('admin/user/' . $user->id) ?>" class="btn visible-xs-inline" rel="tooltip-left" title="Edit"><span class="glyphicon glyphicon-pencil"></span></a>
					<a href="javascript:void(0)" data-username="<?= $user->username ?>" data-url="<?= site_url('admin/user/' . $user->id) . '?delete=1' ?>" class="btn visible-xs-inline" rel="tooltip-left" title="Delete" data-toggle="modal" data-target="#delete-modal"><span class="glyphicon glyphicon-trash"></span></a>
				<?php endif ?>
				</td>
				<td class="content-date-created hidden-xs"><?= $user->date_created ?></td>
				<td class="content-admin">
					<span class="glyphicon glyphicon-<?= ($user->is_admin)?'ok':'remove'?>"></span>
					<?php if($this->session->userdata('user_id')!=$user->id) if($user->is_admin): ?>
						<a href="javascript:void(0)" data-username="<?= $user->username ?>" data-url="<?= site_url('admin/user/' . $user->id) . '?demote=1' ?>" class="btn visible-xs-inline" rel="tooltip-left" title="Demote" data-toggle="modal" data-target="#demote-modal"><span class="glyphicon glyphicon-arrow-down"></span></a>
					<?php else: ?>
						<a href="javascript:void(0)" data-username="<?= $user->username ?>" data-url="<?= site_url('admin/user/' . $user->id) . '?promote=1' ?>" class="btn visible-xs-inline" rel="tooltip-left" title="Promote" data-toggle="modal" data-target="#promote-modal"><span class="glyphicon glyphicon-arrow-up"></span></a>
					<?php endif ?>
				</td>
			</tr>
		<?php endforeach ?>
			<tr class="user-add">
				<td></td>
				<td colspan="3">
					<a href="<?= site_url('admin/user/add') ?>"><span class="glyphicon glyphicon-plus"></span> Add User</a>
				</td>
				<td class="hidden-xs"></td>
			</tr>
		</tbody>
	</table>
</div>
<div class="modal fade" id="delete-modal" tabindex="-1" role="dialog" aria-labelledby="delete-modal" aria-hidden="true">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
				<h4 class="modal-title" id="deleteModalLabel">Delete Confirmation</h4>
			</div>
			<div class="modal-body">
				Do you want to delete <b id="delete-modal-username"></b>?
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
				<a id="delete-confirm-btn" href="javascript:void(0)" class="btn btn-danger">Delete</a>
			</div>
		</div>
	</div>
</div>
<div class="modal fade" id="promote-modal" tabindex="-1" role="dialog" aria-labelledby="promote-modal" aria-hidden="true">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
				<h4 class="modal-title" id="promoteModalLabel">Admin Promote Confirmation</h4>
			</div>
			<div class="modal-body">
				Do you want to promote <b id="promote-modal-username"></b> as Admin?
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
				<a id="promote-confirm-btn" href="javascript:void(0)" class="btn btn-danger">Promote</a>
			</div>
		</div>
	</div>
</div>
<div class="modal fade" id="demote-modal" tabindex="-1" role="dialog" aria-labelledby="demote-modal" aria-hidden="true">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
				<h4 class="modal-title" id="demoteModalLabel">Admin Demote Confirmation</h4>
			</div>
			<div class="modal-body">
				Do you want to demote <b id="demote-modal-username"></b> from Admin?
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
				<a id="demote-confirm-btn" href="javascript:void(0)" class="btn btn-danger">Demote</a>
			</div>
		</div>
	</div>
</div>
<script type="text/javascript">
	$(document).ready(function(){
		$('#delete-modal').on('show.bs.modal', function (event) {
			var button = $(event.relatedTarget); // Button that triggered the modal
			var name = button.data('username');
			var url = button.data('url'); // Extract info from data-* attributes
			// If necessary, you could initiate an AJAX request here (and then do the updating in a callback).
			// Update the modal's content. We'll use jQuery here, but you could use a data binding library or other methods instead.
			var modal = $(this);
			$('#delete-modal-username').text(name);
			$('#delete-confirm-btn').attr("href", url);
		})
	});
	$(document).ready(function(){
		$('#promote-modal').on('show.bs.modal', function (event) {
			var button = $(event.relatedTarget); // Button that triggered the modal
			var name = button.data('username');
			var url = button.data('url'); // Extract info from data-* attributes
			// If necessary, you could initiate an AJAX request here (and then do the updating in a callback).
			// Update the modal's content. We'll use jQuery here, but you could use a data binding library or other methods instead.
			var modal = $(this);
			$('#promote-modal-username').text(name);
			$('#promote-confirm-btn').attr("href", url);
		})
	});
	$(document).ready(function(){
		$('#demote-modal').on('show.bs.modal', function (event) {
			var button = $(event.relatedTarget); // Button that triggered the modal
			var name = button.data('username');
			var url = button.data('url'); // Extract info from data-* attributes
			// If necessary, you could initiate an AJAX request here (and then do the updating in a callback).
			// Update the modal's content. We'll use jQuery here, but you could use a data binding library or other methods instead.
			var modal = $(this);
			$('#demote-modal-username').text(name);
			$('#demote-confirm-btn').attr("href", url);
		})
	});
</script>