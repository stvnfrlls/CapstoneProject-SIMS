<?php

require_once("connection.php");

class LoginRegister
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
    public function login($email, $password)
    {
        $row = $this->findEmail($email);

        if ($row == false) {
            return false;
        } else {
            if ($row->password == $password) {
                return $row;
            } else {
                return false;
            }
        }
    }
    function addAccount($SR_number, $SR_fname, $SR_mname, $SR_lname, $SR_gender, $SR_age, $SR_birthday, $SR_grade, $SR_section, $SR_address, $SR_guardian, $SR_contact)
    {
        $this->db->query('INSERT INTO studentrecord(SR_number, SR_fname, SR_mname, SR_lname, SR_gender, SR_age, SR_birthday, SR_grade, SR_section, SR_address, SR_guardian, SR_contact) 
                          VALUES ($SR_number, $SR_fname, $SR_mname, $SR_lname, $SR_gender, $SR_age, $SR_birthday, $SR_grade, $SR_section, $SR_address, $SR_guardian, $SR_contact)');
        
        $this->db->bind(':SR_number', $SR_number);
        $this->db->bind(':SR_fname', $SR_fname);
        $this->db->bind(':SR_mname', $SR_mname);
        $this->db->bind(':SR_lname', $SR_lname);
        $this->db->bind(':SR_gender', $SR_gender);
        $this->db->bind(':SR_age', $SR_age);
        $this->db->bind(':SR_birthday', $SR_birthday);
        $this->db->bind(':SR_grade', $SR_grade);
        $this->db->bind(':SR_section', $SR_section);
        $this->db->bind(':SR_address', $SR_address);
        $this->db->bind(':SR_guardian', $SR_guardian);
        $this->db->bind(':SR_contact', $SR_contact);

        if ($this->db->execute()) {
            return true;
        } else {
            return false;
        }
    }
    function updatePassword($userID, $password)
    {
        $this->db->query('UPDATE userdetails SET password = :password WHERE userID = :userID');
        $this->db->bind(':password', $password);
        $this->db->bind(':userID', $userID);

        if ($this->db->execute()) {
            return true;
            
        } else {
            return false;
        }
    }
    function verifyStudentNumber($studentNum) {
        $this->db->query('SELECT * FROM studentrecord WHERE SR_number = :studentNumber');
        $this->db->bind(':studentNumber', $studentNum);

        $row = $this->db->resultSet();

        if ($this->db->rowCount() === 1) {
            return $row;
            //while ($obj = mysqli_fetch_object($result)) {
                //printf("%s (%s)\n", $obj->Name, $obj->CountryCode); <-- ganito mo siya tatawagin sa controller file
            //}
        } else {
            return false;
        }
    }
}

class Admin
{
    private $db;

    public function __construct()
    {
        $this->db = new Database;
    }
}

class Faculty
{
    private $db;

    public function __construct()
    {
        $this->db = new Database;
    }
}

class Student
{
    private $db;

    public function __construct()
    {
        $this->db = new Database;
    }
}
