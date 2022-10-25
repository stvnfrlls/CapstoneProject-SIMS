<?php

require_once("connection.php");

class Authenticate
{
    private $db;

    public function __construct()
    {
        $this->db = new Database;
    }

    public function findEmail($email)
    {
        $this->db->query('SELECT * FROM userdetails WHERE username = :email');
        $this->db->bind(':email', $email);

        $row = $this->db->single();

        if ($this->db->rowCount() > 0) {
            return $row;
        } else {
            return false;
        }
    }
}
