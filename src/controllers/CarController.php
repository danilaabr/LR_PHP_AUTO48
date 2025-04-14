<?php
namespace App\controllers;

use App\models\Car;
use App\models\Client;
use Twig\Environment;
use Twig\Loader\FilesystemLoader;

class CarController {
    private $twig;
    private $carModel;
    private $userModel;

    public function __construct() {
        $this->carModel = new Car();
        $this->userModel = new Client();
        $loader = new FilesystemLoader(__DIR__ . '/../views');
        $this->twig = new Environment($loader);
    }

    public function list() {
        $cars = $this->carModel->getAll();
        echo $this->twig->render('cars/list.twig', [
            'cars' => $cars,
            'styles' => '/assets/styles/car-list-styles.css'
        ]);
    }

    public function showForm() {
        echo $this->twig->render('cars/add.twig', [
            'styles' => '/assets/styles/car-shop-styles.css',
            'form_submitted' => false
        ]);
    }

    public function addCar() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            try {
                $carId = $this->carModel->add([
                    'brand' => $_POST['brand'],
                    'model' => $_POST['model'],
                    'year' => $_POST['year'],
                    'mileage' => $_POST['mileage'],
                    'price' => $_POST['price'],
                    'color' => $_POST['color'],
                    'engine_volume' => $_POST['engine_volume'],
                    'transmission' => $_POST['transmission'],
                    'comment' => $_POST['comment']
                ]);
                
                $this->userModel->add([
                    'seller_name' => $_POST['seller_name'],
                    'contact_phone' => $_POST['contact_phone'],
                    'contact_email' => $_POST['contact_email']
                ]);
                
                echo $this->twig->render('cars/add.twig', [
                    'styles' => '/assets/styles/car-shop-styles.css',
                    'form_submitted' => true,
                    'message' => 'Автомобиль успешно выставлен на продажу',
                    'messageClass' => 'success'
                ]);
                
            } catch (\Exception $e) {
                echo $this->twig->render('cars/add.twig', [
                    'styles' => '/assets/styles/car-shop-styles.css',
                    'form_submitted' => true,
                    'message' => 'Ошибка при сохранении данных: ' . $e->getMessage(),
                    'messageClass' => 'error'
                ]);
            }
        }
    }
}