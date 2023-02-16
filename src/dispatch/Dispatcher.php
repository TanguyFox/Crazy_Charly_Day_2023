<?php

namespace crazy\dispatch;

use crazy\action\ProductsAction;
use crazy\models\Produit;
use Exception;

class Dispatcher {
    private string $action;

    public function __construct(string $action) {
        $this->action = $action;
    }

    public function run() : void {
        require 'header.php';
        $action = match ($this->action) {
            'signin' => new SigninAction(),
            'register' => new RegisterAction(),
            'logout' => new LogoutAction(),
            default => new ProductsAction()
        };
        require 'footer.php';
        try {
            $this->renderPage($action->execute());
        } catch (Exception $e) {
            $this->renderPage($e->getMessage());
        }
    }

    private function renderPage(string $html): void
    {
        echo $html;
    }
}