<?php

declare(strict_types=1);

namespace Khodal\Contactsus\Plugin;

use Magento\Contact\Model\Mail as ContactMail;
use Magento\Framework\App\Config\ScopeConfigInterface;
use Magento\Store\Model\ScopeInterface;
use Magento\Framework\Mail\Template\TransportBuilder;
use Magento\Framework\Translate\Inline\StateInterface;
use Magento\Store\Model\StoreManagerInterface;
use Magento\Contact\Model\ConfigInterface;

/**
 * Plugin for customizing the behavior of the Contact Mail class.
 */
class MailPlugin
{
    private const XML_PATH_EMAIL_RECIPIENT = 'contact/email/recipient_email';
    private const XML_PATH_EMAIL_RECIPIENTS = 'contact/email/recipient_emails';

    /**
     * @var ScopeConfigInterface
     */
    private $scopeConfig;

    /**
     * @var TransportBuilder
     */
    private $transportBuilder;

    /**
     * @var StateInterface
     */
    private $inlineTranslation;

    /**
     * @var StoreManagerInterface
     */
    private $storeManager;

    /**
     * @var ConfigInterface
     */
    private $contactsConfig;

    /**
     * MailPlugin constructor.
     *
     * @param ScopeConfigInterface $scopeConfig
     * @param TransportBuilder $transportBuilder
     * @param StateInterface $inlineTranslation
     * @param StoreManagerInterface $storeManager
     * @param ConfigInterface $contactsConfig
     */
    public function __construct(
        ScopeConfigInterface $scopeConfig,
        TransportBuilder $transportBuilder,
        StateInterface $inlineTranslation,
        StoreManagerInterface $storeManager,
        ConfigInterface $contactsConfig
    ) {
        $this->scopeConfig = $scopeConfig;
        $this->transportBuilder = $transportBuilder;
        $this->inlineTranslation = $inlineTranslation;
        $this->storeManager = $storeManager;
        $this->contactsConfig = $contactsConfig;
    }

    /**
     * Around plugin for the send method of Contact Mail.
     *
     * @param ContactMail $subject
     * @param callable $proceed
     * @param string $replyTo
     * @param array $variables
     * @return mixed
     */
    public function aroundSend(ContactMail $subject, callable $proceed, string $replyTo, array $variables): mixed
    {
        // Call the original send method first
        $result = $proceed($replyTo, $variables);

        // Retrieve the primary recipient email address
        $recipient = $this->scopeConfig->getValue(self::XML_PATH_EMAIL_RECIPIENT, ScopeInterface::SCOPE_STORE);

        // Retrieve additional recipient email addresses
        $multiRecipient = $this->scopeConfig->getValue(self::XML_PATH_EMAIL_RECIPIENTS, ScopeInterface::SCOPE_STORE);

        // Combine the primary recipient and additional recipients
        $recipients = array_filter(array_unique(array_map('trim', array_merge(
            [$recipient],
            explode(',', $multiRecipient)
        ))));

        // Send the email using TransportBuilder
        $this->inlineTranslation->suspend();
        try {
            $this->transportBuilder
                ->setTemplateIdentifier($this->contactsConfig->emailTemplate())
                ->setTemplateOptions(
                    [
                        'area' => \Magento\Framework\App\Area::AREA_FRONTEND,
                        'store' => $this->storeManager->getStore()->getId()
                    ]
                )
                ->setTemplateVars($variables)
                ->setFrom($this->contactsConfig->emailSender())
                ->addTo($recipients) // Add merged recipients here
                ->setReplyTo($replyTo, $variables['data']['name'] ?? null)
                ->getTransport()
                ->sendMessage();
        } finally {
            $this->inlineTranslation->resume();
        }

        return $result;
    }
}
