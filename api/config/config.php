<?php

error_reporting(E_ALL);



include "controller/ProductsQueryController.php";
include "services/ProductsDatabase.php";
include "services/Session.php";
include "models/pdoDBGateway.php";
include "models/ProductTypesQuery.php";
include "models/ProductsByIDQuery.php";
include "views/JsonView.php";
include "models/ProductByArticleID.php";

define("DBHost", "localhost");
define("DBName", "fh_beb_ueb4");
define("DBPassword", "");
define("DBUsername", "root");
