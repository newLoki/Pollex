<?php
namespace Pollex\Entity;

/**
* @Entity
* @Table(name="types")
*/
class Type extends \Pollex\Entity\Base
{
    /**
     * @Column(type="string", name="name")
     * @var string
     */
    protected $name;

    /**
     * Set name for this type
     *
     * @param string $name
     */
    public function setName($name)
    {
        $this->name = $name;
    }

    /**
     * Get type name
     *
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }
}