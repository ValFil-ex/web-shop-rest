<?php
class pdoDBGateway extends ProductsDatabase {


    /**
     * pdoDBGateway constructor.
     */
    public function __construct()
    {
        parent::__construct(DBHost, DBName, DBUsername, DBPassword);
    }
}

//parent::__construct(DBHost, DBName, DBUsername, DBPassword);
