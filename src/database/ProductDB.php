<?php

namespace Store\Product;

class ProductDB
{
    private $pdo;
    
    public function __construct($pdo)
    {
        $this->pdo = $pdo;
    }

    public function get_products()
    {
        $sql = 'SELECT * FROM product';
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