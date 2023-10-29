<?php

namespace Store\Product;

class ProductCRUD
{
    private $pdo;
    
    public function __construct($pdo)
    {
        $this->pdo = $pdo;
    }

    public function get_products($category)
    {
        $sql = "SELECT * FROM product where category=$category";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute();
        $result = $stmt->fetchAll();
        if ($result) {
            return $result;
        }
        return -1;
    }
}

?>