<?php
namespace RefugesInfo\trace\migrations;

class release_1_0_2 extends \phpbb\db\migration\migration
{
	static public function depends_on()
	{
		return array('\RefugesInfo\trace\migrations\release_1_0_1');
	}

	public function update_schema()
	{
		include __DIR__.'/config.php';
		$table_name = array_key_first($config['tables']);

		return [
			'add_columns' => [
				$table_name => [
					'country_name' => ['CHAR:128', NULL],
					'city' => ['CHAR:128', NULL],
				],
			],
		];
	}
}
