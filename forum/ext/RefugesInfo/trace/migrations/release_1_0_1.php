<?php
namespace RefugesInfo\trace\migrations;

class release_1_0_1 extends \phpbb\db\migration\migration
{
	public function update_schema()
	{
		return [
			// Crée la table minimum, les colonnes utiles seront upgradées dans event/listener
			'add_tables' => [
				'trace_requettes' => [
					'COLUMNS' => [
						'trace_id'	=> ['UINT', NULL, 'auto_increment'],
					],
					'PRIMARY_KEY' => 'trace_id',
				],
			],
		];
	}

	public function update_data()
	{
		return [
			['module.add', [
				'mcp',
				0,
				'MCP_TRACE_TITLE'
			]],

			['module.add', [
				'mcp',
				'MCP_TRACE_TITLE',
				[
					'module_basename'	=> '\RefugesInfo\trace\mcp\main_module',
					'modes'				=> ['front'],
				],
			]],
		];
	}
}
