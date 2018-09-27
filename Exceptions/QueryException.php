<?php

class QueryException extends Exception {

    public function __construct($message, $code = 0, Exception $previous = null) {
        parent:: __construct($message, $code, $previous);
    }

    public function getError() {
        //echo $this->getMessage();
        global $error;
//        if($this->getCode() != 0) {
//            switch ($this->getCode()) {
//                case 23000:
//                    return $error->BREAKAWAYI_ID_ALREADY_EXISTS;
//                    break;
//                default:
//                return $error->UNKNOWN_QUERY_ERROR;
//            }
//        }

        switch ($this->getMessage()) {

            case 'REGISTRATION_FAILED':
                return $error->REGISTRATION_FAILED;
                break;
            case 'FAILED_TO_UPDATE_PROFILE_PIC':
                return $error->FAILED_TO_UPDATE_PROFILE_PIC;
                break;
            default:
                if (ENV === 'dev') {
                    return $this->getMessage();
                } else if (ENV === 'test') {
                    return $this->getMessage();
                } else {
                    return $error->UNKNOWN_QUERY_ERROR;
                }
        }
    }

}

?>