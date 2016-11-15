<?php

class SmsInitialSmsMigration extends CmfiveMigration {

	public function up() {
		$column = parent::Column();
        $column->setName('id')
               ->setType('biginteger')
               ->setIdentity(true);
		//SMS
		if (!$this->hasTable("sms_sms")) {
			$this->table('sms_sms', [
				'id'          => false,
				'primary_key' => 'id'
			])->addColumn($column)
				->addColumn('message', 'string', ['limit' => 140])
				->addColumn('mobile', 'string', ['limit' => 12])
				->addColumn('sms_type', 'string', ['limit' => 12])
				->addColumn('processed', 'boolean')
				->addCmfiveParameters()
				->create();
		}
		//Configuration
		if (!$this->hasTable("sms_configuration")) {
			$this->table('sms_configuration', [
				'id'          => false,
				'primary_key' => 'id'
			])->addColumn($column)
				->addColumn('title', 'string', ['limit' => 200])
				->addColumn('description', 'string', ['limit' => 500])
				->addColumn('enabled', 'boolean')
				->addCmfiveParameters()
				->create();
		}
		//Rule
		if (!$this->hasTable("sms_action")) {
			$this->table('sms_action', [
				'id'          => false,
				'primary_key' => 'id'
			])->addColumn($column)
				->addColumn('configuration_id', 'biginteger')
				->addColumn('description', 'string', ['limit' => 500])
				->addColumn('action_type', 'string', ['limit' => 200])
				->addColumn('actions', 'text')
				->addCmfiveParameters()
				->create();
		}
		//Trigger
		if (!$this->hasTable("sms_trigger")) {
			$this->table('sms_trigger', [
				'id'          => false,
				'primary_key' => 'id'
			])->addColumn($column)
				->addColumn('configuration_id', 'biginteger')
				->addColumn('description', 'string', ['limit' => 500])
				->addColumn('trigger_type', 'string', ['limit' => 200])
				->addColumn('trigger_setup', 'text')
				->addCmfiveParameters()
				->create();
		}
	}

	public function down() {
		$this->hasTable("sms_sms") ? $this->dropTable('sms_sms') : null;
		$this->hasTable("sms_configuration") ? $this->dropTable('sms_configuration') : null;
		$this->hasTable("sms_action") ? $this->dropTable('sms_action') : null;
		$this->hasTable("sms_trigger") ? $this->dropTable('sms_trigger') : null;
	}

}
