<?php

function index_GET(Web $w) {
	$w->ctx("title", "SMS Configuration");
	$configurations = $w->Sms->getConfigurations();
	
	$w->ctx("configurations", $configurations);
}