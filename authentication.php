<?php

require 'header.php';

use crazy\auth\Authentication;

$error = '';

// si c'est une requête de login
if (isset($_POST['loginEmail']) && isset($_POST['loginPassword'])) {
    $email = htmlspecialchars(trim($_POST['loginEmail']));
    $password = htmlspecialchars(trim($_POST['loginPassword']));
    $user = Authentication::authenticate($email, $password);
    if (!$user) {
        $error = 'Email ou mot de passe incorrect';
    } else {
        $_SESSION['user'] = $user->id;
        header('Location: index.php');
        exit;
    }


    // si c'est une requête de register
} else if (isset($_POST['registerName']) && isset($_POST['registerEmail']) && isset($_POST['registerPassword']) && isset($_POST['registerRepeatPassword']) && isset($_POST['registerPhone'])) {
    $name = htmlspecialchars(trim($_POST['registerName']));
    $email = htmlspecialchars(trim($_POST['registerEmail']));
    $password = htmlspecialchars(trim($_POST['registerPassword']));
    $repeatPassword = htmlspecialchars(trim($_POST['registerRepeatPassword']));
    $telephone = htmlspecialchars(trim($_POST['registerPhone']));
    if ($password !== $repeatPassword) {
        $error = 'Les mots de passe ne correspondent pas';
    } else {
        $user = Authentication::register($name, $email, $password, $telephone);
        if (is_string($user)) {
            $error = $user;
        } else {
            $_SESSION['user'] = $user->id;
            header('Location: index.php');  
            exit;
        }
    }
}

echo '<div class="container col-sm-12 col-md-8 col-lg-6 col-xl-4 my-4">';

if (isset($_GET['action']) && $_GET['action'] == 'register') {
    echo <<<END
    <!-- Pills navs -->
    <ul class="nav nav-pills nav-justified mb-3" id="ex1" role="tablist">
        <li class="nav-item" role="presentation">
            <a class="nav-link" id="tab-login" data-mdb-toggle="pill" href="authentication.php" role="tab" aria-controls="login" aria-selected="false">Login</a>
        </li>
        <li class="nav-item" role="presentation">
            <a class="nav-link active" id="tab-register" data-mdb-toggle="pill" href="authentication.php?action=register" role="tab" aria-controls="register" aria-selected="true">Register</a>
        </li>
    </ul>
    <!-- Pills navs -->

    <!-- Pills content -->
    <div class="tab-content">
        <div class="tab-pane fade show active" id="register" role="tabpanel" aria-labelledby="tab-register">
            <form method="post">
                <p class="text-center mb-4">or:</p>

                <!-- Name input -->
                <div class="form-outline mb-4">
                    <input type="text" name="registerName" id="registerName" class="form-control" required />
                    <label class="form-label" for="registerName">Nom</label>
                </div>

                <!-- Email input -->
                <div class="form-outline mb-4">
                    <input type="email" name="registerEmail" id="registerEmail" class="form-control" required />
                    <label class="form-label" for="registerEmail">Email</label>
                </div>

                <!-- Password input -->
                <div class="form-outline mb-4">
                    <input type="password" name="registerPassword" id="registerPassword" class="form-control" required />
                    <label class="form-label" for="registerPassword">Mot de passe</label>
                </div>

                <!-- Repeat Password input -->
                <div class="form-outline mb-4">
                    <input type="password" name="registerRepeatPassword" id="registerRepeatPassword" class="form-control" required />
                    <label class="form-label" for="registerRepeatPassword">Répéter le mot de passe</label>
                </div>

                <!-- Phone input -->
                <div class="form-outline mb-4">
                    <input type="tel" name="registerPhone" id="registerPhone" class="form-control" />
                    <label class="form-label" for="registerPhone">Téléphone</label>
                </div>

                <!-- Error message -->
                <div class="text-center mb-4">
                    <p class="text-danger">$error</p>
                </div>

                <!-- Checkbox -->
                <div class="form-check d-flex justify-content-center mb-4">
                    <input class="form-check-input me-2" type="checkbox" value="" id="registerCheck" aria-describedby="registerCheckHelpText" required />
                    <label class="form-check-label" for="registerCheck">
                        I have read and agree to the terms
                    </label>
                </div>

                <!-- Submit button -->
                <button type="submit" class="btn btn-primary btn-block mb-3">Sign in</button>
            </form>
        </div>
    </div>
    END;
} else {
    echo <<<END
    <!-- Pills navs -->
    <ul class="nav nav-pills nav-justified mb-3" id="ex1" role="tablist">
        <li class="nav-item" role="presentation">
            <a class="nav-link active" id="tab-login" data-mdb-toggle="pill" href="authentication.php" role="tab" aria-controls="login" aria-selected="true">Login</a>
        </li>
        <li class="nav-item" role="presentation">
            <a class="nav-link" id="tab-register" data-mdb-toggle="pill" href="authentication.php?action=register" role="tab" aria-controls="register" aria-selected="false">Register</a>
        </li>
    </ul>
    <!-- Pills navs -->

    <!-- Pills content -->
    <div class="tab-content">
        <div class="tab-pane fade show active" id="login" role="tabpanel" aria-labelledby="tab-login">
            <form method="post">
                <p class="text-center mb-4">or:</p>

                <!-- Email input -->
                <div class="form-outline mb-4">
                    <input type="email" name="loginEmail" id="loginEmail" class="form-control" required />
                    <label class="form-label" for="loginEmail">Email</label>
                </div>

                <!-- Password input -->
                <div class="form-outline mb-4">
                    <input type="password" name="loginPassword" id="loginPassword" class="form-control" required />
                    <label class="form-label" for="loginPassword">Mot de passe</label>
                </div>

                <!-- Error message -->
                <div class="text-center mb-4">
                    <p class="text-danger">$error</p>
                </div>

                <!-- 2 column grid layout -->
                <div class="row mb-4">
                    <div class="col-md-6 d-flex ">
                        <!-- Checkbox -->
                        <div class="form-check mb-3 mb-md-0">
                            <input class="form-check-input" type="checkbox" value="" id="loginCheck" />
                            <label class="form-check-label" for="loginCheck"> Remember me </label>
                        </div>
                    </div>
                </div>

                <!-- Submit button -->
                <button type="submit" class="btn btn-primary btn-block mb-4">Sign in</button>

                <!-- Register buttons -->
                <div class="text-center">
                    <p>Not a member? <a href="authentication.php?action=register">Register</a></p>
                </div>
            </form>
        </div>
    </div>
    END;
}

echo '</div>';


require 'footer.php';
