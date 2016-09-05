<?php
/**
 * Created by Slava Basko <basko.slava@gmail.com>
 * Date: 9/5/16
 */

namespace YandexWebmaster\Value;

final class Site
{
    /**
     * @var string
     */
    private $selfLink;

    /**
     * @var string
     */
    private $name;

    /**
     * @var Verification
     */
    private $verification;

    /**
     * @var Crawling
     */
    private $crawling;

    /**
     * @var string
     */
    private $virused;

    /**
     * @var string
     */
    private $lastAccess;

    /**
     * @var float|int
     */
    private $tic;

    /**
     * @var int
     */
    private $urlCount;

    /**
     * @var int
     */
    private $indexCount;

    /**
     * Site constructor.
     * @param $selfLink
     * @param $name
     * @param Verification $verification
     * @param Crawling $crawling
     * @param $virused
     * @param $lastAccess
     * @param $tic
     * @param $urlCount
     * @param $indexCount
     */
    public function __construct(
        $selfLink,
        $name,
        Verification $verification,
        Crawling $crawling,
        $virused,
        $lastAccess,
        $tic,
        $urlCount,
        $indexCount
    )
    {
        $this->selfLink = $selfLink;
        $this->name = $name;
        $this->verification = $verification;
        $this->crawling = $crawling;
        $this->virused = $virused;
        $this->lastAccess = $lastAccess;
        $this->tic = $tic;
        $this->urlCount = $urlCount;
        $this->indexCount = $indexCount;
    }

    /**
     * @param array $data
     * @return Site
     */
    public static function fromArray(array $data)
    {
        return new self(
            isset($data['selfLink']) ? $data['selfLink'] : '',
            isset($data['name']) ? $data['name'] : '',
            isset($data['verification']) ? $data['verification'] : '',
            isset($data['crawling']) ? $data['crawling'] : '',
            isset($data['virused']) ? $data['virused'] : '',
            isset($data['lastAccess']) ? $data['lastAccess'] : '',
            isset($data['tic']) ? $data['tic'] : 0,
            isset($data['urlCount']) ? $data['urlCount'] : 0,
            isset($data['indexCount']) ? $data['indexCount'] : 0
        );
    }

    /**
     * @return string
     */
    public function getSelfLink()
    {
        return $this->selfLink;
    }

    /**
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @return Verification
     */
    public function getVerification()
    {
        return $this->verification;
    }

    /**
     * @return Crawling
     */
    public function getCrawling()
    {
        return $this->crawling;
    }

    /**
     * @return string
     */
    public function getVirused()
    {
        return $this->virused;
    }

    /**
     * @return string
     */
    public function getLastAccess()
    {
        return $this->lastAccess;
    }

    /**
     * @return float|int
     */
    public function getTic()
    {
        return $this->tic;
    }

    /**
     * @return int
     */
    public function getUrlCount()
    {
        return $this->urlCount;
    }

    /**
     * @return int
     */
    public function getIndexCount()
    {
        return $this->indexCount;
    }
}