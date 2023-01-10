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
                                ,auto.Type
                                ,mankement.Id
                                ,instructeur.naam as MANHOI
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

    public function getMankementOverzicht($AutoId)
    {
        $this->db->query("SELECT *
                          FROM mankement
                          WHERE AutoId = :AutoId");
        $this->db->bind(':AutoId', $AutoId);

        $result = $this->db->resultSet();

        return $result;
    }

    public function addMankement($post)
    {
        $sql = "INSERT INTO Onderwerp (AutoId
                                      ,mankement)
                VALUES                (:AutoId
                                      ,:mankement)";

        $this->db->query($sql);
        $this->db->bind(':AutoId', $post['AutoId'], PDO::PARAM_INT);
        $this->db->bind(':mankement', $post['mankement'], PDO::PARAM_STR);
        return $this->db->execute();
    }
}
