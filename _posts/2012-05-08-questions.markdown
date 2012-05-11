---
layout: default
title: Questions Controller
summary: API Documentation for questions controller
categories: api

---
###GET
Return all questions on given poll, count is _rows_ and start is on _offset_, which is 0 by default
####Parameters
* rows - how many entries should return, only necessary if no _id_ where given (_default: 10_)
* offset - where to start the query, only necessary if no _id_ where given (_default: 0_)

_**[GET /polls/1337/questions?rows=2&offset=0](https://github.com/newLoki/Pollex/blob/gh-pages/_includes/mockups/json/questions/get.index.json)**_
<pre class="brush: js">    {% include mockups/json/questions/get.index.json %}
</pre>

_**[GET /polls/1337/questions/1](https://github.com/newLoki/Pollex/blob/gh-pages/_includes/mockups/json/questions/get.1.json)**_
<pre class="brush: js">    {% include mockups/json/questions/get.1.json %}
</pre>

###POST
Creates a new question on this poll.
####Types
Types are templates for questions, which give the possibility to validate answers on this question and which have config options for
the frontend.
For more information look at the _Types_ section.

_**[POST /polls/1337/questions - REQUEST](https://github.com/newLoki/Pollex/blob/gh-pages/_includes/mockups/json/questions/post.request.json)**_
<pre class="brush: js">    {% include mockups/json/questions/post.request.json %}
</pre>

_**[POST /polls/1337/questions - RESPONSE](https://github.com/newLoki/Pollex/blob/gh-pages/_includes/mockups/json/questions/post.response.json)**_
<pre class="brush: js">    {% include mockups/json/questions/post.response.json %}
</pre>

###PUT
Updates a question on this poll.
If question with given _id_ doesn't exists, there will be raise up an error.

_**[PUT /polls/1337/questions/1 - REQUEST](https://github.com/newLoki/Pollex/blob/gh-pages/_includes/mockups/json/questions/put.request.json)**_
<pre class="brush: js">    {% include mockups/json/questions/put.request.json %}
</pre>

_**[PUT /polls/1337/questions/1 - RESPONSE](https://github.com/newLoki/Pollex/blob/gh-pages/_includes/mockups/json/questions/put.response.json)**_
<pre class="brush: js">    {% include mockups/json/questions/put.response.json %}
</pre>

###DELETE
Deletes the question, identified by _id_.

_**[DELETE /polls/1337/questions/1](https://github.com/newLoki/Pollex/blob/gh-pages/_includes/mockups/json/polls/delete.1.json)**_
<pre class="brush: js">    {% include mockups/json/questions/delete.1.json %}
</pre>