<?php
/**
 * Created by Slava Basko <basko.slava@gmail.com>
 * Date: 9/2/16
 */

namespace YandexWebmaster\Action;

use Yandex\Action\ActionInterface;
use Yandex\Action\DataActionInterface;
use Yandex\Auth\Token;
use Yandex\Utils\Json;
use YandexWebmaster\Auth\User;

final class AddSiteAction implements ActionInterface, DataActionInterface
{
    /**
     * @var string
     */
    private $domainName;

    /**
     * @var User
     */
    private $user;

    /**
     * AddSiteAction constructor.
     * @param User $user
     * @param $domainName
     */
    public function __construct(User $user, $domainName)
    {
        if (\Yandex\isValidDomainName($domainName) == false) {
            throw new \InvalidArgumentException('Invalid domain name.');
        }
        $this->user = $user;
        $this->domainName = $domainName;
    }

    /**
     * @return string
     */
    public function getUrl()
    {
        return sprintf('/%s/hosts', $this->user->getUserId());
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
            'host_url' => $this->domainName
        ]);
    }
}
