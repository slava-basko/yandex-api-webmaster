<?php
/**
 * Created by Slava Basko <basko.slava@gmail.com>
 * Date: 9/20/16
 */

namespace YandexWebmaster\Value;


class SiteVerificationStatus
{
    const VERIFICATION_STATUS_NONE = 'NONE';
    const VERIFICATION_STATUS_VERIFIED = 'VERIFIED';
    const VERIFICATION_STATUS_IN_PROGRESS = 'IN_PROGRESS';
    const VERIFICATION_STATUS_VERIFICATION_FAILED = 'VERIFICATION_FAILED';
    const VERIFICATION_STATUS_INTERNAL_ERROR = 'INTERNAL_ERROR';

    private $verificationUin;

    private $verificationState;

    private $verificationType;

    private $latestVerificationTime;

    private $failInfo;

    private $applicableVerifiers;

    /**
     * SiteVerificationStatus constructor.
     * @param $verificationUin
     * @param $verificationState
     * @param $verificationType
     * @param $latestVerificationTime
     * @param $failInfo
     * @param $applicableVerifiers
     */
    public function __construct(
        $verificationUin,
        $verificationState,
        $verificationType,
        $latestVerificationTime,
        $failInfo,
        $applicableVerifiers
    )
    {
        $this->verificationUin = $verificationUin;
        $this->verificationState = $verificationState;
        $this->verificationType = $verificationType;
        $this->latestVerificationTime = $latestVerificationTime;
        $this->failInfo = $failInfo;
        $this->applicableVerifiers = $applicableVerifiers;
    }

    /**
     * @param array $data
     * @return SiteVerificationStatus
     */
    public static function fromArray(array $data)
    {
        return new self(
            isset($data['verification_uin']) ? $data['verification_uin'] : '',
            isset($data['verification_state']) ? $data['verification_state'] : '',
            isset($data['verification_type']) ? $data['verification_type'] : '',
            isset($data['latest_verification_time']) ? $data['latest_verification_time'] : '',
            isset($data['fail_info']) ? $data['fail_info'] : [],
            isset($data['applicable_verifiers']) ? $data['applicable_verifiers'] : []
        );
    }

    /**
     * @return mixed
     */
    public function getVerificationUin()
    {
        return $this->verificationUin;
    }

    /**
     * @return mixed
     */
    public function getVerificationState()
    {
        return $this->verificationState;
    }

    /**
     * @return mixed
     */
    public function getVerificationType()
    {
        return $this->verificationType;
    }

    /**
     * @return mixed
     */
    public function getLatestVerificationTime()
    {
        return $this->latestVerificationTime;
    }

    /**
     * @return mixed
     */
    public function getFailInfo()
    {
        return $this->failInfo;
    }

    /**
     * @return mixed
     */
    public function getApplicableVerifiers()
    {
        return $this->applicableVerifiers;
    }
}