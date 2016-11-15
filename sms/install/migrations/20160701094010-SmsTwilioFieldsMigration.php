<?php

class SmsTwilioFieldsMigration extends CmfiveMigration {

	public function up() {
		// UP
		if ($this->hasTable("sms_sms") && !$this->table("sms_sms")->hasColumn("message_sid")) {
			$this->table("sms_sms")->addColumn('message_sid', 'string', ['limit' => 200])->save();
		}
		if ($this->hasTable("sms_sms") && !$this->table("sms_sms")->hasColumn("status")) {
			$this->table("sms_sms")->addColumn('status', 'string', ['limit' => 12])->save();
		}
	}

	public function down() {
		// DOWN
		$this->hasTable("sms_sms") && $this->table("sms_sms")->hasColumn("message_sid") ? $this->table("sms_sms")->removeColumn("message_sid") : null;
		$this->hasTable("sms_sms") && $this->table("sms_sms")->hasColumn("status") ? $this->table("sms_sms")->removeColumn("status") : null;
	}

}
