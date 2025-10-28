<?php

declare(strict_types=1);

namespace Modules\Core\Services;

class BaseService
{
    protected $load;

    public function __construct()
    {
        $parent = $this;
        $this->load = new class($parent) {
            private $parent;
            
            public function __construct($parent)
            {
                $this->parent = $parent;
            }
            
            public function library(string $name)
            {
                $className = 'Modules\\Core\\Libraries\\' . ucfirst($name);
                if (class_exists($className)) {
                    $instance = new $className();
                    $this->parent->{$name} = $instance;
                    return $instance;
                }
                throw new \Exception("Library {$name} not found");
            }
        };
    }
}
