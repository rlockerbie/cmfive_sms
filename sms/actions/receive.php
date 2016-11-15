<?php

function receive_GET(Web $w) {
	echo 'nothing to see here';
	exit;
}

function receive_POST(Web $w) {
	if(!empty($_POST['MessagingServiceSid']) && Config::get('twilio.message_service_sid') == $_POST['MessagingServiceSid']) {
		$sms = new SmsSms($w);
		$sms->message = $_POST['Body'];
		$sms->mobile = $_POST['From'];
		$sms->sms_type = 'received';
		$sms->message_sid = $_POST['SmsMessageSid'];
		$sms->status = $_POST['SmsStatus'];
		$sms->processed = 0;
		$sms->insert();
	}
	exit;
}