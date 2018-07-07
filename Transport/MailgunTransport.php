<?php namespace Btc\CoreBundle\Transport;

use Mailgun\Mailgun;
use Mailgun\Messages\MessageBuilder;
use Monolog\Logger;
use Swift_ByteStream_FileByteStream;
use Swift_Events_EventListener;
use Swift_Mime_Message;
use Swift_Transport;
use Swift_TransportException;

/**
 * Class MailgunTransport
 */
class MailgunTransport implements Swift_Transport
{
    private $domain;
    private $mailgun;
    private $logger;

    public function __construct($domain, $apiKey, Logger $logger)
    {
        $this->domain  = $domain;
        $this->mailgun = new Mailgun($apiKey);
        $this->logger  = $logger;
    }

    /**
     * @inheritdoc
     */
    public function send(Swift_Mime_Message $swiftMessage, &$failedRecipients = null)
    {
        /** @var MessageBuilder $message */
        $message = $this->mailgun->MessageBuilder();

        foreach ($swiftMessage->getChildren() as $file) {
            if ($file instanceof Swift_ByteStream_FileByteStream) {
                $message->addAttachment($file->getPath());
            }
        }

        $message->setSubject($swiftMessage->getSubject());
        $message->setFromAddress(key($swiftMessage->getFrom()));
        $message->addToRecipient(key($swiftMessage->getTo()));
        $message->setHtmlBody($swiftMessage->getBody());

        try {
            $log = $this->mailgun->sendMessage($this->domain, $message->getMessage(), $message->getFiles());
            if ($log->http_response_code != 200) {
                $body = $log->http_response_body;
                $this->logger->error(json_encode(['message' => $body->message, 'id' => $body->id]));
            }
        } catch (\Exception $ex) {
            $this->logger->error($ex->getMessage(), ['service' => 'mailgun']);
            throw $ex;
        }
    }

    /**
     * @inheritdoc
     */
    public function registerPlugin(Swift_Events_EventListener $plugin)
    {
    }

    /**
     * Not used.
     */
    public function isStarted()
    {
        return true;
    }

    /**
     * Not used.
     */
    public function start()
    {
    }

    /**
     * Not used.
     */
    public function stop()
    {
    }

    /**
     * @param mixed $domain
     * @return $this
     */
    public function setDomain($domain)
    {
        $this->domain = $domain;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getDomain()
    {
        return $this->domain;
    }
}
