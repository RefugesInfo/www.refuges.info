<?php
/**
*
* Contact admin extension for the phpBB Forum Software package.
*
* @copyright 2016 Rich McGirr (RMcGirr83)
* @license GNU General Public License, version 2 (GPL-2.0)
*
*/
namespace rmcgirr83\contactadmin\controller;

use phpbb\auth\auth;
use phpbb\config\config;
use phpbb\config\db_text;
use phpbb\controller\helper;
use phpbb\db\driver\driver_interface as db;
use phpbb\event\dispatcher_interface;
use phpbb\language\language;
use phpbb\log\log;
use phpbb\request\request;
use phpbb\template\template;
use phpbb\user;
use rmcgirr83\contactadmin\core\contactadmin as contactadmin;
use phpbb\captcha\factory as captcha_factory;
use phpbb\exception\http_exception;

/**
* Main controller
*/
class main_controller
{
	/** @var auth */
	protected $auth;

	/** @var config */
	protected $config;

	/** @var db_text */
	protected $db_text;

	/** @var helper */
	protected $helper;

	/** @var db */
	protected $db;

	/** @var dispatcher_interface */
	protected $dispatcher_interface;

	/** @var language */
	protected $language;

	/** @var log */
	protected $log;

	/* @var request */
	protected $request;

	/** @var template */
	protected $template;

	/** @var user */
	protected $user;

	/* @var contactadmin */
	protected $contactadmin;

	/** @var captcha_factory */
	protected $captcha_factory;

	/** @var string root_path */
	protected $root_path;

	/** @var string php_ext */
	protected $php_ext;

	/** @var array contact_constants */
	protected $contact_constants;

	/**
	* Constructor
	*
	* @param auth						$auth					Auth object
	* @param config						$config					Config object
	* @param db_text 					$db_text				Config text object
	* @param helper						$helper					Controller helper object
	* @param db							$db						Database object
	* @param dispatcher_interface		$dispatcher_interface	Dispatcher interface object
	* @param language					$language				Language object
	* @param log						$log					Log object
	* @param request					$request				Request object
	* @param template					$template				Template object
	* @param user						$user					User object
	* @param contactadmin				$contactadmin			Methods for the extension
	* @param captcha_factory			$captcha_factory		Captcha object
	* @param string						$root_path				phpBB root path
	* @param string						$php_ext				phpEx
	* @param array						$contact_constants		constants for the extension
	* @access public
	*/
	public function __construct(
			auth $auth,
			config $config,
			db_text $db_text,
			helper $helper,
			db $db,
			dispatcher_interface $dispatcher_interface,
			language $language,
			log $log,
			request $request,
			template $template,
			user $user,
			contactadmin $contactadmin,
			captcha_factory $captcha_factory,
			string $root_path,
			string $php_ext,
			array $contact_constants)
	{
		$this->auth = $auth;
		$this->config = $config;
		$this->db_text = $db_text;
		$this->helper = $helper;
		$this->db = $db;
		$this->dispatcher = $dispatcher_interface;
		$this->language = $language;
		$this->log = $log;
		$this->request = $request;
		$this->template = $template;
		$this->user = $user;
		$this->contactadmin = $contactadmin;
		$this->captcha_factory = $captcha_factory;
		$this->root_path = $root_path;
		$this->php_ext = $php_ext;
		$this->contact_constants = $contact_constants;
	}

