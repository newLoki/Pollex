---
layout: default
title: Questions Controller
summary: API Documentation for questions controller
categories: api

---
###GET
Return all questions on given poll, count is _rows_ and start is on _offset_, which is 0 by default
####Parameters
* rows - how many entries should return, only necessary if no _id | name_ where given (_default: 10_)
* offset - where to start the query, only necessary if no _id | name_ where given (_default: 0_)

_**[GET /polls/1337/questions?rows=2&offset=0](https://github.com/newLoki/Pollex/blob/master/documentation/questions/get.index.json.html)**_

_**[GET /polls/1337/questions/1](https://github.com/newLoki/Pollex/blob/master/documentation/questions/get.1.json.html)**_

###POST
Creates a new question on this poll.
####Types
Types are templates for questions, which give the possibility to validate answers on this question and which have config options for
the frontend.
For more information look at the _Types_ section.

_**[POST /polls/1337/questions - REQUEST](https://github.com/newLoki/Pollex/blob/master/documentation/questions/post.request.json.html)**_

_**[POST /polls/1337/questions - RESPONSE](https://github.com/newLoki/Pollex/blob/master/documentation/questions/post.response.json.html)**_

###PUT
Updates a question on this poll.
If question with given _id_ doesn't exists, there will be raise up an error.

_**[PUT /polls/1337/questions - REQUEST](https://github.com/newLoki/Pollex/blob/master/documentation/questions/put.request.json.html)**_

_**[PUT /polls/1337/questions - RESPONSE](https://github.com/newLoki/Pollex/blob/master/documentation/questions/put.response.json.html)**_


###DELETE
Deletes the question, identified by _id_.

_**[DELETE /polls/1337/questions/1](https://github.com/newLoki/Pollex/blob/master/documentation/polls/delete.1.json.html)**_