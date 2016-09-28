<?php
/**
 * Created by Slava Basko <basko.slava@gmail.com>
 * Date: 9/28/16
 */

namespace YandexWebmaster\Action;

use Yandex\Action\ActionInterface;
use Yandex\Auth\Token;
use YandexWebmaster\Auth\User;

final class DeleteSitemapAction implements ActionInterface
{
    /**
     * @var User
     */
    private $user;

    /**
     * @var string
     */
    private $hostId;

    /**
     * @var string
     */
    private $sitemapId;

    /**
     * GetSiteAction constructor.
     * @param User $user
     * @param $hostId
     * @param $sitemapId
     */
    public function __construct(User $user, $hostId, $sitemapId)
    {
        $this->user = $user;
        $this->hostId = $hostId;
        $this->sitemapId = $sitemapId;
    }

    /**
     * @return string
     */
    public function getUrl()
    {
        return sprintf('/%s/hosts/%s/user-added-sitemaps/%s', $this->user->getUserId(), $this->hostId, $this->sitemapId);
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