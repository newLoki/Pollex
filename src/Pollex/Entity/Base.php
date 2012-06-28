<?php

namespace Pollex\Entity;

/**
* @HasLifecycleCallbacks
* @MappedSuperclass
*/
abstract class Base
{
    const DATE_FORMAT = 'Y-m-d\TH:i:s';

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
    public function getId()
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

    /**
     * Return the type of the entity
     *
     * @return string
     */
    public function getEntityType()
    {
        $fullClass = get_class($this);
        $parts = preg_split('/\\\\/', $fullClass);

        return strtolower(array_pop($parts));
    }

    /**
     * Return all parts as array for building an url to this entity
     *
     * @return array
     */
    public function getUrlParts()
    {
        $parts = array(
            $this->_pluralizeForUrl($this->getEntityType()),
            $this->getId()
        );

        return $parts;
    }

    /**
     * Return url to this entity
     *
     * @return string
     */
    public function getUrl()
    {
        $urlParts =  $this->getUrlParts();

        $url =  '/' . implode('/', $urlParts);

        return $url;
    }

    /**
     * pluralizes a string for preparing url parts
     *
     * @param $base
     * @return string
     */
    protected function _pluralizeForUrl($base)
    {
        return $base . 's';
    }

    /**
     * Return a obeject representation for this entity
     *
     * @return \stdClass
     */
    public function getOutputObject()
    {
        $entityProperties = new \stdClass();
        $entityProperties->id = $this->getId();
        $entityProperties->url = $this->getUrl();
        $entityProperties->created = $this->getCreated()->format(self::DATE_FORMAT);
        $entityProperties->updated = $this->getUpdated()->format(self::DATE_FORMAT);

        return $entityProperties;
    }
}