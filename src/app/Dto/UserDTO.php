<?php

namespace App\Dto;

class UserDTO
{
    public string $name;
    public string $password;
    public string $email;
    public string $department_id;

    public function __construct(string $name, string $password, string $email, string $department_id)
    {
        $this->name = $name;
        $this->password = $password;
        $this->email = $email;
        $this->department_id = $department_id;
    }

    public function toArray() : array
    {
        return [
            'name' => $this->name,
            'password' => $this->password,
            'email' => $this->email,
            'department_id' => $this->department_id,
        ];
    }
}
