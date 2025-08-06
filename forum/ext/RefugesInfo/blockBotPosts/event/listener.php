<?php
namespace RefugesInfo\blockBotPosts\event;

use Symfony\Component\EventDispatcher\EventSubscriberInterface;
class listener implements EventSubscriberInterface
{
	static public function getSubscribedEvents () {
		return [
			'core.ucp_register_data_after' => 'filter', // ucp_register.php 265
			'core.posting_modify_submission_errors' => 'filter', // posting.php 1428
			'rmcgirr83.contactadmin.modify_data_and_error' => 'filter', // Extension contactadmin
			'block_bot_posts.filter' => 'filter', // External API
			'core.append_sid' => 'append_sid', // includes/functions.php 1543
		];
	}

	public function filter ($event) {
		global $request, $language, $user;

		$post = $request->get_super_global(\phpbb\request\request_interface::POST);

		// Includes language files of this extension
		$ns = explode ('\\', __NAMESPACE__);
		$language->add_lang ('common', $ns[0].'/'.$ns[1]);

		// Générate an error if JS is not enabled
		if (strlen($post['sid']) != strlen($user->session_id)) {
			$error = $event['error'];
			$error[] = $language->lang (
				$event['mode'] ? 'MESSAGE_REJECTED' : 'ACCOUNT_REJECTED'
			);
			$event['error'] = $error;
		}
	}

	// Do not add sid to urls if cookies not enabled
	public function append_sid ($event) {
		global $request, $config_wri;

		$this->server = $request->get_super_global(\phpbb\request\request_interface::SERVER);
		if (isset($config_wri['no_sid_urls']) &&
			!$this->server['HTTP_COOKIE'])
			$event['append_sid_overwrite'] = $event['url'];	
	}
}
