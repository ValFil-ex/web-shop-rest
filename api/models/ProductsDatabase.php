<?php


class ProductsDatabase
{
    private $pdo;


    public function __construct(){
       $this->pdo = new PDO("mysql: host=localhost; dbname=fh_beb_ueb4; charset=utf8", "root", "", [ PDO::ATTR_DEFAULT_FETCH_MODE=>PDO::FETCH_ASSOC]);
    }

    public function executeProductsDBQuery($sqlStatement, $args = []){
        try{
            $result = array();
            $currentSqlStatement = $this->pdo->prepare($sqlStatement);
            $currentSqlStatement->execute($args);
            while($row = $currentSqlStatement->fetch()) {
                $result[]=$row;
            }
            return $result;
        }catch(PDOException $exception){
            error_log("PDO ERROR: querying database: ".$exception->getMessage()."\n".$this->sqlStatement);
            var_dump($sqlStatement);
        }
    }
}
