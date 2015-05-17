<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<div class="container-fluid content">
	<table class="table table-hover">
		<thead>
			<tr class="logs-header">
				<th class="column-id">
					<a href="<?='?sort=user_id'.($sort=='user_id'?($asc==1 ?'&asc=0':'&asc=1'):'')?>">ID</a>
					<?php if($sort=='user_id'): ?>
					<span class="glyphicon glyphicon-chevron-<?=$asc==1 ?'up':'down'?>"></span>
					<?php endif ?>
				</th>
				<th class="column-type">
					<a href="<?='?sort=type'.($sort=='type'?($asc==1 ?'&asc=0':'&asc=1'):'')?>">Type</a>
					<?php if($sort=='type'): ?>
					<span class="glyphicon glyphicon-chevron-<?=$asc==1 ?'up':'down'?>"></span>
					<?php endif ?>
				</th>
				<th class="column-action">
					<a href="<?='?sort=action'.($sort=='action'?($asc==1 ?'&asc=0':'&asc=1'):'')?>">Action</a>
					<?php if($sort=='action'): ?>
					<span class="glyphicon glyphicon-chevron-<?=$asc==1 ?'up':'down'?>"></span>
					<?php endif ?>
				</th>
				<th class="column-content">
					<a href="<?='?sort=content'.($sort=='content'?($asc==1 ?'&asc=0':'&asc=1'):'')?>">Content</a>
					<?php if($sort=='content'): ?>
					<span class="glyphicon glyphicon-chevron-<?=$asc==1 ?'up':'down'?>"></span>
					<?php endif ?>
				</th>
				<th class="column-time">
					<a href="<?='?sort=time'.($sort=='time'?($asc==1 ?'&asc=0':'&asc=1'):'')?>">Time</a>
					<?php if($sort=='time'): ?>
					<span class="glyphicon glyphicon-chevron-<?=$asc==1 ?'up':'down'?>"></span>
					<?php endif ?>
				</th>
			</tr>
		</thead>
		<tbody>
		<?php foreach ($logs as $key => $log): ?>
			<tr class="logs-content">
				<td><?= $log->user_id ?></td>
				<td><?= $log->type ?></td>
				<td><?= $log->action ?></td>
				<td><?= $log->content ?></td>
				<td><?= $log->time ?></td>
			</tr>
		<?php endforeach ?>
		</tbody>
	</table>
</div>