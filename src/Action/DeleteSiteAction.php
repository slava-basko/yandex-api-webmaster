<?php
/**
 * Created by Slava Basko <basko.slava@gmail.com>
 * Date: 9/5/16
 */

namespace YandexWebmaster\Action;

use Yandex\Action\ActionInterface;
use Yandex\Auth\Token;
use YandexWebmaster\Auth\User;

final class DeleteSiteAction implements ActionInterface
{
    /**
     * @var string
     */
    private $hostId;

    /**
     * @var User
     */
    private $user;

    /**
     * DeleteSiteAction constructor.
     * @param User $user
     * @param $hostId
     */
    public function __construct(User $user, $hostId)
    {
        $this->user = $user;
        $this->hostId = $hostId;
    }

    /**
     * @return string
     */
    public function getUrl()
    {
        return sprintf('/%s/hosts/%s', $this->user->getUserId(), $this->hostId);
    }

    /**
     * @return string
     */
    public function getHttpMethod()
    {
        return 'delete';
    }

    /**
     * @return Token
     */
    public function getToken()
    {
        return $this->user->getToken();
    }
}