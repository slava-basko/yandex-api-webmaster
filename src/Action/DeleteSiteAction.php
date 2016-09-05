<?php
/**
 * Created by Slava Basko <basko.slava@gmail.com>
 * Date: 9/5/16
 */

namespace YandexWebmaster\Action;

use Yandex\Action\ActionInterface;
use Yandex\Auth\Token;

final class DeleteSiteAction implements ActionInterface
{
    /**
     * @var Token
     */
    private $token;

    /**
     * @var string
     */
    private $siteId;

    /**
     * DeleteSiteAction constructor.
     * @param Token $token
     * @param $siteId
     */
    public function __construct(Token $token, $siteId)
    {
        $this->token = $token;
        $this->siteId = $siteId;
    }

    /**
     * @return string
     */
    public function getUrl()
    {
        return '/hosts/' . $this->siteId;
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
        return $this->token;
    }
}