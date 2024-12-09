<?php
class User
{
    protected string $user_id;
    protected string $first_name;
    protected string $last_name;
    protected string $email;
    protected string $hashed_password;
    protected string $username;

    public function __construct($user_id, $first_name, $last_name, $email,$hashed_password, $username) {
        $this->user_id = $user_id;
        $this->first_name = $first_name;
        $this->last_name = $last_name;
        $this->email = $email;
        $this->hashed_password = $hashed_password;
        $this->username= $username;
    }

    // Getters
    public function getUserId(): string {
        return $this->user_id;
    }

    public function getFirstName(): string {
        return $this->first_name;
    }

    public function getLastName(): string {
        return $this->last_name;
    }

    public function getEmail(): string {
        return $this->email;
    }

    public function getHashedPassword(): string {
        return $this->hashed_password;
    }

    public function getUsername(): string {
        return $this->username;
    }
}