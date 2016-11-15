<?php if (!empty($log)) : ?>
<table class="table small-12">
	<thead>
		<tr><th>Mobile</th><th>Date</th><th>Message</th><th>Type</th><th>Processed</th></tr>
	</thead>
	<tbody>
		<?php foreach($log as $entry) : ?>
			<tr>
				<td><?php echo $entry->mobile; ?></td>
				<td><?php echo date('d/m/Y H:i:s', $entry->dt_created); ?></td>
				<td><?php echo $entry->message; ?></td>
				<td><?php echo $entry->sms_type; ?></td>
				<?php if($entry->processed): ?>
				<td width="10%"><span class="fi-check" style="color:#43AC6A;"></span></td>
				<?php else: ?>
				<td width="10%"><span class="fi-x" style="color:#F04124;"></span></td>
				<?php endif; ?>
			</tr>
		<?php endforeach; ?>
	</tbody>
</table>
<?php endif; ?>
