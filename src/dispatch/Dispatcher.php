<?php

namespace crazy\dispatch;

use crazy\action\MapAction;
use crazy\action\ProductsAction;
use crazy\action\ProductDetailsAction;
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
            'map' => new MapAction(),
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