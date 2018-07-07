<?php

namespace Btc\CoreBundle\DataFixtures\ORM\CMSPages;

use Btc\CoreBundle\Entity\Page;
use Doctrine\Common\DataFixtures\FixtureInterface;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;

class TradingToolsPages implements FixtureInterface, OrderedFixtureInterface
{
    private $pages = [
        // path, title, description, content, language
        [
            '/trading-tools',
            'Trading tools',
            '',
            '
            <div class="page-header">
              <h1>Trading Tools</h1>
            </div>
            <p> Trading bitcoins professionally consumes a lot of valuable time. That  is why Exmarkets has partnered up with automated trading program providers. These programs place buy and sell orders for you, based on market price movements and rules that you specify. This way you will not miss the best time to trade and minimize the human factor. Below you can find a list of bots that offer to trade automaticly on the Exmarkets platform. </p>
            <hr>
            <div class="exchanger-entry">
              <div class="row">
                <div class="col-sm-2"> <a href="https://www.haasonline.com" target="_blank"> <img src="{{ asset(\'dist/app/images/haasonline.png\') }}" alt="Haasbot"> </a> </div>
                <div class="col-sm-10">
                  <p class="methods pull-right" style="padding-top: 3px;"> <a class="btn btn-xs btn-default" href="https://wiki.haasonline.com/Main_Page" target="_blank">Guide</a> <a href="http://cryptocoinchronicle.com/2014/11/haasbot-bitcoin-bot/" target="_blank" class="btn btn-xs btn-default">Review</a> <a href="https://forum.haasonline.com/" target="_blank" class="btn btn-xs btn-default">Forum</a> </p>
                  <h2><strong>Haasbot</strong> <a href="https://www.haasonline.com" target="_blank" class="btn btn-yellow btn-xs">www.haasonline.com</a></h2>
                  <div class="text short">
                    <p>Haasbot is one of the most versatile bitcoin trading bots that is commercially available. Haasbot allows a user to automate their trades in three different ways, from technical analysis indicator based trade bots and internal arbitrage bots, to order bots. Trade bots allow a user to utilize over 20 technical analysis indicators, which are checked against special conditions called insurances. Arbitrag<span class="ellipsis">...</span></p></div>
                  <div class="text full">
                    <p>Haasbot is one of the most versatile bitcoin trading bots that is commercially available. Haasbot allows a user to automate their trades in three different ways, from technical analysis indicator based trade bots and internal arbitrage bots, to order bots. Trade bots allow a user to utilize over 20 technical analysis indicators, which are checked against special conditions called insurances. Arbitrage bots can be set up to watch for price differences between 3 related currencies and execute trades when the price differences reach a defined profit threshold. Haasbot supports over 500 crytocurrencies.</p>
                    <p>As far as a guide, we have a fully dedicated wiki that describes everything from guides, tutorials, features, etc.</p>
                  </div>
                  <span class="btn btn-default read-more">Read more</span> </div>
              </div>
            </div>
            <hr>
            <div class="exchanger-entry">
              <div class="row">
                <div class="col-sm-2"> <a href="http://rchange.net/" target="_blank"> <img src="{{ asset(\'dist/app/images/1bbot.png\') }}" alt="1BBot"> </a> </div>
                <div class="col-sm-10">
                  <p class="methods pull-right" style="padding-top: 3px;"> <a class="btn btn-xs btn-default" href="http://1bbot.com/docsen/103-learning-to-use-1b-bot-pro.html" target="_blank">Guide</a> <a href="http://translate.google.com/translate?client=tmpg&amp;hl=en&amp;langpair=ru%7Cen&amp;u=http%3A//1bbot.com/forum/" target="_blank" class="btn btn-xs btn-default">Forum</a> </p>
                  <h2><strong>1BBot</strong> <a href="http://1bbot.com" target="_blank" class="btn btn-yellow btn-xs">www.1bbot.com</a></h2>
                  <div class="text short">
                    <p>1BBot Lite and 1BBot Pro\'s purpose is to fully automate the process of buying and selling bitcoins. They take the guess work and uncertainty out of when to trade. What\'s unique about them among the other trading bots is that they allow you to write in-dept trading algorithms from scratch that many bots simply don\'t have the functionality to do, or they charge high monthly fees to use. </p>
          <span class="ellipsis">...</span></div>
                  <div class="text full">
                    <p>1BBot Lite and 1BBot Pro\'s purpose is to fully automate the process of buying and selling bitcoins. They take the guess work and uncertainty out of when to trade. What\'s unique about them among the other trading bots is that they allow you to write in-dept trading algorithms from scratch that many bots simply don\'t have the functionality to do, or they charge high monthly fees to use. </p>
                    <p> 1BBot Lite uses it\'s own simple to understand programming language that anyone can learn within a few hours. This language lets even a novice create advanced buy and sell rules that can be used within seconds. Orders are triggered instantly and if not filled they are killed. </p>
                    <p> 1BBot Pro Zeus takes it a step further and allows users to write trading strategies using the powerful programming language Pascal. These strategies are compiled within the bot and act as their own independent programs. This means you can create and run multiple buy and sell trade strategies at the same time. Orders can use the Lite versions "Fill or Kill" method or you could let orders stay in a pending state. 1BBot Pro Zeus also has feature of internal AND external Arbitration support! This means you can take advantage of a price difference between two or more currencies.</p>
                  </div>
                  <span class="btn btn-default read-more">Read more</span> </div>
              </div>
            </div>
            <hr>
            <div class="well text-center" style="font-size: 16px; margin:0; line-height:24px;">If you want to integrate Exmarkets into your bot please contact us via our support page here: <a href="https://support.exmarkets.com/" target="_blank">support.exmarkets.com</a></div>
              ', 'en'
        ]
    ];

    /**
     * {@inheritDoc}
     */
    public function getOrder()
    {
        return 1; // very high priority
    }

    /**
     * {@inheritDoc}
     */
    public function load(ObjectManager $manager)
    {
        foreach ($this->pages as $page) {
            list($path, $title, $description, $html, $language) = $page;

            // en is default language
            $dummy = new Page();
            $dummy->setPath($path);
            $dummy->setTitle($title);
            $dummy->setDescription($description);
            $dummy->setHtml($html);

            $manager->persist($dummy);
        }
        $manager->flush();
    }
}
