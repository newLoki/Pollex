###GET
Get an answers for given question, identified by _id_.
If no _id_ is given, it return all answers, limited by _rows_ and starting by _offset_.

####Parameters
* rows - how many entries should return, only necessary if no _id | name_ where given.
* offset - where to start the query, only necessary if no _id | name_ where given.

_**[GET /polls/1337/questions/1/answers?rows=2&offset=0](https://github.com/newLoki/Pollex/blob/master/documentation/answers/get.index.json)**_

_**[GET /polls/1337/questions/1/answers/1](https://github.com/newLoki/Pollex/blob/master/documentation/answers/get.1.json)**_


###POST
Creates a new answer for this question.

_**[POST /polls/1337/questions/1/answers - REQUEST](https://github.com/newLoki/Pollex/blob/master/documentation/answers/post.request.json)**_

_**[POST /polls/1337/questions/1/answers - RESPONSE](https://github.com/newLoki/Pollex/blob/master/documentation/answers/post.response.json)**_

###PUT
Updates an existing answer for this question.

_**[PUT /polls/1337/questions/1/answers - REQUEST](https://github.com/newLoki/Pollex/blob/master/documentation/answers/put.request.json)**_
_**[PUT /polls/1337/questions/1/answers - RESPONSE](https://github.com/newLoki/Pollex/blob/master/documentation/answers/put.response.json)**_

###DELETE
Deletes answer with _id_ for this question.

_**[DELETE /polls/1337/questions/1/answers/1](https://github.com/newLoki/Pollex/blob/master/documentation/answers/delete.1.json)**_