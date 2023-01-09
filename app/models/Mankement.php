<?php

class Mankement
{
    private $db;

    public function __construct()
    {
        $this->db = new Database();
    }

    public function getMankementen()
    {
        $this->db->query("SELECT mankement.Datum
                                ,auto.Naam
                                ,mankement.Id
                          FROM instructeur
                          INNER JOIN auto
                          ON Instructeur.Id = auto.InstructeurId
                          INNER JOIN mankement
                          ON mankement.Id = mankement.AutoId
                          WHERE Instructeur.Id = :Id");

        $this->db->bind(':Id', 2);

        $result = $this->db->resultSet();

        return $result;
    }

    public function getMankementOverzicht($lessonId)
    {
        $this->db->query("SELECT *
                          FROM Onderwerp
                          WHERE LesId = :lessonId");
        $this->db->bind(':lessonId', $lessonId);

        $result = $this->db->resultSet();

        return $result;
    }

    public function addMankement($post)
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
