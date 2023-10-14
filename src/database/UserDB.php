<?php

namespace Store\User;

class UserDB
{
    private $pdo;
    
    public function __construct($pdo)
    {
        $this->pdo = $pdo;
    }

    public function get_user($email)
    {
        $sql = 'SELECT * FROM users WHERE email = ?';
        $stmt = $this->pdo->prepare($sql);
        $stmt->bindValue(1, $email);
        $stmt->execute();
        $result = $stmt->fetch();
        if ($result) {
            return $result;
        }
        return -1;
    }

    public function update($data, $email)
    {
        $setValues = '';
        foreach ($data as $key => $value) {
            $setValues .= "$key = :$key, ";
        }
        $setValues = rtrim($setValues, ', ');
        $sql = "UPDATE users SET $setValues WHERE email='$email'";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute($data);
    }

    public function registration($email, $password, $fio, $bdate)
    {
        $registration_sql = 'INSERT INTO users(email, password, fio, bdate) VALUES(:email, :password, :fio, :bdate)';
        $registration_stmt = $this->pdo->prepare($registration_sql);
        $registration_stmt->bindValue(':email', $email);
        $registration_stmt->bindValue(':password', $password);
        $registration_stmt->bindValue(':fio', $fio);
        $registration_stmt->bindValue(':bdate', $bdate);
        $registration_stmt->execute();
        $id = $this->pdo->lastInsertId('users_id_seq');
        return $id;
    }
}

?>