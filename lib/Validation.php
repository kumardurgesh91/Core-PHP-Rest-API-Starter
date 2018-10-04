<?php
require_once DIR_PATH . '/exceptions/ValidationException.php';

class Validation {
    /**
     * 
     * @param type $email
     * @return boolean
     */
    public function email($email = '') {
        if(empty($email)) {
            throw new ValidationException('EMAIL_EMPTY');
        }
        if(!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            throw new ValidationException('EMAIL_INVALID');
        }
        return true;
    }
    
    /**
     * 
     * @param type $name
     * @return boolean
     * @throws type
     */
    public function firstName($name = '') {
        if(empty($name)) {
            throw new ValidationException('FIRST_NAME_EMPTY');
        }
        if(strlen($name) < 3) {
            throw new ValidationException('FIRST_NAME_MIN_LENGTH');
        }
        if(strlen($name) > 60) {
            throw new ValidationException('FIRST_NAME_MAX_LENGTH');
        }
        return true;
    }
    
    /**
     * 
     * @param type $name
     * @return boolean
     * @throws type
     */
    public function lastName($name = '') {
        if(empty($name)) {
            throw new ValidationException('LAST_NAME_EMPTY');
        }
        if(strlen($name) < 3) {
            throw new ValidationException('LAST_NAME_MIN_LENGTH');
        }
        if(strlen($name) > 60) {
            throw new ValidationException('LAST_NAME_MAX_LENGTH');
        }
        return true;
    }
    
    /**
     * 
     * @param type $password
     * @return boolean
     * @throws type
     */
    public function password($password = '') {
        if(empty($password)) {
            throw ValidationException('PASSWORD_EMPTY');
        }
        if(strlen($password) < 6) {
            throw ValidationException('PASSWORD_MIN_LENGTH');
        }
        if(strlen($password) > 60) {
            throw ValidationException('PASSWORD_MAX_LENGTH');
        }
        return true;
    }

}
?>