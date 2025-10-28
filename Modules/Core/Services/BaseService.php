<?php

declare(strict_types=1);

namespace Modules\Core\Services;

class BaseService
{
    protected $load;

    public function __construct()
    {
        $this->load = new class {
            public function library(string $name)
            {
                $className = 'Modules\\Core\\Libraries\\' . ucfirst($name);
                if (class_exists($className)) {
                    return new $className();
                }
                throw new \Exception("Library {$name} not found");
            }
        };
    }
}
