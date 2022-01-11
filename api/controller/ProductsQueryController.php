<?php

header("Access-Control-Allow-Origin: *");

class ProductsQueryController
{
    private $databaseQuery;
    private $view;
    private $session;


    public function __construct(){
        $this->session = new Session();
        $this->view = new JsonView();
        $this->databaseQuery = null;
    }

    public function routeDataRequest()
    {
        $action = filter_input(INPUT_GET, 'action', FILTER_SANITIZE_STRING);
        $typeID = filter_input(INPUT_GET, 'typeId', FILTER_SANITIZE_STRING);
        $articleId = filter_input(INPUT_GET, 'articleId', FILTER_SANITIZE_STRING);

        switch(strtolower($action)){
            case 'listtypes': $this->listProductTypes();
                break;
            case 'listproductsbytypeid': $this->listProductsByTypeID($typeID);
                break;
            case 'addarticle':  $this->addArticleToCart($articleId);
                break;
            case 'removearticle': $this->removeArticleFromCart($articleId);
                break;
            case 'listcart': $this->listItemsInCart();
                break;
            default: $this->view->streamOutput([
                "error" => "interface not found.",
                "possible parameters" => "action (listTypes, listProductsByTypeId), typeId",
            ]);
                return false;
        }

    }

    private function listProductTypes(){
        $this->databaseQuery = new ProductTypesQuery();
        $output = $this->databaseQuery->executeQuery();
        $this->view->streamOutput($output);
    }

    private function listProductsByTypeID($typeID){
        $this->databaseQuery = new ProductsByIDQuery($typeID);
        $output = $this->databaseQuery->executeQuery();
        $this->view->streamOutput($output);
    }

    private function addArticleToCart($articleId)
    {
        $this->session->init();
        $this->databaseQuery = new ProductByArticleID($articleId);
        $productAvailable = $this->databaseQuery->executeQuery();
        if((empty($productAvailable))){
            $output['state'] = "ERROR";
            $this->view->streamOutput($output);
        }else{
            $result = $this->session->addArticle($articleId);
            $this->view->streamOutput($result);
        }
    }

    private function removeArticleFromCart($articleId)
    {
        $this->session->init();
        $output = $this->session->removeArticle($articleId);
        $this->view->streamOutput($output);
    }

    private function listItemsInCart()
    {
        $this->session->init();
        $output["cart"] = array();
        $itemsInCart = $this->session->getAllArticles();

        foreach($itemsInCart as $id=>$qty){
            $this->databaseQuery = new ProductByArticleID($id);
            $result = $this->databaseQuery->executeQuery();
            array_push($output["cart"], ["articleName"=>$result[0]["articleName"], "price"=>$result[0]["price"], "amount" => $qty, "pid" => $id]);
        }

        $this->view->streamOutput($output);
    }

}
