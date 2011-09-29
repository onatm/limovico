<?php if ( ! defined('SYSPATH')) exit('You didn\'t say the magic word!');

class Home extends Moco {

    function show()
    {
        $data['welcome'] = 'Welcome to Limovico';
        $this->wrapper->view('home','home_view',$data);
    }
    
}

/*End of home.php*/