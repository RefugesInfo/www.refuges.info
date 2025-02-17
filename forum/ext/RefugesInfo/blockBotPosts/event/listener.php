<?php
namespace RefugesInfo\blockBotPosts\event;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;

if (!defined('IN_PHPBB')) exit;

use phpbb\request\request;
use phpbb\user;
use phpbb\language\language;

class listener implements EventSubscriberInterface
{
	public function __construct(
		request $request,
		user $user,
		language $language)
	{
		$this->post = $request->get_super_global(\phpbb\request\request_interface::POST);
		$this->user = $user;
		$this->language = $language;
	}
	static public function getSubscribedEvents () {
		return [
			'core.ucp_register_data_after' => 'filter', // ucp_register.php 265
			'core.posting_modify_submission_errors' => 'filter', // posting.php 1428
			'rmcgirr83.contactadmin.modify_data_and_error' => 'filter', // Extension contactadmin
			'block_bot_posts.filter' => 'filter', // External API
		];
	}

	public function filter ($event) {
		// Includes language files of this extension
		$ns = explode ('\\', __NAMESPACE__);
		$this->language->add_lang ('common', $ns[0].'/'.$ns[1]);

		// Générate an error if JS is not enabled
		if ($this->post['sid'] != $this->user->session_id) {
			$error = $event['error'];
			$error[] = $this->language->lang (
				$event['mode'] ? 'MESSAGE_REJECTED' : 'ACCOUNT_REJECTED'
			);
			$event['error'] = $error;
		}
	}
}
