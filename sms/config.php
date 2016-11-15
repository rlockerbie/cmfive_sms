<?php
Config::set('sms', array(
	'version' => '0.0.1',
    'active' => true,
    'path' => 'modules',
    'topmenu' => true,
	'hooks' => array('core_dbobject'),
    'dependencies' => array(
		"twilio/sdk" => "^4.10",
	),
));
