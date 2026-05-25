<?php 
 namespace App\models;

use Container\Dic;
use Helper\Build\Database;

 class UserModel extends Model {
    public function create(array $data) 
    {
        $sql = "INSERT INTO users (username, email, password, role) VALUES (:username, :email, :password, :role)";
        $stmt = Dic::get(Database::class)->prepare($sql);
        $stmt->execute([
            ':username' => $data['username'],
            ':email' => $data['email'],
            ':password' => password_hash($data['password'], PASSWORD_BCRYPT),
            ':role' => $data['role']
        ]);
       
    }
 }
?>