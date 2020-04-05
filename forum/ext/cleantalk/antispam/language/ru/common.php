<?php
/**
*
* @package phpBB Extension - Antispam by CleanTalk
* @author Сleantalk team (welcome@cleantalk.org)
* @copyright (C) 2014 СleanTalk team (http://cleantalk.org)
* @license GNU/GPL: http://www.gnu.org/copyleft/gpl.html
*
*/

if (!defined('IN_PHPBB'))
{
	exit;
}

if (empty($lang) || !is_array($lang))
{
	$lang = array();
}

$lang = array_merge($lang, array(
	'ACP_CLEANTALK_TITLE'                       => 'Антиспам от CleanTalk',	
	'ACP_CLEANTALK_SETTINGS'                    => 'Настройки защиты от спама',
	'ACP_CLEANTALK_SETTINGS_SAVED'              => 'Настройки защиты от спама сохранены!',

	'ACP_CLEANTALK_REGS_LABEL'                  => 'Проверять регистрации',
	'ACP_CLEANTALK_REGS_DESCR'                  => 'Спам-боты будут отвергнуты с выводом причины.',

	'ACP_CLEANTALK_GUESTS_LABEL'                => 'Проверять анонимных',
	'ACP_CLEANTALK_GUESTS_DESCR'                => 'Посты и темы от анонимных будут проверяться на спам. Спам будет отвергнут или направлен на одобрение.',

	'ACP_CLEANTALK_NUSERS_LABEL'	            => 'Проверять вновь зарегистрированных',
	'ACP_CLEANTALK_NUSERS_DESCR'	            => 'Посты и темы от вновь зарегистрированных будут проверяться на спам. Спам будет отвергнут или направлен на одобрение.',

	'ACP_CLEANTALK_CCF_LABEL'	           		=> 'Проверять контактные формы',
	'ACP_CLEANTALK_CCF_DESCR'	           		=> 'Включить антиспам тест для контактной формы. Внимание, возможны конфликты!',		

	'ACP_CLEANTALK_SFW_LABEL'		       		=> 'SpamFireWall',
	'ACP_CLEANTALK_SFW_DESCR'		        	=> 'Включает SpamFireWall. Это не даст ботам зайти на сайт и позволит снизить нагрузку на веб-сервер.',
	
	'ACP_CLEANTALK_APIKEY_LABEL'	            => 'Ключ доступа',
	'ACP_CLEANTALK_APIKEY_LABEL_PLACEHOLDER'    => 'Введите ключ доступа',	
	'ACP_CLEANTALK_APIKEY_DESCR'	            => 'Для получения зарегистрируйтесь на сайте ',
	'ACP_CLEANTALK_REG_NOTICE'                  => 'E-mail форума',
	'ACP_CLEANTALK_REG_NOTICE2'                 => 'будет использован для регистрации',
	'ACP_CLEANTALK_AGREEMENT'                   => 'Лицензионное соглашение',
	'ACP_CLEANTALK_APIKEY_IS_OK_LABEL'			=> 'Ключ действителен.',
	'ACP_CLEANTALK_APIKEY_IS_BAD_LABEL'			=> 'Ключ не действителен!',
	'ACP_CLEANTALK_APIKEY_GET_AUTO_BUTTON_LABEL'		=> 'Получить ключ автоматически',
	'ACP_CLEANTALK_APIKEY_GET_MANUALLY_BUTTON_LABEL'	=> 'Получить ключ вручную',
	'ACP_CLEANTALK_APIKEY_CP_LINK_BUTTON'		=> 'Перейти в панель управления CleanTalk',
	'ACP_CLEANTALK_ACCOUNT_NAME_OB'				=> 'Аккаунт на cleantalk.org',
	'ACP_CLEANTALK_CHECKUSERS_TITLE'		    => 'Проверить пользователей на спам',
	'ACP_CLEANTALK_CHECKUSERS_DESCRIPTION'		=> 'Антиспам от CleanTalk проверит всех пользователей по черным спискам и покажет вам тех, кто проявил спам-активность на других сайтах. ',
	'ACP_CLEANTALK_CHECKUSERS_PAGES_TITLE'      => 'Страницы:',
	'ACP_CLEANTALK_CHECKUSERS_BUTTON'			=> 'Проверить на спам',
	'ACP_CHECKUSERS_DONE_2'                     => 'Готово. Все пользователи проверены на спам, найдено 0 результатов',
	'ACP_CHECKUSERS_DONE_3'						=> 'Ошибка. Нет соединения с базой данных черных списков.',
	'ACP_CHECKUSERS_USERNAME'                   => 'Пользователь',
	'ACP_CHECKUSERS_MESSAGES'                   => 'Сообщений',
	'ACP_CHECKUSERS_JOINED'                     => 'Присоединился',
	'ACP_CHECKUSERS_EMAIL'                      => 'Email',
	'ACP_CHECKUSERS_IP'                         => 'IP',
	'ACP_CHECKUSERS_LASTVISIT'                  => 'Последний визит',
	'ACP_CHECKUSERS_DELETEALL'                  => 'Удалить всех',
	'ACP_CHECKUSERS_DELETEALL_DESCR'            => 'Все посты выбранных пользователей будут тоже удалены',
	'ACP_CHECKUSERS_DELETESEL'                  => 'Удалить выбранных',
	'ACP_CLEANTALK_MODERATE_IP'					=> 'Антиспам сервис оплачен вашим хостин провайдером. Лицензия #',	
	'SFW_DIE_NOTICE_IP'                         => 'SpamFireWall включен для вашего IP',
	'SFW_DIE_MAKE_SURE_JS_ENABLED'              => 'Что бы продолжить работу с сайтом, убедитесь что у вас включен JavaScript.',
	'SFW_DIE_CLICK_TO_PASS'                     => 'Нажмите ниже что снять блокировку',
	'SFW_DIE_YOU_WILL_BE_REDIRECTED'            => 'Вы будете автоматически переадресовны на запрошенную вами страницу через 3 секунды.',
	
	'CLEANTALK_ERROR_MAIL'		                => 'Ошибка работы с сервисом CleanTalk',
	'CLEANTALK_ERROR_LOG'		                => '<strong>Ошибка работы с сервисом CleanTalk</strong><br />%s',
	'CLEANTALK_ERROR_CURL'		                => 'CURL ошибка: `%s`',
	'CLEANTALK_ERROR_NO_CURL'		            => 'Нет поддержки CURL',
	'CLEANTALK_ERROR_ADDON'		                => ' или выключена настройка allow_url_fopen в php.ini.',
	'CLEANTALK_NOTIFICATION'					=> 'Вы уверены?',
));
