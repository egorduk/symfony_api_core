<?php

namespace Btc\CoreBundle\DataFixtures\ORM;

use Btc\CoreBundle\Entity\Page;
use Doctrine\Common\DataFixtures\FixtureInterface;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;

class LoadPagesData implements FixtureInterface, OrderedFixtureInterface
{
    private $pages = [
        // path, title, description, content, language
        [
            '/faq',
            'You have questions – We have answers',
            'You have questions like, what is bitcoin? What is litecoin? How everything here works? And the main question. Is it safe? Exmarkets.com frequently asked questions.',
            '<h2 class="content-title">About</h2>
            <hr>
            <h4><strong>What is Exmarkets?</strong></h4>
            <p>Exmarkets is an online cryptocurrency trading platform. It allows people from all around the world to safely buy and sell bitcoins and litecoins. Not only do we offer our customers a very friendly and user-orientated interface, everything is done with you, the trader, being our center of focus. Our users have the opportunity to fund and withdraw from their accounts using various different methods so that everyone will have a chance to easily and quickly enter/exit the market.</p>
            <hr>
            <h4><strong>What is Bitcoin?</strong></h4>
            <p>Bitcoin (BTC) is a form of completely digital peer-to-peer internet currency that can be transferred easily and securely between any two parties. All you need is internet access. Nobody owns the Bitcoin network, it is a decentralized payment network that is powered by its users. It is independent from any government or traditional banking. Bitcoin creation is based on a process, which is called mining. Users of the Bitcoin network can send and receive bitcoins using wallets, which can be held on a personal computer, mobile device or a web application. User can identify other traders or buyers in a block chain by a Bitcoin address, which can be created at no cost by any user of the Bitcoin protocol. A Bitcoin address begins with the number 1 or 3 and is an identifier that usually contains 34 alphanumeric characters. Bitcoin was introduced by Satoshi Nakamoto in his self- published paper in 2008. The first unit of the Bitcoin currency and the Bitcoin software that launched the network were released in 2009. Another interesting fact is that Bitcoin was programmed in such a way that the number of Bitcoin currency units will never pass 21 million units.</p>
            <hr>
            <h4><strong>What is Litecoin?</strong></h4>
            <p>Litecoin (LTC) is a digital peer-to peer cryptocurrency that is based on the Bitcoin protocol. Litecoin has offered several main differences intended to improve on Bitcoin. Litecoins enable a block to be processed every 2.5 minutes, which in turn provides faster transaction confirmation and also reduces the risk of double spending attacks. Litecoin network is planned to produce 84 million Litecoin currency units compared to the 21 million bitcoins.</p>
            <hr>
            <h4><strong>How does it work?</strong></h4>
            <p>The exchanging of bitcoins (litecoins) works like any regular cryptocurrency trading platform by collecting cash deposits on one side and bitcoin (litecoin) deposits on the other side of the trade. Then we allow our clients to exchange fiat currencies for bitcoins (litecoins) or vice versa. Exmarkets offer trades in BTC, LTC to USD, EUR.</p>
            <hr>
            <h4><strong>Is it safe?</strong></h4>
            <p>When it comes to safety we take it very seriously. Secure Sockets Layered technology is used to protect the privacy and security of each individual account, and cold storage wallets are used to keep most of the funds unavailable to potential hackers. All customer data are stored on dedicated servers that are scanned periodically for suspicious activity, and the integrity of the entire exchange is also monitored by a third party company on a continuous basis. </p>
            <hr>
            <h4><strong>Is Exmarkets a scam?</strong></h4>
            <p>Due to Bitcoin’s decentralized nature there is no regulatory body that would assure traders over an exchange’s trustfulness. All this reassurance lies with the exchange platform itself. That is why to avoid mistrust we are open and clear about the origins of our company. We are based in Lithuania, Europe. Our CEO is Paulius Meskauskas; our CMO is Tomas Andzelis and our CRO is Mantas Gustys. More information about Exmarkets can be found <a href="{{ path(\'btc_page_aboutus\') }}">here</a>. We believe that showing who we are and who we work with brings confidence for our clients that Exmarkets is not a \'scam\'.</p>',
            'en'
        ],
        [
            '/faq/fees',
            'Bitcoin trading fees | Trading cost',
            'How much does bitcoin trading cost? What are the fees for bitcoin trading? It’s a very simple 3-steps fee structure where accounts will be indexed accordingly to their 30-day trading amounts.',
            '<h2 class="content-title">Fees</h2>
    <hr>
    <h4><strong>How much does trading cost?</strong></h4>
    <p>We are introducing a very simple 3-steps fee structure where accounts will be indexed accordingly to their 30-day trading amounts:</p>
    <table class="table table-bordered">
        <tr>
            <td><strong>Starter</strong></td>
            <td>0.3%</td>
            <td>$0 - $50,000</td>
        </tr>
        <tr>
            <td><strong>Trader</strong></td>
            <td>0.25%</td>
            <td>$50,000 - $300,000</td>
        </tr>
        <tr>
            <td><strong>Enterprise</strong></td>
            <td>0.2%</td>
            <td>$300,000+</td>
        </tr>
    </table>
    <hr>
    <h4><strong>How can I get more help?</strong> <small>If my question is not covered here.</small></h4>
    <p>Please contact our customer support service on the main page or <a href="http://support.exmarkets.com" target="_blank">submit a ticket</a> by choosing a department regarding your question, then press next to proceed and fill up the form. Our support team member, will respond to your ticket as soon as possible.</p>
        ',
            'en'
        ],
        [
            '/faq/profile',
            'How to verify account for Bitcoin trading',
            'How do you verify your account with Exmarkets.com and how to change your details. And a lot of other questions regarding Exmarkets.com account policy.',
            '<h2 class="content-title">Profile</h2>
    <hr>
    <h4><strong>How can I verify my account?</strong></h4>
    <p>Account -> Verification -> Verification form</p>
    <p>To verify your account, please submit</p>
    <p>1) a valid government issued ID, acceptable high quality images of documents are:</p>
    <ul>
        <li>international passport (double page)</li>
        <li>national ID card (both sides)</li>
        <li>driver\'s license (both sides)</li>
    </ul>
    <p>2) a proof of residency, acceptable scanned images of paper documents are:</p>
    <ul>
        <li>bank statement</li>
        <li>utility bill for utilities consumed at your home address</li>
        <li>tax return, council tax</li>
        <li>certificate of residency issued by a government or a local government authority</li>
    </ul>
    <p>You can also submit other documents to serve as proof of residency such as; government-issued documents, judicial authority-issued documents, documents issued by a public agency / authority, utility service company, or similar regulated service providing companies.</p>
    <hr>
    <h4><strong>How can I change my details?</strong></h4>
    <p>User can change the details by itself. To change your details, you need to go to “Account” and proceed pressing on “Profile”. Now you can change your details in the fields you wish. Fill out the form and press “Save settings”. </p>
        ',
            'en'
        ],
        [
            '/faq/get-started',
            'Start trading cryptocurrency',
            'Start trading cryptocurrency with Exmarkets.com. Just create an account and start trading bitcoins, litecoins to Euros, Dollars.',
            '<h2 class="content-title">Get started</h2>
    <hr>
    <h4><strong>How can I create an account?</strong></h4>
    <p>Simply press “<a href="{{ url(\'btc_user_registration_register\') }}">Register</a>” while on our home screen. Enter your first name, your last name, your e-mail and specify the country you currently live in. You will receive a confirmation email with your log-in details. It is easy, fast and free.</p>
    <hr>
    <h4><strong>How can I start trading?</strong></h4>
    <p>After your account is created you will need to fund it using one of the deposit options. Click “Deposit”
        on the main account menu and continue the process by selecting one of our various different funding
        methods. After your account has been funded you will be ready to begin purchasing and selling
        bitcoins. Place your offer to buy (or sell) bitcoins in the “Buy/Sell” section. As soon as your order is
        matched against another, the order is executed.</p>',
            'en'
        ],
        [
            '/faq/trading',
            'Questions regarding Bitcoins and Litecons trading',
            'How does instant order works? How does limit order work? How can I cancel an open limited order and other questions regarding Bitcoin and Litecoin trading.',
            '<h2 class="content-title">Trading</h2>
    <hr>
    <h4><strong>How does instant order work?</strong></h4>
    <p>When you place a “Buy/Sell” order using the instant order function the system will match your order against orders that are closest to the market price. The system will stop when your order is fully fulfilled.</p>
    <hr>
    <h4><strong>How does limit order work?</strong></h4>
    <p>When you want to buy or sell your BTC/LTC, but you do not want to do that at the current price, you can choose the limit order option and set a “Buy/Sell” order at certain wanted price.</p>
    <hr>
    <h4><strong>How can I cancel an open limited order?</strong></h4>
    <p>To cancel an open limited order go to “My orders” - there you will see a list of your open buy/sell orders. Each order on the list has a “Cancel” button. Simply press the button for your order to be canceled.</p>
        ',
            'en'
        ],
        [
            '/about-us',
            '',
            '',
            '    <div class="page-header">
            <h1>About us</h1>
        </div>
        
        <p>The <strong>Exmarkets project</strong> was inspired by the changes and new revolutionary technologies in the financial sector that sprung in to life in the past few years. Of course we are talking about cryptocurrencies. Seeing how this wonderful new idea of digital money could reshape the world we live in, our team decided that we want to do more than just watch the revolution happen. We decided that we want to be a part of it! That is why we have devoted ourselves to this project working days, nights and even weekends to bring you the Virtual Exchange platform you have been waiting for. </p>
        <br>',
            'en'
        ],
        [
            '/how-to-start',
            'How to trade bitcoins and Litecoins',
            'How to trade bitcoins and litecoins. Short guide which will help you to start trading bitcoins and litecoins. Start trading now!',
            '<div class="page-header">
            <h1>How to start trading</h1>
        </div>
        <div class="hts-cont">
            <p><strong>In order to start trading you have to go over these 3 simple steps:</strong></p>
            <hr>
            <div class="row">
                <div class="col-md-7"><br>

                    <p class="lead"><strong>1.</strong> Register an account at www.exmarkets.com → "Register account for free".
                        You will have to enter your first name, last name, e-mail address and specify the country you
                        currently live in.</p></div>
                
            </div>
            <hr>
            <div class="row">
                <div class="col-md-7"><p class="lead"><strong>2.</strong> After receiving an e-mail with your login information you will need to log in and change your password
                        before you can do anything else. Once your password is changed you can fund your account using our
                        various funding methods.</p></div>
            </div>

            <div class="alert alert-warning aler-sm">NOTE: Before uploading any scanned documents please make sure they are
                high quality, entirely visible and in Latin letters.
            </div>
            <hr>
            <div class="row">
                <div class="col-md-7"><br>
                    <p class="lead"><strong>3.</strong> And once funded you can start trading by placing instant or limited
                        market orders.</p></div>
            </div>
            <hr>
            <div class="alert alert-warning aler-sm"><p><strong>!Important notice:</strong></p>
                <p>Users will have to complete the verification process if they want to perform certain actions. <br/>
                   These are:
                </p>
                <ul>
                    <li>Exceed these deposit limits:</li>
                    <br/>
                    <div class="row">
                        <div class="col-md-6">
                            <table class="table">
                                <tr>
                                    <td>OKPay</td>
                                    <td>50 000$/EUR</td>
                                </tr>
                                <tr>
                                    <td>Payza</td>
                                    <td>50 000$/EUR</td>
                                </tr>
                                <tr>
                                    <td>PerfectMoney</td>
                                    <td>50 000$/EUR</td>
                                </tr>
                            </table>
                        </div>
                    </div>
                    <li>Exceed these withdrawal limits:</li>
                    <br/>
                    <div class="row">
                        <div class="col-md-6">
                            <table class="table">
                                <tr>
                                    <td>OKPay</td>
                                    <td>10 000$/EUR</td>
                                </tr>
                                <tr>
                                    <td>Payza</td>
                                    <td>10 000$/EUR</td>
                                </tr>
                                <tr>
                                    <td>PerfectMoney</td>
                                    <td>10 000$/EUR</td>
                                </tr>
                            </table>
                        </div>
                    </div>
                    <li>Request bank wire deposit / withdrawal (This will be relevant once bank wires are implemented to
                     our system)</li>
                </ul>
            </div>
            <hr/>
            <p>There might be some questions that arise if you are new to cryptocurrency trading.<br>If so we strongly
                advise you to read our <a href="faq">F.A.Q. section</a>.</p>

            <p>And if you still haven\'t found your answer please do not hesitate to ask us directly at our <a
                        href="http://support.exmarkets.com">support centre</a>.</p>
        </div>',
            'en'
        ],
        [
            '/privacy',
            'Privacy Policy | Keep you e-currency safe',
            'Do you want you e-currency transactions to be safe? We gather and protect all essential data. Read our Privacy policy, be calm, your e-currency is safe with exmarkets.com',
            '<div class="page-header">
                    <h1>Privacy Policy</h1>
                </div>
                <h4>GENERAL:</h4>
                <p> We  have been running a successful online investment business by establishing a  formidable TRUST between our customers as well as to ourselves. We strive to do  our best to protect all your Personal Information in every way possible. <br>
                    When  we collect your Personal Information, we maintain the following privacy policy:</p>
                <ul>
                    <li>We collect your personal information only if we think it\'s relevant or necessary  to conduct our business.</li>
                    <li>We will NOT reveal your personal information (user name, e-mail address, and password)  to any third-party unless you have authorized us, we are required by law, or we  have informed you previously.</li>
                    <li>Sometimes,  we may be asked to reveal your personal information from judicial, Governmental  bodies, agencies or our supervisory board. However we will only do this under  proper authority. </li>
                    <li>We strive to keep your personal records up to date and accurate.</li>
                    <li>We keep a strict security system that will prevent unauthorized people to access  your personal information, including our staff</li>
                    <li>All third parties and Exmarkets staff who have authorized access to your personal  information are required to study and comply with our confidentiality  obligations so that they do NOT abuse it.<strong></strong></li>
                </ul>
                <hr><h4>DATA GATHERING:</h4>
                <p> Exmarkets reserves the right to collect  your personal information when you use our site, open an account with us, or  conduct financial transaction(s) on our site.</p>
                <p>We may collect the following types of  personal information. </p>
                <ul>
                    <li>Your name</li>
                    <li>Your ID that includes a photo (may be a digital copy) which could be government issued ID,  passport, national ID card, and/or EU driving license.</li>
                    <li>Your  email-address</li>
                    <li>Your mailing address</li>
                    <li>Your date of birth</li>
                    <li>Your banking details</li>
                    <li>Your trades</li>
                    <li>Your bank statement and/or utility bill that confirms your residential address.<strong></strong></li>
                </ul>
                <hr><h4>DATA USE:</h4>
                <p>Exmarkets may use Personal Information for  the following purposes:</p>
                <ul>
                    <li>To personalize  your experience on our website (your information allows us to understand your  individual needs, and therefore, better respond to it);</li>
                    <li>To enhance our  website performance (we continuously modify and update our website with new  features based on the feedback and information we receive from you.);</li>
                    <li>To analyze  usage of our website – number of visitors/months, pages viewed per visit, etc;</li>
                    <li>To improve  customer service (your personal information allows us to quickly respond to  your unique service needs and requirements);</li>
                    <li>To process  transactions. Your personal information, public or private, will NOT be sold or  exchanged by Exmarkets to any third-party company for any reasons whatsoever,  without your approval. We will only use your information to deliver the product  or services you&rsquo;ve purchased or requested;</li>
                    <li>To send e-mail  notifications. The e-mail address you provide us during account creation will  be used to keep you updated with your order or service requests. In addition,  we may also send company news, promotions, updates, and other relevant offers  and service information that may interest you;</li>
                    <li>To run and  direct a promotion, contest, survey, or any other site feature.</li>
                </ul>
                <p>Note that we will ONLY process your  personal information for the purpose for which it has been provided to us.</p>
                <p>ATTENTION: By using Exmarkets.com and  viewing any of its pages, you agree to comply with our terms of use. </p>
                <hr><h4>DISCLOSURE OF  PERSONAL INFORMATION</h4>
                <p> Exmarkets  will use your Personal Information for the purpose mentioned at the time when  you provide us with such information, and/or for the intentions mentioned in  this Privacy Policy, and/or as permitted by law.</p>
                <p> You  understand and accept that by using any of our Services, and accepting our Terms  of Use, you will provide us your Personal Information whenever necessary.</p>
                <p> You  give us permission to disclose your Personal Information whenever we are  required by law / to third parties for electronic identification purposes (as  mentioned above).</p>
                <p> Non-personal  information may be given to third-parties for the purpose of marketing,  advertising, and/or other uses.</p>
                <p> If  any third-party receives or has access to your Personal Information, they&rsquo;ll be  required by us to protect your Personal Information. They are required to use  it ONLY for the purpose of carrying out the services they are performing for  you, or for Exmarkets, or otherwise required or permitted by law.</p>
                <p> Exmarkets  will make sure that any such third party knows and understands our obligations  mentioned in this Privacy Policy. By working with us they are bound by our  &lsquo;terms of use&rsquo; which is equally protective of any Personal Information that  will be disclosed to them as the obligations we carry out to you under this  Privacy Policy or which are strictly enforced on us under applicable data  protection laws.<strong></strong></p>
                <hr><h4>USE OF COOKIES</h4>
                <p> We  will record your visit to our website for analytical purposes, to understand  the flow of traffic to our website as well as get an overview of our site  usage. </p>
                <p> Some  information will be collected through the use of &ldquo;cookies.&rdquo;</p>
                <p> What  are cookies? Cookies contain a small amount of information that is  automatically placed on your computer. Our website may access these &lsquo;cookies&rsquo;  whenever you use our website. Cookies include information such as your personal  preferences on certain sites, thus allowing website owners to enhance user  experience. The information collected by &ldquo;cookies&rdquo; are used for research  purposes, and in no way contains your name, e-mail address, or any Personal  Information that would allow others to contact you via e-mail, telephone, or  any other means.</p>
                <p> Initially,  most major browsers are installed to accept &lsquo;cookies.&rsquo; If you want, you may  change the settings of your browsers to disable cookies. However, by disabling  cookies, you may NOT be able to use our website to its maximum potential.</p>
                    ',
            'en'
        ],
        [
            '/terms-and-conditions',
            'Terms and Conditions',
            'Everything about accounts, account types, account security, transactions, limitations and restrictions, why are we terminating your account and what personal information do we collect from you.',
            '<div class="page-header">
        <h1>Terms and conditions</h1>
    </div>
    <p><strong>Exmarkets  Systems Ltd</strong> is an online cryptocurrency trading platform, registered in  Seychelles, and therefore, is required to follow the legal requirements of  Seychelles, including, but not limited to, restricting certain businesses and people from using services offered by the company.<br>
        If you will be using one of our services offered  through our online website, www.Exmarkets.com, before opening a FREE account, you  will have to comply with the following terms of services.</p>
    <p> Please note that Exmarkets reserves the full right to  modify any of the &lsquo;terms and conditions,&rsquo; at any time and without prior notice. <br>
        All changes will be updated on this page and it is  your responsibility to periodically review this page. </p>
    <p> If you decide to continue using Exmarkets\'s services  after reading these terms of services, that means you fully understand and  accept it.<strong></strong></p>
    <hr>
    <h3>1. Accounts</h3>
    <p> <strong>You must be at least 18 years of age at the time of  opening an account with Exmarkets. We reserve the right to ask for personal  documentation to verify your identity.</strong></p>
    <p> 1. Here is the list of restricted countries that are  NOT allowed to use Exmarkets\'s services.</p>
    <div class="row">
        <div class="col-sm-4">
            <ul>
                <li>Afghanistan</li>
                <li>Burma</li>
                <li>Cuba</li>
                <li>Ecuador</li>
                <li>Iran</li>
                <li>Kenya</li>
            </ul>
        </div>
        <div class="col-sm-4">
            <ul>
                <li>Libya</li>
                <li>Myanmar</li>
                <li>North Korea</li>
                <li>Sao Tome and Principe</li>
                <li>Sudan</li>
                <li>Syria</li>
            </ul>
        </div>
        <div class="col-sm-4">
            <ul>
                <li>Tanzania</li>
                <li>United States of America</li>
                <li>Vietnam</li>
                <li>Yemen</li>
            </ul>
        </div>
    </div>
    <p>2. Anyone using services provided by Exmarkets are NOT  allowed to use it in a way which violates their residential countries laws and  regulations. Violating this term will lead to account termination, and the account holder is responsible for any losses that may occur.<br>
        3. Account holders must obey and follow all the identity theft guidelines set by Exmarkets Systems Ltd at all times.<strong></strong></p>
    <hr>
    <h3>2. Personal Information</h3>
    <p><strong> According to the current laws of Seychelles, Exmarkets  has the right to collect personal information of its account holders.</strong> </p>
    <p> 1. During verification, all account holders are  required to provide valid and accurate personal details. By failing to comply  with this clause the account holder risks anything from, but not limited to,  facing delays in payment processing, to having their account suspended or  terminated. </p>
    <p> Exmarkets has the full right to ask and verify personal  information such as ID documents and proof of address. Failure in complying  with this clause may not only lead to misuse of your account, but it could also  lead to immediate suspension of your account to prevent fraudulent activity.</p>
    <p> 2. You may be asked to provide the following personal  information/documents for personal identification verification:<br>
        2.1. Full Name<br>
        2.2. Date of birth<br>
        2.3. Representing a company<br>
        2.4. Contact Email Address<br>
        2.5. Contact Phone<br>
        2.6. Legal Residence</p>
    <ul>
        <li>Street Name</li>
        <li>Street Number</li>
        <li>Address Extra (Apartment, District  and any country specific)</li>
        <li>City</li>
        <li>Postal Code</li>
        <li>State (Province, Region)</li>
        <li>Country</li>
    </ul>
    <p>2.7. Legal Compliance<br>
        Valid government issued ID (Passport; national ID; driver’s license)</p>
    <ul>
        <li>ID Serial</li>
        <li>ID Expiry Date</li>
        <li>Third Party Beneficiary</li>
    </ul>
    <p>2.8. Company Information (if representing a company)</p>
    <ul>
        <li>Business Name</li>
        <li>Legal Business Name (name found on  the public records)</li>
        <li>Business Description</li>
        <li>Business Registration (Incorporation) Number</li>
        <li>Consumer owns 25% or more</li>
        <li>Total number of business owners who  own 25% or more</li>
        <li>Business Primary Phone</li>
    </ul>
    <p>2.9. Legal Company Address (if representing a  company)</p>
    <ul>
        <li>Street Name</li>
        <li>Street Number</li>
        <li>Address Extra</li>
        <li>City</li>
        <li>Postal Code</li>
        <li>State</li>
        <li>Country</li>
    </ul>
    <p>3. You  can always change your personal information under the &lsquo;Profile&rsquo; tab inside  member&rsquo;s area (you need to log in). <br>
        If you are NOT able to change your personal  information after logging in your account, you must contact one of our customer  service staff with your updated information. </p>
    <p> 4. In order to receive regular updates and  communication from Exmarkets, account holders must be sure that their account  details are updated regularly.</p>
    <p> Exmarkets will not be responsible for possible losses  that may arise when account holders do NOT comply with this clause.</p>
    <p> Please be aware that Exmarkets has the full right to send  its members (account holders) regular e-mails regarding our new offers,  features, special events, and promotions. </p>
    <p> 5. For legal reasons, Exmarkets will keep its account  holder&rsquo;s personal information for a period of 3 years, after they&rsquo;ve closed  their account with us. </p>
    <hr>
    <h3>3. Account Security</h3>
    <p> Exmarkets offers a secure environment for its account  holders to protect their sensitive information using a complex 256 bit SSL  encryption supported by GeoTrust.</p>
    <p> 1. Account holders are responsible to make sure that  their login information (username, e-mail address, and password) is kept safe  and NEVER shared with others.</p>
    <p> 2. Account holders must make sure to secure their  account login password by changing it frequently. </p>
    <p> 3. Account holders MUST create a password that has at  least an UPPERCASE letter and a number. Plus, there must be at least 8  characters in their password. Passwords are mandatory to gain access to your  account.<strong> </strong></p>
    <hr>
    <h3>4.Transactions</h3>
    <p>Account holders can keep track of their online  transactions by logging to their account. If they notice any irregularities  within these transactions, account holders are asked to contact Exmarkets customer  service department immediately. </p>
    <p> 1. All transactions conducted on Exmarkets are final,  meaning it cannot be reversed back later. </p>
    <p> 2. If Exmarkets suspects suspicious and fraudulent funds,  we reserve a full right to put such transactions on hold until we&rsquo;ve  investigated the issue and resolved it.</p>
    <p> 3. Funding, transactions, and withdrawals are  dependent to charges and fees of a 3rd party fee structure.<strong></strong></p>
    <hr>
    <h3>5. Account  Limitations &amp; Restrictions</h3>
    <p> These limitations and restrictions will allow Exmarkets  to offer a safe and secure environment for account holders.<br>
        1. Account holders who are suspected of participating  in fraudulent activity or turn out to be fraudulent, will have their accounts  SUSPENDED until the investigation period is over.</p>
    <p> 2. During investigation, if Exmarkets finds out that the  SUSPENDED account is fraudulent and the user is violating Exmarkets terms and  conditions, we will NOT lift the account suspension imposed on that account.</p>
    <p> 3. Exmarkets will not be responsible for those account  holders whose country or jurisdiction does not approve of the type of services  we offer. </p>
    <p> 4. Furthermore, account holders must NOT swear, abuse,  or threaten Exmarkets staff, either through e-mail, support center, or live chat.  If Exmarkets finds account holders abusing our employers, we reserve the right to  immediately terminate their account.<strong></strong></p>
    <hr>
    <h3>6. Account  Termination</h3>
    <p> 1. To close an account, account holders must submit a  ticket to our customer support staffs.</p>
    <p> 2. Account holders who &lsquo;close&rsquo; their account may  re-open their account by submitting a ticket.</p>
    <p> 3. Exmarkets reserves the right to terminate account  holders account who violates our terms and conditions, without prior notice. </p>
    <p> 4. There are several reasons why an account may be  terminated, including fraudulent activity, violating of terms or service,  violating law and regulations.</p>
    <p> 5. Furthermore, if Exmarkets suspects any of its accounts  using any software/program to hide their actual location, or in case of  Copyright infringements, we reserve the right to immediately terminate such accounts.</p>
    <p> 6. Exmarkets will NOT terminate inactive accounts,  though.<strong></strong></p>
    <hr>
    <h3>7.Copyright</h3>
    <p>1. Account holders may use Exmarkets trademarks (text,  images, and other files) ONLY after a written permission from our  administration.</p>
    <p> 2. Account holders are NOT allowed to modify Exmarkets  trademarks.</p>
    <p> 3. If account holders fail to comply with Vertex  copyright terms, we will immediately terminate such accounts.<strong></strong></p>
    <hr/>
    <h3>8.Exmarkets  Responsibilities</h3>
    <p> 1. Exmarkets will make sure that a safe and secure online  investment platform is provided to its account holders so that they can start  investing at ease. </p>
    <p> 2. All transactions are conducted in USD  or EUR. </p>
    <p> 3. Exmarkets strives to back all electronic  amounts with USD or a EUR reserve.<strong> </strong></p>
    <hr/>
    <h3>9. Fees</h3>
    <p> As an account holder at Exmarkets, you agree to pay the  trade fee calculated through our Services (&ldquo;Fees&rdquo;), which is available through  the Fees and Pair Info under &lsquo;Fee Schedule,&rsquo; that may change frequently.</p>
    <div class="col-sm-6">
            {{ render(controller(\'BtcAccountBundle:Default:paymentFees\', {
                \'type\': \'Deposit\'
            })) }}
    </div>
    <div class="col-sm-6">
            {{ render(controller(\'BtcAccountBundle:Default:paymentFees\', {
                \'type\': \'Withdrawal\'
            })) }}
    </div>',
            'en'
        ],
        [
            '/anti-money-laundering',
            'We are against money laundering',
            'We are against money laundering. If you are trying to use exmarkets.com services as means of legalizing money, bitcoins, litecoins, all of virtual currency that is acquired though criminal activities. Be aware, and keep off.',
            '<div class="page-header">
        <h1>Anti-Money Laundering at Exmarkets</h1>
    </div>

    <p>Money  laundering, in law terms, basically means legalizing money that is acquired  through criminal activities – i.e. actions that are devised to hide the source  of funds just to make it appear lawful.</p>
    <p> Anti-money  laundering (AML), on the other hand, includes a set of complex prevention  measures that is aimed to stop a financial system of a particular country or  any financial institution from money laundering or terrorist financing  activities.</p>
    <p> Such prevention  measures are devised and implemented by all institutions, including national  and international institutions, lending institutions such as banks, and  business communities.</p>
    <p> Exmarkets Systems  Ltd (or &ldquo;Exmarkets&rdquo; or the &ldquo;Company&rdquo;) collects Personal Identification data of  every account holder, including their IP address, their online activity,  communication, and any transaction they may carry out using our online portal.</p>
    <p> Exmarkets keeps  track of unusual and suspicious online activities and transactions conducted by  our clients using auto-monitoring as well as auto-controlling prevention  mechanisms.
        These mechanisms will keep track of, but not limited to,  transactions that does not make economic sense, large transactions that is  unexplainable, and/or transactions that involve unknown parties, investment  transactions that are of unclear nature.</p>
    <p> Exmarkets is  authorized to ask for supporting documents from its account holders to explain  these suspicious and unusual transactions.</p>
    <p>To ensure that  our account holders feel at ease investing in one of our services, Exmarkets  continuously updates its AML procedures so that we&rsquo;re prepared to combat any  unlawful financial activities that may arise from time to time.</p>
    <p> Exmarkets also  reserves the right to limit, or refuse to process any transaction at any stage,  especially when we believe that a specific transaction is associated with money  laundering or any other criminal activity.</p>
    <p> Exmarkets fully  obeys with the legal implications of the country Seychelles for anti-money  laundering. Sometimes as required by certain legal enactments, Exmarkets may  contact and work along with government officials and institutions of the  Seychelles and/or other countries too.</p>
        ',
            'en'
        ],
        [
            '/exchangers',
            'Need to exchange cryptocurrency? Exchange e-currency',
            'Exchange cryptocurrency if you are using payment processors that Exmarkets does not accept. Exchange you e-currency through one of the following exchangers.',
            '<div class="page-header">
        <h1>Exchange e-currency</h1>
    </div>
    <p>
        If you are using payment processors that Exmarkets does not accept deposits from you can always exchange your money through one of the following exchangers:
    </p>
    <hr/>
    <div class="exchanger-entry">
        <div class="row">
            <div class="col-sm-2"> <a href="https://www.paymentbase.com/" target="_blank"> <img src="{{ asset(\'dist/app/images/paymentbase.png\') }}" alt="PaymentBase"> </a> </div>
            <div class="col-sm-10">
                <h3>Payment base <a href="https://www.paymentbase.com/" target="_blank" class="btn btn-yellow btn-xs">www.paymentbase.com</a></h3>
                <p class="methods"><span class="label label-default">Payza</span> <span class="label label-default">Perfect Money</span> <span class="label label-default">Paxum</span> <span class="label label-default">C-gold</span> <span class="label label-default">OkPay</span> <span class="label label-default">BTC-E</span> <span class="label label-default">SolidTrustPay</span> </p>
                <p>This is a well known, trusted e-currency exchange service provider. It is very easy to use. The exchange takes up to 1-2 days to proceed the transactions.</p>
            </div>
        </div>
    </div>
    <hr>
    <div class="exchanger-entry">
        <div class="row">
            <div class="col-sm-2"> <a href="https://www.dagensia.eu/" target="_blank"> <img src="{{ asset(\'dist/app/images/dagensia.png\') }}" alt="Dagensia"> </a> </div>
            <div class="col-sm-10">
                <h3>Dagensia <a href="https://www.dagensia.eu/" target="_blank" class="btn btn-yellow btn-xs">www.dagensia.eu</a></h3>
                <p class="methods"><span class="label label-default">VISA</span> <span class="label label-default">Bank Wire</span> <span class="label label-default">SEPA</span> <span class="label label-default">C-gold</span><span class="label label-default">Payza</span> </p>
                <p>It is a specialized and licensed Bitcoin exchanger. Dagensia.eu website and its services are provided by Dagensia Finance s.r.o., the company is authorized by the Czech National Bank as a small Payment Institution under the Payment Services Regulation.</p>
            </div>
        </div>
    </div>
    <hr>
    <div class="exchanger-entry">
        <div class="row">
            <div class="col-sm-2"> <a href="http://rchange.net/" target="_blank"> <img src="{{ asset(\'dist/app/images/rchange.png\') }}" alt="Rchange"> </a> </div>
            <div class="col-sm-10">
                <h3>Rchange <a href="http://rchange.net/?ref=363310" target="_blank" class="btn btn-yellow btn-xs">www.rchange.net</a></h3>
                <p class="methods"> <span class="label label-default">Local transfer (Hong Kong, Macau and Taiwan)</span> <span class="label label-default">Bank Wire</span> <span class="label label-default">Western Union</span> <span class="label label-default">Money Gram</span> <span class="label label-default">China UnionPay</span> <span class="label label-default">Perfect Money</span> <span class="label label-default">SolidTrustPay</span> <span class="label label-default">OkPay</span> <span class="label label-default">WebMoney</span></p>
                <p>Rchange is an exchanger that offers a fast and secure service, and its very easy to use. It has various payment processors that you could choose from.</p>
            </div>
        </div>
    </div>
    <hr>
    <div class="exchanger-entry">
        <div class="row">
            <div class="col-sm-2"> <a href="https://www.xchanger.org/" target="_blank"> <img src="{{ asset(\'dist/app/images/xchanger.png\') }}" alt="XChanger.org"> </a> </div>
            <div class="col-sm-10">
                <h3>XChanger.org <a href="https://www.xchanger.org" target="_blank" class="btn btn-yellow btn-xs">www.xchanger.org</a></h3>
                <p class="methods"><span class="label label-default">SolidTrustPay</span> <span class="label label-default">Perfect Money</span> <span class="label label-default">OkPay</span> <span class="label label-default">PexPay</span></p>
                <p>Xchanger.net is e-currency exchange. To exchange your currency, select the e-currency you want to exchange from and to. You will be able to see the fees and reserve that Xchanger has in that currency. Usually exchange in this site takes less than 24 hours.</p>
            </div>
        </div>
    </div>',
            'en'
        ],
        [
            '/education/guide',
            'Guide to cryptocurrency trading',
            'Important information about cryptocurrency trading',
            '<div class="page-header">
    <h1>Guide to Cryptocurrency Trading</h1>
</div>
<p>In recent years, a new, alternative category of currency trading has emerged and caught the
    attention of the general public mostly due to its innovative and unique characteristics compared
    to the more established form of foreign currency (forex) trading. For those of you who have been
    living under a rock for the past couple of years, what we are talking about is cryptocurrency
    trading, also known as digital currency trading, or simply as bitcoin trading – in reference to
    the most famous digital currency, Bitcoin (BTC). Although it is a relatively new phenomenon,
    cryptocurrency trading shares some commonalities with forex trading since both of them are
    concerned with the buying and selling of currencies, independently of whether they are national,
    legal-tender currencies or alternative currencies. However, cryptocurrency trading also presents
    several distinguishing characteristics that set it apart from forex trading, elements which we
    will elaborate later on. </p>

<p>In this guide, we will guide readers through the nuts and bolts of cryptocurrency trading by
    first looking at what cryptocurrencies are, then by discussing the many advantages that this
    particular form of trading has over others and by examining the various strategies that one can
    employ to turn a hefty profit through digital currency trading. </p>

<p> Traders who are familiar with forex terminology may possess a marked advantage over others,
    since many of the concepts and strategies used in forex trading can be transferred and applied
    to the world of cryptocurrency trading. However those who are new or have relatively little
    experience with forex trading should not feel left out, as we will strive through this guide to
    offer all the necessary information that one needs to understand and trade
    cryptocurrencies. </p>
<hr>',
            'en'
        ],
        [
            '/education/guide/what-is-cryptocurrency',
            'What Is A Cryptocurrency?',
            'Important information about cryptocurrency trading',
            '<div class="page-header">
        <h1>Guide to Cryptocurrency Trading</h1>
    </div>

    <h3>1. What Is A Cryptocurrency?</h3>

    <p>In simple terms, a cryptocurrency is an alternative, digital currency which operates using
        principles of cryptography to ensure security, privacy, and anonymity. A cryptocurrency and all
        of its underlying aspects are sheltered by extensive and quite complex lines of code, which are
        designed to protect users who engage in trading this alternative form of currency. In addition,
        all types of cryptocurrencies are decentralized, meaning that they operate independently and are
        not coined by a central authority such as a central bank. In recent times, digital currencies
        have become subject to regulation in many countries, with some countries allowing for their use
        and others restricting them. Government regulation, coupled with market participants who engage
        in the buying and selling of such currencies on an exchange platform are two of the main forces
        that drive and determine the present market price of a digital currency. </p>

    <p>Cryptocurrencies are often referred to as electronic currencies or digital currencies because
        they all share the same inherent qualities of encryption and also because the terminology is
        more appealing and less arcane. </p>

    <p> The first and most famous cryptocurrency ever coined is Bitcoin, which was first launched in
        2009. Over the years, various other types of cryptocurrency have emerged, spawned by the
        relatively rapid adoption and proliferation of Bitcoin. Alternative types of cryptocurrencies
        include Dogecoin, Peercoin, Namecoin, Mastercoin and Litecoin (LTC). The list of
        cryptocurrencies keeps growing over time, and each one tries to be unique or offer an
        improvement over others while preserving the underlying principles of cryptography. </p>

    <p> All cryptocurrencies share several qualities that set them apart from other traditional forms of
        currency. Specifically, all cryptocurrencies are electronic, they are all based on a secure form
        of cryptography, their value is mostly determined by market participants through supply and
        demand, and they cannot be debased by a central authority. </p>
    <hr>',
            'en'
        ],
        [
            '/education/guide/why-trade-cryptocurrencies',
            'Why Trade Cryptocurrencies?',
            'Important information about cryptocurrency trading',
            '<div class="page-header">
        <h1>Guide to Cryptocurrency Trading</h1>
    </div>

    <h3>2. Why Trade Cryptocurrencies?</h3>

    <p>Before answering this question directly, let&rsquo;s turn our attention to the following chart,
        which visualizes Bitcoin&rsquo;s astronomic rise over a one-year period in 2013. </p>

    <p> As the chart well illustrates, the price of a single Bitcoin surged from below $14 in January
        2013 to an all-time high of $1124.76 at the end of November 2013. Anyone who was lucky enough or
        had the prophetic foresight to acquire Bitcoins at the beginning of 2013 would have made a
        massive, 8300% profit if they decided to unload their Bitcoin holdings at the end of
        November. </p>

    <p>What this chart illustrates, more than anything, is that there is an almost unlimited amount of
        profit to be made if one is able to correctly predict the overall trend of this alternative
        currency. In addition, one must note that the 8300% profit could have been made not by relying
        on anything too complex, but by simply using a relatively straightforward strategy of buying low
        and selling high also known as a long-based strategy. </p>

    <p>In its relatively short, 6-year lifespan, Bitcoin has experienced a roller-coaster ride, rising
        spectacularly from below $20 to over $1100, then dropping to below $400, only to rise back to
        just below the $700 threshold. At the time when this guide was being written, the average price
        of Bitcoin stood at approximately $633 (EUR 469). Although one cannot predict what the price of
        Bitcoin will be in the near future, it is safe to assume that this digital currency, as well as
        others, will be prone to major swings, thereby providing savvy traders with many profit-taking
        opportunities. </p>

    <p>Another reason why individuals should look into trading cryptocurrencies is because of several
        innate advantages that they possess over other traditional stores of value. As we&rsquo;ve
        discussed in the previous sector, cryptocurrencies are partially regulated by national
        governments and not regulated at all by a national regulator as in the case of traditional
        currencies, stocks or commodities. Furthermore, the exchanges and trading platforms on which
        alternative currencies are traded also fall outside the realm of national regulators.
        Consequently, digital currencies cannot be debased, seized or blocked by governing authorities.
        What this means is that alternative currencies should be viewed as viable alternatives to
        traditional forms of investments such as dollars, euros, stocks, bonds, gold and silver.
        Cryptocurrency trading could be especially appealing to individuals who are wary of their
        national governments and are worried that their personal assets could be taxed or seized in-full
        by their country&rsquo;s government in an effort to replenish state coffers due to the ongoing
        global economic crisis. </p>

    <p>Digital currency trading shares several attributes with forex trading, making it more attractive
        when compared to stock or futures trading. Like forex trading, cryptocurrency trading has low
        commissions and transaction costs, and it does not have a fixed lot size so that one may trade
        less than a single Bitcoin or Litecoin per transaction. Additionally, the cryptocurrency market,
        unlike other financial markets, is not at the mercy of analysts and brokerage firms, meaning
        that analysts&rsquo; recommendations have a limited impact on the future trend of digital
        currencies.    </p>
    <hr>',
            'en'
        ],
        [
            '/education/guide/who-trades-cryptocurrencies',
            'Who Trades Cryptocurrencies?',
            'Important information about cryptocurrency trading',
            '<div class="page-header">
        <h1>Guide to Cryptocurrency Trading</h1>
    </div>

    <h3>3. Who Trades Cryptocurrencies?</h3>

    <p>Initially, when it was first devised in 2009, trading in cryptocurrencies was limited to a small
        number of enthusiasts and aficionados of alternative forms of currency. However, as time passed
        and interest in digital currency increased progressively, more and more people have sought to
        trade digital currencies such as Bitcoins for a variety of reasons. In recent years, as the
        overall value of the cryptocurrency market increased manifold, this market witnessed the active
        involvement of bigger, more established financial players such as hedge funds and major banks.
        Today, one could say that the cryptocurrency market resembles more and more the forex market
        since its participant pool includes retail investors, hedge funds and commercial companies, as
        well as small, medium-sized and multinational banks. As more and more players enter this market,
        it must be noted that they create a self-reinforcing positive loop. In other words, as digital
        currencies gain in popularity, more and more people start trading, which increases trading
        volume, and in turn drives up the price of digital currencies since the supply and demand of any
        cryptocurrency is limited by default. This price rise then attracts more and more participants,
        which leads to even more trading volume and continues feeding the loop. </p>
    <hr>',
            'en'
        ],
        [
            '/education/guide/when-can-you-trade-cryptocurrencies',
            'When Can You Trade Cryptocurrencies?',
            'Important information about cryptocurrency trading',
            ' <div class="page-header">
        <h1>Guide to Cryptocurrency Trading</h1>
    </div>

    <h3>4. When Can You Trade Cryptocurrencies? </h3>

    <p>Cryptocurrencies can be traded 24 hours a day, 7 days a week since the cryptocurrency market is
        always open for business and unlike other financial markets, it does not close for public
        holidays. Despite this apparent advantage over other markets, it must be noted that on certain
        days of the week, digital currency trading may be hampered by a lack of overall volume. Said
        otherwise, those looking to trade cryptocurrencies on Christmas or on a slow, uneventful summer
        weekend may find it hard to complete such a trade due to a lack of market participants, who in
        other circumstances would be willing to take on the opposing side of the trade. Individuals are
        highly recommended to keep note of this minor drawback when trading cryptocurrencies. </p>
    <hr>',
            'en'
        ],
        [
            '/education/guide/how-do-you-trade-cryptocurrencies',
            'How Do You Trade Cryptocurrencies?',
            'Important information about cryptocurrency trading',
            '<div class="page-header">
        <h1>Guide to Cryptocurrency Trading</h1>
    </div>

    <h3>5. How Do You Trade Cryptocurrencies? </h3>

    <p> For the most part, cryptocurrencies are traded digitally through an online exchange or trading
        platform. In recent times, spurred on by the increased adoption of this form of alternative
        currency, various businesses have opened up the possibility of trading Bitcoins and other
        digital currencies through an ATM. Although such a possibility exists, we will not go into depth
        on the matter right now and just note that it is an alternative –albeit a limited one – to
        online cryptocurrency trading. </p>

    <p>Before one can buy or sell cryptocurrencies, one will have to create and learn how to use what&rsquo;s
        known as a digital wallet, also known as an e-wallet. Digital wallets essentially provide the
        same service that a wallet provides to individuals in the real world. Namely, it allows one to
        safely store digital currency on an individual account, which one can access to send and receive
        digital currencies such as Bitcoins and Litecoins. Setting up an e-wallet is relatively easy and
        it can be set up either offline on one&rsquo;s computer or online through one of the many
        Internet bitcoin wallet service providers. Currently, there are many digital wallet systems to
        choose from and users should remember to look at a range of e-wallets before choosing the most
        appropriate one.</p>

    <p>As we&rsquo;ve stated before, cryptocurrencies are decentralized and the same goes for their
        trading. What this means is that there isn&rsquo;t a single, centralized exchange which accounts
        for all digital currency trading. Rather, digital currencies are traded via a multitude of
        exchanges and trading platforms, so prices and volume for a given digital currency may vary from
        one exchange or trading platform to another one. The fact that digital currencies are traded on
        a number of exchanges presents a distinct advantage, something which is called arbitrage that
        will be addressed later on in this guide. For now, the important thing to note is that
        cryptocurrency markets possess varying levels of liquidity and volume, determined by the number
        of active participants of a particular exchange or platform. </p>

    <p>Cryptocurrencies are traded either through a market order or a limit order. Both types of orders
        have their own sets of advantages and disadvantages and in this section we will look at each of
        their relative strengths and weaknesses. To begin with, cryptocurrency market orders are orders
        placed to buy or sell a digital currency at the current available market price. The main
        advantage of a market order is that it is executed immediately; one does not have to wait around
        until a counterparty is found. The biggest disadvantage that market orders have is something
        called slippage, which is defined by Investopedia as &ldquo;the difference between the expected
        price of a trade, and the price the trade actually executes at […] Slippage often occurs when
        volatility, perhaps due to news events, makes an order at a specific price impossible to
        execute.&rdquo; In other words, a market order to sell a Bitcoin at the current market price may
        not be executed due to high volatility, and in this case the exchange or trading platform will
        sell the Bitcoin at the next best available price. </p>

    <p>Limit orders, on the other hand, refer to orders placed to buy or sell a digital currency at a
        specific, predetermined price regardless of the current market price. The main advantage of
        limit orders is that they allow one to enter or exit a market at a specific level, exactly where
        one intends to. Unfortunately, limit orders also possess a distinct weakness as it may take a
        lot of time to fulfill the order if the price level set by the user is not reached immediately.
        Oftentimes, the limit order may not even get executed if the price set by the user is never
        reached within a set period of time. Although there is no guarantee that limit orders will get
        fulfilled, they ensure that a user will pay only what he or she is willing to pay. </p>

    <hr>',
            'en'
        ],
        [
            '/education/guide/three-ways-to-analyze-cryptocurrency-market',
            'Three Ways to Analyze the Cryptocurrency Market',
            'Important information about cryptocurrency trading',
            '<div class="page-header">
        <h1>Guide to Cryptocurrency Trading</h1>
    </div>

    <h3>6. Three Ways to Analyze the Cryptocurrency Market</h3>

    <p>Much like in forex trading, there are three main methods of analysis which can be applied to
        analyze cryptocurrency markets and develop trading ideas or strategies. These three types of
        market analysis are technical analysis, fundamental analysis and sentiment analysis. Technical
        analysis refers to the study of historical price movements which is done primarily through the
        use of charts. This type of analysis relies on the belief that historical price movements tend
        to repeat themselves by forming cyclical trends or patterns. Traders who rely on technical
        analysis believe that they can implement trading strategies by referring to previous price
        movements and by betting whether a currency will hold or break through a key price level. </p>

    <p>Fundamental analysis refers to a type of analysis which looks at various economic, social and
        political factors that may affect the performance of a given currency. Fundamental analysis
        presupposes that the value of a currency is affected if not determined by various macroeconomic
        factors which may include newsworthy events. In the case of alternative currencies such as
        bitcoin, these factors could include newsworthy developments such as the U.S. government&rsquo;s
        decision to shut down the anonymous market place Silk Road, and its subsequent move to seize
        bitcoins from various Silk Road accounts. </p>

    <p> The third type of analysis, sentiment analysis, is performed by gauging the overall sentiment in
        the markets in an effort to figure out whether the majority of participants are feeling bullish
        or bearish. In simple terms, this type of analysis tries to decipher how the market is feeling
        so that one can act accordingly with the intention of generating a profit. One way to gauge
        market sentiment is by looking at the overall volume of trades. So for instance, if Bitcoin has
        been appreciating on an exchange but volume has been falling, this may indicate that the
        currency is currently overbought. If the price of Bitcoin suddenly reverses course and rises on
        high volume, this may indicate that market sentiment has shifted to bullish from bearish. </p>

    <p> Generally speaking, anyone looking to trade alternative currencies should try to employ more
        than just one type of market analysis. It is best not to rely solely on one type of analysis
        since cryptocurrency markets are highly volatile, the historical charts only go back to 2009 at
        best, and because volume may be hard to gauge. More experienced traders may decide to focus
        primarily on just one or two types of analysis. However, those who are new or have limited
        experience should comprehend the risks of relying on just one or two types of analysis and
        proceed very cautiously. </p>
    <hr>',
            'en'
        ],
        [
            '/education/guide/cryptocurrency-exchanges-and-trading-platforms',
            'Cryptocurrency Exchanges and Trading Platforms',
            'Important information about cryptocurrency trading',
            '<div class="page-header">
        <h1>Guide to Cryptocurrency Trading</h1>
    </div>

    <h3>7. Cryptocurrency Exchanges and Trading Platforms</h3>

    <p>Cryptocurrency trading is performed either through an online exchange or via an online trading
        platform such as Exmarkets&rsquo;s newly-released virtual exchange platform. Individuals can
        exchange traditional currencies with e-currencies and in some exchanges, individuals can also
        exchange digital currencies such as Bitcoins with other e-currencies. In the case of Exmarkets,
        cryptocurrency trading is currently limited to Bitcoins and Litecoins, which can be traded in
        exchange for dollars or euros. Currently, there are hundreds of exchanges and trading platforms
        to choose from and users should be very careful when choosing the most appropriate one. Each
        exchange and trading platform presents unique levels of liquidity and volume, determined by
        their overall popularity and use. Some exchanges and platforms may be more capitalized than
        others and it is important to choose a reliable one, one that is strong and robust enough to
        withstand wild swings and fluctuations, and one that is secure enough to withstand repeated
        hacker attacks. This is why you are on the right track by choosing Exmarkets. The recent shutdown
        of Mt. Gox, one of Japan&rsquo;s biggest cryptocurrency exchanges should serve as a reminder to
        readers that digital currency exchanges may present vulnerabilities that other types of
        exchanges generally don&rsquo;t have. </p>

    <p>In order to start trading digital currencies at Exmarkets, there are just a couple of steps that
        individuals will have to follow. The first thing that individuals will have to do is create an
        account, which is provided for free. Once the account is created, the user can immediately
        deposit and start trading. The only catch is that unverified accounts can deposit/withdraw a
        limited amount of money before being forced to verify their accounts. Verification is done by
        submitting documents that attest one&rsquo;s identity and proof of address. Once this
        verification process is completed, users will again be able to fund their accounts by using one
        of the many payment methods available such as OKPay, Payza,Perfect Money etc.; request
        withdraws through corresponding payment gateways, and most importantly – trade
        cryptocurrencies. </p>
    <hr>',
            'en'
        ],
        [
            '/education/guide/strategies-employed-in-cryptocurrency-trading',
            'Strategies Employed in Cryptocurrency Trading',
            'Important information about cryptocurrency trading',
            '    <div class="page-header">
        <h1>Guide to Cryptocurrency Trading</h1>
    </div>

    <h3>8. Strategies Employed in Cryptocurrency Trading</h3>

    <p>Cryptocurrency trading shares many common strategies with forex trading and in this section, we
        will examine five of the most famous trading strategies, starting with the position trading
        strategy. The position trading strategy is one of the most conservative forms of trading and it
        consists of opening a position – by either buying or selling a currency – and maintaining that
        position for a long period of time in the belief that the currency will appreciate if one is
        holding a long position or depreciate if one is holding a short position. The position is then
        closed, meaning that a currency is sold at a higher price or bought back at a lower price
        relative to the initial price. </p>

    <p>Scalping is another commonly used strategy in the forex markets which can also be utilized when
        trading cryptocurrencies. Scalping consists of executing many trades within a short time frame.
        This form of trading tries to profit on the relatively small oscillations that a currency goes
        through in daily trading sessions. Scalping is a high-frequency form of trading that is
        generally not recommended for the faint of heart. However, it must be said that scalping can
        generate solid, consistent profits if it is executed with patience. </p>

    <p>Day trading refers to a type of trading in which one or more positions are opened at the
        beginning of the day and closed before the successive day. Although day trading is mostly used
        by forex traders, it can be successfully employed in cryptocurrency trading even if, unlike
        forex markets, cryptocurrency exchanges do not have an official opening and closing time. Day
        trading is suited for individuals who do not want to keep too many positions open for too long
        and would rather measure profits on a daily basis. </p>

    <p>Trend trading is a type of trading that is based on identifying emerging trends early on. The
        intention here is to identify a nascent trend, position one&rsquo;s trades to ride the trend,
        and profit from it before the trend reverses. In order to properly execute trend trading, one
        should look at various charts, each with its own specific timeframe. This will allow users to
        identify past trends and prepare them to spot future trends. Trend trading can be applied as a
        form of position trading –one with a more extended timeframe – or as a form of day trading with
        a shorter timeframe. </p>

    <p>Another strategy that is widely used in cryptocurrency trading is a strategy called
        cryptocurrency arbitrage or bitcoin arbitrage. Compared to the previous four methods, this last
        strategy is a bit more complex and technical. Cryptocurrency arbitrage is a type of trading that
        takes advantage of discrepancies which exist in the price of cryptocurrencies between different
        exchanges. Specifically, this type of arbitrage trading is performed when an individual decides
        to buy one or more digital currencies at one exchange, and then sells them at a different
        exchange since it carries a higher quoted price compared to the other exchange. </p>

    <p>The practice of digital currency arbitrage is only possible because cryptocurrency exchanges do
        not always quote the same prices. In part, this is because some exchanges are more liquid than
        others. It must be noted that to employ this strategy of arbitrage, one will have to trade on
        more than one exchange or trading platform. </p>

    <p>Bitcoin arbitrage can be coupled with another form of arbitrage called forex arbitrage to gain
        even bigger profits. Put simply, one can buy a digital currency with one type of legal currency
        i.e. dollars and then sell the same digital currency at another exchange for euros if the
        equivalent amount in dollars is higher than at the other exchange. Oftentimes, bitcoin prices in
        euros, converted back to dollars, are not in line with the prices of bitcoins at various
        dollar-denominated exchanges. For example, let&rsquo;s assume that on a dollar-denominated
        exchange, the current market price of a single bitcoin is $600 while at a euro-denominated
        exchange bitcoins are priced at EUR480 per coin. Considering that the EUR/USD exchange rate is
        currently at 1.36, one could gain a profit of over $50 by simply buying a bitcoin at the
        dollar-exchange, selling it at the euro-exchange, and then converting the euro proceeds back to
        dollars. </p>

    <p>As a word of caution, it must be noted that not all of these strategies can be employed on every
        exchange or trading platform. This is because some exchanges do not allow for short selling or
        margin trading, meaning that some exchanges do not allow one to sell digital currencies that one
        does not own outright, with the option of buying them later when the price drops to a lower
        level. Therefore, individuals should make sure that their trading strategy of choice can be
        successfully implemented on a specific exchange or trading platform. </p>
    <hr>',
            'en'
        ],
        [
            '/education/guide/what-drives-price-of-cryptocurrencies',
            'What Drives the Price of Cryptocurrencies?',
            'Important information about cryptocurrency trading',
            '<div class="page-header">
        <h1>Guide to Cryptocurrency Trading</h1>
    </div>

    <h3>9. What Drives the Price of Cryptocurrencies?</h3>

    <p>For the most part, the price of cryptocurrencies is driven by the overall demand generated by the
        general public, which is made up of individuals and a wide-range of businesses. As we&rsquo;ve
        stated before, cryptocurrencies have trended positively higher over the past several years, as
        increased awareness and adoption of alternative currencies have brought more people to engage in
        cryptocurrency trading, driving up demand for this type of currency and creating a
        self-reinforcing loop. According to payment gateway provider BitPay, the number of businesses
        accepting bitcoins as a method of payment exploded from a few hundred at the end of 2011 to over
        14,000 in November 2013. During this time, prices of bitcoins and other emerging
        cryptocurrencies surged higher, propelled by an increased adoption of these alternative forms of
        currency. </p>

    <p>In addition to this key driver, cryptocurrency prices are also swayed by attempts to regulate the
        cryptocurrency market by government entities. For instance, in early December 2013, China&rsquo;s
        central bank disallowed banks and other financial institutions from buying and selling
        cryptocurrencies and products relating to all forms of digital currencies. Once this news hit
        the public domain, bitcoin prices slumped almost 40% to a low of $551 from $906.50. </p>

    <p>The price of cryptocurrencies, unlike national currencies and commodities, is not impacted by
        supply issues. While this may seem rather strange, cryptocurrencies and their relative price are
        mostly impacted by the demand side and not by the supply side simply because the supply of
        cryptocurrencies is set to increase at a constant, identifiable rate. In other words, the supply
        side of cryptocurrencies such as bitcoins is assumed to be already priced in the current market
        price, as well as in future markets considering that all cryptocurrencies have a limit, such as
        bitcoin which is capped at and will never exceed 21 million units. </p>
    <hr>',
            'en'
        ],
        [
            '/education/guide/major-advantages-of-trading-cryptocurrencies-on-exmarkets',
            'Major Advantages of Trading Cryptocurrencies on the Exmarkets Virtual Exchange Platform',
            'Important information about cryptocurrency trading',
            '    <div class="page-header">
        <h1>Guide to Cryptocurrency Trading</h1>
    </div>

    <h3>10. Major Advantages of Trading Cryptocurrencies on the Exmarkets Virtual Exchange Platform</h3>

    <p>This last section will focus on the Exmarkets virtual exchange platform (<a
                href="http://www.exmarkets.com">www.exmarkets.com</a>) and the many advantages that this
        trading platform exhibits over other competing platforms. To begin with, the Exmarkets platform
        works like any regular cryptocurrency trading platform by allowing users to deposit currency as
        well as e-currency through one&rsquo;s e-wallet on one&rsquo;s account. 
    </p>



    <p>Users should also keep in mind that all of the trading strategies outlined in this guide can be
        used on the Exmarkets trading platform, including scalping, position trading based on holding long
        positions, as well as long-trend trading.  </p>

    <p>In addition, Exmarkets has introduced a very simple, 3-step fee structure that is applied based on
        the total amount traded by a member over a 30-day period. Individuals who trade between $0 and
        $50,000 will be subject to a 0.3% trading commission, those who trade between $50,000 and
        $300,000 will be applied a 0.25% trading fee, and those who trade over $300,000 will be subject
        to a 0.2% trading fee. Compared to other platforms, Exmarkets offers trading costs that are below
        the industry average.</p>

    <p>Another positive aspect of the Exmarkets platform is that it currently provides deposit and
        withdrawal options by four of the most popular payment gateways: PayZa, OKPay, and
        PerfectMoney. Additionally Exmarkets is constantly working on adding more gateways to create an
        even easier way of entering/exiting the market. </p>

    <p>A final advantage that Exmarkets&rsquo;s platform has over many of its peers is that Exmarkets has
        added Google&rsquo;s Two-Step Authentication in an effort to provide customers with an even
        safer trading environment. This last advantage should not be overlooked since cryptocurrency
        accounts can easily fall victim to security attacks. </p>
<hr/>',
            'en'
        ],
        [
            '/education/perfectmoney',
            'New generation of Internet payment system - Perfect Money. Money transfer payment processor',
            'Buy, send receive money with most secure payment processor on the Internet. Accept bank wire, SMS payments and e-currency on you website.',
            '<div class="page-header">
        <h1>How to use PerfectMoney</h1>
    </div>
    <a href="https://www.perfectmoney.com"><img
                src="{{ asset(\'dist/app/images/perfectmoney-logo.png\') }}"
                alt="PerfectMoney logo" class="pull-left"></a>

    <p>Perfect Money is a one of the leading online financial service providers allowing its users
        to make instant payments and international money transfers securely throughout the
        Internet.</p>

    <p>Perfect Money targets to bring the transactions on the Internet to the ideal level! For your
        convenience it has various deposit and withdrawal options. It is simple to register and
        use.</p>
    <hr>
    <h3>Register an account at PerfectMoney</h3>

    <p>If you don’t have an account with PerfectMoney, just sign up. You can do that with these easy
        steps.</p>

    <p><strong>Step 1.</strong> Register for an account. Enter all required information and create a
        password.<br>
        <strong>Step 2.</strong> Check your email. You will receive Member ID.<br>
        <strong>Step 3.</strong> Log in with your Member ID and Password.</p>

    <div class="alert alert-warning"><strong>!Important notice:</strong> Verified users enjoy lower
        fees (0.5%) as opposed to unverified users (2%).
    </div>

    <p>Also you will receive full funding instructions how to deposit money to PerfectMoney. You can
        choose from direct funding options like:</p>


    <ul>
        <li>Direct Deposit (German, Austrian, Swiss and Belgian bank account holders)</li>
        <li>Cash Terminals (Russia and Ukraine)</li>
    </ul>

    <p><strong>Also you can use one of the funding options available via Perfect Money Certified
            Partners</strong></p>

    <p><img src="{{ asset(\'dist/app/images/available-ways-of-deposit.jpg\') }}"
            alt="Available ways of deposit"
            class="img-shadow"></p>

    <p>You can find the list at: <a href="https://perfectmoney.is/business-partners.html"
                                    target="_blank">https://perfectmoney.is/business-partners.html</a>.
    </p>
    <hr>
    <h3>Deposit to your Exmarkets account through PerfectMoney</h3>

    <p>
        <strong>Step 1.</strong> Go to member area and click on PerfectMoney in the Deposit section.
    </p>

    <p><img src="{{ asset(\'dist/app/images/perfectmoney-deposit.jpg\') }}" alt="PerfectMoney deposit"
            class="img-shadow"></p>

    <p><strong>Step 2.</strong> Enter the amount and currency you would like to receive to your
        Exmarkets account.<br>
        <strong>Step 3.</strong> Select your deposit method.<br>
        <strong>Step 4.</strong> Authorize the payment. After the deposit has been authorized you
        can go back to your Exmarkets account where you should see your request available in Deposit
        history.</p>

    <div class="row">
        <div class="col-md-6">
            {{ render(controller(\'BtcAccountBundle:Default:bankPaymentFees\', {
            \'type\': \'Deposit\', \'bank\': \'perfect-money\'
            })) }}
        </div>
    </div>
    <hr>

    <h3>Withdraw to your PerfectMoney account from Exmarkets</h3>

    <p><strong>Step 1.</strong> Go to member area and click on PerfectMoney in the withdraw section.
    </p>

    <p><img src="{{ asset(\'dist/app/images/perfectmoney-withdraw.jpg\') }}" alt="PerfectMoney withdraw"
            class="img-shadow"></p>

    <p><strong>Step 2.</strong> Fill in empty fields with the required information and click
        Withdraw. You should see your request available in Withdraw history.</p>

    <div class="row">
        <div class="col-md-6">
            {{ render(controller(\'BtcAccountBundle:Default:bankPaymentFees\', {
            \'type\': \'Withdrawal\', \'bank\': \'perfect-money\'
            })) }}
        </div>
    </div>',
            'en'
        ],
        [
            '/education/payza',
            'All types of money transfer. Send money, Receive payment with Payza',
            'Get paid from anywhere in the world. Send and receive money, make online payments online with payza payment platform.',
            '<div class="page-header">
        <h1>How to use Payza</h1>
    </div>
    <a href="https://www.payza.com"><img src="{{ asset(\'dist/app/images/payza-lg-logo.png\') }}" alt="Payza logo"
                                         class="pull-left"></a>

    <p>Payza is a leading global online payment platform that specializes in e-commerce processing,
        corporate disbursements, and remittances for individuals and businesses around the world. The
        e-wallet platform provides Payza members worldwide with convenient and flexible loading and
        withdrawal options, such as localized bank transfers, global bank wires, credit/debit card,
        checks, prepaid cards, and others.</p>

    <p>Payza also provides under-serviced and emerging markets with an affordable and convenient way to
        send and receive international payments, thereby bolstering local economies in a global
        marketplace.</p>

    <p><strong>Step 1.</strong> Sign up for an account.<br>
        <strong>Step 2.</strong> Complete the profile setup.<br>
        <strong>Step 3.</strong> Complete verification process. (Documents required: Proof of identity,
        Proof of address)<br>
        <strong>Step 4.</strong> Set up security options. (Set up transaction PIN, Edit your avatar and
        message which allow you to quickly confirm the validity of the Payza website)</p>
    <hr>
    <h4>Adding funds: Bank transfer, Credit card, Bank wire transfer.</h4><br>

    <div class="row">
        <div class="col-sm-8">
            <table class="table table-bordered">
                <thead>
                <tr>
                    <th width="1%">&nbsp;</th>
                    <th>Fee</th>
                    <th>Duration</th>
                </tr>
                </thead>
                <tr>
                    <td><img src="{{ asset(\'dist/app/images/icons/bankwire.gif\') }}" alt="Bankwire"></td>
                    <td>3.5%</td>
                    <td>Immediate</td>
                </tr>
                <tr>
                    <td><img src="{{ asset(\'dist/app/images/icons/visa-master.png\') }}" alt="Visa"></td>
                    <td>$20 USD</td>
                    <td>2-4 business days</td>
                </tr>
                <tr>
                    <td><img src="{{ asset(\'dist/app/images/icons/bankwire-transfer.png\') }}" alt="Bankwire tranfer">
                    </td>
                    <td><a target="_blank" href="https://www.payza.com/support/payza-transaction-fees">Varies</a>
                    </td>
                    <td>3-4 business days</td>
                </tr>
            </table>
        </div>
    </div>


    <h4>Withdraw: Bank transfer, Bank wire transfer.</h4><br>

    <div class="row">
        <div class="col-sm-8">
            <table class="table table-bordered">
                <thead>
                <tr>
                    <th width="1%">&nbsp;</th>
                    <th>Fee</th>
                    <th>Duration</th>
                </tr>
                </thead>
                <tr>
                    <td><img src="{{ asset(\'dist/app/images/icons/bankwire.gif\') }}" alt="Bankwire"></td>
                    <td><a href="https://www.payza.com/support/payza-transaction-fees" target="_blank">Varies</a>
                    </td>
                    <td>3-5 business days</td>
                </tr>
                <tr>
                    <td><img src="{{ asset(\'dist/app/images/icons/bankwire-transfer.png\') }}" alt="Bankwire tranfer">
                    </td>
                    <td>$25 USD</td>
                    <td>2-4 business days</td>
                </tr>
            </table>
        </div>
    </div>
    <hr>
    <h3>Deposit to / Withdraw from your Exmarkets account through Payza.</h3>

    <p><strong>Step 1.</strong> Go to member area and click on Payza in Deposit/Withdraw section. </p>

    <p><img src="{{ asset(\'dist/app/images/payza-deposit.jpg\') }}" alt="Payza deposit" class="img-shadow"> &nbsp;&nbsp;&nbsp;
        <img src="{{ asset(\'dist/app/images/payza-withdraw.jpg\') }}" alt="Payza withdraw" class="img-shadow"></p>

    <p><strong>Step 2.</strong> Fill in the empty fields with required information and click
        Depost/Withdraw. </p>

    <p><strong>Step 3.</strong> You will be transferred to the payment page. Login to your Payza account
        (if required) and confirm your order. Go back to your Exmarkets account and you should see your
        request available in Transactions -> Deposit/Withdraw history. </p>
    <hr>
    <h3>Fees</h3>

    <div class="row">
        <div class="col-md-6">
            {{ render(controller(\'BtcAccountBundle:Default:bankPaymentFees\', {
            \'type\': \'Deposit\', \'bank\': \'payza\'
            })) }}
        </div>
        <div class="col-md-6">
            {{ render(controller(\'BtcAccountBundle:Default:bankPaymentFees\', {
            \'type\': \'Withdrawal\', \'bank\': \'payza\'
            })) }}
        </div>
    </div>',
            'en'
        ],
        [
            '/education/okpay',
            'Transaction protection, reliable electronic currency and instant money transfers with OKPAY',
            'Convenient and reliable electronic currency with instant money transfers and transaction protection with OKPAY.',
            ' <div class="page-header">
        <h1>How to use OKpay</h1>
    </div>
    <a href="https://www.okpay.com"><img src="{{ asset(\'dist/app/images/okpay-lg-logo.png\') }}" alt="OKpay logo"
                                         class="pull-left"></a>
    <p>OKPAY is a trustworthy online banking system. The company has a vast experience in the field of electronic
        commerce, financial software development, product marketing and sales via the Internet for over 10 years. It is
        a P2P and B2C web based payment system providing users with a virtual account that allows to easily load, send,
        receive and withdraw money as well as make purchases online. OKPAY is a widely spread electronic payments system
        and is among the world’s leading eWallet providers. OKPAY payment network offers access to a great number of
        payment options for businesses in over 200 countries with a single integration. The company gives you complete
        online control over your finances. It allows you to accept bank wire and money transfers and all e-currencies
        quickly and affordably.</p>
    <p><strong>Step 1.</strong> Sign up for an account.<br>
        <strong>Step 2.</strong> Check email for account confirmation.<br>
        <strong>Step 3.</strong> Verify your profile. (Documents and information required: Proof of identity, Proof of
        address,
        Mobile phone number(required for OKPAY card), Email address.)<br>
        <strong>Step 4.</strong> Set up the security options and get started.</p>
    <hr>
    <h3>For your convenience OKPAY implemented various funding options: bank transfers, electronic currencies, phone
        payments, money transfer systems.</h3>

    <p><strong>Bank Transfers</strong></p>
    <table class="table table-bordered-bottom">
        <tr>
            <td width="1%"><img src="{{ asset(\'dist/app/images/icons/bankwire.gif\') }}" alt="Wire Transfers"></td>
            <td>Wire Transfers<br>
                <em>Bank commission fee charged, deposit can take up to 3-7 business days</em></td>
        </tr>
        <tr>
            <td><img src="{{ asset(\'dist/app/images/icons/sofort.gif\') }}" alt="SofortBanking"></td>
            <td>SofortBanking<br>
                <em>Instant transfer, commission fee charged - 2.0% (Min. 0.10 EUR)</em></td>
        </tr>
        <tr>
            <td><img src="{{ asset(\'dist/app/images/icons/mayzus.png\') }}" alt="Mayzus FS"></td>
            <td>Mayzus FS<br>
                <em>Commission fee charged from 0.0%</em></td>
        </tr>
        <tr>
            <td><img src="{{ asset(\'dist/app/images/icons/alfaClik.png\') }}" alt="Alfa Click"></td>
            <td>Alfa Click<br>
                <em>Instant transfer, commission fee charged - 2.0%</em></td>
        </tr>
        <tr>
            <td><img src="{{ asset(\'dist/app/images/icons/sber.png\') }}" alt="Sberbank"></td>
            <td>Sberbank<br>
                <em>Instant transfer, commission fee charged - 2.0%</em></td>
        </tr>
        <tr>
            <td><img src="{{ asset(\'dist/app/images/icons/svyaznoy.png\') }}" alt="Svyaznoy"></td>
            <td>Svyaznoy<br>
                <em>Instant transfer, commission fee charged - 2.0%</em></td>
        </tr>
        <tr>
            <td><img src="{{ asset(\'dist/app/images/icons/psb.png\') }}" alt="PromSvyazBank"></td>
            <td>PromSvyazBank<br>
                <em>Instant transfer, commission fee charged - 2.0%</em></td>
        </tr>
    </table>
    <p><strong>Electronic Payment Systems</strong></p>
    <table class="table table-bordered-bottom">
        <tr>
            <td width="1%"><img src="{{ asset(\'dist/app/images/icons/bitcoin.gif\') }}" alt="Bitcoin"></td>
            <td>Bitcoin<br>
                <em>Instant processing, exchange at a market rate</em></td>
        </tr>
        <tr>
            <td><img src="{{ asset(\'dist/app/images/icons/litecoin.png\') }}" alt="Litecoin"></td>
            <td>Litecoin<br>
                <em> Instant processing, exchange at a market rate</em></td>
        </tr>
        <tr>
            <td><img src="{{ asset(\'dist/app/images/icons/cashU.gif\') }}" alt="CashU"></td>
            <td>CashU<br>
                <em>Instant transfer, commission fee charged - 10.0% (Min. 1.00 EUR)</em></td>
        </tr>
        <tr>
            <td><img src="{{ asset(\'dist/app/images/icons/w1.gif\') }}" alt="W1"></td>
            <td>W1<br>
                <em>Instant transfer, commission fee charged - 2.0%</em></td>
        </tr>
        <tr>
            <td><img src="{{ asset(\'dist/app/images/icons/easypay.gif\') }}" alt="EasyPay"></td>
            <td>EasyPay<br>
                <em>Instant transfer, commission fee charged - 3.0%</em></td>
        </tr>
        <tr>
            <td><img src="{{ asset(\'dist/app/images/icons/a1-pay.png\') }}" alt="Mobile Payments"></td>
            <td>Mobile Payments<br>
                <em>Instant transfer, commission fee charged - 5.0% (Min. 0.10 EUR)</em></td>
        </tr>
        <tr>
            <td><img src="{{ asset(\'dist/app/images/icons/Cash4WM.png\') }}" alt="Cash4WM"></td>
            <td>Cash4WM<br>
                <em>Transfer within minutes, exchange rate plus commission up to 10.0%</em></td>
        </tr>
    </table>
    <p><strong>Money Transfer Systems</strong></p>
    <table class="table table-bordered-bottom">
        <tr>
            <td width="1%"><img src="{{ asset(\'dist/app/images/icons/caspianmt.png\') }}" alt="Caspian"></td>
            <td>Caspian<br>
                <em>Same day transfer, fees from 1.5% depending on the amount and destination</em></td>
        </tr>
        <tr>
            <td><img src="{{ asset(\'dist/app/images/icons/faster.png\') }}" alt="Faster"></td>
            <td>Faster<br>
                <em>Same day transfer, fees from 1.5% depending on the amount and destination.</em></td>
        </tr>
        <tr>
            <td><img src="{{ asset(\'dist/app/images/icons/intelexpress.png\') }}" alt="Inter Express"></td>
            <td>Intel Express<br>
                <em>Same day transfer, fees from 1.5% depending on the amount and destination.</em></td>
        </tr>
        <tr>
            <td><img src="{{ asset(\'dist/app/images/icons/leader.png\') }}" alt="Leader"></td>
            <td> Leader<br>
                <em>Same day transfer, fees from 1.5% depending on the amount and destination </em></td>
        </tr>
        <tr>
            <td><img src="{{ asset(\'dist/app/images/icons/moneypolo.png\') }}" alt="Money Polo"></td>
            <td>Money Polo<br>
                <em>Same day transfer, fees from 1.5% depending on the amount and destination </em></td>
        </tr>
        <tr>
            <td><img src="{{ asset(\'dist/app/images/icons/unistream.png\') }}" alt="Unistream"></td>
            <td>Unistream<br>
                <em>Same day transfer, fees from 1.5% depending on the amount and destination </em></td>
        </tr>
    </table>
    <p><strong>Certified Partners</strong></p>
    <table class="table table-bordered-bottom">
        <tr>
            <td width="1%"><img src="{{ asset(\'dist/app/images/icons/partners.gif\') }}"
                                alt="Certified Exchange Partners"></td>
            <td>Certified Exchange Partners<br>
                <em>Fund your account using service of one of our certified partners </em></td>
        </tr>
    </table>
    <h3>You can select an appropriate option to withdraw funds from your OKPAY account.</h3>
    <p><strong>Bank Wire Transfer</strong></p>
    <table class="table table-bordered-bottom">
        <tr>
            <td width="1%"><img src="{{ asset(\'dist/app/images/icons/bankwire.gif\') }}" alt="Banking service of OKPAY">
            </td>
            <td>Banking service of OKPAY<br>
                <em>1% plus bank transfer commission fee charged, withdrawal can take up to 3-7 business days </em></td>
        </tr>
    </table>
    <p><strong>Bank Cards</strong></p>
    <table class="table table-bordered-bottom">
        <tr>
            <td width="1%"><img src="{{ asset(\'dist/app/images/icons/visa-master.png\') }}"
                                alt="Withdraw via Visa & MasterCard (USD)"></td>
            <td>Withdraw via Visa & MasterCard (USD)<br>
                <em> Up to 3 banking days to process, commission fee charged - 5.0% (Min. 7.00 USD) </em></td>
        </tr>
    </table>
    <p><strong>Money Transfer Systems</strong></p>
    <table class="table table-bordered-bottom">
        <tr>
            <td width="1%"><img src="{{ asset(\'dist/app/images/icons/blizko.png\') }}" alt="Blizko"></td>
            <td>Blizko<br>
                <em> Same day transfer, fees from 1% depending on the amount and your location. </em></td>
        </tr>
        <tr>
            <td><img src="{{ asset(\'dist/app/images/icons/caspianmt.png\') }}" alt="Caspian"></td>
            <td> Caspian<br>
                <em> Same day transfer, fees from 1% depending on the amount and your location. </em></td>
        </tr>
        <tr>
            <td><img src="{{ asset(\'dist/app/images/icons/contakt.gif\') }}" alt="Contact"></td>
            <td>CONTACT<br>
                <em> Same day transfer, fees from 1% depending on the amount and your location. </em></td>
        </tr>
        <tr>
            <td><img src="{{ asset(\'dist/app/images/icons/faster.png\') }}" alt="Faster"></td>
            <td>Faster<br>
                <em> Same day transfer, fees from 1% depending on the amount and your location. </em></td>
        </tr>
        <tr>
            <td><img src="{{ asset(\'dist/app/images/icons/intelexpress.png\') }}" alt="Intel Express"></td>
            <td>Intel Express<br>
                <em> Same day transfer, fees from 1% depending on the amount and your location. </em></td>
        </tr>
        <tr>
            <td><img src="{{ asset(\'dist/app/images/icons/leader.png\') }}" alt="Leader"></td>
            <td>Leader<br>
                <em> Same day transfer, fees from 1% depending on the amount and your location. </em></td>
        </tr>
        <tr>
            <td><img src="{{ asset(\'dist/app/images/icons/moneypolo.png\') }}" alt="Money Polo"></td>
            <td>Money Polo<br>
                <em> Same day transfer, fees from 1% depending on the amount and your location. </em></td>
        </tr>
        <tr>
            <td><img src="{{ asset(\'dist/app/images/icons/unistream.png\') }}" alt="Unistream"></td>
            <td>Unistream<br>
                <em> Same day transfer, fees from 1% depending on the amount and your location. </em></td>
        </tr>
    </table>
    <p><strong>Electronic Payment Systems</strong></p>
    <table class="table table-bordered-bottom">
        <tr>
            <td width="1%"><img src="{{ asset(\'dist/app/images/icons/bitcoin.gif\') }}" alt="Bitcoin"></td>
            <td>Bitcoin<br>
                <em> Instant transfer, exchange at a market rate.</em></td>
        </tr>
        <tr>
            <td><img src="{{ asset(\'dist/app/images/icons/litecoin.png\') }}" alt="Litecoin"></td>
            <td> Litecoin<br>
                <em> Instant transfer, exchange at a market rate.</em></td>
        </tr>
        <tr>
            <td><img src="{{ asset(\'dist/app/images/icons/w1.gif\') }}" alt="W1"></td>
            <td> W1<br>
                <em> Instant transfer, commission fee charged - 2.0%.</em></td>
        </tr>
        <tr>
            <td><img src="{{ asset(\'dist/app/images/icons/payza.png\') }}" alt="Payza"></td>
            <td> Payza<br>
                <em> Same day transfer, commission fee charged - 2.0%.</em></td>
        </tr>
        <tr>
            <td><img src="{{ asset(\'dist/app/images/icons/yandexmoney.gif\') }}" alt="Yandex Money"></td>
            <td> Yandex Money<br>
                <em> Same day transfer, commission fee charged - 3.0%.</em></td>
        </tr>
        <tr>
            <td><img src="{{ asset(\'dist/app/images/icons/rbkmoney.gif\') }}" alt="RBK Money"></td>
            <td> RBK Money<br>
                <em> Instant transfer, commission fee charged - 3.0%.</em></td>
        </tr>
        <tr>
            <td><img src="{{ asset(\'dist/app/images/icons/Cash4WM.png\') }}" alt="Cash4WM"></td>
            <td> Cash4WM<br>
                <em> Instant transfer, commission fee charged - 1.0%.</em></td>
        </tr>
    </table>
    <p><strong>OKPAY Card</strong></p>
    <table class="table table-bordered-bottom">
        <tr>
            <td width="1%"><img src="{{ asset(\'dist/app/images/icons/card.gif\') }}" alt="OKPAY Card"></td>
            <td><em>You can apply for OKPAY Card and use it wherever there is a MasterCard® logo. </em></td>
        </tr>
    </table>
    <p><strong>E-Currency Exchangers</strong></p>
    <table class="table table-bordered-bottom">
        <tr>
            <td width="1%"><img src="{{ asset(\'dist/app/images/icons/allec.gif\') }}" alt="E-Currency Exchangers"></td>
            <td><em>You can convert your OKPAY e-currency to any other e-currency using services of independent
                    exchangers.</em></td>
        </tr>
    </table>
    <h3>Deposit to / Withdraw from your Exmarkets account through OKPAY:</h3>
    <p><strong>Step 1.</strong> Go to member area and click on OKPAY in Deposit/Withdraw section.</p>
    <p><img src="{{ asset(\'dist/app/images/okpay-deposit.jpg\') }}" alt="OKpay deposit" class="img-shadow"> &nbsp;&nbsp;&nbsp;
        <img src="{{ asset(\'dist/app/images/okpay-withdraw.jpg\') }}" alt="OKpay withdraw" class="img-shadow"></p>
    <p><strong>Step 2.</strong> Fill in empty fields with the required information and click Deposit/Withdraw.<br>
        <strong>Step 3.</strong> You will be transferred to the payment page. Login to your OKPAY account (If required)
        and confirm your order. Go back to your Exmarkets account and you should see your request available in your
        Deposit/Withdraw history.</p>
    <hr>
    <h3>Fees</h3>
    <div class="row">
        <div class="col-md-6">
            {{ render(controller(\'BtcAccountBundle:Default:bankPaymentFees\', {
            \'type\': \'Deposit\', \'bank\': \'okpay\'
            })) }}
        </div>
        <div class="col-md-6">
            {{ render(controller(\'BtcAccountBundle:Default:bankPaymentFees\', {
            \'type\': \'Withdrawal\', \'bank\': \'okpay\'
            })) }}
        </div>
    </div>',
            'en'
        ]
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
