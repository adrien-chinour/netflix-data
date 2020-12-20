<?php

namespace App\Attribute;

use Attribute;

#[Attribute]
class FileModel
{
    public function __construct(public string $filename)
    {
    }
}
