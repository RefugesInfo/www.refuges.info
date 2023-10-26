<?php

namespace cleantalk\antispam\library\Cleantalk\Common;

/**
 * CleanTalk API class.
 * Mostly contains wrappers for API methods. Check and send methods.
 * Compatible with any CMS.
 *
 * @version       4.0
 * @author        Cleantalk team (welcome@cleantalk.org)
 * @copyright (C) 2014 CleanTalk team (http://cleantalk.org)
 * @license       GNU/GPL: http://www.gnu.org/copyleft/gpl.html
 * @see           https://github.com/CleanTalk/php-antispam
 */
class API
{
    /* Default params  */
    const URL = 'https://api.cleantalk.org';
    const AGENT = 'ct-api-3.2';

    /**
     * Wrapper for 2s_blacklists_db API method.
     * Gets data for SpamFireWall.
     *
     * @param string $api_key
     * @param null|string $out Data output type (JSON or file URL)
     * @param string $version API method version
     * @param boolean $do_check
     *
     * @return string|array ('error' => STRING)
     *
     * @psalm-suppress PossiblyUnusedMethod
     */
    public static function methodGet2sBlacklistsDb($api_key, $out = null, $version = '1_0', $do_check = true)
    {
        $request = array(
            'method_name' => '2s_blacklists_db',
            'auth_key'    => $api_key,
            'out'         => $out,
            'version'     => $version,
        );

        $result = static::sendRequest($request);
        $result = $do_check ? static::checkResponse($result, '2s_blacklists_db') : $result;

        return $result;
    }

    /**
     * Wrapper for get_api_key API method.
     * Gets access key automatically.
     *
     * @param string $product_name Type of product
     * @param string $email Website admin email
     * @param string $website Website host
     * @param string $platform Website platform
     * @param string|null $timezone
     * @param string|null $language
     * @param string|null $user_ip
     * @param bool $wpms
     * @param bool $white_label
     * @param string $hoster_api_key
     * @param bool $do_check
     *
     * @return array|bool|mixed
     */
    public static function methodGetApiKey(
        $product_name,
        $email,
        $website,
        $platform,
        $timezone = null,
        $language = null,
        $user_ip = null,
        $wpms = false,
        $white_label = false,
        $hoster_api_key = '',
        $do_check = true
    ) {
        $request = array(
            'method_name'          => 'get_api_key',
            'product_name'         => $product_name,
            'email'                => $email,
            'website'              => $website,
            'platform'             => $platform,
            'timezone'             => $timezone,
            'http_accept_language' => $language,
            'user_ip'              => $user_ip,
            'wpms_setup'           => $wpms,
            'hoster_whitelabel'    => $white_label,
            'hoster_api_key'       => $hoster_api_key,
        );

        $result = static::sendRequest($request);
        $result = $do_check ? static::checkResponse($result, 'get_api_key') : $result;

        return $result;
    }

    /**
     * Wrapper for get_antispam_report API method.
     * Gets spam report.
     *
     * @param string $host website host
     * @param integer $period report days
     * @param boolean $do_check
     *
     * @return array|bool|mixed
     *
     * @psalm-suppress PossiblyUnusedMethod
     */
    public static function methodGetAntispamReport($host, $period = 1, $do_check = true)
    {
        $request = array(
            'method_name' => 'get_antispam_report',
            'hostname'    => $host,
            'period'      => $period
        );

        $result = static::sendRequest($request);
        $result = $do_check ? static::checkResponse($result, 'get_antispam_report') : $result;

        return $result;
    }

    /**
     * Wrapper for get_antispam_report_breif API method.
     * Ggets spam statistics.
     *
     * @param string $api_key
     * @param bool $do_check
     *
     * @return array|bool|mixed
     *
     * @psalm-suppress PossiblyUnusedMethod
     */
    public static function methodGetAntispamReportBreif($api_key, $do_check = true)
    {
        $request = array(
            'method_name' => 'get_antispam_report_breif',
            'auth_key'    => $api_key,
        );

        $result = static::sendRequest($request);
        $result = $do_check ? static::checkResponse($result, 'get_antispam_report_breif') : $result;

        return $result;
    }

