<?php
namespace Src\Model;

class MailModel {
    private $db = null;
    public function __construct($db)
    {
        $this->db = $db;
    }

    public function getList() {
        $statment = "
            SELECT * FROM mail;
        ";

        try {
            $statment = $this->db->query($statment);
            $result = $statment->fetchAll(\PDO::FETCH_ASSOC);
            return $result;
        } catch (\PDOException $e) {
            exit($e->getMessage());
        }
    }

    public function insertMail(Array $input) {
        $statment = "
            INSERT INTO mail (receiver_mail, subject_mail, message) VALUES (:receiver_mail, :subject_mail, :message);
        ";
        try {
            $statement = $this->db->prepare($statment);
            $statement->execute(array(
                'receiver_mail' => $input['receiver_mail'],
                'subject_mail'  => $input['subject_mail'],
                'message'  => $input['message']
            ));
            
            return $statement->rowCount();
        } catch (\PDOException $e) {
            exit($e->getMessage());
        }   
    }
}