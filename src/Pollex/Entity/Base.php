<?php

namespace Pollex\Entity;

/**
* @Entity @Table(name="polls")
* @HasLifecycleCallbacks
*/
abstract class Base
{
    const TYPE = 'base';

    /**
     * @Id
     * @Column(type="integer")
     * @GeneratedValue(strategy="AUTO")
     * @var int
     **/
    protected $id;

    /**
     * @Column(type="datetime")
     * @var \DateTime
     */
    protected $created;

    /**
     * @Column(type="datetime")
     * @var \DateTime
     */
    protected $updated;

    /**
     * Set created date to now, if a new object is constructed
     * (this is not called on hydration)
     *
     * @return void
     */
    public function __construct()
    {
        $this->created = new \DateTime();
    }

    /**
     * Set updated field to now()
     * @PrePersist
     */
    public function createUpdateDateTime()
    {
        $this->updated = new \DateTime();
    }

    /**
     * Return, when entity was created
     *
     * @return \DateTime
     */
    public function getCreated()
    {
        return $this->created;
    }

    /**
     * Return when entity was updated last time
     *
     * @return \DateTime
     */
    public function getUpdated()
    {
        return $this->updated;
    }

    /**
     * Return unique identifier for entity
     *
     * @return int
     */
    public function getid()
    {
        return $this->id;
    }

    /**
     * Set id for this entity (commonly for testing reasons)
     *
     * @param int $id
     */
    public function setId($id)
    {
        $this->id = (int) $id;
    }

    public function getType()
    {
        return static::TYPE;
    }

    public function getUrl()
    {
        return '/' . static::TYPE . 's' . '/' . $this->getid();
    }
}