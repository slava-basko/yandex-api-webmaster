<?php
/**
 * Created by Slava Basko <basko.slava@gmail.com>
 * Date: 9/29/16
 */

namespace YandexWebmaster\Action;

use Yandex\Action\ActionInterface;
use Yandex\Auth\Token;
use YandexWebmaster\Auth\User;

final class DeleteOriginalTextAction implements ActionInterface
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
     * @var string
     */
    private $textId;

    /**
     * DeleteSiteAction constructor.
     * @param User $user
     * @param $hostId
     * @param $textId
     */
    public function __construct(User $user, $hostId, $textId)
    {
        $this->user = $user;
        $this->hostId = $hostId;
        $this->textId = $textId;
    }

    /**
     * @return string
     */
    public function getUrl()
    {
        return sprintf('/%s/hosts/%s/original-texts/%s', $this->user->getUserId(), $this->hostId, $this->textId);
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