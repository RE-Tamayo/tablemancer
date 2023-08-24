<?php

namespace Retamayo\Absl\Classes;

class Table
{
    public function __construct(
        public string $name,
        public array $columns,
        public string $primary,
        public string $foreign,
    ) {}
}
