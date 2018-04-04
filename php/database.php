<?php
require "constants.php";

class DataBase{
  private $db;
  
  public function __construct(){
    global $host,$port,$dbname,$user,$password;
        $this->db = new PDO("mysql:host=$host;port=$port;dbname=$dbname;charset=UTF8;",$user,$password);
  }
  
  public function getDB(){
    return $this->db;
  }
  
  public function execute($query,$data=NULL,$className=NULL){
    $statement = $this->db->prepare($query);
	
    if(strtolower(explode(" ",$query)[0]) == "select"){
      $statement->execute();
      if(!isset($className)){
        $sqlResult = $statement->fetchAll();
        $result = array();
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
            return $result;
      }else{
        $result = array();
        while($r = $statement->fetchObject($className)){
          $result[] = $r;
        }
        return $result;
          }
    }
    else{
      if(isset($data)){
        return $statement->execute($data);
      }else{
        return $statement->execute();
      }
    }
  }
}
?>
