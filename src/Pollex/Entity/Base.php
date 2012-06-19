<?php

namespace Pollex\Entity;

/**
* @HasLifecycleCallbacks
* @MappedSuperclass
*/
abstract class Base
{
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
        $fullClass = get_class($this);
        $parts = preg_split('/\\\\/', $fullClass);

        return strtolower(array_pop($parts));
    }

    public function getUrlParts()
    {
        //@todo get parts by namespace, by stripping \Pollex\Entity
        $parts = array(
            $this->_pluralizeForUrl($this->getType()),
            $this->getid()
        );

        return $parts;
    }

    public function getUrl()
    {
        $urlParts =  array(
            $this->_pluralizeForUrl($this->getType()),
            $this->getid()
        );

        $url =  '/' . implode('/', $urlParts);

        return $url;
    }

    protected function _pluralizeForUrl($base)
    {
        return $base . 's';
    }
}