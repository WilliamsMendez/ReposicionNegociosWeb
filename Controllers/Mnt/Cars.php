<?php 

namespace Controllers\Mnt;

use Controllers\PublicController;
use View\Renderer;

class Cars extends PublicController{

    public function run() :void{
        $viewData = array(
            "edit_enable" =>true,
            "delete_enable" =>true,
            "new_enable" => true
        );
        $viewData["cars"] = \Dao\Mnt\Cars::findAll();
        Renderer::render('mnt/cars',$viewData);
    }
}
?>