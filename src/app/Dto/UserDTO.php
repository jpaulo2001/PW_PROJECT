<?php

namespace App\Dto;

class UserDTO
{
    public string $name;
    public string $email;
    public string $password;
    public string $department_id;
    public function __construct(string $name, string $email, string $password, string $department_id)
    {
        $this->name = $name;
        $this->email = $email;
        $this->password = $password;
        $this->department_id = $department_id;
    }

    public function toArray() : array
    {
        return [
            'name' => $this->name,
            'email' =>$this->email,
            'password' =>$this->password,
            'department_id' =>$this->department_id,
        ];
    }
}
