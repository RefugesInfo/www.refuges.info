<?php
/**
*
* Stop forum Spam extension for the phpBB Forum Software package.
*
* @copyright (c) 2015 Rich McGirr (RMcGirr83)
* @license GNU General Public License, version 2 (GPL-2.0)
*
*/

namespace rmcgirr83\stopforumspam\core;

/**
* ignore
**/
use phpbb\auth\auth;
use phpbb\config\config;
use phpbb\db\driver\driver_interface as db;
use phpbb\controller\helper;
use phpbb\language\language;
use phpbb\log\log;
use phpbb\request\request;
use phpbb\template\template;
use phpbb\user;
use rmcgirr83\stopforumspam\core\sfsgroups;
use rmcgirr83\stopforumspam\core\sfsapi;
use Symfony\Component\DependencyInjection\ContainerInterface;

use phpbb\exception\http_exception;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Generator\UrlGeneratorInterface;

class reporttosfs
{
	/** @var auth $auth */
	protected $auth;

	/** @var config $config */
	protected $config;

	/** @var db $db */
	protected $db;

	/** @var helper $helper */
	protected $helper;

	/** @var language $language */
	protected $language;

	/** @var log $log */
	protected $log;

	/** @var request $request */
	protected $request;

	/** @var template $template */
	protected $template;

	/** @var user $user */
	protected $user;

	/* @var sfsgroups $sfsgroups */
	protected $sfsgroups;

	/* @var sfsapi $sfsapi */
	protected $sfsapi;

	/** @var ContainerInterface */
	protected $container;

	/** @var string root_path */
	protected $root_path;

	/** @var string php_ext */
	protected $php_ext;

	public function __construct(
			auth $auth,
			config $config,
			db $db,
			helper $helper,
			language $language,
			log $log,
			request $request,
			template $template,
			user $user,
			sfsgroups $sfsgroups,
			sfsapi $sfsapi,
			ContainerInterface $container,
			string $root_path,
			string $php_ext)
	{
		$this->auth = $auth;
		$this->config = $config;
		$this->helper = $helper;
		$this->db = $db;
		$this->language = $language;
		$this->log = $log;
		$this->request = $request;
		$this->template = $template;
		$this->user = $user;
		$this->sfsgroups = $sfsgroups;
		$this->sfsapi = $sfsapi;
		$this->container = $container;
		$this->root_path = $root_path;
		$this->php_ext = $php_ext;
	}

