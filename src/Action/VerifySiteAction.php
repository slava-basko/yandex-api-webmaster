<?php
/**
 * Created by Slava Basko <basko.slava@gmail.com>
 * Date: 9/20/16
 */

namespace YandexWebmaster\Action;

use Yandex\Action\ActionInterface;
use Yandex\Auth\Token;
use YandexWebmaster\Auth\User;

final class VerifySiteAction implements ActionInterface
{
    const VERIFICATION_TYPE_DNS = 'DNS';
    const VERIFICATION_TYPE_HTML_FILE = 'HTML_FILE';
    const VERIFICATION_TYPE_META_TAG = 'META_TAG';
    const VERIFICATION_TYPE_WHOIS = 'WHOIS';

    /**
     * @var string
     */
    private $hostId;

    /**
     * @var User
     */
    private $user;

    /**
     * @var int
     */
    private $verificationType;

    /**
     * AddSiteAction constructor.
     * @param User $user
     * @param $hostId
     * @param $verificationType
     */
    public function __construct(User $user, $hostId, $verificationType)
    {
        if (in_array($verificationType, [
                static::VERIFICATION_TYPE_DNS,
                static::VERIFICATION_TYPE_HTML_FILE,
                static::VERIFICATION_TYPE_META_TAG,
                static::VERIFICATION_TYPE_WHOIS
            ]) == false
        ) {
            throw new \InvalidArgumentException('Unsupported verification type.');
        }

        $this->user = $user;
        $this->hostId = $hostId;
        $this->verificationType = $verificationType;
    }

    /**
     * @return string
     */
    public function getUrl()
    {
        return sprintf(
            '/%s/hosts/%s/verification/?verification_type=%s',
            $this->user->getUserId(),
            $this->hostId,
            $this->verificationType);
    }

    /**
     * @return string
     */
    public function getHttpMethod()
    {
        return 'post';
    }

    /**
     * @return Token
     */
    public function getToken()
    {
        return $this->user->getToken();
    }
}