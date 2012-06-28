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
}