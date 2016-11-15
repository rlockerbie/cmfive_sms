<div class="row-fluid panel">
	<?php echo $config->description; ?>
</div>

<div class="tabs">
	<div class="tab-head">
		<a href="#triggers">Triggers</a>
		<a href="#sms_actions">Actions</a>
	</div>
	<div class="tab-body">
		<div id="triggers">
			<h3>Triggers</h3>
			<?php echo Html::box("/sms-trigger/edit/?config_id=" . $config->id, "Add a trigger", true); ?>
			<?php if (!empty($triggers)) : ?>
				<table class="table small-12">
					<thead>
						<tr>
							<th>Description</th><th>Type</th><th>Actions</th>
						</tr>
					</thead>
					<tbody id="sortable" >
						<?php foreach ($triggers as $trigger) : ?>
							<tr id="field_<?php echo $trigger->id; ?>" >
								<td><?php echo $trigger->description; ?></td>
								<td><?php echo $trigger->trigger_type; ?></td>
								<td>
									<?php
									echo Html::box("/sms-trigger/edit/" . $trigger->id . "?config_id=" . $config->id, "Edit", true);
									echo Html::b("/sms-trigger/delete/" . $trigger->id, "Delete", "Are you sure you want to delete this trigger?", null, false, "alert");
									?>
								</td>
							</tr>
						<?php endforeach; ?>
					</tbody>
				</table>
			<?php endif; ?>
		</div>
		<div id="sms_actions">
			<h3>Actions</h3>
			<?php echo Html::box("/sms-action/edit/?config_id=" . $config->id, "Add an action", true); ?>
			<?php if (!empty($actions)) : ?>
				<table class="table small-12">
					<thead>
						<tr>
							<th>Description</th><th>Type</th><th>Actions</th>
						</tr>
					</thead>
					<tbody id="sortable" >
						<?php foreach ($actions as $action) : ?>
							<tr id="field_<?php echo $action->id; ?>" >
								<td><?php echo $action->description; ?></td>
								<td><?php echo $action->action_type; ?></td>
								<td>
									<?php
									echo Html::box("/sms-action/edit/" . $action->id . "?config_id=" . $config->id, "Edit", true);
									echo Html::b("/sms-action/delete/" . $action->id, "Delete", "Are you sure you want to delete this action?", null, false, "alert");
									?>
								</td>
							</tr>
						<?php endforeach; ?>
					</tbody>
				</table>
			<?php endif; ?>
		</div>
	</div>
</div>