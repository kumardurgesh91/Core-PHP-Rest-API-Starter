<?php

class Rest {

    public function __construct() {
        $this->inputs();
    }

    public function getRequestMethod() {
        return $_SERVER['REQUEST_METHOD'];
    }

    private function inputs() {
        global $utils;
        switch ($this->getRequestMethod()) {
            case 'POST':
            case 'PUT':
            case 'PATCH':
                $this->queryParams = $utils->underscoreKeys($this->cleanInputs($_GET));
                $this->bodyParams = json_decode(file_get_contents("php://input"), true);
                $this->bodyParams = $utils->underscoreKeys($this->cleanInputs($this->bodyParams));
                break;
            case 'GET':
            case 'DELETE':
                $this->queryParams = $this->cleanInputs($_GET);
                break;
            default:
                global $response;
                $response->ok();
        }
    }

    public function cleanInputs($data) {
        $clean_input = array();
        if (is_array($data)) {
            foreach ($data as $k => $v) {
                $clean_input[$k] = $this->cleanInputs($v);
            }
        } else {
            if (get_magic_quotes_gpc()) {
                $data = stripslashes($data);
            }

            if (gettype($data) == 'string') {
                $data = strip_tags($data);
                $clean_input = trim($data);
            } else {
                $clean_input = $data;
            }
        }
        return $clean_input;
    }
}

// REST class ends
?>