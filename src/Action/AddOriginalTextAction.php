<?php
/**
 * Created by Slava Basko <basko.slava@gmail.com>
 * Date: 9/28/16
 */

namespace YandexWebmaster\Action;

use Yandex\Action\ActionInterface;
use Yandex\Action\DataActionInterface;
use Yandex\Auth\Token;
use Yandex\Utils\Json;
use YandexWebmaster\Auth\User;

final class AddOriginalTextAction implements ActionInterface, DataActionInterface
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
    private $content;

    /**
     * GetSiteAction constructor.
     * @param User $user
     * @param $hostId
     * @param $content
     */
    public function __construct(User $user, $hostId, $content)
    {
        $this->user = $user;
        $this->hostId = $hostId;
        if (function_exists('mb_strlen')) {
            $len = mb_strlen($content);
        } else {
            $len = strlen($content);
        }
        if ($len < 500 or $len > 32000) {
            throw new \InvalidArgumentException('Invalid content');
        }
        $this->content = $content;
    }

    /**
     * @return string
     */
    public function getUrl()
    {
        return sprintf('/%s/hosts/%s/original-texts', $this->user->getUserId(), $this->hostId);
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
            'content' => $this->content
        ]);
    }
}