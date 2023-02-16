<?php

namespace crazy\dispatch;

use crazy\action\catalog\AdminAction;
use crazy\action\catalog\AddToCartAction;
use crazy\action\catalog\DisplayCartAction;
use crazy\action\catalog\MapAction;
use crazy\action\catalog\ProductsAction;
use crazy\action\catalog\ProductDetailsAction;

class Dispatcher
{
    private string $action;

    public function __construct(string $action)
    {
        $this->action = $action;
    }

    public function run(): void
    {
        switch ($this->action) {
            case 'logout':
                unset($_SESSION['user']);
                header('Location: authentication.php');
                exit;
        } 
        $action = match ($this->action) {
            'map' => new MapAction(),
            'products' => new ProductsAction(),
            'productDetails' => new ProductDetailsAction(),
            'addToChart' => new AddToCartAction(),
            'displayCart' => new DisplayCartAction(),
	        'admin' => new AdminAction(),
            default => new ProductsAction()
        };
        $this->renderPage($action->execute());
    }

    private function renderPage(string $html): void
    {
        echo $html;
    }
}
