<?php 
namespace Models;

class Avis extends AbstractModel
{

    protected string $nomDeLaTable = "avis";
    private int $id;
    private string $author;
    private string $content;
    private int $veloId;
    

    public function getAuthor(){
        return $this->author;
    }

    public function setAuthor($author){
        $this->author = $author;
    }

    public function getContent(){
        return $this->content;
    }

    public function setcontent($content){
        $this->content = $content;
    }

    public function getId(){
        return $this->id;
    }

    public function getVeloId(){
        return $this->veloId;
    }

    public function setVeloId($veloId){
        $this->veloId = $veloId;
    }


    /**
 * retourne un tableau d'avis'trouvé avec l'id du vélo associé
 * @param int $veloId
 * @return array|bool
 */
public function findAllByVelo(int $veloId){
    
    $requete = $this->pdo->prepare("SELECT * FROM {$this->nomDeLaTable} WHERE velo_id=:idVelo");
    $requete->execute([
    "idVelo"=> $veloId
    ]);
    $avis = $requete->fetchAll(\PDO::FETCH_CLASS,get_class($this));
    return $avis;
}

 /**
     * ajoute un nouveau avis dans la BDD
     * @param Avis $avis
     * 
     * @return void
     */                     
    public function save(Avis $avis):void
    {
            $sql = $this->pdo->prepare("INSERT INTO {$this->nomDeLaTable} 
             (author, content, velo_id) VALUES (:author,:content,:velo_id)
            ");

            $sql->execute([
                'author'=>$avis->getAuthor(),
                'content'=>$avis->getContent(),
                'velo_id'=>$avis->getVeloId()
            ]);

    }

    /**
     * Modifie un avis 
     * @param Avis $avis
     * 
     */
    public function update(Avis $avis){

        $sql = $this->pdo->prepare("UPDATE {$this->nomDeLaTable} SET author=:author, content=:content WHERE id = :id");
        $sql->execute([
            'author'=>$avis->author,
            'content'=>$avis->content,
            'id'=>$avis->id
            
        ]);

    }

}


?>