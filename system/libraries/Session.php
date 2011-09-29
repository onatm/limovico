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
 * SESSION CLASS (LIBRARY)
 * -------------------------------------------------------------------------------
 */
class Session {
    
    var $salt = 'ABCxyz123';
    var $auto = FALSE;
    
    /*Constructor*/
    function __construct()
    {
        session_start();
    }

    /*
	 * Create fingerprint of the user.
	 *
	 * @access	private
	 */
    function create_fingerprint()
    {
        $_SESSION['fingerprint'] = App::hash($this->salt,$_SERVER['HTTP_USER_AGENT']);
        if($this->auto) { $this->set_cookie('fingerprint', $_SESSION['fingerprint']); }
    }
 
    /*
	 * Create cookies automatically when a session is created.
	 *
	 * @access	private
	 */
    function auto_cookies()
    {
        $this->auto = TRUE;
    }
    
    /*
	 * Set $_SESSION[index]
	 *
	 * @access	private
     * @param   string $_SESSION's index
     * @param   string $_SESSION[index]'s value
	 */
    function set_session($data, $value)
    {
        $_SESSION[$data] = $value;
        if($this->auto) { $this->set_cookie($data, $value); }
    }
    
    /*
	 * Return $_SESSION[index]
	 *
	 * @access	private
     * @param   string $_SESSION's index
     * @return  string
	 */
    function get_session($data)
    {
        return $_SESSION[$data];
    }
 
    /*
	 * Unset $_SESSION array
	 *
	 * @access	private
	 */
    function unset_session()
    {
        unset($_SESSION);
        session_destroy();
    }

    /*
	 * Set $_COOKIE[index]
	 *
	 * @access	private
     * @param   string $_COOKIE's index
     * @param   string $_COOKIE[index]'s value
     * @param   int
	 */    
    function set_cookie($data, $value, $expiration)
    {
        if(!isset($expiration)) { $expiration = time()+60*60*24*100; }
        setcookie($data, $value, $expiration);
    }

    /*
	 * Return $_COOKIE[index]
	 *
	 * @access	private
     * @param   string $_COOKIE's index
     * @return  string
	 */
    function get_cookie($data)
    {
        return $_COOKIE[$data];
    }

    /*
	 * Unset $_COOKIE[index]
	 *
	 * @access	private
     * @param   string $_COOKIE's index
	 */
    function unset_cookie($data)
    {
        $past = time() - 3600;
        setcookie( $data, '', $past, '/' );
    }

    /*
	 * Unset $_SERVER['HTTP_COOKIE'] ($_SESSIN and $_COOKIE)
	 *
	 * @access	private
	 */  
    function unset_all()
    {
        if (isset($_SERVER['HTTP_COOKIE'])) {
            $cookies = explode(';', $_SERVER['HTTP_COOKIE']);
            $past = time() - 3600;
            foreach($cookies as $cookie) {
                $parts = explode('=', $cookie);
                $name = trim($parts[0]);
                setcookie($name, '', $past);
                setcookie($name, '', $past, '/');
            }
        }
    }
    
}

/*End of file Session.php*/