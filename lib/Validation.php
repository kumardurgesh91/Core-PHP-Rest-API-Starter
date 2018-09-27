<?php
require DIR_PATH . '/Exceptions/ValidationException.php';

class Validation {
    /**
     * 
     * @param type $email
     * @return boolean
     */
    public function validateEmail($email = '') {
        if(filter_var($email, FILTER_VALIDATE_EMAIL)) {
            return true;
        }
        throw new ValidationException('EMAIL_INVALID');
    }


    /**
     * 
     * @param type $code
     * @return boolean
     */
    public function validateInvitationCode($code = 0) {
       
        if(is_numeric($code) && $code > 9999999 && $code < 100000000){
            return true;
        }
        
        throw new ValidationException('CODE_INVALID');
    }
    
    public function validateDesire($invi_desire){
        $expected_desire=array(1,2,3,4);
        if(!is_array($invi_desire)){
            throw new ValidationException('DESIRE_MUST_BE_ARRAY');
        }
        if (count(array_intersect($expected_desire, $invi_desire)) != count($invi_desire)) {
            throw new ValidationException('DESIRE_MUST_BE_BETWEEN_1_4');
        }

        foreach ($invi_desire as $value) {
           if(!is_int($value)){
            throw new ValidationException('DESIRE_ID_MUST_BE_INTEGER');
        }
    }
    } //function validateDesire() ends

    
    public function validateBreakAwayiID($breakawayi_id) {
        if(empty($breakawayi_id)) {
            throw new ValidationException('INVALID_BREAKAWAY_ID');
        }
        if(strlen($breakawayi_id) < 4 || strlen($breakawayi_id) > 32) {
            throw new ValidationException('BREAKAWAYI_ID_LENGTH_INVALID');
        }
    } // function validateBreakAwayiID() ends


    public function validatePhoneNo($phone_no){
        
        if(!preg_match("/^[0-9]{10}$/", $phone_no)) {
           throw new ValidationException('PHONE_NUMBER_MUST_BE_15_DIGITE');
       }
    } //function validatePhoneNumber() ends



}
?>