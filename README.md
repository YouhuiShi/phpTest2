#TEST PROJECT
##Shopping List 
###About the test
This is a test in basic backend/frontend development abilities.
This document consists of a short specification for a small web application that you need to develop. 
The specification is intentionally kept very short in an attempt the keep the amount of time required to complete the
test at a minimum. 
You have to develop both the backend system and the frontend for the application. Your
choice of technology (platforms, frameworks, programming language) for this test is completely up to you. We
want to test your skills as a developer, so we do not want you to spend time struggling with technologies that
you do not know. You should choose whatever makes you feel the most at home.
###Specification
The program you need to develop is a simple shopping list application backend and frontend. The shopping list
draws data from a simple REST API (specified below in the API section). The API has been simplified to contain
only the bare minimum of functionality required to complete this test.
The basic requirements are as follows:
*The application must get the content of the shopping list available from the API at each launch/load.
* It must be possible to perform two operations on the list: add an item and delete an item.
In addition, the following non-mandatory suggestions could be followed:
* All the functionality of the application should fit on one page.
* The API documentation below is just a suggestion. If you feel you can do better or smarter you are
welcome to do it differently.

##API documentation
As this test is not supposed to take up too much of your time, the API has been simplified as much as possible.
You do not need to make an authentication mechanism, and only the bare minimum of fields required to
complete the task should be available in the API. There are three API calls available for getting a list, adding an
item to a list, and removing an item for the list.
###GET the shoppinglist
Endpoint /list/{listid}


HTTP method GET

Returns JSON list of items

```
Response example [
 {
 "id": 1,
 "name": "bananas",
 },
 {
 "id": 2,
 "name": “root beer",
 }
]
```
###POST a new item
Endpoint /list/{listid}/products?name={productname}

HTTP method POST

Parameters Query string with parameter: name

Request example /list/{listid}/products?name=Cucumber

```
Response example {
 "status": "success",
 "data": {
 "id": 12,
 "name": "Cucumber"
 }
}
```

###DELETE an item
Endpoint https://novasa.com/api/job/list/{listid}/products/{productid}

HTTP method DELETE

Parameters URL path with id of item to delete

Request example list/{listid}/products/7

```
Response example {
 "success": true
}
```

#Run application
In console:
php bin/console server:run

In browser:
http://127.0.0.1:8000/

