<?php
namespace RefugesInfo\trace\mcp;

class main_module
{
	public function main($id, $mode)
	{
		global $phpbb_container;

		/** @var \RefugesInfo\trace\controller\mcp_controller $mcp_controller */
		$mcp_controller = $phpbb_container->get('refugesinfo.trace.controller.mcp');
		$this->tpl_name = 'mcp_trace_body';
		$this->page_title = 'MCP_TRACE_TITLE';
		$mcp_controller->set_page_url($this->u_action);
		$mcp_controller->display_options();
	}
}
