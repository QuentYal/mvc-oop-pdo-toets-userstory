<?php
class Mankementen extends Controller
{
    public function __construct()
    {
        $this->MankementModel = $this->model('Mankement');
    }

    public function index()
    {
        $result = $this->MankementModel->getMankementen();

        if ($result) {
            $instructeurNaam = $result[0]->MANHOI;
        } else {
            $instructeurNaam = '';
        }

        $rows = '';
        foreach ($result as $info) {
            $d = new DateTimeImmutable($info->Datum, new DateTimeZone('Europe/Amsterdam'));
            $rows .= "<tr>
            <td>{$d->format('d-m-Y')}</td>
            <td>{$d->format('H:i')}</td>
            <td>$info->MANHOI</td>
            <td><a href=''><img src='" . URLROOT . "/img/b_help.png' alt='QuestionMark'></a></td>
            <td><a href='" . URLROOT . "/mankementen/MankementOverzicht/{$info->Id}'><img src='" . URLROOT . "img/b_props.png' alt='QuestionMark'></a></td>
        </tr>";
        }

        $data = [
            'title' => 'overzicht Mankementen',
            'rows' => $rows,
            'instructeurNaam' => $instructeurNaam
        ];
        $this->view('mankementen/index', $data);
    }

    function mankementOverzicht($AutoId)
    {
        $result = $this->MankementModel->getMankementOverzicht($AutoId);

        if ($result) {
            $d = new DateTimeImmutable($result[0]->Datum, new DateTimeZone('Europe/Amsterdam'));
            $date = $d->format('d-m-Y');
            $time = $d->format('H:i');
        } else {
            $date = '';
            $time = '';
        }

        $rows = '';

        foreach ($result as $topic) {
            $rows .= "<tr>
                        <td>$topic->Mankement</td>
                      </tr>";
        }
        $data = [
            'title' => 'Mankementen',
            'rows' => $rows,
            'AutoId' => $AutoId,
            'date' => $date,
            'time' => $time
        ];
        $this->view('mankementen/MankementOverzicht', $data);
    }

    function addTopic($AutoId = NULL)
    {
        $data = [
            'title' => 'Mankement Toevoegen',
            'AutoId' => $AutoId,
            'mankementError' => ''
        ];

        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_FULL_SPECIAL_CHARS);

            $data = [
                'title' => 'onderwerp Toevoegen',
                'AutoId' => $_POST['AutoId'],
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
                header('Refresh:3; url=' . URLROOT . '/mankementen/index');
            } else {
                Header('Refresh:3; url=' . URLROOT . '/mankementen/addTopic/' . $data['mankementId']);
            }
        }
        $this->view('mankementen/addTopic', $data);
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
