<?php
/**
 * Created by Slava Basko <basko.slava@gmail.com>
 * Date: 10/24/16
 */

namespace YandexWebmaster\Value;

class ExternalLink
{
    /**
     * @var string
     */
    private $sourceUrl;

    /**
     * @var string
     */
    private $destinationUrl;

    /**
     * @var \DateTime
     */
    private $discoveryDate;

    /**
     * @var \DateTime
     */
    private $sourceLastAccessDate;

    /**
     * ExternalLink constructor.
     * @param string $sourceUrl
     * @param string $destinationUrl
     * @param string $discoveryDate
     * @param string $sourceLastAccessDate
     */
    public function __construct($sourceUrl, $destinationUrl, $discoveryDate, $sourceLastAccessDate)
    {
        $this->sourceUrl = $sourceUrl;
        $this->destinationUrl = $destinationUrl;
        $this->discoveryDate = \DateTime::createFromFormat(\DateTime::ISO8601, date('c', strtotime($discoveryDate)));
        $this->sourceLastAccessDate = \DateTime::createFromFormat(\DateTime::ISO8601, date('c', strtotime($sourceLastAccessDate)));;
    }

    /**
     * @param array $data
     * @return ExternalLink
     */
    public static function fromArray(array $data)
    {
        return new self(
            isset($data['source_url']) ? $data['source_url'] : '',
            isset($data['destination_url']) ? $data['destination_url'] : '',
            isset($data['discovery_date']) ? $data['discovery_date'] : '',
            isset($data['source_last_access_date']) ? $data['source_last_access_date'] : ''
        );
    }

    /**
     * @return string
     */
    public function getSourceUrl()
    {
        return $this->sourceUrl;
    }

    /**
     * @return string
     */
    public function getDestinationUrl()
    {
        return $this->destinationUrl;
    }

    /**
     * @return \DateTime
     */
    public function getDiscoveryDate()
    {
        return $this->discoveryDate;
    }

    /**
     * @return \DateTime
     */
    public function getSourceLastAccessDate()
    {
        return $this->sourceLastAccessDate;
    }
}