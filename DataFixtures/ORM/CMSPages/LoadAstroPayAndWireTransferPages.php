<?php

namespace Btc\CoreBundle\DataFixtures\ORM\CMSPages;

use Btc\CoreBundle\Entity\Page;
use Doctrine\Common\DataFixtures\FixtureInterface;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;

class LoadAstroPayAndWireTransferPages implements FixtureInterface, OrderedFixtureInterface
{
    private $pages = [
        // path, title, description, content, language
        [
            '/education/astropay',
            '',
            '',
            '
<div class="page-header">
              <h1>How to Deposit to / Withdraw from your Exmarkets account through AstroPay</h1>
            </div>
            <a href="https://www.astropay.com/"><img src="{{ asset(\'dist/app/images/astropay-logo.png\') }}" alt="AstroPay logo" class="pull-left"></a>
            <p>AstroPay, a UK company operating in Latin America, covers all the major markets in the Latin American region (Argentina, Brazil, Chile, Colombia, Mexico, Peru, and Uruguay) , providing payment solutions in markets where most popular solutions are not available, or not functioning properly. It is free and simple to register. Most important, it is safe, simple to use and convenient for all the Latin America customers.</p>
            <p>Already used by the likes of Pokerstars & Expedia, AstroPay is a well-established company that processes millions of dollars in transactions, each month. AstroPay’s instant payment confirmations are perfect for paying for digital services and products which customers want to use right away.</p>
            <p>AstroPay is integrated with the most popular payment methods in every country in which it operates. Customers can use their preferred payment methods (Boleto, Online Bank Payments, Debit Cards, Cash payments) and pay in their local currency. AstroPay is fully compliant with each country\'s banking regulations.</p>
            <hr>
            <h2>How to deposit to your Exmarkets account through AstroPay Direct.</h2>
            <p><strong>Step 1.</strong> Sign up for an account with AstroPay.<br>
              <strong>Step 2.</strong> Check your email for an account confirmation link.<br>
              <strong>Step 3.</strong> Once you confirm your AstroPay Direct account, log in to your Exmarkets account, go to Members’ Area/Deposit/AstroPay.</p>
              <p><img src="{{ asset(\'dist/app/images/deposit-with-astropay.png\') }}" alt="Deposit with AstroPay" class="img-responsive img-shadow"></p>
            <p><strong>Step 4.</strong> Enter the USD amount that you would like to deposit (you will also see the deposit fee when you enter the amount), choose the country of your location and press the DEPOSIT button.<br>
              <strong>Step 5.</strong> Choose a deposit option shown on screen (each country has a different list of options). </p>
              <p><img src="{{ asset(\'dist/app/images/choose-deposit-astropay.png\') }}" alt="Choose deposit" class="img-responsive img-shadow"></p>
            <p><strong>Step 6.</strong> When you choose a payment option you will be redirected to another screen. Please, enter the personal information required, then carefully check the details you entered and press send.<br>
              screen</p>
              <p><img src="{{ asset(\'dist/app/images/astropay-deposit-form.png\') }}" alt="AstroPay deposit form" class="img-responsive img-shadow"></p>
              ', 'en'
        ],
        [
            '/education/bankwire',
            '',
            '',
            '
<div class="page-header">
              <h1>How to Deposit to / Withdraw from your Exmarkets account through Bankwire</h1>
            </div>

            <h2>Bank wire USD and SEPA EUR</h2>
            <p>Exmarkets also offers Bank wire USD and SEPA EUR. It is another convenient way to deposit money into your Exmarkets account. This helps our customers to directly transfer funds without using a money processor. It works as any international bank transfer and takes only 1-3 business days to be credited to your Exmarkets account.</p>
            <hr>
            <h2>How to deposit your Exmarkets account with Bank wire USD and SEPA EUR.</h2>
            <p><strong>Step 1.</strong> You must be a verified Exmarkets customer in order to deposit to your account through bank wire. Once you are verified and you are logged in, go to Members’ area/Deposit/Wire USD & SEPA EUR.<br>
              screen</p>
              <p><img src="{{ asset(\'dist/app/images/deposit-with-wire-transfer.jp\') }}g" alt="Deposit With Wire Transfer" class="img-responsive img-shadow"></p>
            <p><strong>Step 2.</strong> Enter the amount that you would like to deposit (you can see the fees on the right side or under the amount that you entered), choose the currency, check if everything is correct and press deposit. You will be redirected to another screen- Deposit receipt.<br>
              screen</p>
              <p><img src="{{ asset(\'dist/app/images/international-deposit-information.pn\') }}g" alt="International Deposit Information" class="img-responsive img-shadow"></p>
            <p><strong>Step 3.</strong> After you have made a deposit request, go to your internet banking and make a International transfer using your deposit receipt information. </p>
            <hr>
            <h2>How to withdraw using Bank wire USD & SEPA EUR.</h2>
            <p><strong>Step 1.</strong> Log in to your Exmarkets account and go to Members’ area/Withdraw/Wire Transfer. Enter the required information and press withdraw.</p>
            <p><img src="{{ asset(\'dist/app/images/withdraw-with-wire-transfer.jpg\') }}" alt="Withdraw With Wire Transfer" class="img-responsive img-shadow"></p>
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
