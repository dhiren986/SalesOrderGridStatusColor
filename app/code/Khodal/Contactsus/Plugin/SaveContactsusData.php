<?php

declare(strict_types=1);

namespace Khodal\Contactsus\Plugin;

use Magento\Framework\Exception\LocalizedException;
use Khodal\Contactsus\Model\ContactusFactory;
use Magento\Contact\Controller\Index\Post as ContactPost;

/**
 * Plugin for saving contact us data.
 *
 * This plugin intercepts the execute method of the ContactPost controller
 * to save contact us data to the database.
 */
class SaveContactsusData
{
    /**
     * @var ContactusFactory
     */
    private ContactusFactory $contactusFactory;

    /**
     * Plugin constructor.
     *
     * @param ContactusFactory $contactusFactory
     */
    public function __construct(
        ContactusFactory $contactusFactory
    ) {
        $this->contactusFactory = $contactusFactory;
    }

    /**
     * Around plugin for the execute method of the ContactPost controller.
     *
     * @param ContactPost $subject
     * @param \Closure $proceed
     * @return mixed
     */
    public function aroundExecute(ContactPost $subject, \Closure $proceed)
    {
        $request = $subject->getRequest()->getPostValue();

        if ($this->validatedParams($request)) {
            $contactus = $this->contactusFactory->create();
            $contactus->setData($request);
            $contactus->save();
        }

        // Call the original execute method
        return $proceed();
    }

    /**
     * Validate contact us form parameters.
     *
     * @param array $request
     * @return array
     * @throws LocalizedException
     */
    private function validatedParams(array $request): array
    {
        if (trim($request['name']) === '') {
            throw new LocalizedException(__('Enter the Name and try again.'));
        }
        if (trim($request['comment']) === '') {
            throw new LocalizedException(__('Enter the comment and try again.'));
        }
        if (false === strpos($request['email'], '@')) {
            throw new LocalizedException(__('The email address is invalid. Verify the email address and try again.'));
        }
        if (trim($request['hideit']) !== '') {
            throw new LocalizedException(__('Invalid field value.'));
        }
        return $request;
    }
}
