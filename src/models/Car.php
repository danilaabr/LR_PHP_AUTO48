<?php
namespace App\models;

use App\core\Database;
use PDO;

class Car {
    private $pdo;

    public function __construct() {
        $this->pdo = Database::connect();
    }

    public function add(array $data): int {
        $stmt = $this->pdo->prepare("
            INSERT INTO `car-list` 
            (car_brand, car_model, `car_release date`, car_mileage, car_price, 
             car_color, `car_engine capacity`, `car_transmission box`, car_comment) 
            VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)
        ");
        
        $stmt->execute([
            $data['brand'],
            $data['model'],
            $data['year'],
            $data['mileage'],
            $data['price'],
            $data['color'],
            $data['engine_volume'],
            $data['transmission'],
            $data['comment'] ?? null
        ]);
        
        return $this->pdo->lastInsertId();
    }
    
    public function getAll(): array {
        $stmt = $this->pdo->query("
            SELECT 
                car_id, car_brand, car_model, `car_release date` as release_date,
                car_mileage, car_price, car_color, `car_engine capacity` as engine_capacity,
                `car_transmission box` as transmission, car_comment
            FROM `car-list`
        ");
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}