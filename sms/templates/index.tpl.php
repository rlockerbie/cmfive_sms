<div class="row-fluid">
	<div class="small-12">
		<?php echo Html::box("/sms/edit", "Add a configuration", true); ?>
	</div>
</div>

<?php if (!empty($configurations)) : ?>
<table class="table small-12">
	<thead>
		<tr><th>Title</th><th>Description</th><th>Enabled</th><th>Actions</th></tr>
	</thead>
	<tbody>
		<?php foreach($configurations as $config) : ?>
			<tr>
				<td width="30%"><?php echo $config->toLink(); ?></td>
				<td width="40%"><?php echo $config->description; ?></td>
				<?php if($config->enabled): ?>
				<td width="10%"><span class="fi-check" style="color:#43AC6A;"></span></td>
				<?php else: ?>
				<td width="10%"><span class="fi-x" style="color:#F04124;"></span></td>
				<?php endif; ?>
				<td width="20%">
					<?php echo Html::box("/sms/edit/" . $config->id, "Edit", true) ?>
					<?php echo Html::b("/sms/delete/" . $config->id, "Delete", "Are you sure you want to delete this Configuration?)", null, false, "alert"); ?>
				</td>
			</tr>
		<?php endforeach; ?>
	</tbody>
</table>
<?php endif; ?>
