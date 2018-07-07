<?php

namespace Btc\CoreBundle\Model;

use Btc\CoreBundle\Entity\Currency;
use Btc\CoreBundle\Entity\Market;

class MarketInfo
{
    private $market;

    public function __construct(Market $market)
    {
        $this->market = $market;
    }

    public function formatNumber($number, Currency $currency, $precision = -1)
    {
        if (!is_numeric($number)) {
            return 'NA';
        }
        $precision = $precision === -1 ? $currency->getPrecision() : $precision;
        $number = bcadd($number, 0, $precision); // floor is evil, use bcadd to cut down up to decimals
        return $currency->getSign() . number_format($number, $precision, '.', ',');
    }

    public function formatQuote($number)
    {
        return $this->formatNumber($number, $this->market->getWithCurrency(), $this->market->getQuotePrecision());
    }

    public function formatPrice($number)
    {
        return $this->formatNumber($number, $this->market->getWithCurrency(), $this->market->getPricePrecision());
    }

    public function formatBase($number)
    {
        return $this->formatNumber($number, $this->market->getCurrency(), $this->market->getBasePrecision());
    }

    public function currencyBase()
    {
        return $this->market->getCurrency();
    }

    public function currencyQuote()
    {
        return $this->market->getWithCurrency();
    }

    public function currencyPair()
    {
        return str_replace('-', '/', $this->market->getName());
    }

    public function slug()
    {
        return $this->market->getSlug();
    }

    public function marketId() {
        return $this->market->getId();
    }

    public function toJson()
    {
        return json_encode([
            'slug' => $this->market->getSlug(),
            'sign' => [
                'base' => $this->market->getCurrency()->getSign(),
                'quote' => $this->market->getWithCurrency()->getSign(),
            ],
            'precision' => [
                'base' => $this->market->getBasePrecision(),
                'quote' => $this->market->getQuotePrecision(),
                'price' => $this->market->getPricePrecision(),
            ],
        ]);
    }
}
