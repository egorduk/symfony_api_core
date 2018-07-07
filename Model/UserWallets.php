<?php

namespace Btc\CoreBundle\Model;

use Btc\CoreBundle\Entity\User;
use Btc\CoreBundle\Entity\Wallet;
use Btc\CoreBundle\Entity\Currency;
use Btc\CoreBundle\Entity\Market;

class UserWallets
{
    private $wallets;

    public function __construct(User $user)
    {
        $this->wallets = $user->getWallets()->toArray();
    }

    public function oneByCurrency($currencyOrCode)
    {
        $code = $currencyOrCode instanceof Currency ? $currencyOrCode->getCode() : $currencyOrCode;
        foreach ($this->wallets as $wallet) {
            if ($wallet->getCurrency()->getCode() === strtoupper($code)) {
                return $wallet;
            }
        }
        return null;
    }

    public function allCrypto()
    {
        return array_values(array_filter($this->wallets, function(Wallet $wallet) {
            $cur = $wallet->getCurrency();
            return $cur->isCrypto();
        }));
    }

    public function allFiat()
    {
        return array_values(array_filter($this->wallets, function(Wallet $wallet) {
            $cur = $wallet->getCurrency();
            return !$cur->isCrypto();
        }));
    }

    public function splitAndSortForMarket(Market $market)
    {
        $fiat = $this->allFiat();
        usort($fiat, function(Wallet $a, Wallet $b) use ($market) {
            return $market->getWithCurrency()->getCode() === $b->getCurrency()->getCode();
        });
        $crypto = $this->allCrypto();
        usort($crypto, function(Wallet $a, Wallet $b) use ($market) {
            return $market->getCurrency()->getCode() === $b->getCurrency()->getCode();
        });
        return [$fiat, $crypto];
    }
}
