<?php
namespace RefugesInfo\trace\mcp;

class main_info
{
  public function module()
  {
    return [
      'filename' => '\RefugesInfo\trace\mcp\main_module',
      'title' => 'MCP_TRACE_TITLE',
      'modes' => [
        'front' => [
          'title' => 'MCP_TRACE',
          'auth' => 'ext_RefugesInfo/trace',
          'cat' => ['MCP_TRACE_TITLE'],
        ],
      ],
    ];
  }
}
