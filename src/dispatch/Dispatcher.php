<?php

namespace crazy\dispatch;

class Dispatcher {
    private string $action;

    public function __construct(string $action) {
        $this->action = $action;
    }

    public function run() : void {
        $action = match ($this->action) {
            'signin' => new SigninAction(),
            'register' => new RegisterAction(),
            'logout' => new LogoutAction(),
            default => new DefaultAction(),
        };
        try {
            $this->renderPage($action->execute());
        } catch (Exception $e) {
            $this->renderPage($e->getMessage());
        }
    }

    private function renderPage(string $html): void{
        $content= '
            <!DOCTYPE html>
            <html lang="fr">
            <head>
                <meta charset="UTF-8">
                <title>Court-Circuit Voltaire - '.$_GET['action'].'</title>
                <link rel="stylesheet" href="css/style.css">
            </head>
            <body>
                <header>
                    <div id="logo">
                        <a href="?action=accueil-catalogue"><img src="images/logo.png" alt="logo" id="logo_image"></a>
                    </div>
                    <div id="menu">';

        if (isset($_SESSION['user'])) {
            $content .= <<<HTML
                            <p><a href="?action=user-home-page">Accueil</a></p>
                            <p><a href="?action=accueil-catalogue">Catalogue</a></p>
                            <p><a href="?action=gestion-utilisateur">Mon compte</a></p>
                            <p><a href="?action=logout">Déconnexion</a></p>
HTML;
        } else {
            $content .= <<<HTML
                            <p><a href="?action=signin">Connexion</a></p>
                            <p><a href="?action=register">Inscription</a></p>
HTML;
        }
        $content .= <<<HTML
                    </div>
                </header> 
HTML;

        $content .= $html;
        $content .= '</body></html>';
        print($content);
    }

}