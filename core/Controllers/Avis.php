<?php 
namespace Controllers;

class Avis extends AbstractController
{

    protected $defaultModelName =\Models\Avis::class;


    /**
     * creation d'un nouvel avis
     * 
     * @return Response
     */
    public function new():Response
    {

            $author = null;
            $content = null;
            $id = null;
            if (!empty($_POST['author']) && !empty($_POST['content']) && !empty($_POST['id']) && ctype_digit($_POST['id'])) {
                
            
                $author = htmlspecialchars($_POST['author']) ;
                $content = htmlspecialchars($_POST['content']) ;
                $id = (int)$_POST['id'];
            }
            
            
            if (!$author || !$content || !$id) {
                return $this->redirect(["type"=>"velo",
                                        "action"=>"index"]);
            
            
            }
            
            
            $modelVelo = new \Models\Velo();
            $velo = $modelVelo->findById($id);
            if (!$velo) {
                return $this->redirect(["type"=>"velo",
                                        "action"=>"index"]);
                
            }
            $avis = new \Models\Avis();
            $avis->setAuthor($author);
            $avis->setContent($content);
            $avis->setVeloId($id);
            $this->defaultModel->save($avis);
                
               return $this->redirect(["type"=>"velo",
                                        "action"=>"show",
                                        "id"=>$id]);
        
    
    }


    /**
 * supprime un avis par son id dans la bdd
 * @return Response
 * 
 */
public function delete():Response{


    $id = null;
    $idVelo = null;
    if (!empty($_POST['id']) && ctype_digit($_POST['id'])) {
    $id = (int)$_POST['id'];
    }
    if (!empty($_POST['idVelo']) && ctype_digit($_POST['idVelo'])) {
        $idVelo = (int)$_POST['idVelo'];
        }

    if (!$id || !$idVelo) {
        return $this->redirect([
            "type"=>"velo",
            "action"=>"index"
        ]);
    
    }

    
    $avis = $this->defaultModel->findById($id);

    if (!$avis) {
        return $this->redirect([
            "type"=>"velo",
            "action"=>"index"
        ]);
    }

    $this->defaultModel->remove($id);
    return $this->redirect([
        "type"=>"velo",
        "action"=>"show",
        "id"=>$idVelo
    ]);

}


/**
     * modifie un avis dans la bdd
     */
    public function change()
    {
        
        $idEdit = null;
        $author = null;
        $content = null;
        

        if(!empty($_POST['idEdit']) && ctype_digit($_POST['idEdit'])){ $idEdit =(int)$_POST['idEdit'];}
        if(!empty($_POST['author'])){ $author = $_POST['author'];}
        if(!empty($_POST['content'])){ $content = $_POST['content'];}
        
        if($idEdit && $author && $content){

          
            $avis = $this->defaultModel->findById($idEdit);
            
            if(!$avis){return $this->redirect([
                "type"=>"velo",
                "action"=>"index"
            ]);}


        
            $avis->setAuthor($author);
            $avis->setContent($content);
            
            

            $this->defaultModel->update($avis);

            return $this->redirect([
                "type"=>"velo",
                "action"=>"index"
            ]);


        }



        $id = null;
        if(!empty($_GET['id']) && ctype_digit($_GET['id'])){  $id = $_GET['id']; }
        if(!$id){return $this->redirect([
            "type"=>"velo",
            "action"=>"show"
        ]);}

        $avis = $this->defaultModel->findById($id);

        if(!$avis){return $this->redirect([
            "type"=>"velo",
            "action"=>"show"
        ]);}

      
        return $this->render("avis/edit", [
                                                    "pageTitle"=>"edition",
                                                    "avis"=>$avis
                                               ]);
    }


}

?>