    /**
     * Wrapper for notice_paid_till API method.
     * Gets information about renew notice.
     *
     * @param string $api_key API key
     * @param string $path_to_cms Website URL
     * @param string $product_name
     * @param bool $do_check
     *
     * @return array|bool|mixed
     *
     * @psalm-suppress PossiblyUnusedMethod
     */
    public static function methodNoticePaidTill(
        $api_key,
        $path_to_cms,
        $product_name = 'antispam',
        $do_check = true
    ) {
        $request = array(
            'method_name' => 'notice_paid_till',
            'path_to_cms' => $path_to_cms,
            'auth_key'    => $api_key,
        );

        if (self::getProductId($product_name)) {
            $request['product_id'] = self::getProductId($product_name);
        }

        $result = static::sendRequest($request);
        $result = $do_check ? static::checkResponse($result, 'notice_paid_till') : $result;

        return $result;
    }

    /**
     * Wrapper for ip_info API method.
     * Gets IP country.
     *
     * @param string $data
     * @param bool $do_check
     *
     * @return array|bool|mixed
     *
     * @psalm-suppress PossiblyUnusedMethod
     */
    public static function methodIpInfo($data, $do_check = true)
    {
        $request = array(
            'method_name' => 'ip_info',
            'data'        => $data
        );

        $result = static::sendRequest($request);
        $result = $do_check ? static::checkResponse($result, 'ip_info') : $result;

        return $result;
    }

    /**
     * Wrapper for spam_check_cms API method.
     * Checks IP|email via CleanTalk's database.
     *
     * @param string $api_key
     * @param array $data
     * @param null|string $date
     * @param bool $do_check
     *
     * @return array|bool|mixed
     *
     * @psalm-suppress PossiblyUnusedMethod
     */
    public static function methodSpamCheckCms($api_key, $data, $date = null, $do_check = true)
    {
        $request = array(
            'method_name' => 'spam_check_cms',
            'auth_key'    => $api_key,
            'data'        => is_array($data) ? implode(',', $data) : $data,
        );

        if ($date) {
            $request['date'] = $date;
        }

        $result = static::sendRequest($request, self::URL, 20);
        $result = $do_check ? static::checkResponse($result, 'spam_check_cms') : $result;

        return $result;
    }

    /**
     * Wrapper for notice_paid_till API method.
     * Gets information about renew notice.
     *
     * @param string $api_key API key
     * @param string $path_to_cms Website URL
     * @param string $product_name
     * @param bool $do_check
     *
     * @return array|bool|mixed
     *
     * @psalm-suppress PossiblyUnusedMethod
     */
    public static function methodEmailCheck($email, $cache_only = true, $do_check = true)
    {
        $request = array(
            'method_name' => 'email_check',
            'cache_only'  => $cache_only ? '1' : '0',
            'email'       => $email,
        );

        $result = static::sendRequest($request);
        $result = $do_check ? static::checkResponse($result, 'email_check') : $result;

        return $result;
    }

    /**
     * Wrapper for spam_check API method.
     * Checks IP|email via CleanTalk's database.
     *
     * @param string $api_key
     * @param array $data
     * @param null|string $date
     * @param bool $do_check
     *
     * @return array|bool|mixed
     *
     * @psalm-suppress PossiblyUnusedMethod
     */
    public static function methodSpamCheck($api_key, $data, $date = null, $do_check = true)
    {
        $request = array(
            'method_name' => 'spam_check',
            'auth_key'    => $api_key,
            'data'        => is_array($data) ? implode(',', $data) : $data,
        );

        if ($date) {
            $request['date'] = $date;
        }

        $result = static::sendRequest($request, self::URL, 10);
        $result = $do_check ? static::checkResponse($result, 'spam_check') : $result;

        return $result;
    }

