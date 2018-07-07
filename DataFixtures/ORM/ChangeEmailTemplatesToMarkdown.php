<?php

namespace Btc\CoreBundle\DataFixtures\ORM;

use Btc\CoreBundle\Entity\EmailTemplate;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Common\DataFixtures\FixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;

class ChangeEmailTemplatesToMarkdown implements FixtureInterface, OrderedFixtureInterface
{
    private $templates = [
        // template name, new body
        [
            'limit.reached',
            <<<EOD
This is an automated message. Please do not reply to this e-mail!

One of the limits was reached in hot-wallet.

Sincerely,

The Exmarkets Team
EOD
        ],
        [
            'user.new_ip',
            <<<EOD
This is an automated message. Please do not reply to this e-mail!

Your account {{user.username}} has logged in from different IP ({{ipAddress}}) address than previously. If you are accessing your account from a different location, disable this notification in your Profile settings or ignore this message.

Sincerely,

The Exmarkets Team
EOD
        ],
        [
            'promotional.email',
            <<<EOD
This is an automated message. Please do not reply to this e-mail!

Dear user,

You have subscribed to our newsletter, so you are entitled for 50% off trading fees for 3 months.

To register and get 50% off trading fees, please follow this link: {{ registrationLink }}

Sincerely,

The Exmarkets Team
EOD
        ],
        [
            'user.register',
            <<<EOD
This is an automated message. Please do not reply to this e-mail!

Congratulations, you have successfully opened an account. Below are your login credentials:

            Client ID: {{ user.username }}

            Password:  {{ user.plainPassword }}

Sincerely,

The Exmarkets Team
EOD
        ],
        [
            'user.reset_request',
            <<<EOD
This is an automated message. Please do not reply to this e-mail!

Hello {{ user.username }}!

To reset your password - please visit {{ confirmationUrl }}

Sincerely,

The Exmarkets Team
EOD
        ],
        [
            'user.suspended',
            <<<EOD
This is an automated message. Please do not reply to this e-mail!

Dear {{user.username}},

Your account has been suspended for Term violation. For more information please submit a ticket at [support.exmarkets.com](http://support.exmarkets.com)

Sincerely,

The Exmarkets Team
EOD
        ],
        [
            'user.verification.denied',
            <<<EOD
This is an automated message. Please do not reply to this e-mail!

Dear {{user.username}},

Your verification request has been denied:
"{{ reasonDeclined }}"

What should you do now?

1. Check that all of the documents you submitted are entirely visible and are in latin letters
2. Re-submit your verification request
3. Wait for approval
4. In case you got denied again please submit a ticket at our support center at: support.exmarkets.com

Sincerely,

The Exmarkets Team
EOD
        ],
        [
            'user.verification.approved',
            <<<EOD
This is an automated message. Please do not reply to this e-mail!

Dear {{user.username}},

Your verification request has been approved!
You can now start trading by depositing through our various deposit methods and placing an order in our market. For more information please refer to our [“How to start”](https://www.exmarkets.com/how-to-start) guide.

Sincerely,

The Exmarkets Team
EOD
        ],
        [
            'newsletter',
            <<<EOD
**Dear Exmarkets customers,**

We would like to start by saying a big thank you for choosing our services. It has been three weeks since we opened our cryptocurrency exchange platform to the public and already there have been some very important improvements that we would like to present to you.

**Funding related changes**

We are happy to announce that PerfectMoney has been added to our funding options. Current fees stand at 1% for deposit and 2% for withdrawal. We have also started work on integrating a new payment gateway - AstroPay. This marks our first step to becoming the cryptocurrency exchange which offers the most deposit/withdrawal methods.

Additionally we switched to an automated cryptocurrency deposit system. This means that from now on cryptocurrency deposits will be automatically credited to a user’s account after the required amount of confirmations is reached.

**Verification related changes**

Our verification rules have changed. Users will not be forced to complete the verification process unless they want to perform certain actions. These are:

**Exceed these deposit limits:**

    *   OKPay 50 000$/EUR
    *   Payza 50 000$/EUR
    *   PerfectMoney 50 000$/EUR

**Exceed these withdrawal limits:**

    *   OKPay 10 000$/EUR
    *   Payza 10 000$/EUR
    *   PerfectMoney 10 000$/EUR

*Request bank wire deposit / withdrawal (This will be relevant once bank wires are implemented to our system)*

**Site improvements**

We have added a completely new section to our site called “Education”. Within this section we will provide various guides and general information that would be of use to our traders. You can already check out our [Guide to Cryptocurrency Trading](https://www.exmarkets.com/education/guide).

Also, be sure to check out our blog as it is frequently updated with interesting posts!

**End note**

Lastly we would like to say that these are only the first out of many positive changes that await the Exmarkets trading platform. We will continue to work hard in order to improve the end-user experience. Also we are extremely grateful for all the positive feedback. It shows that we are on the right track.

Sincerely,

The Exmarkets Team

 If you'd like to unsubscribe [click here](https://www.exmarkets.com/account/preferences/unsubscribe).
EOD
        ]
    ];

    /**
     * {@inheritDoc}
     */
    public function getOrder()
    {
        return 101; // templates need to be loaded first
    }

    /**
     * {@inheritDoc}
     */
    public function load(ObjectManager $manager)
    {
        foreach ($this->templates as $template) {
            list($name, $body) = $template;

            $email = $manager->getRepository('BtcCoreBundle:EmailTemplate')
                ->findOneBy(['name' => $name]);
            $email->setBody($body);

            $manager->persist($email);
        }
        $manager->flush();
    }
}
