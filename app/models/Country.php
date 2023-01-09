<?php
/**
 * Dit is de model country die hoort bij de Countries controller
 */

class Country
{
    private $db;

    public function __construct()
    {
        $this->db = new Database();
    }

    public function getCountries()
    {
        $this->db->query('SELECT * FROM Country');
        $result = $this->db->resultSet();
        return $result;
    }

    public function getSingleCountry($id = NULL)
    {
        $this->db->query("SELECT * FROM `country` WHERE `id` = :id");
        $this->db->bind(':id', $id, PDO::PARAM_INT);
        return $this->db->single();
    }

    public function updateCountry($post)
    {
        // echo "Hoi";var_dump($post);exit();
        $this->db->query("UPDATE `country`
                          SET Name = :name,
                              CapitalCity = :capitalCity,
                              Continent = :continent,
                              Population = :population
                          WHERE Id = :id");
        $this->db->bind(':name', $post['name'], PDO::PARAM_STR);
        $this->db->bind(':capitalCity', $post['capitalCity'], PDO::PARAM_STR);
        $this->db->bind(':continent', $post['continent'], PDO::PARAM_STR);
        $this->db->bind(':population', $post['population'], PDO::PARAM_INT);
        $this->db->bind(':id', $post['id'], PDO::PARAM_INT);

        $this->db->execute();
    }

    public function deleteCountry($Id)
    {
        $this->db->query("DELETE FROM Country WHERE Id = :Id");
        $this->db->bind(':Id', $Id);
        return $this->db->execute();
    }

    public function createCountry($post)
    {
        // var_dump($post);exit();
        $this->db->query("INSERT INTO country (Id, Name, CapitalCity, Continent, Population)
                         VALUES (NULL, :name, :capitalCity, :continent, :population)");
        $this->db->bind(':name', $post['name'], PDO::PARAM_STR);
        $this->db->bind(':capitalCity', $post['capitalCity'], PDO::PARAM_STR);
        $this->db->bind(':continent', $post['continent'], PDO::PARAM_STR);
        $this->db->bind(':population', $post['population'], PDO::PARAM_INT);
        return $this->db->execute();
    }
}




