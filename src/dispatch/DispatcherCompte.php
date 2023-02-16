<?php

namespace crazy\dispatch;

use crazy\action\account\AccountAction;

class DispatcherCompte
{
    private string $action;

    public function __construct(string $action)
    {
        $this->action = $action;
    }

    public function run(): void
    {
        $action = match ($this->action) {
            default => new AccountAction()
        };
        $this->renderPage($action->execute());
    }

    private function renderPage(string $html): void
    {
        echo $html;
    }
}
