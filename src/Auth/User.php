<?php
/**
 * Created by Slava Basko <basko.slava@gmail.com>
 * Date: 9/19/16
 */

namespace YandexWebmaster\Auth;

use Yandex\Auth\Token;

class User
{
    /**
     * @var int
     */
    private $userId;

    /**
     * @var Token
     */
    private $token;

    /**
     * User constructor.
     * @param $userId
     * @param Token $token
     */
    public function __construct($userId, Token $token)
    {
        $this->userId = $userId;
        $this->token = $token;
    }

    /**
     * @return int
     */
    public function getUserId()
    {
        return $this->userId;
    }

    /**
     * @return Token
     */
    public function getToken()
    {
        return $this->token;
    }
}