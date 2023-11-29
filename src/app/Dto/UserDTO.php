<?php

namespace App\Dto;

class UserDTO
{
    public string $name;

    public function __construct(string $name, string $password, string $email)
    {
        $this->name = $name;
        $this->password = $password;
        $this->email = $email;
    }

    public function toArray() : array
    {
        return [
            'nome' => $this->name,
            'password' => $this->password,
            'email' => $this->email,
        ];
    }
}
