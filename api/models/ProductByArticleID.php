<?php


class ProductByArticleID
{
    private $database;
    private $sqlStatement;

    public function __construct($articleID){
        $this->articleID = array($articleID);
        $this->database = new pdoDBGateway();
        $this->sqlStatement = "SELECT t.name AS articleName , t.price_of_sale AS price FROM products t WHERE id = ?;";
    }


    public function executeQuery()
    {
        return $this->database->executeProductsDBQuery($this->sqlStatement, $this->articleID);
    }
}