    /**
     * Wrapper for sfw_logs API method.
     * Sends SpamFireWall logs to the cloud.
     *
     * @param string $api_key
     * @param array $data
     * @param bool $do_check
     *
     * @return array|bool
     *
     * @psalm-suppress PossiblyUnusedMethod
     */
    public static function methodSfwLogs($api_key, $data, $do_check = true)
    {
        $request = array(
            'auth_key'    => $api_key,
            'method_name' => 'sfw_logs',
            'data'        => json_encode($data),
            'rows'        => count($data),
            'timestamp'   => time()
        );

        $request['data'] = str_replace('"EMPTY_ASSOCIATIVE_ARRAY"', '{}', $request['data']);

        $result = static::sendRequest($request);
        $result = $do_check ? static::checkResponse($result, 'sfw_logs') : $result;

        return $result;
    }

    /**
     * Wrapper for security_logs API method.
     * Sends security logs to the cloud.
     *
     * @param string $api_key
     * @param array $data
     * @param bool $do_check
     *
     * @return array|bool|mixed
     *
     * @psalm-suppress PossiblyUnusedMethod
     */
    public static function methodSecurityLogs($api_key, $data, $do_check = true)
    {
        $request = array(
            'auth_key'    => $api_key,
            'method_name' => 'security_logs',
            'timestamp'   => current_time('timestamp'),
            'data'        => json_encode($data),
            'rows'        => count($data),
        );

        $result = static::sendRequest($request);
        $result = $do_check ? static::checkResponse($result, 'security_logs') : $result;

        return $result;
    }

    /**
     * Wrapper for security_logs API method.
     * Sends Securitty Firewall logs to the cloud.
     *
     * @param string $api_key
     * @param array $data
     * @param bool $do_check
     *
     * @return array|bool|mixed
     *
     * @psalm-suppress PossiblyUnusedMethod
     */
    public static function methodSecurityLogsSendFWData($api_key, $data, $do_check = true)
    {
        $request = array(
            'auth_key'    => $api_key,
            'method_name' => 'security_logs',
            'timestamp'   => current_time('timestamp'),
            'data_fw'     => json_encode($data),
            'rows_fw'     => count($data),
        );

        $result = static::sendRequest($request);
        $result = $do_check ? static::checkResponse($result, 'security_logs') : $result;

        return $result;
    }

    /**
     * Wrapper for security_logs API method.
     * Sends empty data to the cloud to syncronize version.
     *
     * @param string $api_key
     * @param bool $do_check
     *
     * @return array|bool|mixed
     *
     * @psalm-suppress PossiblyUnusedMethod
     */
    public static function methodSecurityLogsFeedback($api_key, $do_check = true)
    {
        $request = array(
            'auth_key'    => $api_key,
            'method_name' => 'security_logs',
            'data'        => '0',
        );

        $result = static::sendRequest($request);
        $result = $do_check ? static::checkResponse($result, 'security_logs') : $result;

        return $result;
    }

    /**
     * Wrapper for security_firewall_data API method.
     * Gets Securitty Firewall data to write to the local database.
     *
     * @param string $api_key
     * @param bool $do_check
     *
     * @return array|bool|mixed
     *
     * @psalm-suppress PossiblyUnusedMethod
     */
    public static function methodSecurityFirewallData($api_key, $do_check = true)
    {
        $request = array(
            'auth_key'    => $api_key,
            'method_name' => 'security_firewall_data',
        );

        $result = static::sendRequest($request);
        $result = $do_check ? static::checkResponse($result, 'security_firewall_data') : $result;

        return $result;
    }

    /**
     * Wrapper for security_firewall_data_file API method.
     * Gets URI with security firewall data in .csv.gz file to write to the local database.
     *
     * @param string $api_key
     * @param bool $do_check
     *
     * @return array|bool|mixed
     *
     * @psalm-suppress PossiblyUnusedMethod
     */
    public static function methodSecurityFirewallDataFile($api_key, $do_check = true)
    {
        $request = array(
            'auth_key'    => $api_key,
            'method_name' => 'security_firewall_data_file',
        );

        $result = static::sendRequest($request);
        $result = $do_check ? static::checkResponse($result, 'security_firewall_data_file') : $result;

        return $result;
    }

