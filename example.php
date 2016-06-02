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


/**
 * include first your karibusms.php file
 */
include_once 'karibusms.php';

/**
 *  define your api key and api secret
 */
define("API_KEY", "21541789095");
define("API_SECRET", "9c57d6c6f41b893123a286e5803ae95a8b52d395");

/**
 * call your object
 */
$karibu = new karibusms();

/**
 * If you uncomment and put this variable true, you will send karibuSMSpro SMS
 * otherwise, you will use karibuSMS. By default, it is false, so you will use
 * your phone to send SMS
 * 
 *  $karibu->karibuSMSpro=TRUE;
 */
//
$karibu->karibuSMSpro=FALSE;
//
//# Set this only if you set karibuSMSpro=TRUE, otherwise it will be neglected
//$karibu->set_name('FROMNAME');
/**
 * send your sms now......
 */
$data=$karibu->send_sms('0655406004', 'hellow. www.karibusms.com/inets');
//$data=$karibu->get_statistics();
print_r($data);