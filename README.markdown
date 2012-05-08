#Modules
 * __/polls__ - handle polls, create, get and delete poll
 * __/polls/{id}/questions__ - handle questions for polls
 * __/polls/{id}/questions/{id}/answers__ - handle answers for this question
 * __/users__ -  handle users
 * __/types__ - handle question types, this are used for question templates (@todo, in first step, only use free text and rating types, hardcoded)

##On Error
<<[documentation/error.markdown]

##Authentification
<<[documentation/authentification.markdown]

##Polls
Handles polls.
<<[documentation/polls.markdown]

##Questions
<<[documentation/questions.markdown]

##Answers
<<[documentation/answers.markdown]

##Users
Handles users
<<[documentation/users.markdown]

##Groups
<<[documentation/groups.markdown]

##Types
Types are templates for questions.
<<[documentation/types.markdown]



##TODO
* data formats
* on error
* numFound for each items