    /**
     * Wrapper for security_linksscan_logs API method.
     * Send data to the cloud about scanned links.
     *
     * @param string $api_key
     * @param string $scan_time Datetime of scan
     * @param bool $scan_result
     * @param int $links_total
     * @param array $links_list
     * @param bool $do_check
     *
     * @return array|bool|mixed
     *
     * @psalm-suppress PossiblyUnusedMethod
     */
    public static function methodSecurityLinksscanLogs(
        $api_key,
        $scan_time,
        $scan_result,
        $links_total,
        $links_list,
        $do_check = true
    ) {
        $request = array(
            'auth_key'          => $api_key,
            'method_name'       => 'security_linksscan_logs',
            'started'           => $scan_time,
            'result'            => $scan_result,
            'total_links_found' => $links_total,
            'links_list'        => $links_list,
        );

        $result = static::sendRequest($request);
        $result = $do_check ? static::checkResponse($result, 'security_linksscan_logs') : $result;

        return $result;
    }

    /**
     * Wrapper for security_mscan_logs API method.
     * Sends result of file scan to the cloud.
     *
     * @param string $api_key
     * @param int $service_id
     * @param string $scan_time Datetime of scan
     * @param bool $scan_result
     * @param int $scanned_total
     * @param array $modified List of modified files with details
     * @param array $unknown List of modified files with details
     * @param bool $do_check
     *
     * @return array|bool|mixed
     *
     * @psalm-suppress PossiblyUnusedMethod
     */
    public static function methodSecurityMscanLogs(
        $api_key,
        $service_id,
        $scan_time,
        $scan_result,
        $scanned_total,
        $modified,
        $unknown,
        $do_check = true
    ) {
        $request = array(
            'method_name'      => 'security_mscan_logs',
            'auth_key'         => $api_key,
            'service_id'       => $service_id,
            'started'          => $scan_time,
            'result'           => $scan_result,
            'total_core_files' => $scanned_total,
        );

        if ( ! empty($modified)) {
            $request['failed_files']      = json_encode($modified);
            $request['failed_files_rows'] = count($modified);
        }
        if ( ! empty($unknown)) {
            $request['unknown_files']      = json_encode($unknown);
            $request['unknown_files_rows'] = count($unknown);
        }

        $result = static::sendRequest($request);
        $result = $do_check ? static::checkResponse($result, 'security_mscan_logs') : $result;

        return $result;
    }

    /**
     * Wrapper for security_mscan_files API method.
     * Sends file to the cloud for analysis.
     *
     * @param string $api_key
     * @param string $file_path Path to the file
     * @param array $file File itself
     * @param string $file_md5 MD5 hash of file
     * @param array $weak_spots List of weak spots found in file
     * @param bool $do_check
     *
     * @return array|bool|mixed
     *
     * @psalm-suppress PossiblyUnusedMethod
     */
    public static function methodSecurityMscanFiles(
        $api_key,
        $file_path,
        $file,
        $file_md5,
        $weak_spots,
        $do_check = true
    ) {
        $request = array(
            'method_name'    => 'security_mscan_files',
            'auth_key'       => $api_key,
            'path_to_sfile'  => $file_path,
            'attached_sfile' => $file,
            'md5sum_sfile'   => $file_md5,
            'dangerous_code' => $weak_spots,
        );

        $result = static::sendRequest($request);
        $result = $do_check ? static::checkResponse($result, 'security_mscan_files') : $result;

        return $result;
    }

    /**
     * Wrapper for get_antispam_report API method.
     * Function gets spam domains report.
     *
     * @param string $api_key
     * @param array|string|mixed $data
     * @param string $date
     * @param bool $do_check
     *
     * @return array|bool|mixed
     *
     * @psalm-suppress PossiblyUnusedMethod
     */
    public static function methodBacklinksCheckCms($api_key, $data, $date = null, $do_check = true)
    {
        $request = array(
            'method_name' => 'backlinks_check_cms',
            'auth_key'    => $api_key,
            'data'        => is_array($data) ? implode(',', $data) : $data,
        );

        if ($date) {
            $request['date'] = $date;
        }

        $result = static::sendRequest($request);
        $result = $do_check ? static::checkResponse($result, 'backlinks_check_cms') : $result;

        return $result;
    }

