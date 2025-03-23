<?php
namespace RefugesInfo\trace\migrations;

class release_1_0_1 extends \phpbb\db\migration\migration
{
	public function update_schema()
	{
		return [
			'add_tables' => [
				'trace_requettes' => [
					'COLUMNS' => [
						'trace_id' => ['UINT', NULL, 'auto_increment'],
						'appel' => ['CHAR:128', NULL],
						'ext_error' => ['TEXT', NULL],
						'uri' => ['TEXT', NULL],
						'ip' => ['CHAR:64', NULL],
						'host' => ['CHAR:255', NULL],
						'asn' => ['CHAR:128', NULL],
						'user_agent' => ['CHAR:255', NULL],
						'language' => ['CHAR:128', NULL],
						'browser_operator' => ['CHAR:128', NULL],
						'date' => ['CHAR:64', NULL],
						'topic_id' => ['UINT', NULL],
						'post_id' => ['UINT', NULL],
						'id_point' => ['UINT', NULL],
						'id_commentaire' => ['UINT', NULL],
						'title' => ['CHAR:255', NULL],
						'text' => ['TEXT', NULL],
						'user_id' => ['UINT', NULL],
						'user_name' => ['CHAR:128', NULL],
						'user_email' => ['CHAR:128', NULL],
						'user_lang' => ['CHAR:128', NULL],
						'user_timezone' => ['CHAR:64', NULL],
						'ip_enregistrement' => ['CHAR:64', NULL],
						'host_enregistrement' => ['CHAR:128', NULL],
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
