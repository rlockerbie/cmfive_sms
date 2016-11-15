<?php

function log_GET(Web $w) {
	$w->ctx("title", "SMS Log");
	$log = $w->Sms->getLog();
	//$w->Sms->triggerSmsActions('0423812962', 'YES');
	//$w->Sms->triggerSmsActions('0423812962', 'NO');
	$w->ctx("log", $log);
}