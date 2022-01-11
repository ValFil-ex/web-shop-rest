<?php


class ProductsByIDQuery
{
    private $typeID;
    private $database;
    private $sqlStatement;
    private $js;

    public function __construct($typeID){
        $this->typeID = array($typeID);
        $this->js = new JsonView();
        $this->database = new pdoDBGateway();
        //$this->sqlStatement = "SELECT t.name AS productTypeName, p.name AS productName FROM product_types t JOIN products p ON t.id = p.id_product_types WHERE t.id = ?";
        $this->sqlStatement = "SELECT t.name AS productTypeName, p.name AS productName, p.id AS pid, p.base_unit AS baseUnit, p.price_of_sale AS productPrice, p.description AS productDescription FROM product_types t JOIN products p ON t.id = p.id_product_types WHERE t.id = ?";
    }


    public function executeQuery()
    {
        $result = $this->database->executeProductsDBQuery($this->sqlStatement, $this->typeID);
        return $this->formatQueryData($result);
    }


    private function formatQueryData($result){
        $productData = array();

        $backUrl = "http://localhost:63343/web_shop_rest/api/index.php?action=listtypes";
        foreach($result as $row){
            $row["url"] = $backUrl;
            array_push($productData,  $row); //simply $row['url'] = $backUrl did not work on my side

        }
        return $productData;
    }
}
