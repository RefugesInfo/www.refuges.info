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
		];
	}

	public function filter ($event) {
		global $request, $language, $user;

		$post = $request->get_super_global(\phpbb\request\request_interface::POST);

		// Includes language files of this extension
		$ns = explode ('\\', __NAMESPACE__);
		$language->add_lang ('common', $ns[0].'/'.$ns[1]);

		// Générate an error if JS is not enabled
		if ($post['sid'] != $user->session_id) {
			$error = $event['error'];
			$error[] = $language->lang (
				$event['mode'] ? 'MESSAGE_REJECTED' : 'ACCOUNT_REJECTED'
			);
			$event['error'] = $error;
		}
	}
}
