<?php

function edit_GET(Web $w) {
	
	$p = $w->pathMatch("id");
	$config_id = $w->request("config_id");
	$_trigger_object = $p['id'] ? $w->Sms->getTrigger($p['id']) : new SmsTrigger($w);
	
	if (empty($config_id)) {
		$w->error("Configuration not found", "/sms");
	}
	
	if(empty($_trigger_object->trigger_setup)) {
		$_trigger_object->trigger_setup =
		'{
  "database": {
    "update": [
      {}
	],
    "insert": [
      {}
    ],
    "delete": [
      {}
    ]
  },
  "sms": {
    "receive": [
      {}
    ]
  }
}';
	}
	
	$form = [
		"Action" => [
			[["Description", "text", "description", $_trigger_object->description]],
			[["Type", "select", "trigger_type", $_trigger_object->trigger_type, ['database' => 'Database', 'sms' => 'SMS']]],
			[["Actions", "textarea", "trigger_setup", $_trigger_object->trigger_setup, null, 6, 'codemirror']],
			[["", "hidden", "configuration_id", $config_id]],
		]
	];
	
	$w->out(Html::multiColForm($form, '/sms-trigger/edit/' . $_trigger_object->id));
	$w->out('<script>CodeMirror.fromTextArea(document.getElementById("trigger_setup"), {mode: "javascript", json: true, lineNumbers:true});</script>');
}

function edit_POST(Web $w) {
	
	$p = $w->pathMatch("id");
	$_trigger_object = $p['id'] ? $w->Sms->getTrigger($p['id']) : new SmsTrigger($w);
	$_trigger_object->fill($_POST);
	$_trigger_object->insertOrUpdate();
	
	$redirect_url = $w->request("redirect_url");
	$w->msg("Configuration " . ($p['id'] ? 'updated' : 'created'), !empty($redirect_url) ? $redirect_url : "/sms/show/".$_trigger_object->configuration_id);
	
}
