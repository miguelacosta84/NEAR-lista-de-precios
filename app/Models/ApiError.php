<?php

namespace App\Models;

class ApiError
{
    public $isError;
    public $message;
    public $id;
    public $exist;
    public $rows;


    public function __construct(){
        $this->isError  = false;
        $this->exist    = false;
        $this->id       = 0;
        $this->code     = 200;
        $this->message  = '';
        $this->modelo   = [];
        $this->request  = [];
        $this->rows     = [];
        $this->errors   = [];

    }

    protected $casts = [
        'isError'   => 'boolean',
        'exist'     => 'boolean',
        'id'        => 'integer',
        'message'   => 'string'
    ];

    public function toJSON(){
        return json_encode($this);
    }

    public function setError($sMessage, $code = 400){
        $this->isError  =  true;
        $this->code     =  $code;
        $this->message  =  $sMessage;
    }

    public function setErrors(array $errors, $code = 400){
        $this->isError  =  true;
        $this->code     =  $code;
        $this->errors   =  $errors;
    }

    public function setCode($code) {
        $this->code     =  $code;
    }

    public function setMessage($sMessage){
        $this->message  =  $sMessage;
    }

}
