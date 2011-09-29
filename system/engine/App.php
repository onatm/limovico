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
 * COMMON FUNCTIONS CLASS (CORE)
 * -------------------------------------------------------------------------------
 *
 * This class grants system wide common functions.
 * 
 */
class App {

	/*
	 * Class Loader
	 *
	 * Import the requested class.
	 *
	 * @access	static
	 * @param	string	directory name in SYSPATH
	 * @return	object
	 */
    static function &import($directory, $class)
    {
        if (file_exists(SYSPATH.$directory.'/'.$class.EXT))
        {
            require_once(SYSPATH.$directory.'/'.$class.EXT);
        }else {
            die('The class you wanted is not found: '.$class.EXT);
        }
        
        $class = new $class();
    
        return $class;
    }
    
    /*
	 * Hash function
	 *
	 * Hash the given variable with a salt
	 *
	 * @access	static
	 * @param	string	given salt
     * @param	string	given variable
	 * @return	string
	 */
    static function hash($salt, $var)
    {
        return base64_encode(sha1($salt.$var, TRUE).$salt);
    }

}

/*End of file App.php*/