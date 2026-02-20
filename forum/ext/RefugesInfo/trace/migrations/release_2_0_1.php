<?php
namespace RefugesInfo\trace\migrations;

class release_2_0_1 extends \phpbb\db\migration\migration
{
  // Desactivate & supress ext data,  clean phpbb3_ext & phpbb3_modules
  public function update_schema()
  {
    // Initial creation
    return [
      'add_tables' => 'trace_requettes',
      'add_columns' => [
        'trace_requettes' => [
          'trace_id' => ['UINT', NULL, 'auto_increment'],
          'ext_error' => ['TEXT', NULL],
          'to_check' => ['UINT', NULL],

          'topic_id' => ['UINT', NULL],
          'post_id' => ['UINT', NULL],
          'id_point' => ['UINT', NULL],
          'id_commentaire' => ['UINT', NULL],
          'title' => ['CHAR:255', NULL],
          'text' => ['TEXT', NULL],
          'date' => ['CHAR:64', NULL],

          'uri' => ['TEXT', NULL],
          'host' => ['CHAR:255', NULL],
          'appel' => ['CHAR:128', NULL],
          'user_agent' => ['CHAR:255', NULL],
          'language' => ['CHAR:128', NULL],
          'browser_locale' => ['CHAR:128', NULL],
          'browser_timezone' => ['CHAR:128', NULL],
          'browser_operator' => ['CHAR:128', NULL],
          'referer' => ['CHAR:255', NULL],
          'browser_referer' => ['CHAR:255', NULL],

          'user_id' => ['UINT', NULL],
          'user_name' => ['CHAR:128', NULL],
          'user_email' => ['CHAR:128', NULL],
          'user_lang' => ['CHAR:128', NULL],
          'user_timezone' => ['CHAR:64', NULL],
          'ip_enregistrement' => ['CHAR:64', NULL],
          'host_enregistrement' => ['CHAR:128', NULL],
          'creator_id' => ['UINT', NULL],
          'creator_name' => ['CHAR:128', NULL],

          'ip' => ['CHAR:64', NULL],
          'asn_id' => ['CHAR:32', NULL],
          'asn_name' => ['CHAR:128', NULL],
          'country_name' => ['CHAR:128', NULL],
          'city' => ['CHAR:128', NULL],
        ],
      ],
      'add_index' => [
        'trace_requettes' => [
          'trace_id' => ['trace_id'],
          'ext_error' => ['ext_error'],
          'to_check' => ['to_check'],
          'uri' => ['uri'],

          'topic_id' => ['topic_id'],
          'post_id' => ['post_id'],
          'user_id' => ['user_id'],
          'id_point' => ['id_point'],
          'id_commentaire' => ['id_commentaire'],
          'asn_id' => ['asn_id'],
          'browser_operator' => ['browser_operator'],
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
          'module_basename'  => '\RefugesInfo\trace\mcp\main_module',
          'modes'        => ['front'],
        ],
      ]],
    ];
  }
}
