<?php

namespace App\Model;

use App\Attribute\FileModel;
use App\Loader;

abstract class Model
{
    static function load(): array
    {
        $attributes = (new \ReflectionClass(static::class))->getAttributes(FileModel::class);

        if (empty($attributes)) {
            throw new \LogicException(sprintf("You must add a '%s' attribute on class '%s'", FileModel::class, static::class));
        }

        if (!key_exists("filename", $attributes[0]->getArguments())) {
            throw new \LogicException();
        }

        return (new Loader($attributes[0]->getArguments()["filename"], static::class))->load();
    }
}
