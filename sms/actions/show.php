<?php

function show_GET(Web $w) {
	
	$p = $w->pathMatch("id");
	if (empty($p['id'])) {
		$w->error("Configuration not found", "/sms");
	}
	
	$_config_object = $w->Sms->getConfiguration($p['id']);
	
	$w->ctx("title", "Configuration: " . $_config_object->printSearchTitle());
	$w->ctx("config", $_config_object);
	$w->ctx("actions", $_config_object->getActions());
	$w->ctx("triggers", $_config_object->getTriggers());
}