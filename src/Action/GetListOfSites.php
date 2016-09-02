<?php
/**
 * Created by Slava Basko <basko.slava@gmail.com>
 * Date: 9/2/16
 */

namespace YandexWebmaster\Action;

use Yandex\Action\ActionInterface;
use Yandex\Auth\Token;

final class GetListOfSites implements ActionInterface
{
    /**
     * @var Token
     */
    private $token;

    /**
     * GetListOfSites constructor.
     * @param Token $token
     */
    public function __construct(Token $token)
    {
        $this->token = $token;
    }

    /**
     * @return string
     */
    public function getUrl()
    {
        return '/hosts';
    }

    /**
     * @return string
     */
    public function getHttpMethod()
    {
        return 'get';
    }

    /**
     * @return Token
     */
    public function getToken()
    {
        return $this->getToken();
    }
}