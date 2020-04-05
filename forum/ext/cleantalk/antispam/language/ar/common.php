<?php
/**
*
* @package phpBB Extension - Antispam by CleanTalk
* @author Сleantalk team (welcome@cleantalk.org)
* @copyright (C) 2014 СleanTalk team (http://cleantalk.org)
* @license GNU/GPL: http://www.gnu.org/copyleft/gpl.html
*
* Translated By : Bassel Taha Alhitary - www.alhitary.net
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
	'ACP_CLEANTALK_TITLE'			            => 'المُكافح CleanTalk',
	
	'ACP_CLEANTALK_SETTINGS'		            => 'الإعدادات',
	'ACP_CLEANTALK_SETTINGS_SAVED'		        => 'تم حفظ الإعدادات بنجاح !',

	'ACP_CLEANTALK_REGS_LABEL'		            => 'فحص عمليات التسجيل ',
	'ACP_CLEANTALK_REGS_DESCR'		            => 'سيتم منع التسجيلات المُزعجة مع توضيح الأسباب.',

	'ACP_CLEANTALK_GUESTS_LABEL'		        => 'إدارة الزائرين ',
	'ACP_CLEANTALK_GUESTS_DESCR'		        => 'سيتم فحص المشاركات والمواضيع بواسطة الزائرين. ومنع المُزعجة منها أو إرسالها للموافقة عليها بواسطة المشرفين.',

	'ACP_CLEANTALK_NUSERS_LABEL'		        => 'إدارة آخر الأعضاء المُسجلين ',
	'ACP_CLEANTALK_NUSERS_DESCR'		        => 'سيتم فحص المشاركات والمواضيع بواسطة آخر الأعضاء المُسجلين. ومنع المُزعجة منها أو إرسالها للموافقة عليها بواسطة المشرفين.',

	'ACP_CLEANTALK_CCF_LABEL'	           		=> 'اختبار نموذج الاتصال',
	'ACP_CLEANTALK_CCF_DESCR'	           		=> 'لتمكين مكافحة البريد المزعج اختبار نموذج الاتصال. الملاحظة التعارضات المحتملة!',
			
	'ACP_CLEANTALK_SFW_LABEL'		       		=> 'SpamFireWall',
	'ACP_CLEANTALK_SFW_DESCR'					=> 'تفعيل جدار الحماية. تخفيف حمل السيرفر وحماية الموقع من العمليات المُزعجة.',

	'ACP_CLEANTALK_APIKEY_LABEL'		        => 'مفتاح الدخول ',
	'ACP_CLEANTALK_APIKEY_LABEL_PLACEHOLDER'    => 'أدخل مفتاح الوصول',	
	'ACP_CLEANTALK_APIKEY_DESCR'		        => 'للحصول على مفتاح الدخول , نرجوا التسجيل في الموقع ',
	'ACP_CLEANTALK_REG_NOTICE'                  => 'Board e-mail',
	'ACP_CLEANTALK_REG_NOTICE2'                 => 'will be used for registration',
	'ACP_CLEANTALK_AGREEMENT'                   => 'License agreement',
	'ACP_CLEANTALK_APIKEY_IS_OK_LABEL'			=> 'رقم المفتاح صحيح !',
	'ACP_CLEANTALK_APIKEY_IS_BAD_LABEL'			=> 'رقم المفتاح غير صحيح !',
	'ACP_CLEANTALK_APIKEY_GET_AUTO_BUTTON_LABEL'=> 'الحصول على مفتاح الدخول تلقائياً',
	'ACP_CLEANTALK_APIKEY_GET_MANUALLY_BUTTON_LABEL'	=> 'الحصول على مفتاح الدخول يدوياً',
	'ACP_CLEANTALK_APIKEY_CP_LINK_BUTTON'		=> 'انقر هنا للحصول على احصائيات المُكافح',
	'ACP_CLEANTALK_ACCOUNT_NAME_OB'				=> 'الحساب at cleantalk.org هو',
	'ACP_CLEANTALK_CHECKUSERS_TITLE'			=> 'فحص الأعضاء المُزعجين',
	'ACP_CLEANTALK_CHECKUSERS_DESCRIPTION'		=> 'المكافح CleanTalk سوف يفحص جميع الأعضاء في قاعدة بيانات القوائم السوداء لديه , وسيعرض لك أسماء الأعضاء الذين لديهم نشاط مُزعج في المواقع الأخرى. فقط انقر على الزر `فحص الأعضاء المُزعجين` لبدء عملية الفحص.',
	'ACP_CLEANTALK_CHECKUSERS_PAGES_TITLE'      => 'صفحات',	
	'ACP_CLEANTALK_CHECKUSERS_BUTTON'			=> 'فحص الأعضاء المُزعجين',
	'ACP_CHECKUSERS_DONE_2'                     => 'تم فحص جميع الأعضاء بواسطة قاعدة بيانات القوائم السوداء. لم يتم العثور على أعضاء مُزعجين.',
	'ACP_CHECKUSERS_DONE_3'						=> 'Error. No connection with blacklist database.',
	'ACP_CHECKUSERS_USERNAME'                   => 'إسم المستخدم',
	'ACP_CHECKUSERS_MESSAGES'                   => 'الرسائل',
	'ACP_CHECKUSERS_JOINED'                     => 'تاريخ الإشتراك',
	'ACP_CHECKUSERS_EMAIL'                      => 'البريد الإلكتروني',
	'ACP_CHECKUSERS_IP'                         => 'رقم الـ IP',
	'ACP_CHECKUSERS_LASTVISIT'                  => 'آخر زيارة',
	'ACP_CHECKUSERS_DELETEALL'                  => 'حذف الجميع',
	'ACP_CHECKUSERS_DELETEALL_DESCR'            => 'سيتم أيضاً حذف جميع المشاركات للأعضاء المحذوفين.',
	'ACP_CHECKUSERS_DELETESEL'                  => 'حذف المُحدد',
	'ACP_CLEANTALK_MODERATE_IP'					=> 'خدمة مكافحة الرسائل المزعجة مدفوعة من قبل مزود استضافتك الرخصة #',	
	'SFW_DIE_NOTICE_IP'                         => 'SpamFireWall is activated for your IP ',
	'SFW_DIE_MAKE_SURE_JS_ENABLED'              => 'To continue working with web site, please make sure that you have enabled JavaScript.',
	'SFW_DIE_CLICK_TO_PASS'                     => 'Please click bellow to pass protection,',
	'SFW_DIE_YOU_WILL_BE_REDIRECTED'            => 'Or you will be automatically redirected to the requested page after 3 seconds.',
		
	'CLEANTALK_ERROR_MAIL'		                => 'هناك خطأ أثناء عملية الإتصال بخدمة الـ CleanTalk',
	'CLEANTALK_ERROR_LOG'		                => '<strong>خطأ أثناء عملية الإتصال بخدمة الـ CleanTalk</strong><br />%s',
	'CLEANTALK_ERROR_CURL'		                => 'CURL error: `%s`',
	'CLEANTALK_ERROR_NO_CURL'		            => 'No CURL support compiled in',
	'CLEANTALK_ERROR_ADDON'		                => ' or disabled allow_url_fopen in php.ini.',
	'CLEANTALK_NOTIFICATION'					=> 'هل أنت متأكد ؟',
));
