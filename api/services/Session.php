<?php



class Session
{

    private $cart;

    public function __construct(){
        session_name("productCart");

    }

    public function init(){
        session_start();
        if(isset($_SESSION["articleId"])){
            return;
        } else {
            $_SESSION["articleId"] = array();
        }
    }


    public function addArticle($articleId){
        $output = array();
        if(array_key_exists($articleId, $_SESSION["articleId"]))
        {
            $_SESSION["articleId"][$articleId] +=1;
        }else{
            $_SESSION["articleId"][$articleId] =1;
        }
        $output['state'] = 'OK';
        return $output;
    }

    public function getAllArticles(){
        $array = $_SESSION["articleId"];
        return $array;
    }

    public function removeArticle($articleId){
        $output = array();
        if(!array_key_exists($articleId, $_SESSION["articleId"])){
            $output['state'] = 'ERROR';
        }else if($_SESSION["articleId"][$articleId] <= 1){
            unset($_SESSION["articleId"][$articleId]);
            $output['state'] = 'OK';
        }else{
            $_SESSION["articleId"][$articleId] -= 1;
            $output['state'] = 'OK';
        }
        return $output;
    }
}
