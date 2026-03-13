<?php

namespace Luna\Core\Contracts;

interface RenderableInterface
{
    public function render(string $view, array $data = []): string;
}
