<?php
namespace App\models;

use App\core\Database;
use PDO;

class Client {
    private $pdo;

    public function __construct() {
        $this->pdo = Database::connect();
    }

    public function add(array $data): int {
        $stmt = $this->pdo->prepare("
            INSERT INTO `client-list`
            (client_fullname, `client_telephone number`, client_email)
            VALUES (?, ?, ?)
        ");
        
        $stmt->execute([
            $data['seller_name'],
            $data['contact_phone'],
            $data['contact_email']
        ]);
        
        return $this->pdo->lastInsertId();
    }
    
    public function getAll(): array {
        return $this->pdo->query("
            SELECT 
                client_id, client_fullname as fullname, 
                `client_telephone number` as phone, 
                client_email as email
            FROM `client-list`
        ")->fetchAll(PDO::FETCH_ASSOC);
    }
}