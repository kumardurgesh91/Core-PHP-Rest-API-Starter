<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

class ValidationException extends Exception {

    public function __construct($message, $code = 0, Exception $previous = null) {
        parent:: __construct($message, $code, $previous);
    }

    /**
     * 
     * @global type $error
     * @return type
     */
    public function getError() {
        global $error;
        if($error->{$this->getMessage()} != null) {
            return $error->{$this->getMessage()};
        } else {
            return $error->UNKNOWN_VALIDATION_ERROR;
        }
        
//        switch ($this->getMessage()) {
//            case 'EMAIL_INVALID' :
//                return $error->EMAIL_INVALID;
//                break;
//
//            default :
//                return $error->UNKNOWN_VALIDATION_ERROR;
//        }
    }

}

?>