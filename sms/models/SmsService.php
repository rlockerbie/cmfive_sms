<?php
/**
 * SmsService class for working with Twilio SMS API
 * 
 * @author Robert Lockerbie, June 2016
 */
class SmsService extends DbService {
	
	public function send($to, $body) {
		$to = str_replace(' ', '', $to);
		if(!strpos($to, '+61')) {
			$to = '+61' . substr($to, 1);
		}
		$client = new Services_Twilio(Config::get('twilio.account_sid'), Config::get('twilio.auth_token'));
		$message = $client->account->messages->create(
			array(
				'To' => $to,
				'From' => Config::get('twilio.from'),
				'Body' => $body,
				'MessagingServiceSid' => Config::get('twilio.message_service_sid')
			)
		);
		$sms = new SmsSms($this->w);
		$sms->message = $body;
		$sms->mobile = $to;
		$sms->sms_type = 'sent';
		$sms->message_sid = $message->sid;
		$sms->status = 'delivered ';
		$sms->processed = 0;
		$sms->insert();
		return $message;
	}
	
	public function getLog() {
		return $this->getObjects("SmsSms",array("is_deleted" => 0));
	}
	
	public function triggerActions($config_id) {
		$_config_object = $this->getConfiguration($config_id);
		if(!empty($_config_object)) {
			$actions = $_config_object->getActions();
			foreach($actions as $action) {
				$json = json_decode($action->actions);
				if(!empty($json)) {
					if(isset($json->sms->send) && is_array($json->sms->send)) {
						foreach($json->sms->send as $smsToSend) {
							$this->send($smsToSend->to, $smsToSend->message);
						}
					}
					if(isset($json->email->send) && is_array($json->email->send)) {
						foreach($json->email->send as $emailToSend) {
							$this->w->Mail->sendMail($emailToSend->to, $emailToSend->from, $emailToSend->subject, $emailToSend->message);
						}
					}
				}
			}
		}
	}
	
	public function triggerSmsActions($from, $body) {
		$triggers = $this->getAllTriggers('sms');
		foreach($triggers as $trigger) {
			$json = json_decode($trigger['trigger_setup']);
			if(!empty($json)) {
				if(!empty($json->sms->receive) && is_array($json->sms->receive)) {
					foreach($json->sms->receive as $entry) {
						if($entry->from == '*' || $entry->from = $from) {
							if(empty($entry->message) || preg_match($entry->message, $body)) {
								$this->triggerActions($trigger['id']);
								break;//Only run once per trigger
							}
						}
					}
				}
			}
		}
	}
	
	public function getAllTriggers($type) {
		$_config_object = new SmsConfiguration($this->w);
		$t = $_config_object->getDbTableName();
		$result = $this->_db->get($t)
			->select('sms_trigger.trigger_setup')
			->where(array(
				$t.'.is_deleted' => 0,
				$t.'.enabled' => 1,
				'sms_trigger.trigger_type' => $type
			))
			->leftJoin("sms_trigger ON sms_trigger.configuration_id = $t.id")
			//->leftJoin("sms_action ON sms_trigger.configuration_id = $t.id")
			->fetchAll();
		return $result;
	}
	
	public function getConfigurations() {
		return $this->getObjects("SmsConfiguration",array("is_deleted" => 0));
	}
	
	public function getConfiguration($id) {
		return $this->getObject("SmsConfiguration", $id);
	}
	
	public function getAction($id) {
		return $this->getObject("SmsAction", $id);
	}
	
	public function getTrigger($id) {
		return $this->getObject("SmsTrigger", $id);
	}
	
	public function navigation(Web $w, $title = null, $prenav = null) {
        if ($title) {
            $w->ctx("title", $title);
        }
		
        $nav = $prenav ? $prenav : array();
        if ($w->Auth->loggedIn()) {
            $w->menuLink("sms/log", "SMS Log", $nav);
        }
		
        $w->ctx("navigation", $nav);
        return $nav;
    }
}
	