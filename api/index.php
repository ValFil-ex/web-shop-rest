<?php
include "config/config.php";

$requestController = new ProductsQueryController();
$requestController->routeDataRequest();

///index.php?action=listtypes
///index.php?action=listProductsByTypeId&typeId=2
///index.php?action=addArticle&articleId=10
///index.php?action=removeArticle&articleId=12
///index.php?action=listCart
