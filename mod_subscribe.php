<?php

/**
 * Web Query Module Entry Point
 * 
 * @package    Joomla
 * @subpackage Modules
 * @license    MIT
 * @link
 *     
 */
 
// No direct access
defined('_JEXEC') or die;

// Load vendors
include 'vendor/autoload.php';

// Load helpers
include 'helpers/db.php';
include 'helpers/mailer.php';

// Gather FuelPHP
use Fuel\Validation\Validator;

// Check for post data
if($post = JRequest::getVar('subscribe', false, 'post')){

    // Check honeypot
    if( ! empty($_POST['birthday']) ){
        return true;
    }

    // Validate
    $val = new Validator;
    $val->addField('email')->required()->email();
    $result = $val->run($post);
    if($result->isValid()){

        // Save data
        SubscribeHelperDB::save($post);

        // Email data
        SubscribeHelperMailer::send(
            array(
                $params->get('to_a'), 
                $params->get('to_b'), 
                $params->get('to_c')
            ),
            array(
                $params->get('cc_a'), 
                $params->get('cc_b'), 
                $params->get('cc_c')
            ),
            array(
                $params->get('bcc_a'), 
                $params->get('bcc_b'), 
                $params->get('bcc_c')
            ),
            $params->get('subject'),
            $post
        );

        // We done
        print '<div class="ui message"><i class="ui circular checkmark icon"></i>Sent successfully, we will be in touch.</div>';

        // Message
        //JFactory::getApplication()->enqueueMessage('Please check that all required fields have been completed.', 'success');

        // End
        return true;
    }

}

// Display data
ob_start();
    require JModuleHelper::getLayoutPath('mod_subscribe', 'default');
    $get = ob_get_contents();
ob_end_clean();
print preg_replace("({{ ?form ?}})", $get, $params->get('template'));