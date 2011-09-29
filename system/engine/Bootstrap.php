<?php if ( ! defined('SYSPATH')) die('You didn\'t say the magic word!');
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
 * FRONT CONTROLLER FILE
 * -------------------------------------------------------------------------------
 *
 * Imports the core classes and executes the requested controller's method
 * with parameters.
 * 
 */

/*
 * -------------------------------------------------------------------------------
 * IMPORT CORE CLASSES
 * -------------------------------------------------------------------------------
 */

/*static common functions class*/ 
require_once (SYSPATH.'engine/App'.EXT);
/*static errors class*/
require_once (SYSPATH.'engine/Errors'.EXT);
/*model-controller abstract class*/
require_once (SYSPATH.'engine/Moco'.EXT);
/*singleton wrapper-loader class. dependecy of model-controller*/
require_once (SYSPATH.'engine/Wrapper'.EXT);
/*router class*/ 
$ROUTER = App::import('engine','Router');

/*
 * -------------------------------------------------------------------------------
 * Fetch the requested uri and return the requested controller and its method
 * -------------------------------------------------------------------------------
 */

$c = $ROUTER->fetch_uri();

/*
 * -------------------------------------------------------------------------------
 * Check if the controller and the method exists.
 * -------------------------------------------------------------------------------
 */

if(file_exists($c))
{
    require_once($c);
    if (method_exists($ROUTER->controller,$ROUTER->method))
    {
        // Instantiate the requested controller
        $LIMOVICO = new $ROUTER->controller(Wrapper::get_instance());
    }
    else
    {
        Errors::show404();
    }
}
else
{
    Errors::show404();
}

/*
 * -------------------------------------------------------------------------------
 * Call the requested method and pass the parameters to it.
 * -------------------------------------------------------------------------------
 */
 
call_user_func(array(&$LIMOVICO, $ROUTER->method), $ROUTER->parameters);

/*End of file Bootstrap.php*/