<?php


class ProductTypesQuery
{
    private $database;
    private $sqlStatement;

    public function __construct(){
        $this->database = new pdoDBGateway();
        $this->sqlStatement = "SELECT id, name FROM product_types ORDER BY name;";
    }


    public function executeQuery()
    {
        $result = $this->database->executeProductsDBQuery($this->sqlStatement);
        return($this->formatQueryData($result));
    }


    private function formatQueryData($result)
    {
        $productNames = array();

        for($x = 0; $x<count($result); $x++) {
            $a = ["productType" => $result[$x]['name'], "url" => "http://localhost/web_shop_rest/api/index.php?action=listProductsByTypeId&typeId=" . $result[$x]['id'] . ""];
            array_push($productNames, $a);
        }
        return $productNames;
    }
}
