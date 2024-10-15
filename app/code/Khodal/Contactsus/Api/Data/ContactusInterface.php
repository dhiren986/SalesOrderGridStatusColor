<?php
/**
 * Copyright ©  All rights reserved.
 * See COPYING.txt for license details.
 */
declare(strict_types=1);

namespace Khodal\Contactsus\Api\Data;

interface ContactusInterface
{

    const EMAIL = 'email';
    const CONTACTUS_ID = 'contactus_id';
    const NAME = 'name';
    const COMMENT = 'comment';
    const TELEPHONE = 'telephone';

    /**
     * Get contactus_id
     * @return string|null
     */
    public function getContactusId();

    /**
     * Set contactus_id
     * @param string $contactusId
     * @return \Khodal\Contactsus\Contactus\Api\Data\ContactusInterface
     */
    public function setContactusId($contactusId);

    /**
     * Get name
     * @return string|null
     */
    public function getName();

    /**
     * Set name
     * @param string $name
     * @return \Khodal\Contactsus\Contactus\Api\Data\ContactusInterface
     */
    public function setName($name);

    /**
     * Get telephone
     * @return string|null
     */
    public function getTelephone();

    /**
     * Set telephone
     * @param string $telephone
     * @return \Khodal\Contactsus\Contactus\Api\Data\ContactusInterface
     */
    public function setTelephone($telephone);

    /**
     * Get email
     * @return string|null
     */
    public function getEmail();

    /**
     * Set email
     * @param string $email
     * @return \Khodal\Contactsus\Contactus\Api\Data\ContactusInterface
     */
    public function setEmail($email);

    /**
     * Get comment
     * @return string|null
     */
    public function getComment();

    /**
     * Set comment
     * @param string $comment
     * @return \Khodal\Contactsus\Contactus\Api\Data\ContactusInterface
     */
    public function setComment($comment);
}

