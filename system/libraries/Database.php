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
 * Wrapper CLASS (LIBRARY)
 * -------------------------------------------------------------------------------
 *
 * This class is a singleton class and dependency for models and controllers.
 * It loads the requested model, view and library.
 * 
 */
class Database {

    var $host;
    var $username;
    var $password;
    var $database;

    var $link;
    var $db_link;
    
    var $query;
    var $result_object = array();

    /*
	 * Constructor
	 *
	 * Gets database configuration.
	 */
    function __construct()
	{
        require_once(APPPATH.'configurations/database'.EXT);
        $this->host = $database['host'];
        $this->username = $database['username'];
        $this->password = $database['password'];
        $this->database = $database['database'];
	}

    /*
	 * This function makes connection to database and returns self instance.
	 *
	 * @access	private
	 * @return	object self instance
	 */
    function &connect()
    {
        if(!$this->link)
        {
            $this->link = @mysql_connect($this->host,$this->username,$this->password);
            if(!$this->link)
            {
				die(mysql_error());
            }else {
                $this->db_link= @mysql_select_db($this->database,$this->link);
                if(!$this->db_link) { die(mysql_error()); } else { return $this; }
            }
        }
    }
 
    /*
	 * Execute the sql command given.
	 *
	 * @access	private
	 * @param	string sql command
	 */
    function query($sql)
    {
        $sql = $this->sanitize($sql);
        $this->query = @mysql_query($sql);
        if(!$this->query) { die(mysql_error()); }
    }

    /*
	 * Return number of rows of the executed query.
	 *
	 * @access	private
	 * @return	string
	 */
    function num_rows()
    {
        return @mysql_num_rows($this->query);
    }
 
    /*
	 * Return the result of the executed query as object.
	 *
	 * @access	private
	 * @return	object
	 */
    function result()
    {
        while ($row = @mysql_fetch_object($this->query))
		{
			$this->result_object[] = $row;
		}
        return $this->result_object;
    }
    
    /*
	 * Return the request column of the executed query.
	 *
	 * @access	private
     * @param   string requested column
	 * @return	string
	 */   
    function row($col)
    {
        return @mysql_result($this->query,0,$col);
    }
 
     /*
	 * Close database connection.
     *
	 * @access	private
	 * @return	string
	 */
    function close()
    {
        @mysql_close($this->link);
    }
    
    /*
	 * Sanitize the given sql command.
	 *
	 * @access	private
     * @param   string sql command
	 * @return	string
	 */
    function sanitize($sql)
    {
        $sql = mysql_escape_string(trim($sql));
        $sql = preg_replace ('/<[^>]*>/', '', $sql);
        return $sql;
    }
      
}

/*End of file Database.php*/