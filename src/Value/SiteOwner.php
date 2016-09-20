<?php
/**
 * Created by Slava Basko <basko.slava@gmail.com>
 * Date: 9/20/16
 */

namespace YandexWebmaster\Value;

class SiteOwner
{
    /**
     * @var string
     */
    private $userLogin;

    /**
     * @var string
     */
    private $verificationUin;

    /**
     * @var string
     */
    private $verificationType;

    /**
     * @var \DateTime
     */
    private $verificationDate;

    /**
     * SiteOwner constructor.
     * @param $userLogin
     * @param $verificationUin
     * @param $verificationType
     * @param $verificationDate
     */
    public function __construct(
        $userLogin,
        $verificationUin,
        $verificationType,
        $verificationDate
    )
    {
        $this->userLogin = $userLogin;
        $this->verificationUin = $verificationUin;
        $this->verificationType = $verificationType;
        // TODO: handle milliseconds
        $this->verificationDate = \DateTime::createFromFormat(\DateTime::ISO8601, date('c', strtotime($verificationDate)));
    }

    /**
     * @param array $data
     * @return SiteOwner
     */
    public static function fromArray(array $data)
    {
        return new self(
            isset($data['user_login']) ? $data['user_login'] : '',
            isset($data['verification_uin']) ? $data['verification_uin'] : '',
            isset($data['verification_type']) ? $data['verification_type'] : '',
            isset($data['verification_date']) ? $data['verification_date'] : ''
        );
    }

    /**
     * @return string
     */
    public function getUserLogin()
    {
        return $this->userLogin;
    }

    /**
     * @return string
     */
    public function getVerificationUin()
    {
        return $this->verificationUin;
    }

    /**
     * @return string
     */
    public function getVerificationType()
    {
        return $this->verificationType;
    }

    /**
     * @return \DateTime
     */
    public function getVerificationDate()
    {
        return $this->verificationDate;
    }
}