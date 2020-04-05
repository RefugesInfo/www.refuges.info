<?php
/**
 * Cleantalk Base class
 * Compatible only with phpBB 3.1+
 * @version 2.3-phpbb
 * @package Cleantalk
 * @subpackage Base
 * @author Cleantalk team (welcome@cleantalk.org)
 * @copyright (C) 2014 CleanTalk team (http://cleantalk.org)
 * @license GNU/GPL: http://www.gnu.org/copyleft/gpl.html
 * @see https://github.com/CleanTalk/php-antispam 
 *
 */

namespace cleantalk\antispam\model;

use phpbb\request\request;

class Cleantalk
{    
    /**
    * Maximum data size in bytes
    * @var int
    */
    private $dataMaxSise = 32768;
    
    /**
    * Data compression rate 
    * @var int
    */
    private $compressRate = 6;
    
    /**
    * Server connection timeout in seconds 
    * @var int
    */
    private $server_timeout = 15;

    /**
     * Cleantalk server url
     * @var string
     */
    public $server_url = null;

    /**
     * Last work url
     * @var string
     */
    public $work_url = null;

    /**
     * WOrk url ttl
     * @var int
     */
    public $server_ttl = null;

    /**
     * Time wotk_url changer
     * @var int
     */
    public $server_changed = null;

    /**
     * Flag is change server url
     * @var bool
     */
    public $server_change = false;

    /**
     * Use TRUE when need stay on server. Example: send feedback
     * @var bool
     */
    public $stay_on_server = false;
    
    /**
     * Codepage of the data 
     * @var bool
     */
    public $data_codepage = null;
    
    /**
     * API version to use 
     * @var string
     */
    public $api_version = '/api2.0';
    
    /**
     * Use https connection to servers 
     * @var bool 
     */
    public $ssl_on = false;
    
    /**
     * Path to SSL certificate 
     * @var string
     */
    public $ssl_path = '';

    /**
     * Minimal server response in miliseconds to catch the server
     *
     */
    public $min_server_timeout = 50;

    /* @var \phpbb\request\request */
    protected $request;

    /**
    * Constructor
    * @param request        $request    Request object
    */    
    public function __construct(request $request)
    {
        $this->request = $request;
    }
    /**
     * Function checks whether it is possible to publish the message
     * @param CleantalkRequest $request
     * @return type
     */
    public function isAllowMessage(CleantalkRequest $request) 
    {
        $request = $this->filterRequest($request);
        $msg = $this->createMsg('check_message', $request);
        return $this->httpRequest($msg);
    }

    /**
     * Function checks whether it is possible to publish the message
     * @param CleantalkRequest $request
     * @return type
     */
    public function isAllowUser(CleantalkRequest $request) 
    {
        $request = $this->filterRequest($request);
        $msg = $this->createMsg('check_newuser', $request);
        return $this->httpRequest($msg);
    }

    /**
     * Function sends the results of manual moderation
     *
     * @param CleantalkRequest $request
     * @return type
     */
    public function sendFeedback(CleantalkRequest $request) 
    {
        $request = $this->filterRequest($request);
        $msg = $this->createMsg('send_feedback', $request);
        return $this->httpRequest($msg);
    }

    /**
     *  Filter request params
     * @param CleantalkRequest $request
     * @return type
     */
    private function filterRequest(CleantalkRequest $request) 
    {
        // general and optional
        foreach ($request as $param => $value) 
        {
            if (in_array($param, array('message', 'example', 'agent',
                        'sender_info', 'sender_nickname', 'post_info', 'phone')) && !empty($value)) 
            {
                if (!is_string($value) && !is_integer($value)) 
                {
                    $request->$param = NULL;
                }
            }

            if (in_array($param, array('stoplist_check', 'allow_links')) && !empty($value)) 
            {
                if (!in_array($value, array(1, 2))) 
                {
                    $request->$param = NULL;
                }
            }
            
            if (in_array($param, array('js_on')) && !empty($value)) 
            {
                if (!is_integer($value)) 
                {
                    $request->$param = NULL;
                }
            }

            if ($param == 'sender_ip' && !empty($value)) 
            {
                if (!is_string($value)) 
                {
                    $request->$param = NULL;
                }
            }

            if ($param == 'sender_email' && !empty($value)) 
            {
                if (!is_string($value)) 
                {
                    $request->$param = NULL;
                }
            }

            if ($param == 'submit_time' && !empty($value)) 
            {
                if (!is_int($value)) 
                {
                    $request->$param = NULL;
                }
            }
        }
        return $request;
    }
    
