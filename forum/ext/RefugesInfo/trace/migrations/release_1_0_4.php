<?php
namespace RefugesInfo\trace\migrations;

class release_1_0_4 extends \phpbb\db\migration\migration
{
	static public function depends_on()
	{
		return array('\RefugesInfo\trace\migrations\release_1_0_3');
	}

	public function update_schema()
	{
		include __DIR__.'/config.php';
		$table_name = array_key_first($config['tables']);

		return [
			'add_columns' => [
				$table_name => [
					'referer' => ['CHAR:255', NULL],
					'browser_referer' => ['CHAR:255', NULL],
					'browser_locale' => ['CHAR:128', NULL],
					'browser_timezone' => ['CHAR:128', NULL],
				],
			],
		];
	}
}
