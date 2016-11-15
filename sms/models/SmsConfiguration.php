<?php
/**
 * SmsConfiguration class
 * 
 * @author Robert Lockerbie, June 2016
 */
class SmsConfiguration extends DbObject {
	
	public $title;
	public $description;
	public $enabled;
	
	public function getActions() {
		return $this->getObjects("SmsAction", ["configuration_id" => $this->id, "is_deleted" => 0]);
	}
	
	public function getTriggers() {
		return $this->getObjects("SmsTrigger", ["configuration_id" => $this->id, "is_deleted" => 0]);
	}
	
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