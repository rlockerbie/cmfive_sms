<?php

/**
 * Store audit entries for any inserting DbObjects
 *
 * @param unknown $w
 * @param unknown $object
 */
function sms_core_dbobject_after_insert(Web $w, DbObject $object) {
	$triggers = $w->Sms->getAllTriggers('Database');
	foreach($triggers as $trigger) {
		$json = json_decode($trigger['trigger_setup']);
		if(!empty($json)) {
			if(isset($json->database->insert) && is_array($json->database->insert)) {
				foreach($json->database->insert as $insert) {
					if(isset($insert->model) && $insert->model == get_class($object)) {
						var_dump(get_class($object));
					}
				}
			}
		}
	}
}

function sms_core_dbobject_after_update(Web $w, DbObject $object) {
	$triggers = $w->Sms->getAllTriggers('Database');
	foreach($triggers as $trigger) {
		$json = json_decode($trigger['trigger_setup']);
		if(!empty($json)) {
			if(isset($json->database->update) && is_array($json->database->update)) {
				foreach($json->database->update as $update) {
					if(isset($update->model) && $update->model == get_class($object)) {
						$w->Sms->triggerActions($trigger['id']);
						break;//Only trigger once per trigger
					}
				}
			}
		}
	}
}