<?php
namespace RefugesInfo\trace\controller;

class mcp_controller
{
	public function set_page_url($u_action)
	{
		global $request;

		$this->u_action = htmlspecialchars_decode ($u_action);
	}

	public function display_options() {
		global $template, $phpbb_dispatcher;

		// Set get variables for display in the template
		$template->assign_var('U_MCP_ACTION', str_replace ('&mode=front', '', $this->u_action));

		// Hook ext/RefugesInfo/trace/listener.php
		$vars = [];
		extract($phpbb_dispatcher->trigger_event('refugesinfo.trace.display_traces', compact($vars)));
	}
}
