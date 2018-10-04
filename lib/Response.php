<?php

class Response {

    private function getContentType($type) {
        if ($type === 'json') {
            return "application/json";
        }
        return "application/json";
    }

    public function ok() {
        header('Access-Control-Allow-Origin: *');
        header('Access-Control-Allow-Methods: POST, GET, DELETE, PUT, PATCH, OPTIONS');
        header('Access-Control-Allow-Headers: token, Content-Type');
        header('Access-Control-Max-Age: 1728000');
        header('Content-Length: 0');
        die();
    }

// ok function ends

    private function setHeaders() {
        header("HTTP/1.1 " . $this->code . " " . $this->getStatusMessage());
        header("Content-Type:" . $this->contentType);
        //header("Access-Control-Allow-Origin: *");
        header('Access-Control-Allow-Origin: *');
        header('Access-Control-Allow-Methods: POST, GET, DELETE, PUT, PATCH, OPTIONS');
        header('Access-Control-Allow-Headers: token, Content-Type');
        header('Access-Control-Max-Age: 1728000');
        header('Content-Length: 0');
    }

    public function jsonResponse($data = array(), $status = 200) {
        // pending default should not be 200 . check again
        $this->code = $status;
        if (!is_array($data)) {
            $this->data = array();
            $this->data['message'] = $data;
        } else {
            $this->data = $data;
            $this->data = json_decode(json_encode($this->data), true);
        }

        $this->data['success'] = $status === 200 ? true : false;
        $this->contentType = $this->getContentType('json');
        $this->setHeaders();
        global $utils;
        $camelCase = $utils->camelCaseKeys($this->data);
        echo json_encode($camelCase);
        exit;
    }

//jasonResponse function ends

    private function getStatusMessage() {
        $status = array(
            100 => 'Continue',
            101 => 'Switching Protocols',
            200 => 'OK',
            201 => 'Created',
            202 => 'Accepted',
            203 => 'Non-Authoritative Information',
            204 => 'No Content',
            205 => 'Reset Content',
            206 => 'Partial Content',
            300 => 'Multiple Choices',
            301 => 'Moved Permanently',
            302 => 'Found',
            303 => 'See Other',
            304 => 'Not Modified',
            305 => 'Use Proxy',
            306 => '(Unused)',
            307 => 'Temporary Redirect',
            400 => 'Bad Request',
            401 => 'Unauthorized',
            402 => 'Payment Required',
            403 => 'Forbidden',
            404 => 'Not Found',
            405 => 'Method Not Allowed',
            406 => 'Not Acceptable',
            407 => 'Proxy Authentication Required',
            408 => 'Request Timeout',
            409 => 'Conflict',
            410 => 'Gone',
            411 => 'Length Required',
            412 => 'Precondition Failed',
            413 => 'Request Entity Too Large',
            414 => 'Request-URI Too Long',
            415 => 'Unsupported Media Type',
            416 => 'Requested Range Not Satisfiable',
            417 => 'Expectation Failed',
            500 => 'Internal Server Error',
            501 => 'Not Implemented',
            502 => 'Bad Gateway',
            503 => 'Service Unavailable',
            504 => 'Gateway Timeout',
            505 => 'HTTP Version Not Supported');
        return ($status[$this->code]) ? $status[$this->code] : $status[500];
    }

}

?>