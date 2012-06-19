<?php

namespace Pollex\Entity\Poll;

/**
 * @Entity
 * @Table(name="questions")
 */
class Question extends \Pollex\Entity\Base
{
    /**
     * @Column(type="string")
     * @var string
     */
    protected $title;

    /**
     * @param string $title
     */
    public function setTitle($title)
    {
        $this->title = $title;
    }

    /**
     * @return string
     */
    public function getTitle()
    {
        return $this->title;
    }
}