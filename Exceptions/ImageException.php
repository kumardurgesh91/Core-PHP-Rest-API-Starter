<?php

class ImageException extends Exception {
    public function __construct($message, $code = 0, Exception $previous = null) {
        parent::__construct($message, $code, $previous);
    }
    /**
     * 
     * @global type $error
     * @return type
     */
    public function getError() {
        global $error;
        switch ($this->getMessage()) {
            case 'IMAGE_SIZE_ERROR' :
            return $error->IMAGE_SIZE_ERROR;
            break;
            case 'INVALID_IMAGE_TYPE' :
            return $error->INVALID_IMAGE_TYPE;
            break;
            default :
            return $error->UNKNOWN_IMAGE_ERROR;
        }
    }
}
