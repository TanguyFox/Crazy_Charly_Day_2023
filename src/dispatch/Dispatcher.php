<?php

namespace crazy\dispatch;

use crazy\action\ProductsAction;
use crazy\action\ProductDetailsAction;
use crazy\action\AddToCartAction;
use Exception;

class Dispatcher
{
    private string $action;

    public function __construct(string $action)
    {
        $this->action = $action;
    }

    public function run(): void
    {
        $action = match ($this->action) {
            'products' => new ProductsAction(),
            'productDetails' => new ProductDetailsAction(),
            'addToChart' => new AddToCartAction(),
            default => new ProductsAction()
        };
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