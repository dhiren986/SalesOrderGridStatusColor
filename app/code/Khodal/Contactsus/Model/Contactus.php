<?php
/**
 * Copyright ©  All rights reserved.
 * See COPYING.txt for license details.
 */
declare(strict_types=1);

namespace Khodal\Contactsus\Model;

use Khodal\Contactsus\Api\Data\ContactusInterface;
use Magento\Framework\Model\AbstractModel;

class Contactus extends AbstractModel implements ContactusInterface
{

    /**
     * @inheritDoc
     */
    public function _construct()
    {
        $this->_init(\Khodal\Contactsus\Model\ResourceModel\Contactus::class);
    }

    /**
     * @inheritDoc
     */
    public function getContactusId()
    {
        return $this->getData(self::CONTACTUS_ID);
    }

    /**
     * @inheritDoc
     */
    public function setContactusId($contactusId)
    {
        return $this->setData(self::CONTACTUS_ID, $contactusId);
    }

    /**
     * @inheritDoc
     */
    public function getName()
    {
        return $this->getData(self::NAME);
    }

    /**
     * @inheritDoc
     */
    public function setName($name)
    {
        return $this->setData(self::NAME, $name);
    }

    /**
     * @inheritDoc
     */
    public function getTelephone()
    {
        return $this->getData(self::TELEPHONE);
    }

    /**
     * @inheritDoc
     */
    public function setTelephone($telephone)
    {
        return $this->setData(self::TELEPHONE, $telephone);
    }

    /**
     * @inheritDoc
     */
    public function getEmail()
    {
        return $this->getData(self::EMAIL);
    }

    /**
     * @inheritDoc
     */
    public function setEmail($email)
    {
        return $this->setData(self::EMAIL, $email);
    }

    /**
     * @inheritDoc
     */
    public function getComment()
    {
        return $this->getData(self::COMMENT);
    }

    /**
     * @inheritDoc
     */
    public function setComment($comment)
    {
        return $this->setData(self::COMMENT, $comment);
    }
}

