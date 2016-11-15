<?php

function edit_GET(Web $w) {
	
	$p = $w->pathMatch("id");
	$config_id = $w->request("config_id");
	$_action_object = $p['id'] ? $w->Sms->getAction($p['id']) : new SmsAction($w);
	
	if (empty($config_id)) {
		$w->error("Configuration not found", "/sms");
	}
	
	if(empty($_action_object->actions)) {
		$_action_object->actions =
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
    "send": [
      {}
    ]
  }
}';
	}
	
	$form = [
		"Action" => [
			[["Description", "text", "description", $_action_object->description]],
			[["Type", "select", "action_type", $_action_object->action_type, ['database' => 'Database', 'sms' => 'SMS']]],
			[["Actions", "textarea", "actions", $_action_object->actions, null, 6, 'codemirror']],
			[["", "hidden", "configuration_id", $config_id]],
		]
	];
	
	$w->out(Html::multiColForm($form, '/sms-action/edit/' . $_action_object->id));
	$w->out('<script>CodeMirror.fromTextArea(document.getElementById("actions"), {mode: "javascript", json: true, lineNumbers:true});</script>');
}

function edit_POST(Web $w) {
	
	$p = $w->pathMatch("id");
	$_action_object = $p['id'] ? $w->Sms->getAction($p['id']) : new SmsAction($w);
	$_action_object->fill($_POST);
	$_action_object->insertOrUpdate();
	
	$redirect_url = $w->request("redirect_url");
	$w->msg("Configuration " . ($p['id'] ? 'updated' : 'created'), !empty($redirect_url) ? $redirect_url : "/sms/show/".$_action_object->configuration_id);
	
}
