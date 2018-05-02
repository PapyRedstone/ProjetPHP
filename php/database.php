<?php
//ALEXANDRE
require "constants.php";

/*Classe interfacant la base de donnee PDO
 */
class DataBase{
  private $db;

  /*Constructeur
   *
   *Creer le lien avec la base de donnee en utilisant les constantes predefinies
   */
  public function __construct(){
    global $host,$port,$dbname,$user,$password;
        $this->db = new PDO("mysql:host=$host;port=$port;dbname=$dbname;charset=UTF8;",$user,$password);
  }

  /*getDB
   *
   *Fonction permettant de recuperer la base de donnee pour des actions pointus sur celle la
   */
  public function getDB(){
    return $this->db;
  }

  /*execute
   *
   *Fonction executant une requete SQL, gerant les potentiels donnees a passer a la requete
   *ainsi que la recuperation de donnees sous forme d'objet
   *
   *Retourne un tableau de reponse SQL pour une requete SELECT
   *         un bool de la reussite de la requete sinon
   */
  public function execute($query,$data=NULL,$className=NULL){
    $statement = $this->db->prepare($query);

    //Si la requete est un SELECT
    if(strtolower(explode(" ",$query)[0]) == "select"){
      $statement->execute();
      $result = array();

      //Si on ne veut pas recuperer les resultat en tant qu'objet
      if(!isset($className)){
        $sqlResult = $statement->fetchAll();

        //Il existe des donnees "parasite" et inutile dans le retour de fetchAll
        //Dans cette partie il s'agit de les supprimer
        foreach($sqlResult as $k=>$v){
          $result[$k] = array();
          $i = 0;
          foreach($v as $key=>$value){
            if($key === $i){
              $i++;
            }
            else{
              $result[$k][$key] = $value;
            }
          }
        }
      }else{//Si on veut recuperer les donnes sous forme d'objets
        while($r = $statement->fetchObject($className)){
          $result[] = $r;
        }
      }
      return $result;
    }else{//Si la requete n'est pas un SELECT
      if(isset($data)){
        return $statement->execute($data);
      }else{
        return $statement->execute();
      }
    }
  }
}
?>
