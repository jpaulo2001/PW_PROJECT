<?php

namespace App\Dto;

class DocumentDTO
{
    public string $path;
    public string $doc_name;
    public string $author;
    public string $type;
    public string $proprietary;
    public string $file_size;
    public string $file_extension;

    public function __construct(string $path, string $doc_name, string $author, string $type, string $proprietary, string $file_size, string $file_extension)
    {
        $this->path = $path;
        $this->doc_name = $doc_name;
        $this->author = $author;
        $this->type = $type;
        $this->proprietary = $proprietary;
        $this->file_size = $file_size;
        $this->file_extension = $file_extension;
    }

    public function toArray(): array
    {
        return [
            'path' => $this->path,
            'doc_name' => $this->doc_name,
            'author' => $this->author,
            'type' => $this->type,
            'proprietary' => $this->proprietary,
            'file_size' => $this->file_size,
            'file_extension' => $this->file_extension,
        ];
    }
}
