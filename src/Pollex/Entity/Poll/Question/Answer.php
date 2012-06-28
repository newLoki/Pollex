<?php

namespace Pollex\Entity\Poll\Question;

/**
 * @Entity
 * @Table(name="answers")
 */
class Answer extends \Pollex\Entity\Base
{
    /**
     * @Column(type="integer", name="question_id")
     * @ManyToOne(targetEntity="\Pollex\Entity\Poll\Question")
     * @JoinColumn(name="question_id", referencedColumnName="id")
     * @var \Pollex\Entity\Poll\Question
     */
    protected $question;

    /**
     * @Column(type="integer", name="type_id")
     * @ManyToOne(targetEntity="\Pollex\Entity\Type")
     * @JoinColumn(name="type_id", referencedColumnName="id")
     * @var \Pollex\Entity\Type
     */
    protected $type;

    /**
     * @Column(type="integer", name="poll_id")
     * @ManyToOne(targetEntity="\Pollex\Entity\Poll")
     * @JoinColumn(name="poll_id", referencedColumnName="id")
     * @var \Pollex\Entity\Poll
     */
    protected $poll;

    /**
     * @Column(type="integer", name="value")
     * @var string
     */
    protected $value;

    /**
     * set question which is related to this answers
     *
     * @param \Pollex\Entity\Poll\Question $question
     */
    public function setQuestion(\Pollex\Entity\Poll\Question $question)
    {
        $this->question = $question;
    }

    /**
     * Get question, related to this answer
     *
     * @return \Pollex\Entity\Poll\Question
     */
    public function getQuestion()
    {
        return $this->question;
    }

    public function getUrlParts()
    {
        $questionParts = $this->question->getUrlParts();
        $answerParts = array(
            $this->_pluralizeForUrl($this->getEntityType()),
            $this->getId()
        );

        return array_merge($questionParts, $answerParts);
    }

    /**
     * Set question type to which this answers is related to
     *
     * @param \Pollex\Entity\Type $type
     */
    public function setType(\Pollex\Entity\Type $type)
    {
        $this->type = $type;
    }

    /**
     * Get type of this answer
     *
     * @return \Pollex\Entity\Type
     */
    public function getType()
    {
        return $this->type;
    }

    /**
     * Set poll to which this answer is related to
     *
     * @param \Pollex\Entity\Poll $poll
     */
    public function setPoll(\Pollex\Entity\Poll $poll)
    {
        $this->poll = $poll;
    }

    /**
     * Get poll, related to this answers
     *
     * @return \Pollex\Entity\Poll
     */
    public function getPoll()
    {
        return $this->poll;
    }

    /**
     * Set value of this answer
     *
     * @param string $value
     */
    public function setValue($value)
    {
        $this->value = (string) $value;
    }

    /**
     * Get value of this question
     *
     * @return string
     */
    public function getValue()
    {
        return (string) $this->value;
    }
}