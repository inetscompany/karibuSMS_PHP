<?php

/**
 * -----------------------------------------
 * 
 * ******* Address****************
 * INETS COMPANY LIMITED
 * P.O BOX 32258, DAR ES SALAAM
 * TANZANIA
 * 
 * 
 * *******Office Location *********
 * 11th block, Bima Road, Mikocheni B, Kinondoni, Dar es salaam
 * 
 * 
 * ********Contacts***************
 * Email: <info@inetstz.com>
 * Website: <www.inetstz.com>
 * Mobile: <+255 655 406 004>
 * Tel:    <+255 22 278 0228>
 * -----------------------------------------
 */
//**** We check if your server support php curl.....
if (!function_exists('curl_init')) {
    die('KaribuSMS needs you to install first CURL PHP extension. If you use linux, '
	    . 'check it here http://goo.gl/FbtR9n');
}

//**** Check if JSON is enabled in your server
if (!function_exists('json_decode')) {
    die('karibusms needs you to install first JSON PHP extension.');
}

class karibusms {

    private $HEADER = array(
	'application/x-www-form-urlencoded'
    );
    private $URL = 'http://karibusms.com/api';
    private $name;

    /**
     *
     * @var karibuSMSpro
     * @uses True Will not use your android phone to send SMS but will use internet messaging
     * 	     False is the default. SMS will be called from your android phone
     */
    public $karibuSMSpro = TRUE;

    public function __construct() {
	if (!defined('API_KEY')) {
	    die('define first your API_KEY. To define, just write: '
		    . 'define("API_KEY","paste your api key here");');
	}
	if (!defined('API_SECRET')) {
	    die('define first your API_SECRET. To define, just write:'
		    . ' define("API_SECRET","paste your secret key here");');
	}
    }

    /**
     * 
     * @param type $name
     * @uses Set a name Name that will appear as from keyword in message sent
     * @access public, Used only when you use karibusmspro=TRUE; but is still an
     *                 option case. If you don't set name and you use karibusmspro=true,
     *                 app name will be displayed as from name, in a message
     * @return type
     */
    public function set_name($name) {
	return $this->name = $name;
    }

    /**
     * 
     * @return JSON object 
     */
    public function get_statistics() {
	$param = array(
	    'api_secret' => API_SECRET,
	    'api_key' => API_KEY,
	    'tag' => 'get_statistics'
	);
	return $this->curl($param);
    }

    /**
     * 
     * @param type $phone_number 
     * @param type $message
     * @return message from Server
     * @example path $karibusms->send_sms(255714826458,25578658464,"Hello");
     */
    public function send_sms($phone_number, $message) {
	$pro = $this->karibuSMSpro == FALSE ? 0 : 1;
	$name = $this->name == '' ? 0 : $this->name;
	$fields = array(
	    'phone_number' => $phone_number,
	    'message' => $message,
	    'api_secret' => API_SECRET,
	    'karibusmspro' => $pro,
	    'name' => $name,
	    'api_key' => API_KEY
	);
	return $this->curl($fields);
    }

    /**
     * 
     * @param type $pure_string
     * @return type
     */
    private function encryptApp($pure_string) {
	$iv = "1234567812345678";
	$data = openssl_encrypt($pure_string, 'aes-256-cbc', API_KEY, OPENSSL_RAW_DATA, $iv);
	return base64_encode($data);
    }

    /**
     * 
     * @param type $fields
     */
    private function curl($fields) {
	// Open connection
	$ch = curl_init();
	// Set the url, number of POST vars, POST data

	curl_setopt($ch, CURLOPT_URL, $this->URL);
	curl_setopt($ch, CURLOPT_HTTPHEADER, $this->HEADER);

	curl_setopt($ch, CURLOPT_POST, TRUE);
	curl_setopt($ch, CURLOPT_POSTFIELDS, $fields);

	curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

	$result = curl_exec($ch);
	curl_close($ch);
	return $result;
    }

}
