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
	'ACP_CLEANTALK_TITLE'                        => 'Антиспам от CleanTalk',

	'ACP_CLEANTALK_SETTINGS'                     => 'Настройки защиты от спама',
	'ACP_CLEANTALK_SETTINGS_SAVED'               => 'Настройки защиты от спама сохранены!',

	'ACP_CLEANTALK_REGS_LABEL'                   => 'Проверять регистрации',
	'ACP_CLEANTALK_REGS_DESCR'                   => 'Спам-боты будут отвергнуты с выводом причины.',

	'ACP_CLEANTALK_GUESTS_LABEL'                 => 'Проверять анонимных',
	'ACP_CLEANTALK_GUESTS_DESCR'                 => 'Посты и темы от анонимных будут проверяться на спам. Спам будет отвергнут или направлен на одобрение.',

	'ACP_CLEANTALK_NUSERS_LABEL'	             => 'Проверять вновь зарегистрированных',
	'ACP_CLEANTALK_NUSERS_DESCR'	             => 'Посты и темы от вновь зарегистрированных будут проверяться на спам. Спам будет отвергнут или направлен на одобрение.',

	'ACP_CLEANTALK_APIKEY_LABEL'	             => 'Ключ доступа',
	'ACP_CLEANTALK_APIKEY_DESCR'	             => 'Для получения зарегистрируйтесь на сайте ',

	'MAIL_CLEANTALK_ERROR'		                 => 'Ошибка работы с сервисом CleanTalk',
	'LOG_CLEANTALK_ERROR'		                 => '<strong>Ошибка работы с сервисом CleanTalk</strong><br />%s',
	'ACP_CLEANTALK_CHECKUSERS_TITLE'		     => 'Проверить пользователей на спам',
	'ACP_CLEANTALK_CHECKUSERS_DESCRIPTION'		 => 'Антиспам от CleanTalk проверит всех пользователей по черным спискам и покажет вам тех, кто проявил спам-активность на других сайтах. ',
	'ACP_CLEANTALK_CHECKUSERS_BUTTON'			 => 'Проверить на спам',
	'ACP_CHECKUSERS_DONE_1'                      => 'Готово. Все пользователи проверены на спам, результат в таблице ниже',
	'ACP_CHECKUSERS_DONE_2'                      => 'Готово. Все пользователи проверены на спам, найдено 0 результатов',
	'ACP_CHECKUSERS_SELECT'                      => 'Выбрать',
	'ACP_CHECKUSERS_USERNAME'                    => 'Пользователь',
	'ACP_CHECKUSERS_MESSAGES'                    => 'Сообщений',
	'ACP_CHECKUSERS_JOINED'                      => 'Присоединился',
	'ACP_CHECKUSERS_EMAIL'                       => 'Email',
	'ACP_CHECKUSERS_IP'                          => 'IP',
	'ACP_CHECKUSERS_LASTVISIT'                   => 'Последний визит',
	'ACP_CHECKUSERS_DELETEALL'                   => 'Удалить всех',
	'ACP_CHECKUSERS_DELETEALL_DESCR'             => 'Все посты выбранных пользователей будут тоже удалены',
	'ACP_CHECKUSERS_DELETESEL'                   => 'Удалить выбранных',
));