    /**
     * Compress data and encode to base64 
     * @param type string
     * @return string 
     */
    private function compressData($data = null)
    {
        
        if (strlen($data) > $this->dataMaxSise && function_exists('gzencode') && function_exists('base64_encode'))
        {

            $localData = gzencode($data, $this->compressRate, FORCE_GZIP);

            if ($localData === false)
            {
                return $data;
            }
            
            $localData = base64_encode($localData);
            
            if ($localData === false)
            {
                return $data;
            }
            
            return $localData;
        }

        return $data;
    } 

    /**
     * Create msg for cleantalk server
     * @param type $method
     * @param CleantalkRequest $request
     * @return \xmlrpcmsg
     */
    private function createMsg($method, CleantalkRequest $request) 
    {
        switch ($method) 
        {
            case 'check_message':
                // Convert strings to UTF8
                $request->message = $this->stringToUTF8($request->message, $this->data_codepage);
                $request->example = $this->stringToUTF8($request->example, $this->data_codepage);
                $request->sender_email = $this->stringToUTF8($request->sender_email, $this->data_codepage);
                $request->sender_nickname = $this->stringToUTF8($request->sender_nickname, $this->data_codepage);

                $request->message = $this->compressData($request->message);
                $request->example = $this->compressData($request->example);
                break;

            case 'check_newuser':
                // Convert strings to UTF8
                $request->sender_email = $this->stringToUTF8($request->sender_email, $this->data_codepage);
                $request->sender_nickname = $this->stringToUTF8($request->sender_nickname, $this->data_codepage);
                break;

            case 'send_feedback':
                if (is_array($request->feedback)) 
                {
                    $request->feedback = implode(';', $request->feedback);
                }
                break;
        }
        
        $request->method_name = $method;
        
        //
        // Removing non UTF8 characters from request, because non UTF8 or malformed characters break json_encode().
        //
        foreach ($request as $param => $value) 
        {
            if (!preg_match('//u', $value))
            {
                $request->{$param} = 'Nulled. Not UTF8 encoded or malformed.'; 
            }
        }
        
        return $request;
    }
    