    /**
     * Wrapper for get_antispam_report API method.
     * Function gets spam domains report
     *
     * @param string $api_key
     * @param array $logs
     * @param bool $do_check
     *
     * @return array|bool|mixed
     *
     * @psalm-suppress PossiblyUnusedMethod
     */
    public static function methodSecurityBackendLogs($api_key, $logs, $do_check = true)
    {
        $request = array(
            'method_name' => 'security_backend_logs',
            'auth_key'    => $api_key,
            'logs'        => json_encode($logs),
            'total_logs'  => count($logs),
        );

        $result = static::sendRequest($request);
        $result = $do_check ? static::checkResponse($result, 'security_backend_logs') : $result;

        return $result;
    }

    /**
     * Wrapper for get_antispam_report API method.
     * Sends data about auto repairs
     *
     * @param string $api_key
     * @param bool $repair_result
     * @param string $repair_comment
     * @param        $repaired_processed_files
     * @param        $repaired_total_files_proccessed
     * @param        $backup_id
     * @param bool $do_check
     *
     * @return array|bool|mixed
     *
     * @psalm-suppress PossiblyUnusedMethod
     */
    public static function methodSecurityMscanRepairs(
        $api_key,
        $repair_result,
        $repair_comment,
        $repaired_processed_files,
        $repaired_total_files_proccessed,
        $backup_id,
        $do_check = true
    ) {
        $request = array(
            'method_name'                  => 'security_mscan_repairs',
            'auth_key'                     => $api_key,
            'repair_result'                => $repair_result,
            'repair_comment'               => $repair_comment,
            'repair_processed_files'       => json_encode($repaired_processed_files),
            'repair_total_files_processed' => $repaired_total_files_proccessed,
            'backup_id'                    => $backup_id,
            'mscan_log_id'                 => 1,
        );

        $result = static::sendRequest($request);
        $result = $do_check ? static::checkResponse($result, 'security_mscan_repairs') : $result;

        return $result;
    }

    /**
     * Wrapper for get_antispam_report API method.
     * Force server to update checksums for specific plugin\theme
     *
     * @param string $api_key
     * @param string $plugins_and_themes_to_refresh
     * @param bool $do_check
     *
     * @return array|bool|mixed
     *
     * @psalm-suppress PossiblyUnusedMethod
     */
    public static function methodRequestChecksums($api_key, $plugins_and_themes_to_refresh, $do_check = true)
    {
        $request = array(
            'method_name' => 'request_checksums',
            'auth_key'    => $api_key,
            'data'        => $plugins_and_themes_to_refresh
        );

        $result = static::sendRequest($request);
        $result = $do_check ? static::checkResponse($result, 'request_checksums') : $result;

        return $result;
    }

    /**
     * Settings templates get API method wrapper
     *
     * @param string $api_key
     * @param bool $do_check
     *
     * @return array|bool|mixed
     *
     * @psalm-suppress PossiblyUnusedMethod
     */
    public static function methodServicesTemplatesGet($api_key, $product_name = 'antispam', $do_check = true)
    {
        $request = array(
            'method_name'        => 'services_templates_get',
            'auth_key'           => $api_key,
            'search[product_id]' => self::getProductId($product_name),
        );

        $result = static::sendRequest($request);
        $result = $do_check ? static::checkResponse($result, 'services_templates_get') : $result;

        return $result;
    }

    /**
     * Settings templates add API method wrapper
     *
     * @param string $api_key
     * @param null|string $template_name
     * @param bool $do_check
     *
     * @return array|bool|mixed
     *
     * @psalm-suppress PossiblyUnusedMethod
     */
    public static function methodServicesTemplatesAdd(
        $api_key,
        $template_name = null,
        $options = '',
        $product_name = 'antispam',
        $do_check = true
    ) {
        $request = array(
            'method_name'        => 'services_templates_add',
            'auth_key'           => $api_key,
            'name'               => $template_name,
            'options_site'       => $options,
            'search[product_id]' => self::getProductId($product_name),
        );

        $result = static::sendRequest($request);
        $result = $do_check ? static::checkResponse($result, 'services_templates_add') : $result;

        return $result;
    }

