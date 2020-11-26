<?php

namespace cleantalk\antispam\cron\task;

class cleantalk_antispam_sfw_logs_send extends \phpbb\cron\task\base
{

	protected $config;

	/* @var \cleantalk\antispam\model\main_model */
	protected $main_model;

	public function __construct(\phpbb\config\config $config, \cleantalk\antispam\model\main_model $main_model)
	{
		$this->config = $config;
		$this->main_model = $main_model;
	}
		
	public function run()
	{
		$this->main_model->sfw_send_logs($this->config['cleantalk_antispam_apikey']);
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

