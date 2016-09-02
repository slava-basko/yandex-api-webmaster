<?php
/**
 * Created by Slava Basko <basko.slava@gmail.com>
 * Date: 9/2/16
 */

namespace YandexWebmaster\Action;


use Yandex\Action\ActionInterface;
use Yandex\Action\DataActionInterface;
use Yandex\Auth\Token;

final class AddSiteAction implements ActionInterface, DataActionInterface
{
    /**
     * @var Token
     */
    private $token;

    /**
     * @var string
     */
    private $domainName;

    /**
     * GetListOfSites constructor.
     * @param Token $token
     * @param string $domainName
     */
    public function __construct(Token $token, $domainName)
    {
        if (\Yandex\isValidDomainName($domainName) == false) {
            throw new \InvalidArgumentException('Invalid domain name.');
        }
        $this->token = $token;
        $this->domainName = $domainName;
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
        return 'post';
    }

    /**
     * @return Token
     */
    public function getToken()
    {
        return $this->token;
    }

    public function getBody()
    {
        return '';
    }
}
