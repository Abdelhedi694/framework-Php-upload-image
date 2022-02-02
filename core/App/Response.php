<?php 
namespace App;


class Response
{
    /**
     * redirige vers l'url passé en paramètre
     * @param array $parametres
     * @return void
     */
    public static function redirect(?array $parametres=null):void{

        // index.php?type=".$parametres['type']."&action=".$parametres['action']
        $url = "index.php";

        if ($parametres) {
            $url = "?";
            foreach($parametres as $cle => $valeur){


                    
                    $url .= $cle."=".$valeur."&";


            }




        }


        header("Location: ".$url);
        exit();

    }
}
?>