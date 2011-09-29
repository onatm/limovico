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
 * MODEL-CONTROLLER ABSTRACT CLASS (CORE)
 * -------------------------------------------------------------------------------
 *
 * User defined models and cotrollers should be extended from this abstract class.
 *
 */
abstract class Moco {

    public $wrapper;

    /*
	 * Constructor
	 *
	 * Wrapper class instance is the dependency of all models and controllers
	 *
	 * @access	private
     * @param   object wrapper class instance
	 */
    function __construct($wrapper)
	{
        $this->wrapper = &$wrapper;
	}
    
}

/*End of file Moco.php*/