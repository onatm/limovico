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
 * TIMER CLASS (LIBRARY)
 * -------------------------------------------------------------------------------
 */
class Timer {
    
    var $start_time;

    /*
	 * Start the timer.
	 *
	 * @access	private
	 */
    function start()
    {
        $mtime = microtime(); 
        $mtime = explode(" ",$mtime); 
        $mtime = $mtime[1] + $mtime[0]; 
        $this->start_time = $mtime;
    }

    /*
	 * Return the elapsed time.
	 *
	 * @access	private
     * @return  float
	 */
    function elapsed_time()
    {
        $mtime = microtime(); 
        $mtime = explode(" ",$mtime); 
        $mtime = $mtime[1] + $mtime[0]; 
        return ($mtime - $this->start_time); 
    }
    
}

/*End of file Timer.php*/