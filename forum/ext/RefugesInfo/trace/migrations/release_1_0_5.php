<?php
namespace RefugesInfo\trace\migrations;

class release_1_0_5 extends \phpbb\db\migration\migration
{
	static public function depends_on()
	{
		return array('\RefugesInfo\trace\migrations\release_1_0_4');
	}

	public function update_schema()
	{
		include __DIR__.'/config.php';
		$table_name = array_key_first($config['tables']);

		return [
			'add_index' => [
				$table_name => [
					'trace_id' => ['trace_id'],
					'topic_id' => ['topic_id'],
					'user_id' => ['user_id'],
					'ext_error' => ['ext_error'],
					'browser_operator' => ['browser_operator'],
				],
			],
		];
	}
}
