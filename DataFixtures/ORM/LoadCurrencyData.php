<?php

namespace Btc\CoreBundle\DataFixtures\ORM;

use Btc\CoreBundle\Entity\Currency;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Common\DataFixtures\FixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;

class LoadCurrencyData implements FixtureInterface, OrderedFixtureInterface
{
    private $currencies = [
        //code crypto sign precision eth isErcToken $contractAddress $contractAbi
        ['USD', false, '', 2, false, false, '', ''],
        ['BTC', true, '', 8, false, false, '', ''],
        ['EUR', false, '', 2, false, false, '', ''],
        ['LTC', true, '', 8, false, false, '', ''],

        ['ETH', true, '', 8, true, false, '', ''],
        ['BNK', true, '', 2, true, true, '0xd3B4e180e00519293Afe1CfC0E874F450932Fb14', '[{"constant":true,"inputs":[],"name":"name","outputs":[{"name":"","type":"string","value":"SAVATOKEN"}],"payable":false,"type":"function"},{"constant":false,"inputs":[{"name":"_spender","type":"address"},{"name":"_value","type":"uint256"}],"name":"approve","outputs":[{"name":"success","type":"bool"}],"payable":false,"type":"function"},{"constant":true,"inputs":[],"name":"totalSupply","outputs":[{"name":"","type":"uint256","value":"10000"}],"payable":false,"type":"function"},{"constant":false,"inputs":[{"name":"_from","type":"address"},{"name":"_to","type":"address"},{"name":"_value","type":"uint256"}],"name":"transferFrom","outputs":[{"name":"success","type":"bool"}],"payable":false,"type":"function"},{"constant":true,"inputs":[],"name":"decimals","outputs":[{"name":"","type":"uint8","value":"210"}],"payable":false,"type":"function"},{"constant":true,"inputs":[],"name":"version","outputs":[{"name":"","type":"string","value":"H0.1"}],"payable":false,"type":"function"},{"constant":true,"inputs":[{"name":"_owner","type":"address"}],"name":"balanceOf","outputs":[{"name":"balance","type":"uint256","value":"0"}],"payable":false,"type":"function"},{"constant":true,"inputs":[],"name":"symbol","outputs":[{"name":"","type":"string","value":"SAV$"}],"payable":false,"type":"function"},{"constant":false,"inputs":[{"name":"_to","type":"address"},{"name":"_value","type":"uint256"}],"name":"transfer","outputs":[{"name":"success","type":"bool"}],"payable":false,"type":"function"},{"constant":false,"inputs":[{"name":"_spender","type":"address"},{"name":"_value","type":"uint256"},{"name":"_extraData","type":"bytes"}],"name":"approveAndCall","outputs":[{"name":"success","type":"bool"}],"payable":false,"type":"function"},{"constant":true,"inputs":[{"name":"_owner","type":"address"},{"name":"_spender","type":"address"}],"name":"allowance","outputs":[{"name":"remaining","type":"uint256","value":"0"}],"payable":false,"type":"function"},{"inputs":[{"name":"_initialAmount","type":"uint256","index":0,"typeShort":"uint","bits":"256","displayName":"&thinsp;<span class=\"punctuation\">_</span>&thinsp;initial Amount","template":"elements_input_uint","value":"10000"},{"name":"_tokenName","type":"string","index":1,"typeShort":"string","bits":"","displayName":"&thinsp;<span class=\"punctuation\">_</span>&thinsp;token Name","template":"elements_input_string","value":"SAVATOKEN"},{"name":"_decimalUnits","type":"uint8","index":2,"typeShort":"uint","bits":"8","displayName":"&thinsp;<span class=\"punctuation\">_</span>&thinsp;decimal Units","template":"elements_input_uint","value":"1234"},{"name":"_tokenSymbol","type":"string","index":3,"typeShort":"string","bits":"","displayName":"&thinsp;<span class=\"punctuation\">_</span>&thinsp;token Symbol","template":"elements_input_string","value":"SAV$"}],"payable":false,"type":"constructor"},{"anonymous":false,"inputs":[{"indexed":true,"name":"_from","type":"address"},{"indexed":true,"name":"_to","type":"address"},{"indexed":false,"name":"_value","type":"uint256"}],"name":"Transfer","type":"event"},{"anonymous":false,"inputs":[{"indexed":true,"name":"_owner","type":"address"},{"indexed":true,"name":"_spender","type":"address"},{"indexed":false,"name":"_value","type":"uint256"}],"name":"Approval","type":"event"}]'],

    ];

    /**
     * {@inheritDoc}
     */
    public function getOrder()
    {
        return 0; // very high priority
    }

    /**
     * {@inheritDoc}
     */
    public function load(ObjectManager $manager)
    {
        foreach ($this->currencies as $data) {
            list($code, $isCryptoCurrency, $sign, $precision, $eth, $isErcToken, $contractAddress, $contractAbi) = $data;
            if (!$eth) $eth = 0;
            if (!$isErcToken) $isErcToken = 0;

            $currency = new Currency;
            $currency->setCode($code)
                ->setSign($sign)
                ->setPrecision($precision)
                ->setCrypto($isCryptoCurrency)
                ->setEth($eth)
                ->setIsErcToken($isErcToken)
                ->setContractAddress($contractAddress)
                ->setContractAbi($contractAbi);


            $manager->persist($currency);
        }
        $manager->flush();
    }
}