    /**
     * Send JSON request to servers 
     * @param $msg
     * @return boolean|\CleantalkResponse
     */
    private function sendRequest($data = null, $url, $server_timeout = 3) 
    {
        // Convert to array
        $data = (array)json_decode(json_encode($data), true);
        
        $original_url = $url;
        $original_data = $data;
        
        //Cleaning from 'null' values
        $tmp_data = array();
        foreach($data as $key => $value)
        {
            if($value !== null)
            {
                $tmp_data[$key] = $value;
            }
        }
        $data = $tmp_data;
        unset($key, $value, $tmp_data);
        
        // Convert to JSON
        $data = json_encode($data);
        
        if (isset($this->api_version)) 
        {
            $url = $url . $this->api_version;
        }
        
        $result = false;
        $curl_error = null;
        if(function_exists('curl_init')) {

            $ch = curl_init();

            curl_setopt($ch, CURLOPT_URL, $url);
            curl_setopt($ch, CURLOPT_TIMEOUT, $server_timeout);
            curl_setopt($ch, CURLOPT_POST, 1);
            curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true); // receive server response ...
            curl_setopt($ch, CURLOPT_HTTPHEADER, array('Expect:')); // resolve 'Expect: 100-continue' issue
            curl_setopt($ch, CURLOPT_HTTP_VERSION, CURL_HTTP_VERSION_1_0); // see http://stackoverflow.com/a/23322368

            curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false); // Disabling CA cert verivication and
            curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);     // Disabling common name verification

            if ($this->ssl_on && $this->ssl_path != '') {
                curl_setopt($ch, CURLOPT_CAINFO, $this->ssl_path);
            }

            $result = curl_exec($ch);
            if (!$result) {
                $curl_error = curl_error($ch);
                // Use SSL next time, if error occurs.
                if(!$this->ssl_on){
                    $this->ssl_on = true;
                    $args = func_get_args();
                    return $this->sendRequest($args[0], $args[1], $server_timeout);
                }
            }

            curl_close($ch);
        }

        if (!$result) 
        {
            $allow_url_fopen = ini_get('allow_url_fopen');
            if (function_exists('file_get_contents') && isset($allow_url_fopen) && $allow_url_fopen == '1') 
            {
                $opts = array('http' =>
                  array(
                    'method'  => 'POST',
                    'header'  => "Content-Type: text/html\r\n",
                    'content' => $data,
                    'timeout' => $server_timeout
                  )
                );

                $context  = stream_context_create($opts);
                $result = @file_get_contents($url, false, $context);
            }
        }
        
        if (!$result || !$this->cleantalk_is_JSON($result)) 
        {
            $response = null;
            $response['errno'] = 1;
            $response['errstr'] = true;
            $response['curl_err'] = isset($curl_error) ? $curl_error : false;
            $response = json_decode(json_encode($response));
            
            return $response;
        }
        
        $errstr = null;
        $response = json_decode($result);
        if ($result !== false && is_object($response)) 
        {
            $response->errno = 0;
            $response->errstr = $errstr;
        } 
        else 
        {

            $response = null;
            $response['errno'] = 1;
            $response = json_decode(json_encode($response));
        } 
        
        
        return $response;
    }

    /**
     * httpRequest 
     * @param $msg
     * @return boolean|\CleantalkResponse
     */
    private function httpRequest($msg) 
    {    
        $result = false;
        if($msg->method_name != 'send_feedback')
        {
            $tmp = $this->request_headers();
            if ($tmp !== null)
            {
                $msg->all_headers=json_encode($tmp);
            }
        }
        $si=(array)json_decode($msg->sender_info,true);
        
        if(method_exists($this->request,'server'))
        {
            $si['remote_addr']=$this->request->server('REMOTE_ADDR');
            $msg->x_forwarded_for=$this->request->server('X_FORWARDED_FOR');
            $msg->x_real_ip=$this->request->server('X_REAL_IP');
        }
        
        $msg->sender_info=json_encode($si);
        if (((isset($this->work_url) && $this->work_url !== '') && ($this->server_changed + $this->server_ttl > time()))
                || $this->stay_on_server == true) 
        {    
            $url = (!empty($this->work_url)) ? $this->work_url : $this->server_url;
            
            $result = $this->sendRequest($msg, $url, $this->server_timeout);
        }

        if (($result === false || $result->errno != 0) && $this->stay_on_server == false) 
        {
            // Split server url to parts
            preg_match("@^(https?://)([^/:]+)(.*)@i", $this->server_url, $matches);
            $url_prefix = '';
            if (isset($matches[1]))
            {
                $url_prefix = $matches[1];
            }

            $pool = null;
            if (isset($matches[2]))
            {
                $pool = $matches[2];
            }
            
            $url_suffix = '';
            if (isset($matches[3]))
            {
                $url_suffix = $matches[3];
            }
            
            if ($url_prefix === '')
            {
                $url_prefix = 'http://';
            }

            if (empty($pool)) 
            {
                return false;
            } 
            else 
            {
                // Loop until find work server
                foreach ($this->get_servers_ip($pool) as $server) 
                {
                    if ($server['host'] === 'localhost' || $server['ip'] === null) 
                    {
                        $work_url = $server['host'];
                    } 
                    else 
                    {
                        $server_host = $server['ip'];
                        $work_url = $server_host;
                    }
                    $host = filter_var($work_url,FILTER_VALIDATE_IP) ? gethostbyaddr($work_url) : $work_url;
                    $work_url = $url_prefix . $host; 
                    if (isset($url_suffix))
                    { 
                        $work_url = $work_url . $url_suffix;
                    }
                    
                    $this->work_url = $work_url;
                    $this->server_ttl = $server['ttl'];
                    
                    $result = $this->sendRequest($msg, $this->work_url, $this->server_timeout);

                    if ($result !== false && $result->errno === 0) 
                    {
                        $this->server_change = true;
                        break;
                    }
                }
            }
        }
        
        $response = new CleantalkResponse(null, $result);
        
        if (!empty($this->data_codepage) && $this->data_codepage !== 'UTF-8') 
        {
            if (!empty($response->comment))
            {
                $response->comment = $this->stringFromUTF8($response->comment, $this->data_codepage);
            }
            if (!empty($response->errstr))
            {
                $response->errstr = $this->stringFromUTF8($response->errstr, $this->data_codepage);
            }
            if (!empty($response->sms_error_text))
            {
                $response->sms_error_text = $this->stringFromUTF8($response->sms_error_text, $this->data_codepage);
            }
        }
        
        return $response;
    }
    
    /**
     * Function DNS request
     * @param $host
     * @return array
     */
    private function get_servers_ip($host)
    {
        $response = null;
        if (!isset($host))
        {
            return $response;
        }

        if (function_exists('dns_get_record')) 
        {
            $records = dns_get_record($host, DNS_A);

            if ($records !== FALSE) 
            {
                foreach ($records as $server) 
                {
                    $response[] = $server;
                }
            }
        }

        if (count($response) == 0 && function_exists('gethostbynamel')) 
        {
            $records = gethostbynamel($host);

            if ($records !== FALSE) 
            {
                foreach ($records as $server) 
                {
                    $response[] = array(
                        "ip" => $server,
                        "host" => $host,
                        "ttl" => $this->server_ttl
                    );
                }
            }
        }

        if (count($response) == 0) 
        {
            $response[] = array("ip" => null,
                "host" => $host,
                "ttl" => $this->server_ttl
            );
        } 
        else 
        {
            // $i - to resolve collisions with localhost
            $i = 0;
            $r_temp = null;
            $fast_server_found = false;
            foreach ($response as $server) 
            {
                
                // Do not test servers because fast work server found
                if ($fast_server_found) 
                {
                    $ping = $this->min_server_timeout; 
                } 
                else 
                {
                    $ping = $this->httpPing($server['ip']);
                    $ping = $ping * 1000;
                }
                
                // -1 server is down, skips not reachable server
                if ($ping != -1) 
                {
                    $r_temp[$ping + $i] = $server;
                }
                $i++;
                
                if ($ping < $this->min_server_timeout) 
                {
                    $fast_server_found = true;
                }
            }
            if (count($r_temp))
            {
                ksort($r_temp);
                $response = $r_temp;
            }
        }

        return $response;
    } 
    
    /**
    * Function to check response time
    * param string
    * @return int
    */
    private function httpPing($host)
    {
        // Skip localhost ping cause it raise error at fsockopen.
        // And return minimun value 
        if ($host == 'localhost')
        {
            return 0.001;
        }

        $starttime = microtime(true);
        $file      = @fsockopen ($host, 80, $errno, $errstr, $this->server_timeout);
        $stoptime  = microtime(true);
        $status    = 0;
        if (!$file) 
        {
            $status = -1;  // Site is down
        } 
        else 
        {
            fclose($file);
            $status = ($stoptime - $starttime);
            $status = round($status, 4);
        }
        
        return $status;
    }
    
    /**
    * Function convert string to UTF8 and removes non UTF8 characters 
    * param string
    * param string
    * @return string
    */
    private function stringToUTF8($str, $data_codepage = null)
    {
        if (!preg_match('//u', $str) && function_exists('mb_detect_encoding') && function_exists('mb_convert_encoding'))
        {
            if ($data_codepage !== null)
            {
                return mb_convert_encoding($str, 'UTF-8', $data_codepage);
            }

            $encoding = mb_detect_encoding($str);
            if ($encoding)
            {
                return mb_convert_encoding($str, 'UTF-8', $encoding);
            }
        }
        
        return $str;
    }
    
    /**
    * Function convert string from UTF8 
    * param string
    * param string
    * @return string
    */
    private function stringFromUTF8($str, $data_codepage = null)
    {
        if (preg_match('//u', $str) && function_exists('mb_convert_encoding') && $data_codepage !== null)
        {
            return mb_convert_encoding($str, $data_codepage, 'UTF-8');
        }
        
        return $str;
    }

    /* 
     * If Apache web server is missing then making
     * Patch for apache_request_headers() 
     */
    private function request_headers()
    {   
        $headers['Host']  = $this->request->server('HTTP_HOST','');
        $headers['X-Real-IP'] = $this->request->server('HTTP_X_REAL_IP','');
        $headers['X-Forwarded-Proto'] = $this->request->server('HTTP_X_FORWARDED_PROTO','');
        $headers['Connection'] = $this->request->server('HTTP_CONNECTION','');
        $headers['Content-Length'] = $this->request->server('CONTENT_LENGTH','');
        $headers['Cache-Control'] = $this->request->server('HTTP_CACHE_CONTROL','');
        $headers['Origin'] = $this->request->server('HTTP_ORIGIN','');
        $headers['Upgrade-Insecure-Requests'] = $this->request->server('HTTP_UPGRADE_INSECURE_REQUESTS','');
        $headers['Content-Type'] = $this->request->server('CONTENT_TYPE','');
        $headers['User-Agent'] = $this->request->server('HTTP_USER_AGENT','');
        $headers['Accept'] = $this->request->server('HTTP_ACCEPT','');
        $headers['Referer'] = $this->request->server('HTTP_REFERER','');
        $headers['Accept-Encoding'] = $this->request->server('HTTP_ACCEPT_ENCODING','');
        $headers['Accept-Language'] = $this->request->server('HTTP_ACCEPT_LANGUAGE','');            
        return $headers;
    }

    /**
    * Function to check  JSON string
    * param string
    * @return boolean
    */
    private function cleantalk_is_JSON($string)
    {
        return ((is_string($string) && (is_object(json_decode($string)) || is_array(json_decode($string))))) ? true : false;
    }

    /**
    * Function to get IP address
    * @return string
    */
    public function cleantalk_get_real_ip()
    {       
        if ($this->request->server('X_FORWARDED_FOR'))
        {
            $ip = explode(",", trim($this->request->server('X_FORWARDED_FOR')));
            $ip = trim($ip[0]);
        }
        elseif ($this->request->server('HTTP_X_FORWARDED_FOR'))
        {
            $ip = explode(",", trim($this->request->server('HTTP_X_FORWARDED_FOR')));
            $ip = trim($ip[0]);
        }
        else
        {
            $ip = $this->request->server('REMOTE_ADDR');
        }
         // Validating IP
        // IPv4
        if(filter_var($ip, FILTER_VALIDATE_IP, FILTER_FLAG_IPV4))
        {
            $the_ip = $ip;
            // IPv6
        }
        elseif(filter_var($ip, FILTER_VALIDATE_IP, FILTER_FLAG_IPV6))
        {
            $the_ip = $ip;
            // Unknown
        }
        else
        {
            $the_ip = null;
        }
        
        return $the_ip;
    }    

}