    /**
     * Settings templates add API method wrapper
     *
     * @param string $api_key
     * @param int $template_id
     * @param string $options
     * @param string $product_name
     * @param bool $do_check
     *
     * @return array|bool|mixed
     *
     * @psalm-suppress PossiblyUnusedMethod
     */
    public static function methodServicesTemplatesUpdate(
        $api_key,
        $template_id,
        $options = '',
        $product_name = 'antispam',
        $do_check = true
    ) {
        $request = array(
            'method_name'        => 'services_templates_update',
            'auth_key'           => $api_key,
            'template_id'        => $template_id,
            'name'               => null,
            'options_site'       => $options,
            'search[product_id]' => self::getProductId($product_name),
        );

        $result = static::sendRequest($request);
        $result = $do_check ? static::checkResponse($result, 'services_templates_update') : $result;

        return $result;
    }

    /**
     *
     *
     * @param string $user_token
     * @param string $service_id
     * @param string $ip
     * @param string $service_type
     * @param int $product_id
     * @param int $record_type
     * @param string $note Description text
     * @param string $status allow|deny
     * @param string $expired Date Y-m-d H:i:s
     * @param bool $do_check
     *
     * @return array|bool|bool[]|mixed|string[]
     *
     * @psalm-suppress PossiblyUnusedMethod
     */
    public static function methodPrivateListAdd(
        $user_token,
        $service_id,
        $ip,
        $service_type,
        $product_id,
        $record_type,
        $note,
        $status,
        $expired,
        $do_check = true
    ) {
        $request = array(
            'method_name'  => 'private_list_add',
            'user_token'   => $user_token,
            'service_id'   => $service_id,
            'records'      => $ip,
            'service_type' => $service_type,
            'product_id'   => $product_id,
            'record_type'  => $record_type,
            'note'         => $note,
            'status'       => $status,
            'expired'      => $expired,
        );

        $result = static::sendRequest($request);
        $result = $do_check ? static::checkResponse($result, 'private_list_add') : $result;

        return $result;
    }

    private static function getProductId($product_name)
    {
        $product_id = null;
        $product_id = $product_name === 'antispam' ? 1 : $product_id;
        $product_id = $product_name === 'security' ? 4 : $product_id;

        return $product_id;
    }

    /**
     * Function sends raw request to API server
     *
     * @param array $data to send
     * @param string $_url
     * @param integer $timeout timeout in seconds
     * @param boolean $ssl use ssl on not
     * @param string $ssl_path
     *
     * @return array|string
     */
    public static function sendRequest($data, $_url = self::URL, $timeout = 10, $ssl = false, $ssl_path = '')
    {
        global $apbct_debug;

        // Possibility to switch agent version
        $data['agent'] = ! empty($data['agent'])
            ? $data['agent']
            : (defined('CLEANTALK_AGENT') ? CLEANTALK_AGENT : self::AGENT);

        // Make URL string
        $data_string = http_build_query($data);
        $data_string = str_replace("&amp;", "&", $data_string);

        // For debug purposes
        if (defined('CLEANTALK_DEBUG') && CLEANTALK_DEBUG) {
            $apbct_debug['sent_data']      = $data;
            $apbct_debug['request_string'] = $data_string;
        }

        // Possibility to switch API url
        $url = defined('CLEANTALK_API_URL') ? CLEANTALK_API_URL : $_url;

        if (function_exists('curl_init')) {
            $ch = curl_init();

            // Set diff options
            curl_setopt($ch, CURLOPT_URL, $url);
            curl_setopt($ch, CURLOPT_TIMEOUT, $timeout);
            curl_setopt($ch, CURLOPT_POST, true);
            curl_setopt($ch, CURLOPT_POSTFIELDS, $data_string);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
            curl_setopt($ch, CURLOPT_HTTPHEADER, array('Expect:'));

            $ssl_path = $ssl_path ?: (defined('CLEANTALK_CASERT_PATH') ? CLEANTALK_CASERT_PATH : '');

            // Switch on/off SSL
            if ($ssl && $ssl_path) {
                curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, true);
                curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 2);
                curl_setopt($ch, CURLOPT_CAINFO, $ssl_path);
            } else {
                curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
                curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
            }

