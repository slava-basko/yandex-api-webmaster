<?php
/**
 * Created by Slava Basko <basko.slava@gmail.com>
 * Date: 9/29/16
 */

namespace YandexWebmaster\Value;

class OriginalText
{
    /**
     * @var string
     */
    private $textId;

    /**
     * @var int
     */
    private $quotaRemainder;

    /**
     * OriginalText constructor.
     * @param $textId
     * @param $quotaRemainder
     */
    public function __construct($textId, $quotaRemainder)
    {
        $this->textId = $textId;
        $this->quotaRemainder = $quotaRemainder;
    }

    /**
     * @param array $data
     * @return OriginalText
     */
    public static function fromArray(array $data)
    {
        return new self(
            isset($data['text_id']) ? $data['text_id'] : '',
            isset($data['quota_remainder']) ? $data['quota_remainder'] : ''
        );
    }

    /**
     * @return string
     */
    public function getTextId()
    {
        return $this->textId;
    }

    /**
     * @return int
     */
    public function getQuotaRemainder()
    {
        return $this->quotaRemainder;
    }
}