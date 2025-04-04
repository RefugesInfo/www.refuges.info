<?php
namespace RefugesInfo\trace\migrations;

class release_1_0_3 extends \phpbb\db\migration\migration
{
	static public function depends_on()
	{
		return array('\RefugesInfo\trace\migrations\release_1_0_2');
	}

	public function update_schema()
	{
		include __DIR__.'/config.php';
		$table_name = array_key_first($config['tables']);

		return [
			'add_columns' => [
				$table_name => [
					'asn_id' => ['CHAR:32', NULL],
					'asn_name' => ['CHAR:128', NULL],
				],
			],
		];
	}
}