            // Make a request
            $result = curl_exec($ch);
            $errors = curl_error($ch);
            curl_close($ch);
        } else {
            $errors = 'CURL_NOT_INSTALLED';
        }

        // Trying to use file_get_contents() to make a API call
        if ( ! empty($errors)) {
            if (ini_get('allow_url_fopen')) {
                $opts    = array(
                    'http' => array(
                        'method'  => "POST",
                        'timeout' => $timeout,
                        'content' => $data_string,
                    ),
                );
                $context = stream_context_create($opts);
                $result  = @file_get_contents($url, false, $context);

                $errors = $result === false
                    ? $errors . '_FAILED_TO_USE_FILE_GET_CONTENTS'
                    : false;
            } else {
                $errors .= '_AND_ALLOW_URL_FOPEN_IS_DISABLED';
            }
        }

        return empty($result) || ! empty($errors)
            ? array('error' => $errors)
            : $result;
    }

    /**
     * Function checks server response
     *
     * @param array|string $result
     * @param string $method_name
     *
     * @return mixed (array || array('error' => true))
     */
    public static function checkResponse($result, $method_name = null)
    {
        // Errors handling
        // Bad connection
        if (is_array($result)) {
            $last = error_get_last();

            return (isset($result['error']) && ! empty($result['error']))
                ? array('error' => 'CONNECTION_ERROR : "' . $result['error'] . '"')
                : array('error' => 'CONNECTION_ERROR : "Unknown Error. Last error: ' . $last['message']);
        }

        // JSON decode errors
        $result = json_decode($result, true);
        if (empty($result)) {
            return array(
                'error' => 'JSON_DECODE_ERROR',
            );
        }

        // Server errors
        if ($result && (isset($result['error_no'], $result['error_message']))) {
            if ($result['error_no'] != 12) {
                return array(
                    'error'         => "SERVER_ERROR NO: {$result['error_no']} MSG: {$result['error_message']}",
                    'error_no'      => $result['error_no'],
                    'error_message' => $result['error_message'],
                );
            }
        }

        // Patches for different methods
        switch ($method_name) {
            // notice_paid_till
            case 'notice_paid_till':
                $result = isset($result['data']) ? $result['data'] : $result;

                if ((isset($result['error_no']) && $result['error_no'] == 12) ||
                    (
                        ! (isset($result['service_id']) && is_int($result['service_id'])) &&
                        empty($result['moderate_ip'])
                    )
                ) {
                    $result['valid'] = 0;
                } else {
                    $result['valid'] = 1;
                }

                return $result;

            case 'email_check':
                return isset($result['data']) ? $result : array('error' => 'NO_DATA');

            // get_antispam_report_breif
            case 'get_antispam_report_breif':
                $out = isset($result['data']) && is_array($result['data'])
                    ? $result['data']
                    : array('error' => 'NO_DATA');

                for ($tmp = array(), $i = 0; $i < 7; $i++) {
                    $tmp[date('Y-m-d', time() - 86400 * 7 + 86400 * $i)] = 0;
                }
                $out['spam_stat']    = array_merge($tmp, isset($out['spam_stat']) ? $out['spam_stat'] : array());
                $out['top5_spam_ip'] = isset($out['top5_spam_ip']) ? array_slice($out['top5_spam_ip'], 0, 5) : array();

                return $out;

            case 'services_templates_add':
            case 'services_templates_update':
                return isset($result['data']) && is_array($result['data']) && count($result['data']) === 1
                    ? $result['data'][0]
                    : array('error' => 'NO_DATA');

            case 'private_list_add':
                return isset($result['records'][0]['operation_status']) && $result['records'][0]['operation_status'] === 'SUCCESS'
                    ? true
                    : array('error' => 'COULDNT_ADD_WL_IP');

            case '2s_blacklists_db':
                return isset($result['data']) && isset($result['data_user_agents'])
                    ? $result
                    : $result['data'];

            default:
                return isset($result['data']) && is_array($result['data'])
                    ? $result['data']
                    : array('error' => 'NO_DATA');
        }
    }
}
