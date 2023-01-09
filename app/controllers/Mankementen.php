<?php
class Mankementen extends Controller
{
    public function __construct()
    {
        $this->MankementModel = $this->model('Mankement');
    }

    public function index()
    {
        $result = $this->MankementModel->getMankement();

        if ($result) {
            $instructeurNaam = $result[0]->Manhoi;
        } else {
            $instructeurNaam = '';
        }

        $rows = '';
        foreach ($result as $info) {
            $d = new DateTimeImmutable($info->Datum, new DateTimeZone('Europe/Amsterdam'));
            $rows .= "<tr>
            <td>{$d->format('d-m-Y')}</td>
            <td>{$d->format('H:i')}</td>
            <td>$info->Manhoi</td>
            <td><a href=''><img src='" . URLROOT . "/img/b_help.png' alt='QuestionMark'></a></td>
            <td><a href='" . URLROOT . "/lessen/MankementOverzicht/{$info->Id}'><img src='" . URLROOT . "img/b_props.png' alt='QuestionMark'></a></td>
        </tr>";
        }

        $data = [
            'title' => 'overzicht Mankementen',
            'rows' => $rows,
            'instructeurNaam' => $instructeurNaam
        ];
        $this->view('lessen/index', $data);
    }

    function mankementOverzicht($mankementId)
    {
        $result = $this->MankementModel->getmankementOvezicht($mankementId);

        if ($result) {
            $d = new DateTimeImmutable($result[0]->DatumTijd, new DateTimeZone('Europe/Amsterdam'));
            $date = $d->format('d-m-Y');
            $time = $d->format('H:i');
        } else {
            $date = '';
            $time = '';
        }

        $rows = '';

        foreach ($result as $topic) {
            $rows .= "<tr>
                        <td>$topic->onderwerp</td>
                      </tr>";
        }
        $data = [
            'title' => 'Onderwerpen Les',
            'rows' => $rows,
            'mankementId' => $mankementId,
            'date' => $date,
            'time' => $time
        ];
        $this->view('mankementen/MankementOverzicht', $data);
    }

    function addTopic($mankementId = NULL)
    {
        $data = [
            'title' => 'Mankement Toevoegen',
            'mankementId' => $mankementId,
            'mankementError' => ''
        ];

        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_FULL_SPECIAL_CHARS);

            $data = [
                'title' => 'onderwerp Toevoegen',
                'mankementId' => $_POST['mankementId'],
                'mankement' => $$_POST['mankement'],
                'mankementError' => ''
            ];

            $data = $this->validateAddMankementForm($data);

            if (empty($data['topicError'])) {
                $result = $this->MankementModel->addTopic($_POST);

                if ($result) {
                    $data['title'] = "<p>Het nieuwe mankement is succesvol toegevoegd</p>";
                } else {
                    echo "<p>Het nieuwe mankement is niet toegevoegd</p>";
                }
                header('Refresh:3; url=' . URLROOT . '/lessen/index');
            } else {
                Header('Refresh:3; url=' . URLROOT . '/lessen/addTopic/' . $data['lesId']);
            }
        }
        $this->view('lessen/addTopic', $data);
    }

    private function validateAddMankementForm($data)
    {
        if (strlen($data['mankement']) > 50) {
            $data['mankementError'] = "Het nieuwe mankement bevat meer dan 50 letters.";
        } elseif (empty($data['mankement'])) {
            $data['mankementError'] = "U bent verplicht dit veld in te vullen.";
        }

        return $data;
    }
}
