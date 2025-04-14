<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="assets/styles/main-styles.css">  
    <title>Автосалон - Auto48</title>
</head>
<body>
    <h1>Главная панель автосалона Auto48</h1>

    <div class="main-form">
        <div class="action_add_car" onclick="location.href='/cars/add'">
            <p>Окно для выставления машины на продажу</p>
        </div>
        <div class="action_car_list" onclick="location.href='/cars'">
            <p>Список машин, выставленных на продажу</p> 
        </div>
        <div class="action_user_list" onclick="location.href='/clients'">
            <p>Список продавцов машин</p>
        </div>
    </div>

    <div class="footer-container">
        <a href="/">Главная</a>
        <a href="">Профиль</a>
    </div>
</body>
</html>