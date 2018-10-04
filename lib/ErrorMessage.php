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


    /**
     * Validation Errors
     * Start with 3000
     */
    public $UNKNOWN_VALIDATION_ERROR = array('error' => 'Can not process request, please try after some time', 'code' => 2000);
    public $EMAIL_EMPTY = array('message' => 'email is required', 'code' => 2001);
    public $EMAIL_INVALID = array('message' => 'email address is invalid', 'code' => 2002);
    public $PASSWORD_EMPTY = array('error' => 'Password missing', 'code' => 2003);
    public $FIRST_NAME_EMPTY = array('error' => 'First name missing', 'code' => 2004);
    public $EMAIL_ALREADY_EXIST = array('error' => 'Email id already exist', 'code' => 2005);
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