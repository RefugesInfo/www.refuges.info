<?php

namespace cleantalk\antispam\cron\task;

class cleantalk_antispam_sfw_logs_send extends \phpbb\cron\task\base
{

	protected $config;

	/* @var \cleantalk\antispam\model\CleantalkSFW */
	protected $cleantalk_sfw;

	public function __construct(\phpbb\config\config $config, \cleantalk\antispam\model\CleantalkSFW $cleantalk_sfw)
	{
		$this->config = $config;
		$this->cleantalk_sfw = $cleantalk_sfw;
	}
		
	public function run()
	{
		$this->cleantalk_sfw->send_logs($this->config['cleantalk_antispam_apikey']);
		$this->config->set('cleantalk_antispam_sfw_logs_send_last_gc', time());			

	}
	
	// Is allow to run?
	public function is_runnable()
	{	
		return ($this->config['cleantalk_antispam_sfw_enabled'] && $this->config['cleantalk_antispam_key_is_ok']);
	}
	
	// Next run
	public function should_run()
	{
		return (int)$this->config['cleantalk_antispam_sfw_logs_send_last_gc'] < time() - (int)$this->config['cleantalk_antispam_sfw_logs_send_gc'];
	}
	
}

