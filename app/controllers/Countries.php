<?php

class Countries extends Controller
{
    private $countryModel;

    public function __construct() 
    {
       $this->countryModel = $this->model('Country');
    }

    public function index($land = null, $age = null) 
    {
        // Laat de model de gegevens uit de database halen via method getCountries()
        $records = $this->countryModel->getCountries();

        $rows = '';
        foreach ($records as $value) {
            $rows .= "<tr>
                         <td>$value->Name</td>
                         <td>$value->CapitalCity</td>
                         <td>$value->Continent</td>
                         <td>$value->Population</td>
                         <td><a href='" . URLROOT . "/countries/update/$value->Id'>update</a></td>
                         <td><a href='" . URLROOT . "/countries/delete/$value->Id'>delete</a></td>
                      </tr>";
        }

        // Stuur de gegevens uit de model naar de view via het $data array
        $data = [
            'title' => "Landen van de wereld",
            'rows' => $rows
        ];
        $this->view('countries/index', $data);
    }

    public function update($id = NULL)
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            

            $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_FULL_SPECIAL_CHARS);

            // var_dump($_POST);exit();
            $this->countryModel->updateCountry($_POST);

            header("Location: " . URLROOT . "/countries/index");

        }
        $row = $this->countryModel->getSingleCountry($id);
        $data = [
            'title' => '<h1>Update landenoverzicht</h1>',
            'row' => $row
        ];
        $this->view('countries/update', $data);
    }

    public function delete($id)
    {
        if($this->countryModel->deleteCountry($id)) {
            echo "Het deleten is gelukt";
            header("Refresh:3; URL=" . URLROOT . "/countries/index");
        } else {
            echo "Internal server error. Raadpleeg de admin";
            header("Refresh:3; URL=" . URLROOT . "/countries/index");
        }
    }

    public function create()
    {
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_FULL_SPECIAL_CHARS);

            $result = $this->countryModel->createCountry($_POST);
            if ($result) {
                echo "Het toevoegen is gelukt";
                header("Refresh:3; URL=" . URLROOT . "/countries/index");
            } else {
                echo "Internal server error, het toevoegen is niet gelukt";
                header("Refresh:3; URL=" . URLROOT . "/countries/index");
            }
        } else {
            $data = [
                'title' => 'Voeg een nieuw land toe'
            ];
            $this->view("countries/create", $data);
        }
    }


}