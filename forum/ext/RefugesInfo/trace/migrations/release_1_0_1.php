<?php
namespace RefugesInfo\trace\migrations;

class release_1_0_1 extends \phpbb\db\migration\migration
{
	public function update_schema()
	{
		include __DIR__.'/config.php';

		// Initial creation
		return [
			'add_tables' => $config['tables'],
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
