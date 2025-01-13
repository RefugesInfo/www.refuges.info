<?php
namespace RefugesInfo\blockBotPosts\event;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;

if (!defined('IN_PHPBB')) exit;

class listener implements EventSubscriberInterface
{
	public function __construct(
	) {
		global $request;
		$this->server = $request->get_super_global(\phpbb\request\request_interface::SERVER);
		$this->get = $request->get_super_global(\phpbb\request\request_interface::GET);
		$this->post = $request->get_super_global(\phpbb\request\request_interface::POST);
	}

	static public function getSubscribedEvents () {
		return [
			'core.posting_modify_submission_errors' => 'filter', // posting.php 1403
			'core.ucp_register_data_before' => 'filter',
			'rmcgirr83.contactadmin.modify_data_and_error' => 'filter',
			'block_bot_posts.filter' => 'filter', // External API
		];
	}

	function filter($vars) {
		global $user, $config_wri;

		if ($this->post['sid'] != $user->session_id) {
			if ($vars['mode']) { // Post
				$error = $vars['error'];
				$error['POST_REJECTED'] = 'Your message has been rejected for security reasons.';
				$vars['error'] = $error;
			}
			elseif ($this->post['username']) // User creation
				trigger_error('Your account has been rejected for security reasons.');
		}
	}
}
