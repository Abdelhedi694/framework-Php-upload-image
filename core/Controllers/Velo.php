<?php 
namespace Controllers;

class Velo extends AbstractController
{

    protected $defaultModelName =\Models\Velo::class;

/**
 * Affiche tous les vélos 
 * 
 */
    public function index(){


            $velos = $this->defaultModel->findAll();
            $pageTitle = "Tous les vélos";

            return $this->render("velos/index", compact("velos", "pageTitle"));

    }

/**
 * Affiche un vélo à partir de son id
 * 
 */
    public function show()
{

    $id = null;
            if (!empty($_GET['id']) && ctype_digit($_GET['id'])) {
                $id = (int)$_GET['id'];
            }

            if (!$id) {
                return $this->redirect([
                    "type"=>"velo",
                    "action"=>"index"
                ]);
            }

            
            $velo = $this->defaultModel->findById($id);
            if ( !$velo ) {  return $this->redirect([
                "type"=>"velo",
                "action"=>"index"
            ]); }

            $pageTitle = $velo->getName();

            $modelAvis = new \Models\Avis();
            $avis = $modelAvis->findAllByVelo($velo->getId());
            



            return $this->render("velos/show", compact("velo", "pageTitle","avis"));


}


/**
 * creation d'un nouveau cocktail
 * 
 */
public function new(){

    $name = null;
    $description = null;
    $price = null;

   if(!empty($_POST['name'])){ $name = htmlspecialchars($_POST['name']) ; }
   if(!empty($_POST['description'])){ $description = htmlspecialchars($_POST['description']) ; }
   if(!empty($_POST['price'])){ $price = (int)$_POST['price'] ; }
  
    if( $name && $description && !empty($_FILES['imageVelo']) && $price){
      

        
        $file = new \App\File("imageVelo");
        if ($file->isImage()) {
           
           
            $file->upload();
            $velo = new \Models\Velo();
            $velo->setName($name);
            $velo->setDescription($description);
            $velo->setImage($file->getName());
            $velo->setPrice($price);

                               
            $this->defaultModel->save($velo);

            return $this->redirect([
            "type"=>"velo",
            "action"=>"index"
            ]);
        }
        

    }


    return $this->render('velos/create', ["pageTitle"=> "nouveau vélo"]);


}


/**
 * supprime un velo par son id dans la bdd
 * @return Response
 * 
 */
public function delete():Response{


    $id = null;
    if (!empty($_POST['id']) && ctype_digit($_POST['id'])) {
    $id = (int)$_POST['id'];
    }

    if (!$id) {
        return $this->redirect([
            "type"=>"velo",
            "action"=>"index"
        ]);
    
    }

    
    $velo = $this->defaultModel->findById($id);

    if (!$velo) {
        return $this->redirect([
            "type"=>"velo",
            "action"=>"index"
        ]);
    }

    $this->defaultModel->remove($id);
    return $this->redirect([
        "type"=>"velo",
        "action"=>"index"
    ]);

}


/**
     * modifie un velo dans la bdd
     */
    public function change()
    {
        
        $idEdit = null;
        $name = null;
        $description = null;
        $image = null;
        $price = null;

        if(!empty($_POST['idEdit']) && ctype_digit($_POST['idEdit'])){ $idEdit =(int)$_POST['idEdit'];}
        if(!empty($_POST['name'])){ $name = $_POST['name'];}
        if(!empty($_POST['image'])){ $image = $_POST['image'];}
        if(!empty($_POST['description'])){ $description = $_POST['description'];}
        if(!empty($_POST['price'])){ $price = (int)$_POST['price'];}
        if($idEdit && $name && $description && $image && $price){

          
            $velo = $this->defaultModel->findById($idEdit);

            if(!$velo){return $this->redirect([
                "type"=>"velo",
                "action"=>"index"
            ]);}


        
            $velo->setName($name);
            $velo->setDescription($description);
            $velo->setImage($image);
            $velo->setPrice($price);

            $this->defaultModel->update($velo);

            return $this->redirect([
                "type"=>"velo",
                "action"=>"show",
                "id"=>$velo->getId()
            ]);


        }



        $id = null;
        if(!empty($_GET['id']) && ctype_digit($_GET['id'])){  $id = $_GET['id']; }
        if(!$id){return $this->redirect();}

        $velo = $this->defaultModel->findById($id);

        if(!$velo){return $this->redirect([
            "type"=>"velo",
            "action"=>"show"
        ]);}

      
        return $this->render("velos/edit", [
                                                    "pageTitle"=>"edition",
                                                    "velo"=>$velo
                                               ]);
    }
    


}

?>