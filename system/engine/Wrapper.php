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
 * Wrapper CLASS (CORE)
 * -------------------------------------------------------------------------------
 *
 * This class is a singleton class and dependency for models and controllers.
 * It loads the requested model, view and library.
 * 
 */
class Wrapper {

    static $instance;

    var $modules_path = '';
    var $library_path = '';
    
    /*Constructor*/
    function __construct()
	{
        self::$instance =& $this;
        $this->modules_path = APPPATH.'modules/';
        $this->library_path = SYSPATH.'libraries/';
	}
    
    /*
	 * Instantiate the class.
	 *
	 * @access	public
	 * @return	object reference
	 */
    public static function &get_instance()
	{
        if (!isset(self::$instance)) {
            self::$instance = new self();
        }
		return self::$instance;
	}
    
    /*
	 * Load requested model.
	 *
	 * @access	private
     * @param   string module's name
     * @param   string model's name
	 */
    function model($module, $model)
	{
		if ($model == '') die('You haven\'t specified any model');
        if ( ! file_exists($this->modules_path.$module.'/models/'.$model.EXT))
            die('There is not such a model in your model directory');
        if (isset($this->$model))
			die('This model is already loaded: '.$model);
        require_once($this->modules_path.$module.'/models/'.$model.EXT);
        $model = strtolower($model);
        $this->$model = new $model($this);
	}

    /*
	 * Load requested view.
	 *
	 * @access	private
     * @param   string module's name
     * @param   string view's name
     * @param   array the data sent to view
	 */
    function view($module, $view, $vars = array())
    {
        if ($view == '') die('You haven\'t specified any view');
        if ( ! file_exists($this->modules_path.$module.'/views/'.$view.EXT))
            die('There is not such a view in your view directory');
        if(sizeof($vars) > 0) extract($vars);
        include($this->modules_path.$module.'/views/'.$view.EXT);
    }
    
    /*
	 * Load requested library.
	 *
	 * @access	private
     * @param   string library's name
	 */
    function library($library)
    {
		if ($library == '') die('You haven\'t specified any library'); 
        if ( ! file_exists($this->library_path.$library.EXT))
            die('There is not such a library in your library directory');
        if (isset($this->$library))
			die('This library is already loaded: '.$library);
        require_once($this->library_path.$library.EXT);
        $library = strtolower($library);
        $this->$library = new $library();
    }
}

/*End of file Wrapper.php*/