<?php
/*
 * Limovico
 * 
 * An open source lightweight model-view-controller framework
 * 
 * @package     Limovico
 * @author      Onat Yiðit Mercan
 * @link        https://github.com/onatm/limovico
 * 
 */

/*
 * -------------------------------------------------------------------------------
 * MAIN POINT OF ACCESS FILE
 * -------------------------------------------------------------------------------
 *
 * This file provides main variables and site wide configurations.
 * 
 */

/*
 * -------------------------------------------------------------------------------
 * USER CONFIGURATIONS
 * -------------------------------------------------------------------------------
 *
 * ------------------------------------------------------------------------------- 
 * FOLDER PATHS
 * -------------------------------------------------------------------------------
 *
 * Variables should be set as this file is in the parent folder of
 * the system and application folders.
 * 
 */

$system_path = 'system';
$application_path = 'application';

/*
 *
 * ERROR REPORTING
 *
 */

error_reporting(E_ALL); // development
//error_reporting(0); // production

/*
 * ------------------------------------------------------------------------------- 
 * END OF USER CONFIGURATIONS
 * ------------------------------------------------------------------------------- 
 */

/*
 * ------------------------------------------------------------------------------- 
 * MAIN PATH CONSTANTS
 * -------------------------------------------------------------------------------
 *
 * DO NOT CHANGE ANYTHING
 *
 */

$root = realpath(dirname(__FILE__));

if (realpath($system_path) !== FALSE) { $system_path = realpath($system_path).'/'; }

if ( ! is_dir($system_path))
{
    die("Your system folder path is not set up correctly.
         You should edit the following file to fix the issue: "
         .pathinfo(__FILE__, PATHINFO_BASENAME));             
}

if (realpath($application_path) !== FALSE) { $application_path = realpath($application_path).'/'; }

if ( ! is_dir($application_path))
{
    die("Your application folder path is not set up correctly.
         You should edit the following file to fix the issue: "
         .pathinfo(__FILE__, PATHINFO_BASENAME));             
}

// Root folder's path
define('ROOT', $root);
// The PHP file extension
define('EXT', '.php');
// System folder's path
define('SYSPATH', $system_path);
// Application folder's path
define('APPPATH', $application_path);

/*
 * FIRE THE BOOTSTRAP
 *
 * 3, 2, 1..
 *
 */
require_once (SYSPATH.'engine/Bootstrap'.EXT);

?>
