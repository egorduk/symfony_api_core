<?php

namespace Btc\CoreBundle\DataFixtures\ORM\CMSPages;

use Btc\CoreBundle\Entity\Page;
use Doctrine\Common\DataFixtures\FixtureInterface;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;

class LoadPayPalMoneyGramWesternUnionPages implements FixtureInterface, OrderedFixtureInterface
{
    private $pages = [
        // path, title, description, content, language
        [
            '/education/paypal',
            '',
            '',
            '
            <div class="page-header">
              <h1>HOW TO WITHDRAW FROM YOUR ACCOUNT THROUGH PAYPAL</h1>
            </div>
            <a href="https://www.paypal.com/" target="_blank"><img src="{{ asset(\'dist/app/images/paypal-lg-logo.jpg\') }}" alt="PayPal" class="pull-left"></a>
            <p>PayPal is a global leader in online payment solutions. Its services allow their users to pay with credit cards, PayPal Smart Connect and bank accounts without sharing financial information. It is a safe and easy way to pay and get paid online. PayPal is available in 24 different currencies and 190 markets all around the world. It is located in San Jose, California and was founded in 1998. Since then Paypal received  more than 20 awards for excellence from the internet industry.</p>
            <p>For your convenience Exmarkets now offers withdrawals to PayPal. Please note that the minimum withdrawal amount is 500 USD/EUR, and maximum withdrawal amount to PayPal per single transaction is 5000 USD/EUR.</p>
            <h2>Withdrawal to your PayPal account from Exmarkets</h2>
            <p><strong>Step 1.</strong> Go to members area and click on PayPal in the withdraw section.</p>
            <p><img class="img-shadow" alt="Withdraw with PayPal" src="{{ asset(\'dist/app/images/withdraw-with-paypal.jpg\') }}"></p>
            <p><strong>Step 2</strong>. Fill in empty fields with the required information, choose currency and click Withdraw. You should see your request available in Withdraw history and we will send you an e-mail with your payment details once we process your withdraw request.</p>
              ', 'en'
        ],
        [
            '/education/moneygram',
            '',
            '',
            '
            <div class="page-header">
            <h1>HOW TO WITHDRAW FROM YOUR ACCOUNT THROUGH MONEYGRAM</h1>
            </div>
            <a href="http://moneygram.com/" target="_blank"><img src="{{ asset(\'dist/app/images/moneygram-lg-logo.jpg\') }}" alt="MoneyGram logo" class="pull-left"></a>
            <p>MoneyGram provides quick and reliable worldwide fund transfers through a vast network of more than 347,000 agent locations - including retailers, international post offices and banks - in more than 200 countries and territories, and through mobile and online channels. MoneyGram offers convenient services to consumers around the world, with market-leading growth in money transfers and payment services.</p>
            <p>Exmarkets offers withdrawal option via MoneyGram, so that we could provide the best service to our clients. Clients should note that the minimum withdrawal amount is 500 USD/EUR and maximum withdrawal amount to MoneyGram per single transaction is 5000 USD/EUR.</p>
            <p><strong>Step 1</strong>. Go to members area and click on MoneyGram in the withdraw section.</p>
            <p><img class="img-shadow" alt="MoneyGram" src="{{ asset(\'dist/app/images/moneygram.jpg\') }}"></p>
            <p><strong>Step 2</strong>. Fill in empty fields with the required information, choose currency and click Withdraw. You should see your request available in Withdraw history and we will send you an e-mail with your payment details once we process your withdraw request.</p>
              ', 'en'
        ],
        [
        '/education/westernunion',
            '',
            '',
            '
            <div class="page-header">
            <h1>HOW TO WITHDRAW FROM YOUR ACCOUNT THROUGH WESTERN UNION</h1>
            </div>
            <a href="https://www.wu.com/" target="_blank"><img src="{{ asset(\'dist/app/images/wu-lg-logo.jpg\') }}" alt="WesternUnion logo" class="pull-left"></a>
            <p>Western Union is one of the better known American companies. The brand has several divisions, with products such as person-to-person money transfers, money orders, business payments and commercial services. Western Union is also known for its wide spread availbility and its convenience to send and receive money worldwide.</p>
            <p>These are few of the reasons why Exmarkets has Western Union as a payment partner. It is important to stress that we offer USD and EUR withdrawals from Exmarkets and users can take money from a local Western Union branch in USD, EUR or a local currency based on the countries policy.</p>
            <p>Also worth knowing is that minimum withdrawal amount is 500 USD/EUR and maximum withdrawal amount to Western Union per single transaction is 5000 USD/EUR.</p>
            <h2>Withdrawal via Western Union from Exmarkets</h2>
            <p><strong>Step 1</strong>. Go to members area and click on Western Union in the withdraw section.</p>
            <p><img class="img-shadow" alt="MoneyGram" src="{{ asset(\'dist/app/images/western-union.jpg\') }}"></p>
            <p><strong>Step 2</strong>. Fill in empty fields with the required information, choose currency and click Withdraw. You should see your request available in Withdraw history and we will send you an e-mail with your payment details once we process your withdraw request.</p>
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
