<?php
/**
 * Created by Slava Basko <basko.slava@gmail.com>
 * Date: 9/5/16
 */

namespace YandexWebmaster\Value;

final class Crawling
{
    /**
     * @var string
     */
    private $state;

    /**
     * @var null|string
     */
    private $details;

    /**
     * Crawling constructor.
     * @param $state
     * @param null $details
     */
    public function __construct($state, $details = null)
    {
        if (!is_string($state)) {
            throw new \InvalidArgumentException('Invalid state type.');
        }

        $this->state = $state;
        $this->details = $details;
    }

    /**
     * @return string
     */
    public function getState()
    {
        return $this->state;
    }

    /**
     * @return null|string
     */
    public function getDetails()
    {
        return $this->details;
    }
}