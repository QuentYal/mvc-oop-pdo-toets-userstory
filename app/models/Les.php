<?php

class Les
{
    private $db;

    public function __construct()
    {
        $this->db = new Database();
    }    

    public function getLessons()
    {
        $this->db->query("SELECT Les.DatumTijd
                                ,Leerling.Naam
                                ,Les.Id
                          FROM Les
                          INNER JOIN Instructeur
                          ON Instructeur.Id = Les.InstructeurId
                          INNER JOIN Leerling
                          ON Leerling.Id = Les.LeerlingId
                          WHERE Instructeur.Id = :Id");
        
        $this->db->bind(':Id', 2);

        $result = $this->db->resultSet();

        return $result;
    }

    public function getTopicsLesson($lessonId)
    {
        $this->db->query("SELECT *
                          FROM Onderwerp
                          WHERE LesId = :lessonId");
        $this->db->bind(':lessonId', $lessonId);

        $result = $this->db->resultSet();

        return $result;
    }

    public function addTopic($post) 
    {
        $sql = "INSERT INTO Onderwerp (LesId
                                      ,Onderwerp)
                VALUES                (:lesId
                                      ,:topic)";

        $this->db->query($sql);
        $this->db->bind(':lesId', $post['lesId'], PDO::PARAM_INT);
        $this->db->bind(':topic', $post['topic'], PDO::PARAM_STR);
        return $this->db->execute();
    }
}