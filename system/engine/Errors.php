<?php if ( ! defined('SYSPATH')) exit('You didn\'t say the magic word!');
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
 * ERROR CLASS (CORE)
 * -------------------------------------------------------------------------------
 *
 * This class grants system wide error calls.
 * 
 */
class Errors {

	/*
	 * Show 404 error.
	 *
	 * @access	static
	 */
    static function show404()
    {
		$message = "404 Page Not Found";
		include(APPPATH.'errors/404error'.EXT);
        exit();
    }

}

/*End of file Errors.php*/