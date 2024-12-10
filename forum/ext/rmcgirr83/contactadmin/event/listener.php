<?php
/**
*
* Contact admin extension for the phpBB Forum Software package.
*
* @copyright 2016 Rich McGirr (RMcGirr83)
* @license GNU General Public License, version 2 (GPL-2.0)
*
*/
namespace rmcgirr83\contactadmin\event;

/**
* @ignore
*/
use phpbb\config\config;
use phpbb\controller\helper;
use phpbb\language\language;
use phpbb\template\template;
use phpbb\user;

use Symfony\Component\EventDispatcher\EventSubscriberInterface;

/**
* Event listener
*/
class listener implements EventSubscriberInterface
{
	/** @var config */
	protected $config;

	/** @var helper */
	protected $helper;

	/** @var language */
	protected $language;

	/* @var template */
	protected $template;

	/** @var user */
	protected $user;

	/**
	* Constructor
	*
	* @param config						$config				Config object
	* @param helper						$helper				Controller helper object
	* @param language					$language			Language object
	* @param template					$template			Template object
	* @param user						$user				User object
	* @access public
	*/
	public function __construct(
		config $config,
		helper $helper,
		language $language,
		template $template,
		user $user)
	{
		$this->config = $config;
		$this->helper = $helper;
		$this->language = $language;
		$this->template = $template;
		$this->user = $user;
	}

	/**
	* Assign functions defined in this class to event listeners in the core
	*
	* @return array
	* @static
	* @access public
	*/
	static public function getSubscribedEvents()
	{
		return [
			'core.acp_extensions_run_action_before'	=> 'enable_default_contact',
			'core.adm_page_footer'		=> 'extension_enabled',
			'core.page_header_after'	=> 'page_header_after',
			'core.user_setup'			=> 'user_setup',
			'core.login_box_failed'		=> 'login_box_failed',
			'core.ucp_register_modify_template_data'	=> 'contact_form_register',
		];
	}

	/**
	* enable the default phpbb contact page upon disabling the extension
	*
	* @param object $event The event object
	* @return null
	* @access public
	*/
	public function enable_default_contact($event)
	{
		$action = $event['action'];
		$ext_name = $event['ext_name'];

		if ($action == 'disable' && $ext_name == 'rmcgirr83/contactadmin')
		{
			$this->config->set('contact_admin_form_enable', true);
		}
	}

	/**
	* change the display of information on the default contact page of phpBB within the ACP
	*
	* @param object $event The event object
	* @return null
	* @access public
	*/
	public function extension_enabled($event)
	{
		$this->language->add_lang('acp_contact', 'rmcgirr83/contactadmin');
		$this->template->assign_vars([
			'L_CONTACT_US_ENABLE_EXPLAIN'	=> $this->language->lang('CONTACT_EXTENSION_ACTIVE'),
		]);
	}

	/**
	* ignore ban check
	*
	* @param object $event The event object
	* @return null
	* @access public
	*/
	public function user_setup($event)
	{
		$url = $this->helper->get_current_url();

		if (empty($this->user->data['is_bot']) && $this->config['board_disable'] && substr($url, strrpos($url, '/') + 1) === 'contactadmin')
		{
			define('SKIP_CHECK_DISABLED', true);
		}

		//always ensure the default contact page is disabled if this extension is enabled
		if ($this->config['contact_admin_form_enable'])
		{
			$this->config->set('contact_admin_form_enable', 0);
		}
	}

	/**
	* assign template vars
	*
	* @param object $event The event object
	* @return null
	* @access public
	*/
	public function page_header_after($event)
	{
		if (empty($this->user->data['is_bot']))
		{
			$version = phpbb_version_compare($this->config['version'], '3.3', '>=');

			$this->template->assign_vars([
				'U_CONTACT_US'		=> false,
				'U_CONTACTADMIN'	=> $this->helper->route('rmcgirr83_contactadmin_displayform'),
				'S_FORUM_VERSION'	=> $version,
			]);
		}
	}

	/**
	* change login box failure links
	*
	* @param object $event The event object
	* @return null
	* @access public
	*/
	public function login_box_failed($event)
	{
		$error = $event['err'];
		$result = $event['result'];
		if ($result['error_msg'] == 'LOGIN_ERROR_USERNAME' || $result['error_msg'] == 'LOGIN_ERROR_PASSWORD')
		{
			$error = $this->language->lang($result['error_msg'], '<a href="' . $this->helper->route('rmcgirr83_contactadmin_displayform') . '">', '</a>');
		}
		$event['err'] = $error;
	}

	/**
	* change confirm register link
	*
	* @param object $event The event object
	* @return null
	* @access public
	*/
	public function contact_form_register($event)
	{
		$this->template->assign_vars([
			'L_CONFIRM_EXPLAIN' => $this->language->lang('CONFIRM_EXPLAIN', '<a href="' . $this->helper->route('rmcgirr83_contactadmin_displayform') . '">', '</a>'),
		]);
	}
}