	/**
	 * Display the form
	 *
	 * @access public
	 */
	public function displayform()
	{
		$this->language->add_lang(['ucp', 'posting']);
		$this->language->add_lang('contact', 'rmcgirr83/contactadmin');

		// move this from the constructor so the query isn't run on every page
		$contact_reasons = $this->db_text->get_array(['contactadmin_reasons']);

		//convert the reasons string into an array
		if (!empty($contact_reasons['contactadmin_reasons']))
		{
			$contact_reasons = explode("\n",$contact_reasons['contactadmin_reasons']);
		}
		else
		{
			$contact_reasons = [];
		}

		if (!empty($this->user->data['is_bot']))
		{
			throw new http_exception(401, 'NOT_AUTHORISED');
		}

		if (!$this->config['email_enable'] && $this->config['contactadmin_method'] == $this->contact_constants['CONTACT_METHOD_EMAIL'])
		{

			// add an entry into the error log
			$this->log->add('admin', $this->user->data['user_id'], $this->user->ip, 'LOG_CONTACT_EMAIL_INVALID',  time());

			$message = $this->language->lang('CONTACT_MAIL_DISABLED', '<a href="mailto:' . htmlspecialchars($this->config['board_contact']) . '">', '</a>');

			return $this->helper->message($message);
		}

		// check to make sure the contact forum is legit for posting
		// has to be able to accept posts
		if ($this->config['contactadmin_method'] == $this->contact_constants['CONTACT_METHOD_POST'])
		{
			// check to make sure forum is, ermmm, forum
			// not link and not cat
			$this->contactadmin->contact_check('contact_check_forum', $this->config['contactadmin_forum']);
		}
		else if (in_array($this->config['contactadmin_method'], [$this->contact_constants['CONTACT_METHOD_POST'], $this->contact_constants['CONTACT_METHOD_PM']]))
		{
			// quick check to ensure our "bot" is good
			$this->contactadmin->contact_check('contact_check_bot', false, $this->config['contactadmin_bot_user']);
		}

		// Only have contact CAPTCHA confirmation for guests, if the option is enabled
		if ($this->user->data['user_id'] != ANONYMOUS && $this->config['contactadmin_confirm_guests'])
		{
			$this->config['contactadmin_confirm'] = false;
		}

		// our data array
		$data = [
			'username'			=> ($this->user->data['user_id'] != ANONYMOUS) ?  $this->user->data['username'] : $this->request->variable('username', '', true),
			'email'				=> ($this->user->data['user_id'] != ANONYMOUS) ? $this->user->data['user_email'] : strtolower($this->request->variable('email', '')),
			'email_confirm'		=> ($this->user->data['user_id'] != ANONYMOUS) ? $this->user->data['user_email'] : strtolower($this->request->variable('email_confirm', '')),
			'contact_reason'	=> $this->request->variable('contact_reason', '', true),
			'contact_subject'	=> $this->request->variable('contact_subject', '', true),
			'contact_message'	=> $this->request->variable('message', '', true),
		];

		add_form_key('contactadmin');

		// Visual Confirmation - The CAPTCHA kicks in here
		if ($this->config['contactadmin_confirm'])
		{
			$captcha = $this->captcha_factory->get_instance($this->config['captcha_plugin']);
			$captcha->init($this->contact_constants['CONFIRM_CONTACT']);
		}

		if ($this->request->is_set_post('submit'))
		{
			$error = [];

			// check form
			if (!check_form_key('contactadmin'))
			{
				$error[] = $this->language->lang('FORM_INVALID');
			}

			if (!function_exists('validate_data'))
			{
				include($this->root_path . 'includes/functions_user.' . $this->php_ext);
			}

			// let's check our inputs against the database..but only for unregistered user and only if so set in ACP
			if (empty($this->user->data['is_registered']) && ($this->config['contactadmin_username_chk'] || $this->config['contactadmin_email_chk']))
			{
				if ($this->config['contactadmin_username_chk'] && $this->config['contactadmin_email_chk'])
				{
					$error = validate_data($data, [
						'username'			=> [
							['string', false, $this->config['min_name_chars'], $this->config['max_name_chars']],
							['username', '']],
						'email'				=> [
							['string', false, 6, 60],
							['user_email']],
						]);
				}
				else if ($this->config['contactadmin_username_chk'])
				{
					$error = validate_data($data, [
						'username'			=> [
							['string', false, $this->config['min_name_chars'], $this->config['max_name_chars']],
							['username', '']],
						]);
				}
				else
				{
					$error = validate_data($data, [
						'email'				=> [
							['string', false, 6, 60],
							['user_email']],
					]);
				}
			}

			// always check email addresses for validity but only if setting in ACP isn't set and only for non-registered users
			if (!$this->config['contactadmin_email_check'] && empty($this->user->data['is_registered']))
			{
				$validate_email = phpbb_validate_email($data['email']);
				if ($validate_email)
				{
					$error[] = $validate_email . '_EMAIL';
				}
			}

			// Replace "error" strings with their real, localised form
			$error = array_map(array($this->language, 'lang'), $error);

			// always check for a username
			if (utf8_clean_string($data['username']) === '' && !$this->config['contactadmin_username_chk'])
			{
				$error[] = $this->language->lang('CONTACT_NO_NAME');
			}

			// confirm emails match
			if (strtolower($data['email']) != strtolower($data['email_confirm']))
			{
				$error[] = $this->language->lang('WRONG_DATA_EMAIL');
			}

			// Validate message and subject
			if (utf8_clean_string($data['contact_subject']) === '' && empty($data['contact_reason']))
			{
				$error[] = $this->language->lang('CONTACT_NO_SUBJ');
			}

			// must have a valid reason if reasons are set
			if (!empty($contact_reasons) && $data['contact_reason'] == $this->language->lang('REASON_EXPLAIN'))
			{
				$error[] = $this->language->lang('REASON_ERROR');
			}

			// ensure we have a message
			if (utf8_clean_string($data['contact_message']) === '')
			{
				$error[] = $this->language->lang('CONTACT_NO_MSG');
			}

			// Check for Privacy policy check
			if (empty($this->user->data['is_registered']) && $this->config['contactadmin_gdpr'] && !$this->request->is_set('gdpr'))
			{
				$error[] = $this->user->lang('CONTACT_PRIVACYPOLICY_ERROR');
			}

			// CAPTCHA check
			if ($this->config['contactadmin_confirm'] && !$captcha->is_solved())
			{
				$vc_response = $captcha->validate($data);
				if ($vc_response !== false)
				{
					$error[] = $vc_response;
				}

				if ($this->config['contactadmin_max_attempts'] && $captcha->get_attempt_count() > $this->config['contactadmin_max_attempts'])
				{
					$error[] = $this->language->lang('TOO_MANY_CONTACT_TRIES');
				}
			}
			// pretty up the user name..but only for non emails
			if (in_array($this->config['contactadmin_method'], [$this->contact_constants['CONTACT_METHOD_PM'], $this->contact_constants['CONTACT_METHOD_POST']]))
			{
				$url = generate_board_url() . '/memberlist.' . $this->php_ext . '?mode=viewprofile&u=' . $this->user->data['user_id'];
				$color = $this->user->data['user_colour'] ? '[color=#' . $this->user->data['user_colour'] . ']' . $this->user->data['username'] . '[/color]' : $this->user->data['username'];
				$user_name = !empty($this->user->data['is_registered']) ? '[url=' . $url . ']' . $color . '[/url]' : $data['username'];
			}
			else
			{
				$user_name = $data['username'];
			}

			if (!in_array($this->config['contactadmin_method'], [$this->contact_constants['CONTACT_METHOD_EMAIL']]))
			{
				// change the users stuff
				if ($this->config['contactadmin_bot_poster'] == $this->contact_constants['CONTACT_POST_ALL'] || ($this->config['contactadmin_bot_poster'] == $this->contact_constants['CONTACT_POST_GUEST'] && empty($this->user->data['is_registered'])))
				{
					$contact_perms = $this->contactadmin->contact_change_auth($this->config['contactadmin_bot_user']);
					$data['username'] = $this->user->data['username'];
				}
				if (!function_exists('create_thumbnail'))
				{
					include($this->root_path . 'includes/functions_posting.' . $this->php_ext);
				}
				if (!class_exists('parse_message'))
				{
					include($this->root_path . 'includes/message_parser.' . $this->php_ext);
				}
				$message_parser = new \parse_message();
				// Parse Attachments - before checksum is calculated
				if ($this->config['contactadmin_method'] != $this->contact_constants['CONTACT_METHOD_PM'])
				{
					$message_parser->parse_attachments('fileupload', 'post', $this->config['contactadmin_forum'], true, false, false);
				}
				else
				{
					$message_parser->parse_attachments('fileupload', 'post', 0, true, false, false, true);
				}

				// pretty up the message for posts and pms
				$contact_message = censor_text(trim('[quote] ' . $data['contact_message'] . '[/quote]'));

				// there may not be a reason entered in the ACP...so change the template to reflect this
				if (!empty($data['contact_reason']))
				{
					$contact_message = $this->language->lang('CONTACT_TEMPLATE', $user_name, $data['email'], $this->user->ip, $data['contact_reason'], $contact_message);
				}
				else
				{
					$contact_message = $this->language->lang('CONTACT_TEMPLATE', $user_name, $data['email'], $this->user->ip, $data['contact_subject'], $contact_message);
				}

				$message_parser->message = $contact_message;

				// Grab md5 'checksum' of new message
				$message_md5 = md5($message_parser->message);

				if (count($message_parser->warn_msg))
				{
					$error[] = implode('<br />', $message_parser->warn_msg);
					$message_parser->warn_msg = [];
				}

				$message_parser->parse(true, true, true, true, false, true, true);
			}
			/**
			* Modify data and error strings
			*
			* @event rmcgirr83.contactadmin.modify_data_and_error
			* @var array	error			Error strings
			* @var array	data			An array with data
			* @since 1.0.0
			*/
			$vars = ['error', 'data'];
			extract($this->dispatcher->trigger_event('rmcgirr83.contactadmin.modify_data_and_error', compact($vars)));

			// no errors, let's proceed
			if (!sizeof($error))
			{
				if ($this->config['contactadmin_method'] != $this->contact_constants['CONTACT_METHOD_POST'])
				{
					$contact_users = $this->contactadmin->admin_array();
				}

				$subject = (!empty($data['contact_reason'])) ? $data['contact_reason'] : $data['contact_subject'];
				if (in_array($this->config['contactadmin_method'], [$this->contact_constants['CONTACT_METHOD_POST'], $this->contact_constants['CONTACT_METHOD_PM']]))
				{
					$subject = ($this->user->data['user_id'] != ANONYMOUS) ? $subject . ' - ' . $this->language->lang('CONTACT_REGISTERED') : $subject . ' -  ' . $this->language->lang('CONTACT_GUEST');
				}

				switch ($this->config['contactadmin_method'])
				{
					case $this->contact_constants['CONTACT_METHOD_PM']:
						if (!function_exists('submit_pm'))
						{
							include($this->root_path . 'includes/functions_privmsgs.' . $this->php_ext);
						}
						$pm_data = [
							'from_user_id'		=> (int) $this->user->data['user_id'],
							'icon_id'			=> 0,
							'from_user_ip'		=> $this->user->data['user_ip'],
							'from_username'		=> (string) $this->user->data['username'],
							'enable_sig'		=> false,
							'enable_bbcode'		=> true,
							'enable_smilies'	=> true,
							'enable_urls'		=> true,
							'bbcode_bitfield'	=> $message_parser->bbcode_bitfield,
							'bbcode_uid'		=> $message_parser->bbcode_uid,
							'message'			=> $message_parser->message,
							'attachment_data'	=> $message_parser->attachment_data,
							'filename_data'		=> $message_parser->filename_data,
						];

						// Loop through our list of users
						$size = count($contact_users);
						for ($i = 0; $i < $size; $i++)
						{
							$pm_data['address_list'] = ['u' => [$contact_users[$i]['user_id'] => 'to']];
							submit_pm('post', $subject, $pm_data, false);
						}

					break;

					case $this->contact_constants['CONTACT_METHOD_POST']:

						$sql = 'SELECT forum_name
							FROM ' . FORUMS_TABLE . '
							WHERE forum_id = ' . (int) $this->config['contactadmin_forum'];
						$result = $this->db->sql_query($sql);
						$forum_name = $this->db->sql_fetchfield('forum_name');
						$this->db->sql_freeresult($result);

						$post_data = [
							'forum_id'			=> (int) $this->config['contactadmin_forum'],
							'icon_id'			=> false,

							'enable_sig'		=> true,
							'enable_bbcode'		=> true,
							'enable_smilies'	=> true,
							'enable_urls'		=> true,

							'message_md5'		=> (string) $message_md5,

							'bbcode_bitfield'	=> $message_parser->bbcode_bitfield,
							'bbcode_uid'		=> $message_parser->bbcode_uid,
							'message'			=> $message_parser->message,
							'attachment_data'	=> $message_parser->attachment_data,
							'filename_data'		=> $message_parser->filename_data,

							'post_edit_locked'	=> 0,
							'topic_title'		=> $subject,
							'notify_set'		=> false,
							'notify'			=> true,
							'post_time'			=> time(),
							'forum_name'		=> $forum_name,
							'enable_indexing'	=> true,

							'force_approved_state'	=> ITEM_APPROVED,
							'force_visibility' => ITEM_APPROVED,
						];

						$poll = [];

						// Submit the post!
						submit_post('post', $subject, $data['username'], POST_NORMAL, $poll, $post_data);

					break;

					case $this->contact_constants['CONTACT_METHOD_EMAIL']:
					default:

						// Send using email (default)..first remove all bbcodes
						$bbcode_remove = '#\[/?[^\[\]]+\]#';
						$message = censor_text($data['contact_message']);
						$message = preg_replace($bbcode_remove, '', $message);
						$message = htmlspecialchars_decode($message);

						if (!class_exists('messenger'))
						{
							include($this->root_path . 'includes/functions_messenger.' . $this->php_ext);
						}
						// Some of the code borrowed from includes/ucp/ucp_register.php
						// The first argument of messenger::messenger() decides if it uses the message queue (which we will not)
						$messenger = new \messenger(false);

						// Email headers
						$messenger->headers('X-AntiAbuse: Board servername - ' . $this->config['server_name']);
						$messenger->headers('X-AntiAbuse: User_id - ' . $this->user->data['user_id']);
						$messenger->headers('X-AntiAbuse: Username - ' . $this->user->data['username']);
						$messenger->headers('X-AntiAbuse: User IP - ' . $this->user->ip);

						$contact_name = htmlspecialchars_decode($this->config['board_contact_name']);
						$board_contact = (($contact_name !== '') ? '"' . mail_encode($contact_name) . '" ' : '') . '<' . $this->config['board_contact'] . '>';

						// build an array of all lang directories for the extension and check to make sure we have the lang available that is being chosen
						// if the lang isn't present then errors will present themselves due to no email template found
						$dir_array = $this->contactadmin->dir_to_array($this->root_path .'ext/rmcgirr83/contactadmin/language');

						$size = count($contact_users);
						// Loop through our list of users
						for ($i = 0; $i < $size; $i++)
						{
							$tz = (!empty($contact_users[$i]['user_timezone']) ? $contact_users[$i]['user_timezone'] : $this->config['board_timezone']);
							$iso = (!empty($contact_users[$i]['user_lang']) ? $contact_users[$i]['user_lang'] : $this->config['default_lang']);
							$date_format =(!empty($contact_users[$i]['user_dateformat']) ? $contact_users[$i]['user_dateformat'] : $this->config['default_dateformat']);
							$time = time();

							// use PHP IntlDateFormatter if possible
							$intl_installed = extension_loaded('intl');
							if ($intl_installed)
							{
								$fmt = new \IntlDateFormatter(
									$iso,
									\IntlDateFormatter::RELATIVE_FULL,
									\IntlDateFormatter::FULL,
									$tz,
									\IntlDateFormatter::GREGORIAN);
								$date = $fmt->format($time);
							}
							else
							{
								$date = new \DateTime("now", new \DateTimeZone($tz));
								$date = $date->format($date_format);
							}

							// now check if the email template may exist.  Can't be helped if there is a lang dir and no email dir
							// use en if not exist
							$contact_users[$i]['user_lang'] =  (in_array($contact_users[$i]['user_lang'], $dir_array)) ? $contact_users[$i]['user_lang'] : 'en';
							$messenger->template('@rmcgirr83_contactadmin/contact', $contact_users[$i]['user_lang']);

							$messenger->to($contact_users[$i]['user_email'], $contact_users[$i]['username']);
							$messenger->im($contact_users[$i]['user_jabber'], $contact_users[$i]['username']);
							$messenger->from($board_contact);
							$messenger->replyto($data['email']);
							$messenger->subject($subject);

							$messenger->assign_vars([
								'ADM_USERNAME'	=> htmlspecialchars_decode($contact_users[$i]['username']),
								'SITENAME'		=> htmlspecialchars_decode($this->config['sitename']),
								'USER_IP'		=> $this->user->ip,
								'USERNAME'		=> $data['username'],
								'USER_EMAIL'	=> htmlspecialchars_decode($data['email']),
								'DATE'			=> $date,

								'SUBJECT'		=> $subject,
								'MESSAGE'		=> $message,
							]);

							$messenger->send($contact_users[$i]['user_notify_type']);
						}

						// Save emails in the queue to prevent timeouts
						$messenger->save_queue();

					break;
				}
				//reset captcha
				if ($this->config['contactadmin_confirm'] && (isset($captcha) && $captcha->is_solved() === true))
				{
					$captcha->reset();
				}

				// restore permissions
				if (isset($contact_perms))
				{
					//Restore user
					$this->contactadmin->contact_change_auth('', 'restore', $contact_perms);
				}

				$message = $this->language->lang('CONTACT_MSG_SENT') . '<br><br>' . $this->language->lang('RETURN_INDEX', '<a href="' . append_sid("{$this->root_path}index.$this->php_ext") . '">', '</a>');

				return $this->helper->message($message);
			}
		}
		// Visual Confirmation - Show images
		$s_hidden_fields = [];

		if ($this->config['contactadmin_confirm'])
		{
			$s_hidden_fields = array_merge($s_hidden_fields, $captcha->get_hidden_fields());
		}
		$s_hidden_fields = build_hidden_fields($s_hidden_fields);

		if ($this->config['contactadmin_confirm'] && !$captcha->is_solved())
		{
			$this->template->assign_var('CONTACT_ADMIN_CAPTCHA_TEMPLATE', $captcha->get_template());
		}

		$form_enctype = (@ini_get('file_uploads') == '0' || strtolower(@ini_get('file_uploads')) == 'off') ? false : ' enctype="multipart/form-data"';
		$attachment_allowed = false;

		// the forum allows attachments?
		$post_attachments_allowed = $this->config['allow_attachments'] ? true : false;
		$pm_attachments_allowed = $post_attachments_allowed && $this->config['allow_pm_attach'] ?  true : false;

		// forum and contact form allows attachments
		if ($post_attachments_allowed && $this->config['contactadmin_method'] == $this->contact_constants['CONTACT_METHOD_POST'])
		{
			$attachment_allowed = ($this->config['allow_attachments'] && $this->config['contactadmin_attach_allowed'] && $form_enctype) ? true : false;
		}
		// the forum allows attachments in PMs?
		if ($pm_attachments_allowed && $this->config['contactadmin_method'] == $this->contact_constants['CONTACT_METHOD_PM'])
		{
			$attachment_allowed = ($this->config['contactadmin_attach_allowed'] && $this->config['allow_pm_attach'] && $form_enctype) ? true : false;
		}

		// restore permissions
		if (isset($contact_perms))
		{
			//Restore user
			$this->contactadmin->contact_change_auth('', 'restore', $contact_perms);
		}

		$l_admin_info = $this->db_text->get('contact_admin_info');
		if ($l_admin_info)
		{
			$contactadmin_data			= $this->db_text->get_array([
				'contact_admin_info',
				'contact_admin_info_uid',
				'contact_admin_info_bitfield',
				'contact_admin_info_flags',
			]);

			$l_admin_info = generate_text_for_display(
				$contactadmin_data['contact_admin_info'],
				$contactadmin_data['contact_admin_info_uid'],
				$contactadmin_data['contact_admin_info_bitfield'],
				$contactadmin_data['contact_admin_info_flags']
			);
		}

		$privacy_policy_url = generate_board_url() . '/ucp.' . $this->php_ext . '?mode=privacy';

		$this->template->assign_vars([
			'USERNAME'			=> isset($data['username']) ? $data['username'] : '',
			'EMAIL'				=> isset($data['email']) ? $data['email'] : '',
			'EMAIL_CONFIRM'		=> isset($data['email_confirm']) ? $data['email_confirm'] : '',
			'CONTACT_REASONS'	=> $this->contactadmin->contact_make_select($contact_reasons, $data['contact_reason']),
			'CONTACT_SUBJECT'	=> isset($data['contact_subject']) ? $data['contact_subject'] : '',
			'CONTACT_MESSAGE'	=> isset($data['contact_message']) ? $data['contact_message'] : '',
			'CONTACT_INFO'		=> $l_admin_info,

			'PRIVACY_POLICY_URL'	=> $privacy_policy_url,
			'L_CONTACT_YOUR_NAME_EXPLAIN'	=> $this->config['contactadmin_username_chk'] ? $this->language->lang($this->config['allow_name_chars'] . '_EXPLAIN', $this->config['min_name_chars'], $this->config['max_name_chars']) : $this->language->lang('CONTACT_YOUR_NAME_EXPLAIN'),

			'S_ATTACH_BOX'			=> ($this->config['contactadmin_method'] == $this->contact_constants['CONTACT_METHOD_EMAIL']) ? false : $attachment_allowed,
			'S_FORM_ENCTYPE'		=> $form_enctype,
			'S_CONFIRM_REFRESH'		=> ($this->config['contactadmin_confirm']) ? true : false,
			'S_EMAIL'				=> ($this->config['contactadmin_method'] == $this->contact_constants['CONTACT_METHOD_EMAIL']) ? true : false,
			'S_CONTACT_ADMIN'		=> true,
			'S_HIDDEN_FIELDS'		=> $s_hidden_fields,
			'S_ERROR'				=> (isset($error) && count($error)) ? implode('<br />', $error) : '',
			'S_CONTACT_ACTION'		=> $this->helper->route('rmcgirr83_contactadmin_displayform'),
			'S_CONTACT_GDPR'		=> ($this->config['contactadmin_gdpr'] && empty($this->user->data['is_registered'])) ? true : false,
		]);

		// Send all data to the template file
		return $this->helper->render('contactadmin_body.html', $this->language->lang('ACP_CAT_CONTACTADMIN'));
	}
}
