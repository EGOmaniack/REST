<?php

class User {

    public $autorized;
    private $regSended;
    private $token;
    private $userId;
    public $name;
    public $sName;
    public $patronymic;
    public $nickName;

    public function __construct () {
        $this->autorized = false;
        $this->regSended = false;
    }

    public function getinfo()
    {
        $sqlstr = "select * from getUserInfo( "
            . $this->userId . ");";

        $answer = sqlFunction($sqlstr);
        if($answer['status'] == 'OK')
        {
            $this->name = $answer['answer']['name'];
            $this->sName = $answer['answer']['sname'];
            $this->patronymic = $answer['answer']['patronymic'];
            $this->nickName = $answer['answer']['nick'];
        }
//        var_dump($answer);exit;
    }

    public function setRegSended()
    {
        $this->regSended = true;
    }

    /**
     * @return bool
     */
    public function isAutorized(): bool
    {
        return $this->autorized;
    }

    /**
     * @param bool $autorized
     */
    public function setAutorized(bool $autorized)
    {
        $this->autorized = $autorized;
    }

    /**
     * @return mixed
     */
    public function getToken()
    {
        return $this->token;
    }

    /**
     * @param mixed $token
     */
    public function setToken($token)
    {
        $this->token = $token;
    }

    /**
     * @return mixed
     */
    public function getUserId()
    {
        return $this->userId;
    }

    /**
     * @param mixed $userId
     */
    public function setUserId($userId)
    {
        $this->userId = $userId;
    }
}