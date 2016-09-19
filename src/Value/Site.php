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
    private $hostId;

    /**
     * @var string
     */
    private $asciiHostUrl;

    /**
     * @var string
     */
    private $unicodeHostUrl;

    /**
     * @var string
     */
    private $verified;

    /**
     * @var null|array
     */
    private $mainMirror;

    /**
     * Site constructor.
     * @param $hostId
     * @param $asciiHostUrl
     * @param $unicodeHostUrl
     * @param $verified
     * @param $mainMirror
     */
    public function __construct(
        $hostId,
        $asciiHostUrl,
        $unicodeHostUrl,
        $verified,
        $mainMirror
    )
    {
        $this->hostId = $hostId;
        $this->asciiHostUrl = $asciiHostUrl;
        $this->unicodeHostUrl = $unicodeHostUrl;
        $this->verified = $verified;
        $this->mainMirror = $mainMirror;
    }

    /**
     * @param array $data
     * @return Site
     */
    public static function fromArray(array $data)
    {
        return new self(
            isset($data['host_id']) ? $data['host_id'] : '',
            isset($data['ascii_host_url']) ? $data['ascii_host_url'] : '',
            isset($data['unicode_host_url']) ? $data['unicode_host_url'] : '',
            isset($data['verified']) ? $data['verified'] : '',
            isset($data['main_mirror']) ? $data['main_mirror'] : []
        );
    }

    /**
     * @return string
     */
    public function getHostId()
    {
        return $this->hostId;
    }

    /**
     * @return string
     */
    public function getAsciiHostUrl()
    {
        return $this->asciiHostUrl;
    }

    /**
     * @return string
     */
    public function getUnicodeHostUrl()
    {
        return $this->unicodeHostUrl;
    }

    /**
     * @return string
     */
    public function getVerified()
    {
        return $this->verified;
    }

    /**
     * @return array|null
     */
    public function getMainMirror()
    {
        return $this->mainMirror;
    }
}