<?php

namespace Store\Category;

class CategoryCRUD
{
    private $pdo;
    
    public function __construct($pdo)
    {
        $this->pdo = $pdo;
    }

    public function get_categories()
    {
        $sql = 'SELECT * FROM category ORDER BY id';
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