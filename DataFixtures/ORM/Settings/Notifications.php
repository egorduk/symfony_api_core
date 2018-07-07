<?php

namespace Btc\CoreBundle\DataFixtures\ORM\Settings;

use Btc\CoreBundle\Entity\Settings;
use Doctrine\Common\DataFixtures\FixtureInterface;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;

class Notifications implements FixtureInterface, OrderedFixtureInterface
{
    private $settings = [
        // slug                           name                value       description
        ['withdrawal-notification', 'New withdrawal notification', "1", 'New withdrawal notification'],
        ['withdrawal-email-notification', 'Withdrawal email', 'exmarketsnotification@gmail.com', 'New withdrawal notification email'],
        ['deposit-notification', 'New deposit notification', "1", 'New deposit notification'],
        ['deposit-email-notification', 'Deposit email', 'exmarketsnotification@gmail.com', 'New deposit notification email'],
        ['hot-wallet-notification', 'Hot wallet notification', "1", 'Hot wallet notification'],
        ['hot-wallet-email-notification', 'Hot wallet email', 'exmarketsnotification@gmail.com', 'Hot wallet notification email'],
        ['bitfinex-notification', 'Bitfinex notification', "1", 'Bitfinex notification'],
        ['bitfinex-email-notification', 'Bitfinex email', 'exmarketsnotification@gmail.com', 'Bitfinex notification email'],
        ['kraken-notification', 'Kraken notification', "1", 'Kraken notification'],
        ['kraken-email-notification', 'Kraken email', 'exmarketsnotification@gmail.com', 'Kraken notification email'],
        ['verification-notification', 'Verification notification', "1", 'Verification notification'],
        ['verification-email-notification', 'Verification email', 'exmarketsnotification@gmail.com', 'Verification notification email'],
        ['bitfinex-lower-ltc-limit', 'Bitfinex LTC lower limit', "200", 'Change Bitfinex LTC lower limit'],
        ['bitfinex-lower-btc-limit', 'Bitfinex BTC lower limit', "10", 'Change Bitfinex BTC lower limit'],
        ['bitfinex-lower-usd-limit', 'Bitfinex USD lower limit', "1000", 'Change Bitfinex USD lower limit'],
        ['kraken-lower-btc-limit', 'Kraken BTC lower limit', "3", 'Change Kraken BTC lower limit'],
        ['kraken-lower-ltc-limit', 'Kraken LTC lower limit', "25", 'Change Kraken LTC lower limit'],
        ['kraken-lower-eur-limit', 'Kraken EUR lower limit', "1000", 'Change Kraken EUR lower limit']
    ];

    public function getOrder()
    {
        return 100;
    }

    function load(ObjectManager $manager)
    {
        foreach ($this->settings as $data) {
            list($slug, $name, $value, $description) = $data;
            $settings = new Settings;
            $settings
                ->setSlug($slug)
                ->setMarket(null)
                ->setName($name)
                ->setValue($value)
                ->setDescription($description);

            $manager->persist($settings);
        }

        $oldEmail = $manager->getRepository('BtcCoreBundle:Settings')->findOneBySlug('notification-email');
        $manager->remove($oldEmail);

        $manager->flush();
    }
}