<?php
namespace Controllers\Mnt;

use Controllers\PublicController;
use Exception;
use Views\Renderer;

class Car extends PublicController{
    private $redirectTo = "index.php?page=Mnt-Cars";
    private $viewData = array(
        "mode" => "DSP",
        "modedsc" => "",
        "registro_id" => 0,
        "placa_carro" => "",
        "modelo_carro" => "",
        "year_carro" => "",
        "bin_carro" => "",
        "placa_carro_error"=> "",
        "general_errors"=> array(),
        "has_errors" =>false,
        "show_action" => true,
        "readonly" => false,
        "xssToken" =>""
    );
    private $modes = array(
        "DSP" => "Detalle de %s (%s)",
        "INS" => "Nueva Car",
        "UPD" => "Editar %s (%s)",
        "DEL" => "Borrar %s (%s)"
    );
    public function run() : void
    {
        try{
            $this->page_loaded();
            if($this->isPostBack()){
                $this->validatePostData();
                if(!$this->viewData["has_errors"]){
                    $this->executeAction();
                }
            }
            $this->render();
        }  catch (Exception $error){
            unset($_SESSION["xssToken_Mnt_Car"]);
            error_log(sprintf("Controller/Mnt/Car ERROR: %s", $error->getMessage()));
            \Utilities\Site::redirectToWithMsg(
                $this->redirectTo,
                "Algo Inesperado Sucedió. Intente de Nuevo."
            );
        }
    }

    private function page_loaded(){
        if(isset($_GET['mode'])){
            if(isset($this->modes[$_GET['mode']])){
                $this->viewData["mode"] = $_GET['mode'];
            }else{
                throw new Exception("Mode Not available");
            }
        }else{
            throw new Exception("Mode not defined on Query Params");
        }
        if($this->viewData["mode"] !== "INS"){
            if(isset($_GET['registro_id'])){
                $this->viewData["registro_id"] = intval($_GET["registro_id"]);
            }else{
                throw new Exception("Id not found on Query Params");
            }
        }
    }

    private function validatePostData(){
        if(isset($_POST["xxsToken"])){
            if(isset($_SESSION["xssToken_Mnt_Car"])){
                if($_POST["xssToken"] !== $_SESSION["xssToken_Mnt_Car"]){
                    throw new Exception("Invalid Xss Token no match");
                }
            }else {
                throw new Exception("Invalid Xss Token on Session");
            }
        }else {
            throw new Exception("Invalid Xss Token");
        }
        
        if(isset($_POST["placa_carro"])){
            if(\Utilities\Validators::IsEmpty($_POST["placa_carro"])){
                $this->viewData["has_errors"] = true;
                $this->viewData["placa_carro_error"] = "La Placa no puede ir vacío!";
            }
        } else {
            throw new Exception("placa_carro not present in form");
        }

        if(isset($_POST["modelo_carro"])){
            if(\Utilities\Validators::IsEmpty($_POST["modelo_carro"])){
                $this->viewData["has_errors"] = true;
                $this->viewData["general_errors"][] = "El Modelo no puede ir vacío!";
            }
        } else {
            throw new Exception("modelo_carro not present in form");
        }

        if(isset($_POST["year_carro"])){
            if(\Utilities\Validators::IsEmpty($_POST["year_carro"])){
                $this->viewData["has_errors"] = true;
                $this->viewData["general_errors"][] = "El year no puede ir vacío!";
            }
        } else {
            throw new Exception("year_carro not present in form");
        }

        if(isset($_POST["bin_carro"])){
            if(\Utilities\Validators::IsEmpty($_POST["bin_carro"])){
                $this->viewData["has_errors"] = true;
                $this->viewData["general_errors"][]= "El bin carro no puede ir vacío!";
            }
        } else {
            throw new Exception("bin_carro not present in form");
        }

        if(isset($_POST["registro_id"])){
            if(($this->viewData["mode"] !== "INS" && intval($_POST["registro_id"])<=0)){
                throw new Exception("registro_id is not Valid");
            }
            if($this->viewData["registro_id"]!== intval($_POST["registro_id"])){
                throw new Exception("registro_id value is different from query");
            }
        }else {
            throw new Exception("registro_id not present in form");
        }

        $this->viewData["placa_carro"] = $_POST["placa_carro"];
            $this->viewData["modelo_carro"] = $_POST["modelo_carro"];
            $this->viewData["year_carro"] = $_POST["year_carro"];
            $this->viewData["bin_carro"] = $_POST["bin_carro"];
    }

    private function executeAction(){
        switch($this->viewData["mode"]){
            case "INS":
                $inserted = \Dao\Mnt\Cars::insert(
                    $this->viewData["placa_carro"],
                    $this->viewData["modelo_carro"],
                    $this->viewData["year_carro"],
                    $this->viewData["bin_carro"],
                );
                if($inserted > 0){
                    \Utilities\Site::redirectToWithMsg(
                        $this->redirectTo,"Registro de carro creado exitosamente"
                    );
                }
                break;

            case "UPD":
                $updated = \Dao\Mnt\Cars::update(
                $this->viewData["placa_carro"],
                $this->viewData["modelo_carro"],
                $this->viewData["year_carro"],
                $this->viewData["bin_carro"],
                $this->viewData["registro_id"]
                );
                if($updated > 0){
                    Utilities\Site::redirectToWithMsg(
                        $this->redirectTo, "Registro de carro actualizado correctamente"
                    );
                }
                break;
            
            case "DEL":
                $deleted = \Dao\Mnt\Cars::delete(
                    $this->viewData["registro_id"]
                );
                if($deleted > 0){
                    \Utilities\Site::redirectToWithMsg(
                        $this->redirectTo,"Registro de carro eliminado correctamente"
                    );
                }
                break;
                
        }
    }
    

}