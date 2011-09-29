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
 * ROUTER CLASS (CORE)
 * -------------------------------------------------------------------------------
 *
 * This class fetches URI and sets controller, method and parameters
 * 
 */
class Router {

    var $controller;
    var $method;
    var $parameters = array();
    
    /*
	 * Constructor
	 *
	 * Gets routing configuration.
	 */
    function __construct()
	{
        require_once(APPPATH.'configurations/routes'.EXT);
        $this->controller = $route['default_controller'];
        $this->method = $route['default_method'];
	}
    
    /*
	 * URI fetcher
	 *
	 * Fetch the REQUEST_URI and returns requested controller's method.
	 *
	 * @access	private
	 * @return	string
	 */
    function fetch_uri()
    {
        $uri = $_SERVER['REQUEST_URI'];

        if(strpos($uri, $_SERVER['SCRIPT_NAME']) == 0)
        {
            $uri = substr($uri, strlen($_SERVER['SCRIPT_NAME']));
        }
        
        $segments = preg_split('[/]', $uri, 0, PREG_SPLIT_NO_EMPTY);
            
        $segmentCount = count($segments);
        
        for($i=0; $i<$segmentCount; $i++) { $segments[$i] = $this->filter_uri($segments[$i]); }
    
        if(isset($segments[0])) { $this->controller = $segments[0]; }
            
        if(isset($segments[1])) { $this->method = $segments[1]; }
    
        if($segmentCount > 2) { $this->parameters = array_splice($segments, 2); }
        
        return APPPATH.'modules/'.$this->controller.'/controllers/'.$this->controller.EXT;
    }

    /*
	 * Filter the given uri segment.
	 *
	 * @access	private
     * @param   string uri segment
	 * @return	string
	 */
    function filter_uri($seg)
    {
        // There could be regex match to find unwanted events to create a log about it.
        $seg = htmlspecialchars($seg, ENT_QUOTES);
        return $seg;
    }

}

/*End of file Router.php*/