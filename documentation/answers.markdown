###GET
Get an answers for given question, identified by _id_.
If no _id_ is given, it return all answers, limited by _rows_ and starting by _offset_.

####Parameters
* rows - how many entries should return, only necessary if no _id | name_ where given.
* offset - where to start the query, only necessary if no _id | name_ where given.

_**GET /polls/1337/questions/1/answers**_
<<(documentation/answers/get.index.json)

_**GET /polls/1337/questions/1/answers/1**_
<<(documentation/answers/get.1.json)


###POST
Creates a new answer for this question.

_**POST /polls/1337/questions/1/answers - REQUEST**_
<<(documentation/answers/post.request.json)

_**POST /polls/1337/questions/1/answers - RESPONSE**_
<<(documentation/answers/post.response.json)

###PUT
Updates an existing answer for this question.

_**PUT /polls/1337/questions/1/answers - REQUEST**_
<<(documentation/answers/put.request.json)
_**PUT /polls/1337/questions/1/answers - RESPONSE**_
<<(documentation/answers/put.response.json)

###DELETE
Deletes answer with _id_ for this question.

_**DELETE /polls/1337/questions/1/answers/1**_
<<(documentation/answers/delete.1.json)