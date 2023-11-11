<?php

namespace App\Dto;

class MetadataDTO
{
    public string $name;

    public function __construct(string $name)
    {
        $this->value = $value;
    }

    public function toArray() : array
    {
        return [
            'value' => $this->value
        ];
    }
}
