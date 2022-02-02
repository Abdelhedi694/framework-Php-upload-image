<?php 
namespace Controllers;


class AbstractController{


    protected object $defaultModel;
    
    protected $defaultModelName;


        public function __construct()
                {
                                    // new \Models\Cocktail()
                $this->defaultModel= new $this->defaultModelName();

                }

        public function redirect(? array $url=null):Response
        {

            return \App\Response::redirect($url);

        }     
        
        public function render(string $nomDeTemplate,array $donnees)
        {

            return \App\View::render($nomDeTemplate, $donnees);

        }

}



?>