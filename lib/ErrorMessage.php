<?php

/**
 * Add your error message here
 * Please follow rules for error messages errors comes under some category
 * 1. Miscellaneous error, Start from 1
 * 2. Database query failed error, Start from 4000
 * 3. Missing params, body, url parameters error, Start from 2000
 * 4. Validation error, Start from 3000
 * 5. Image upload error, Start from 5100
 * ---Next, Add Your own type of errors---
 */
class ErrorMessage {

    /**
     * Miscellaneous Error
     * Start with 1
     */
    public $EMAIL_EXIST = array('message' => 'email address already exists', 'code' => 1);
    public $USERNAME_EXIST = array('error' => 'username already exist', 'code' => 2);
    public $LOGIN_FAILED = array('error' => 'invalid email or password', 'code' => 3);
    public $INVALID_ID = array('error' => 'invalid user id', 'code' => 4);
    public $TOKEN_MISSING = array('error' => 'auth token missing', 'code' => 5);
    public $TOKEN_EXPIRED = array('error' => 'auth token expired or invalid', 'code' => 6);
    public $TOKEN_INVALID = array('error' => 'auth token invalid', 'code' => 7);
    public $UPDATED_AT_MISSING = array('error' => 'updated at missing', 'code' => 8);
    public $INVALID_ACTIVATION_STATUS = array('error' => 'wrong activation status', 'code' => 9);

    
    /**
     * Missing or empty in request body
     * Start with 2000
     */
    public $EMAIL_MISSING = array('message' => 'email is required', 'code' => 2000);
    public $PASSWORD_MISSING = array('error' => 'Password missing', 'code' => 2003);
    public $LNAME_MISSING = array('error' => 'Sur name missing', 'code' => 2005);
    public $FNAME_MISSING = array('error' => 'First name missing', 'code' => 2006);
    public $PROFILE_PIC_MISSING = array('error' => 'Profile pic missing', 'code' => 2007);
    public $PHONE_NO_MISSING = array('error' => 'phone number missing', 'code' => 2012);
    public $ISD_CODE_MISSING = array('error' => 'ISD code missing', 'code' => 2013);
    
    /**
     * Validation Errors
     * Start with 3000
     */
    public $CODE_INVALID = array('error' => 'invitation code is invalid', 'code' => 3000);
    public $EMAIL_INVALID = array('message' => 'email address is invalid', 'code' => 3001);
    public $INVALID_FIRST_NAME = array('error' => 'First name must be between 4 to 48 charecter', 'code' => 3002);
    public $INVALID_SUR_NAME = array('error' => 'Sur name must be between 4 to 48 charecter', 'code' => 3004);
    public $INVALID_COUNTRY = array('error' => 'Invalid country', 'code' => 3005);
    public $INVALID_STATE = array('error' => 'Invalid state', 'code' => 3006);
    public $INVALID_CITY = array('error' => 'Invalid city', 'code' => 3007);
    public $UNKNOWN_VALIDATION_ERROR = array('error' => 'Can not process request, please try after some time', 'code' => 3008);
    
    /**
     * Image upload error
     * Start with 5100
     */
    public $UNKNOWN_ERROR = array('error' => 'something went wrong, please try again', 'code' => 5100);
    public $IMAGE_SIZE_ERROR = array('error' => 'Invalid image size', 'code' => 5101);
    public $INVALID_IMAGE_TYPE = array('error' => 'Invalid image type', 'code' => 5102);
    public $UNKNOWN_IMAGE_ERROR = array('error' => 'We can not process your request because of error in image', 'code' => 5103);

}

?>