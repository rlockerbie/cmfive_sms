<?php
/**
 * SmsConfiguration class
 * 
 * @author Robert Lockerbie, June 2016
 */
class SmsSms extends DbObject {
	
	public $message;
	public $mobile;
	public $sms_type;
	public $message_sid;
	public $processed;
	public $status;
	public $dt_created;
	
	/**
	 * Generate label to show this record in select inputs
	 * @return string
	 */
	public function getSelectOptionTitle() {
		return $this->title;
	}
	
	/**
	 * Generate value to use for this record in select inputs
	 * @return string
	 */
	public function getSelectOptionValue() {
		return $this->id;
	}
	
	/**
	 * Generate text to show this record in search results  
	 * @return string
	 */
	public function printSearchTitle() {
		return $this->title;
	}
	
	/**
	 * Generate a link to show this form
	 * @return string
	 */
	public function printSearchUrl() {
		return "/sms/show/" . $this->id;
	}
	
}