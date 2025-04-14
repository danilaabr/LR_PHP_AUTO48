<?php 
namespace App\core;

use PDO;
use PDOException;
use Exception; 

class Database {
    private static ?PDO $pdo = null;

    public static function connect(): PDO {
        if (self::$pdo == null) {
            $config = parse_ini_file(__DIR__ . '/../../.env');
            try {
                self::$pdo = new PDO(
                    "mysql:host={$config['DB_HOST']};dbname={$config['DB_NAME']};charset=utf8",
                    $config['DB_USER'],
                    $config['DB_PASS'],
                    [PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION]
                );
                self::$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            } catch (PDOException $e) {
                $danilaEx = new DanilaException('Ошибка подключения к базе данных: ' . $e->getMessage(), $e->getCode(), $e);
                $danilaEx->logError();
                self::displayErrorPage($danilaEx);
                exit;
            }
        }
        return self::$pdo;
    }

    private static function displayErrorPage(DanilaException $e): void {
        echo '<!DOCTYPE html>
        <html lang="ru">
        <head>
            <meta charset="UTF-8">
            <meta name="viewport" content="width=device-width, initial-scale=1.0">
            <link rel="stylesheet" href="assets/styles/error-messages-styles.css">
            <title>Ошибка базы данных</title>
        </head>
        <body>';
        $e->displayError();
        echo '</body></html>';
    }
}

class DanilaException extends Exception {
    public function displayError() {
        echo '<div class="danila-error">';
        echo '<div class="danila-error-title">Ошибка обработки запроса</div>';
        echo '<div class="danila-error-message">' . htmlspecialchars($this->getMessage()) . '</div>';
        echo '<div class="danila-error-details">';
        echo '<div class="danila-error-detail"><strong>Файл:</strong> ' . htmlspecialchars($this->getFile()) . '</div>';
        echo '<div class="danila-error-detail"><strong>Строка:</strong> ' . $this->getLine() . '</div>';
        echo '<div class="danila-error-detail"><strong>Код ошибки:</strong> ' . $this->getCode() . '</div>';
        echo '</div>';
        echo '</div>';
    }

    public function logError() {
        error_log("Ошибка: " . $this->getMessage() . " в файле " . $this->getFile() . " на строке " . $this->getLine());
        return true;
    }
}
?>