<?php

namespace Btc\CoreBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Gedmo\Mapping\Annotation as Gedmo;
use JMS\Serializer\Annotation as Serializer;
use JMS\Serializer\Annotation\Groups;
use JMS\Serializer\Annotation\SerializedName;
use JMS\Serializer\Annotation\Type;
use JMS\Serializer\Annotation\VirtualProperty;

const OHLCV_BASE_TABLE = 'ohlcv';


/**
 * @ORM\Entity
 * @ORM\Table(name="ohlcv")
 */
class OhlcvCandle implements RestEntityInterface
{
    public static $SUPPORTED_INTERVALS = ['1m', '1d', '1h', '1w', '3d', '5m', '6h', '12h', '15m', '30m'];

    /**
     * @ORM\Id
     * @ORM\Column(type="integer", name="interval_id")
     * @ORM\GeneratedValue
     */
    private $intervalId;

    /**
     * @ORM\Column(type="integer", name="market_id")
     * @Type("integer")
     */
    private $marketId;

    /**
     * @Groups({"api", "api_get_export_candles"})
     * @Type("float")
     * @ORM\Column(type="decimal", precision=24, scale=8)
     */
    private $open = 0;

    /**
     * @Groups({"api", "api_get_export_candles"})
     * @Type("float")
     * @ORM\Column(type="decimal", precision=24, scale=8)
     */
    private $high = 0;

    /**
     * @Groups({"api", "api_get_export_candles"})
     * @Type("float")
     * @ORM\Column(type="decimal", precision=24, scale=8)
     */
    private $low = 0;

    /**
     * @Groups({"api", "api_get_export_candles"})
     * @Type("float")
     * @ORM\Column(type="decimal", precision=24, scale=8)
     */
    private $close = 0;

    /**
     * @Groups({"api", "api_get_export_candles"})
     * @Type("float")
     * @ORM\Column(type="decimal", precision=24, scale=8)
     */
    private $volume = 0;

    /**
     * UNIX_TIMESTAMP
     *
     * @Groups({"api_get_export_candles"})
     * @Type("DateTime<'U'>")
     * @SerializedName("timestamp")
     */
    private $intervalName;

    /**
     * @return mixed
     */
    public function getIntervalName()
    {
        return $this->intervalName;
    }

    /**
     * @param mixed $intervalName
     */
    public function setIntervalName($intervalName)
    {
        $this->intervalName = strtolower($intervalName);
    }

    public function getId()
    {
        return $this->intervalId . ':' . $this->marketId;
    }

    /**
     * @return mixed
     */
    public function getIntervalId()
    {
        return $this->intervalId;
    }

    /**
     * @param mixed $intervalId
     */
    public function setIntervalId($intervalId)
    {
        $this->intervalId = $intervalId;
    }

    /**
     * @return mixed
     */
    public function getMarketId()
    {
        return $this->marketId;
    }

    /**
     * @param mixed $marketId
     */
    public function setMarketId($marketId)
    {
        $this->marketId = $marketId;
    }

    /**
     * @return mixed
     */
    public function getOpen()
    {
        return $this->open;
    }

    /**
     * @param mixed $open
     */
    public function setOpen($open)
    {
        $this->open = $open;
    }

    /**
     * @return mixed
     */
    public function getHigh()
    {
        return $this->high;
    }

    /**
     * @param mixed $high
     */
    public function setHigh($high)
    {
        $this->high = $high;
    }

    /**
     * @return mixed
     */
    public function getLow()
    {
        return $this->low;
    }

    /**
     * @param mixed $low
     */
    public function setLow($low)
    {
        $this->low = $low;
    }

    /**
     * @return mixed
     */
    public function getClose()
    {
        return $this->close;
    }

    /**
     * @param mixed $close
     */
    public function setClose($close)
    {
        $this->close = $close;
    }

    /**
     * @return mixed
     */
    public function getVolume()
    {
        return $this->volume;
    }

    /**
     * @param mixed $volume
     */
    public function setVolume($volume)
    {
        $this->volume = $volume;
    }

    public static function getTableNameForInterval($interval)
    {
        if (empty($interval)) {
            return '';
        }

        $interval = strtolower($interval);

        if (!in_array($interval, self::$SUPPORTED_INTERVALS)) {
            return '';
        }

        return OHLCV_BASE_TABLE . ($interval == '1m' ? '' : $interval);
    }

    /**
     * @VirtualProperty
     * @Groups({"api"})
     * @SerializedName("timestamp")
     */
    public function getTimestamp()
    {
        $intervalType = preg_replace('@[\d]@', '', $this->intervalName);
        $intervalVal = preg_replace('@[^\d]@', '', $this->intervalName);
        $intervalVal = intval($intervalVal);
        $intervalId = intval($this->intervalId);

        switch ($intervalType) {
            case 'm':
                return $intervalId * $intervalVal * 60;
            case 'h':
                return $intervalId * $intervalVal * 3600;
            case 'd':
                return $intervalId * $intervalVal * 3600 * 24;
            case 'w':
                return $intervalId * $intervalVal * 7 * 3600 * 24;
            default:
                return -1;
        }
    }
}
