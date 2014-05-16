<?php

/*
 * This file is part of the Symfony package.
 *
 * (c) Fabien Potencier <fabien.potencier@symfony-project.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Symfony\Component\Security\Acl\Domain;

use Symfony\Component\Security\Acl\Model\AclInterface;
use Symfony\Component\Security\Acl\Model\AuditableEntryInterface;
use Symfony\Component\Security\Acl\Model\EntryInterface;
use Symfony\Component\Security\Acl\Model\SecurityIdentityInterface;

/**
 * Auditable ACE implementation
 *
 * @author Johannes M. Schmitt <schmittjoh@gmail.com>
 */
class Entry implements AuditableEntryInterface
{
    protected $acl;
    protected $mask;
    protected $id;
    protected $securityIdentity;
    protected $strategy;
    protected $auditFailure;
    protected $auditSuccess;
    protected $granting;

    /**
     * Constructor
     *
     * @param integer $id
     * @param AclInterface $acl
     * @param SecurityIdentityInterface $sid
     * @param string $strategy
     * @param integer $mask
     * @param Boolean $granting
     * @param Boolean $auditFailure
     * @param Boolean $auditSuccess
     */
    public function __construct($id, AclInterface $acl, SecurityIdentityInterface $sid, $strategy, $mask, $granting, $auditFailure, $auditSuccess)
    {
        $this->id = $id;
        $this->acl = $acl;
        $this->securityIdentity = $sid;
        $this->strategy = $strategy;
        $this->mask = $mask;
        $this->granting = $granting;
        $this->auditFailure = $auditFailure;
        $this->auditSuccess = $auditSuccess;
    }

    /**
     * {@inheritDoc}
     */
    public function getAcl()
    {
        return $this->acl;
    }

    /**
     * {@inheritDoc}
     */
    public function getMask()
    {
        return $this->mask;
    }

    /**
     * {@inheritDoc}
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * {@inheritDoc}
     */
    public function getSecurityIdentity()
    {
        return $this->securityIdentity;
    }

    /**
     * {@inheritDoc}
     */
    public function getStrategy()
    {
        return $this->strategy;
    }

    /**
     * {@inheritDoc}
     */
    public function isAuditFailure()
    {
        return $this->auditFailure;
    }

    /**
     * {@inheritDoc}
     */
    public function isAuditSuccess()
    {
        return $this->auditSuccess;
    }

    /**
     * {@inheritDoc}
     */
    public function isGranting()
    {
        return $this->granting;
    }

    /**
     * Turns on/off auditing on permissions denials.
     *
     * Do never call this method directly. Use the respective methods on the
     * AclInterface instead.
     *
     * @param Boolean $boolean
     * @return void
     */
    public function setAuditFailure($boolean)
    {
        $this->auditFailure = $boolean;
    }

    /**
     * Turns on/off auditing on permission grants.
     *
     * Do never call this method directly. Use the respective methods on the
     * AclInterface instead.
     *
     * @param Boolean $boolean
     * @return void
     */
    public function setAuditSuccess($boolean)
    {
        $this->auditSuccess = $boolean;
    }

    /**
     * Sets the permission mask
     *
     * Do never call this method directly. Use the respective methods on the
     * AclInterface instead.
     *
     * @param integer $mask
     * @return void
     */
    public function setMask($mask)
    {
        $this->mask = $mask;
    }

    /**
     * Sets the mask comparison strategy
     *
     * Do never call this method directly. Use the respective methods on the
     * AclInterface instead.
     *
     * @param string $strategy
     * @return void
     */
    public function setStrategy($strategy)
    {
        $this->strategy = $strategy;
    }

    /**
     * Implementation of \Serializable
     *
     * @return string
     */
    public function serialize()
    {
        return serialize(array(
            $this->mask,
            $this->id,
            $this->securityIdentity,
            $this->strategy,
            $this->auditFailure,
            $this->auditSuccess,
            $this->granting,
        ));
    }

    /**
     * Implementation of \Serializable
     *
     * @param string $serialized
     * @return void
     */
    public function unserialize($serialized)
    {
        list($this->mask,
             $this->id,
             $this->securityIdentity,
             $this->strategy,
             $this->auditFailure,
             $this->auditSuccess,
             $this->granting
        ) = unserialize($serialized);
    }
}
