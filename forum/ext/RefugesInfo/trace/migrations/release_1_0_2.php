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
		return [
			'add_columns' => [
				'trace_requettes' => [
					'country_name' => ['CHAR:128', NULL],
					'city' => ['CHAR:128', NULL],
				],
			],
		];
	}
}
