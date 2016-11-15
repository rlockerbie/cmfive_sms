<?php

function edit_GET(Web $w) {
	
	$p = $w->pathMatch("id");
	$_config_object = $p['id'] ? $w->Sms->getConfiguration($p['id']) : new SmsConfiguration($w);
	
	$form = [
		"Configuration" => [
			[["Title", "text", "title", $_config_object->title]],
			[["Description", "text", "description", $_config_object->description]],
			[["Enabled", "checkbox", "enabled", $_config_object->enabled]],
		]
	];
	
	$w->out(Html::multiColForm($form, '/sms/edit/' . $_config_object->id));
}

function edit_POST(Web $w) {
	
	$p = $w->pathMatch("id");
	$_config_object = $p['id'] ? $w->Sms->getConfiguration($p['id']) : new SmsConfiguration($w);
	
	$_config_object->fill($_POST);
	if(!isset($_POST['enabled'])) {
		$_config_object->enabled = 0;
	}
	$_config_object->insertOrUpdate();
	
	$redirect_url = $w->request("redirect_url");
	$w->msg("Configuration " . ($p['id'] ? 'updated' : 'created'), !empty($redirect_url) ? $redirect_url : "/sms");
	
}
