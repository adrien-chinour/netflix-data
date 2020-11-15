<?php

namespace App\Model;

use App\Loader;

abstract class Model
{
    static string $file;

    /**
     * @return static[]
     */
    static function load(): array
    {
        if (empty(static::$file)) {
            throw new \LogicException(sprintf("You must define %s::\$file attribute.", static::class));
        }

        return (new Loader(static::$file, static::class))->load();
    }
}
