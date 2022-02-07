<?php

require_once 'AppController.php';
require_once __DIR__ . '/../models/Slope.php';
require_once __DIR__.'/../repository/SlopeRepository.php';

class SlopeController extends AppController
{

    const MAX_FILE_SIZE = 1024 * 1024;
    const SUPPORTED_TYPES = ['image/png', 'image/jpeg'];
    const UPLOAD_DIRECTORY = '/../public/uploads/';

    private $messages = [];
    private $slopeRepository;

    public function __construct()
    {
        parent::__construct();
        $this->slopeRepository = new slopeRepository();
    }

    public function szukaj()
    {
        $slopes = $this->slopeRepository->getSlopes();

        $this->render('szukaj', ['slopes' => $slopes]);
    }
/*
    public function szukaj()
    {
        if ($this->isLog())
            $this->render('szukaj', ['messages' => $this->messages]);
        else
            $this->index();
    }*/

    public function addSlope()
    {
        if ($this->isPost() && is_uploaded_file($_FILES['file']['tmp_name']) && $this->validate($_FILES['file'])) {
            move_uploaded_file(
                $_FILES['file']['tmp_name'],
                dirname(__DIR__) . self::UPLOAD_DIRECTORY . $_FILES['file']['name']
            );

            // TODO create new project object and save it in database
            $slope = new Slope($_POST['title'], $_POST['description'], $_FILES['file']['name']);
            $this->slopeRepository->addSlope($slope);

            return $this->render('szukaj', [
                'messages' => $this->message,
                'slopes' => $this->slopeRepository->getSlopes()
            ]);

        }
        return $this->render('add', ['messages' => $this->message]);
    }

    public function search(){
        $contentType = isset($_SERVER["CONTENT_TYPE"]) ? trim($_SERVER["CONTENT_TYPE"]) : '';

        if ($contentType === "application/json") {
            $content = trim(file_get_contents("php://input"));
            $decoded = json_decode($content, true);

            header('Content-type: application/json');
            http_response_code(200);

            echo json_encode($this->slopeRepository->getSlopeByTitle($decoded['search']));
        }
    }

    private function validate(array $file): bool
    {
        if ($file['size'] > self::MAX_FILE_SIZE) {
            $this->message[] = 'Plik jest zbyt duży!';
            return false;
        }

        if (!isset($file['type']) || !in_array($file['type'], self::SUPPORTED_TYPES)) {
            $this->message[] = 'Złe rozszerzenie pliku!';
            return false;
        }
        return true;
    }

}
