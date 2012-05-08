###GET {id | name}
Return a given poll, identified by _id_ or by _name_ (which will be return a 301 to _id_)
If no _id_ and no _name_ is given, it will return new newest entries, limited by _rows_ parameter and starting by _offset_

####Parameters
* rows - how many entries should return, only necessary if no _id | name_ where given.
* offset - where to start the query, only necessary if no _id | name_ where given.

_**GET /polls/1337**_
<<(documentation/polls/get.1337.json)

_**GET /polls?rows=2&offset=0**_
The parameter _offset_ can be leaved, because default to start is 0.

<<(documentation/polls/get.index.json)


###POST
Will create a new poll
_**POST /polls - REQUEST**_
<<(documentation/polls/post.request.json)

_**POST /polls - RESPONSE**_
<<(documentation/polls/post.response.json)

###PUT
Will return an error, if poll with given id doesn't exists
_**PUT /polls - REQUEST**_
<<(documentation/polls/put.request.json)

_**PUT /polls - RESPONSE**_
<<(documentation/polls/put.response.json)

###DELETE
Will delete poll (@todo status code for already deleted)
<<(documentation/polls/delete.1337.json)