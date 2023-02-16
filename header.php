<?php

declare(strict_types=1);
require 'vendor/autoload.php';
session_start();

use crazy\models\Users;
use Illuminate\Database\Capsule\Manager as DB;

$db = new DB();
$db->addConnection(parse_ini_file('src/conf/conf.ini'));
$db->setAsGlobal();
$db->bootEloquent();

$action = '';
if (isset($_SESSION['user'])) {
    $action = <<<END
        <a class="dropdown-item" href="account.php">Compte</a>
        <hr class="dropdown-divider">
        <a class="dropdown-item" href="index.php?action=logout">Se déconnecter</a>
    END;
} else {
    $action = <<<END
        <a class="dropdown-item" href="authentication.php">Se connecter</a>
        <a class="dropdown-item" href="authentication.php?action=register">S'inscrire</a>
    END;
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CourtCircuit Nancy</title>
    <!-- BOOTSTRAP -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous" />
    <!-- LEAFLET (MAP) -->
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.3/dist/leaflet.css" integrity="sha256-kLaT2GOSpHechhsozzB+flnD+zUyjE2LlfWPgU04xyI=" crossorigin="" />
    <!-- CSS -->
    <link rel="stylesheet" href="src/css/style.css">
</head>

<body>
<nav class="navbar navbar-expand-lg navbar-light bg-light py-0">
    <div class="container-fluid">
        <a class="navbar-brand" href="index.php"><img src="src/img/logo.png" alt="Court Circuit Nancy" style="width: 3rem"></a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                <li class="nav-item">
                    <a class="nav-link active" aria-current="page" href="index.php">Accueil</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="index.php?action=map">Carte</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="?action=displayCart" tabindex="-1" aria-disabled="true">Panier</a>
                </li>
            </ul>
            <div class="dropdown">
                <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                    <svg xmlns="http://www.w3.org/2000/svg" width="26" height="26" fill="black" class="bi bi-person" viewBox="0 0 16 16">
                        <path d="M8 8a3 3 0 1 0 0-6 3 3 0 0 0 0 6Zm2-3a2 2 0 1 1-4 0 2 2 0 0 1 4 0Zm4 8c0 1-1 1-1 1H3s-1 0-1-1 1-4 6-4 6 3 6 4Zm-1-.004c-.001-.246-.154-.986-.832-1.664C11.516 10.68 10.289 10 8 10c-2.29 0-3.516.68-4.168 1.332-.678.678-.83 1.418-.832 1.664h10Z" />
                    </svg>
                </a>
                <div class="dropdown-menu dropdown-menu-end" aria-labelledby="dropdownMenuButton">
                    <?php echo $action; ?>
                </div>
            </div>
            <form class="d-flex" method='post' action='?action=catalogue'>
                <input class="form-control me-2" type="search" name="search" placeholder="Rechercher" aria-label="Search">
                <button class="btn btn-outline-success" type="submit">Rechercher</button>
            </form>
        </div>
    </div>
</nav>
</body>

</html>