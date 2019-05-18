<?php

namespace cleantalk\antispam\cron\task;

class cleantalk_antispam_check_payment_status extends \phpbb\cron\task\base
{

	protected $config;

	public function __construct(\phpbb\config\config $config)
	{
		$this->config = $config;
	}
		
	public function run()
	{
		$result = \cleantalk\antispam\model\CleantalkHelper::noticePaidTill($this->config['cleantalk_antispam_apikey']);
		if(empty($result['error']))
		{
			$this->config->set('cleantalk_antispam_show_notice', ($result['show_notice']) ? $result['show_notice'] : 0);
			$this->config->set('cleantalk_antispam_renew',       ($result['renew']) ? $result['renew'] : 0);
			$this->config->set('cleantalk_antispam_trial',       ($result['trial']) ? $result['trial'] : 0);
			$this->config->set('cleantalk_antispam_user_token',  ($result['user_token']) ? $result['user_token'] : '');
			$this->config->set('cleantalk_antispam_spam_count',  ($result['spam_count']) ? $result['spam_count'] : 0);
			$this->config->set('cleantalk_antispam_moderate_ip', ($result['moderate_ip']) ? $result['moderate_ip'] : 0);
			$this->config->set('cleantalk_antispam_ip_license',  ($result['ip_license']) ? $result['ip_license'] : 0);
			$this->config->set('cleantalk_antispam_check_payment_status_last_gc', time());
		}

	}
	
	// Is allow to run?
	public function is_runnable()
	{	
		return true;
	}
	
	// Next run
	public function should_run()
	{
		return (int)$this->config['cleantalk_antispam_check_payment_status_last_gc'] < time() - (int)$this->config['cleantalk_antispam_check_payment_status_gc'];
	}
		
}

