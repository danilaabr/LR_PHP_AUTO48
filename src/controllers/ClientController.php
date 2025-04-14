<?php
namespace App\controllers;

use App\models\Client;
use Twig\Environment;
use Twig\Loader\FilesystemLoader;

class ClientController {
    private $twig;
    private $userModel;

    public function __construct() {
        $this->userModel = new Client();
        $loader = new FilesystemLoader(__DIR__ . '/../views');
        $this->twig = new Environment($loader);
    }

    public function list() {
        $clients = $this->userModel->getAll();
        echo $this->twig->render('clients/list.twig', [
            'clients' => $clients,
            'styles' => '/assets/styles/client-list-styles.css'
        ]);
    }
}