	/*
	* reporttosfs				reporting of post to stopforum database
	* @param	int	$postid		postid of the post
	* @param	int	$posterid	posterid that made the post
	* @return 	json response
	*/
	public function reporttosfs($postid, $posterid)
	{
		$postid = (int) $postid;
		$posterid = (int) $posterid;

		// don't allow banning of anonymous user
		if ($posterid == ANONYMOUS)
		{
			throw new http_exception(403, 'CANNOT_REPORT_ANONYMOUS');
		}

		// post id must be greater than 0
		if ($postid <= 0)
		{
			throw new http_exception(403, 'POST_NOT_EXIST');
		}

		$sql = 'SELECT p.sfs_reported, p.poster_ip, p.topic_id, p.forum_id, u.username, u.user_email
			FROM ' . POSTS_TABLE . ' p
			LEFT JOIN ' . USERS_TABLE . ' u on p.poster_id = u.user_id
			WHERE p.post_id = ' . (int) $postid . ' AND p.poster_id = ' . (int) $posterid;
		$result = $this->db->sql_query($sql);
		$row = $this->db->sql_fetchrow($result);
		$this->db->sql_freeresult($result);

		// info must exist
		if (!$row)
		{
			throw new http_exception(403, 'INFO_NOT_FOUND');
		}

		$username = $row['username'];
		$userip = $row['poster_ip'];
		$useremail = $row['user_email'];
		$forumid = (int) $row['forum_id'];
		$topicid = (int) $row['topic_id'];
		$sfs_reported = (int) $row['sfs_reported'];

		$admins_mods = $this->sfsgroups->getadminsmods($forumid);

		if (in_array($posterid, $admins_mods))
		{
			throw new http_exception(403, 'CANNOT_REPORT_ADMINS_MODS');
		}

		// ensure the IP is something other than 127.0.0.1 which can happen if the anonymised extension is installed
		if (filter_var($userip, FILTER_VALIDATE_IP, FILTER_FLAG_NO_RES_RANGE) === false)
		{
			throw new http_exception(403, 'SFS_ANONYMIZED_IP');
		}

		if ($sfs_reported)
		{
			throw new http_exception(403, 'SFS_REPORTED');
		}

		if (empty($this->config['allow_sfs']) || empty($this->config['sfs_api_key']) || empty($useremail) || empty($userip))
		{
			throw new http_exception(403, 'SFS_MISSING_DATA');
		}

		// fix confirm box non-ajax error (controller must return)
		if ($this->request->is_set_post('cancel') && !$this->request->is_ajax())
		{
			$message = $this->language->lang('SFS_OPERATION_CANCELED') . '<br><br>' . $this->language->lang('RETURN_TOPIC', '<a href="' . append_sid("{$this->root_path}viewtopic.$this->php_ext?t=" . $topicid) . '">', '</a>');

			return $this->helper->message($message);
		}

		if (confirm_box(true))
		{
			$response = $this->sfsapi->sfsapi('add', $username, $userip, $useremail, $this->config['sfs_api_key']);

			$json_decode = json_decode($response, true);
			// ajax stuffs
			if (isset($json_decode[$this->language->lang('CURL_ERROR')]) && $this->request->is_ajax())
			{
				$data = [
					'MESSAGE_TITLE'	=> $this->language->lang('AJAX_ERROR_TITLE'),
					'MESSAGE_TEXT'	=> $json_decode[$this->language->lang('CURL_ERROR')],
					'success'	=> false,
				];
				return new JsonResponse($data);
			}
			else if (!$response && $this->request->is_ajax())
			{
				$data = [
					'MESSAGE_TITLE'	=> $this->language->lang('AJAX_ERROR_TITLE'),
					'MESSAGE_TEXT'	=> $this->language->lang('SFS_ERROR_MESSAGE'),
					'success'	=> false,
				];
				return new JsonResponse($data);
			}
			//non-ajax stuffs
			else if (isset($json_decode[$this->language->lang('CURL_ERROR')]))
			{
				$this->template->assign_vars([
					'MESSAGE_TITLE' => $this->language->lang('ERROR'),
					'MESSAGE_TEXT'	=> $json_decode[$this->language->lang('CURL_ERROR')]
				]);

				return $this->helper->render('message_body.html');
			}
			else if (!$response)
			{
				$this->template->assign_vars([
					'MESSAGE_TITLE' => $this->language->lang('ERROR'),
					'MESSAGE_TEXT'	=> $this->language->lang('SFS_ERROR_MESSAGE')
				]);

				return $this->helper->render('message_body.html');
			}

			// Report the uhmmm reported?
			if ($this->config['sfs_notify'])
			{
				$this->check_report($postid);
			}

			$sql = 'UPDATE ' . POSTS_TABLE . '
				SET sfs_reported = 1
				WHERE post_id = ' . (int) $postid;
			$this->db->sql_query($sql);

			$sfs_username = $this->language->lang('SFS_USERNAME_STOPPED', $username);

			$this->sfsapi->sfs_ban('user', $username);

			$this->log->add('mod', $this->user->data['user_id'], $this->user->ip, 'LOG_SFS_REPORTED', false, [$sfs_username, 'forum_id' => $forumid, 'topic_id' => $topicid, 'post_id'  => $postid]);

			if ($this->request->is_ajax())
			{
				$data = [
					'MESSAGE_TITLE'	=> $this->language->lang('SFS_SUCCESS'),
					'MESSAGE_TEXT'	=> $this->language->lang('SFS_SUCCESS_MESSAGE'),
					'success'	=> true,
					'postid'	=> $postid,
				];
				return new JsonResponse($data);
			}
			else
			{
				$this->template->assign_vars([
					'MESSAGE_TITLE' => $this->language->lang('SFS_SUCCESS'),
					'MESSAGE_TEXT'	=> $this->language->lang('SFS_SUCCESS_MESSAGE')
				]);

				return $this->helper->render('message_body.html');
			}
		}
		else
		{
			if ($this->request->is_ajax())
			{
				confirm_box(
					false,
					$this->language->lang('SFS_CONFIRM'),
					'',
					'confirm_body.html',
					$this->helper->route(
						'rmcgirr83_stopforumspam_core_reporttosfs',
						[
							'postid' => $postid,
							'posterid' => $posterid,
						],
						true,
						false,
						UrlGeneratorInterface::ABSOLUTE_URL
					)
				);
			}
			else
			{
				confirm_box(false, $this->language->lang('SFS_CONFIRM'));
			}
		}
	}

	/*
	* check_report			check to see if the post msg has already been reported
	* @param 	$postid 	postid from the report to sfs
	* @return 	json|html	response if found
	*/
	private function check_report($postid)
	{
		$sql = 'SELECT *
			FROM ' . POSTS_TABLE . '
			WHERE post_id = ' . (int) $postid;
		$result = $this->db->sql_query($sql);
		$report_data = $this->db->sql_fetchrow($result);
		$this->db->sql_freeresult($result);

		if (!$report_data && $this->request->is_ajax())
		{
			$data = [
				'MESSAGE_TITLE'	=> $this->language->lang('ERROR'),
				'MESSAGE_TEXT'	=> $this->language->lang('POST_NOT_EXIST'),
				'success'	=> false,
			];
			return new JsonResponse($data);
		}
		else if (!$report_data)
		{
			$this->template->assign_vars([
				'MESSAGE_TITLE'	=> $this->language->lang('ERROR'),
				'MESSAGE_TEXT'	=> $this->language->lang('POST_NOT_EXIST'),
			]);

			return $this->helper->render('message_body.html');
		}

		// if the post isn't reported, then report it
		if (!$report_data['post_reported'])
		{
			$report_name = 'other';
			$report_text = $this->language->lang('SFS_WAS_REPORTED');

			$sql = 'SELECT *
				FROM ' . REPORTS_REASONS_TABLE . "
				WHERE reason_title = '" . $this->db->sql_escape($report_name). "'";
			$result = $this->db->sql_query($sql);
			$row = $this->db->sql_fetchrow($result);
			$this->db->sql_freeresult($result);

			$phpbb_notifications = $this->container->get('phpbb.report.handlers.report_handler_post');
			$phpbb_notifications->add_report($postid, $row['reason_id'], $report_text, 0);
		}
	}
}
