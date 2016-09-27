<?php
/**
 * Created by Slava Basko <basko.slava@gmail.com>
 * Date: 9/27/16
 */

namespace YandexWebmaster\Action;

use Yandex\Action\ActionInterface;
use Yandex\Action\DataActionInterface;
use Yandex\Auth\Token;
use Yandex\Utils\Json;
use YandexWebmaster\Auth\User;

final class AddSitemapAction implements ActionInterface, DataActionInterface
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
     * @var
     */
    private $url;

    /**
     * GetSiteAction constructor.
     * @param User $user
     * @param $hostId
     * @param $url
     */
    public function __construct(User $user, $hostId, $url)
    {
        $this->user = $user;
        $this->hostId = $hostId;
        $this->url = $url;
    }

    /**
     * @return string
     */
    public function getUrl()
    {
        return sprintf('/%s/hosts/%s/user-added-sitemaps', $this->user->getUserId(), $this->hostId);
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

    /**
     * @return string
     */
    public function getBody()
    {
        return Json::encode([
            'url' => $this->url
        ]);
    }
}