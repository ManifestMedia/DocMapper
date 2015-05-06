Turnt Documentation
==============

Turn is an anonymous iOs chat application. Written in swift for iOs 7 or later. The app haveally
relies on REST server side for data managment and websocket server for chat communication. This documentation
is divided in 2 mayor parts, the server side, and client side.

Introduction
------------

Turnt iOs application allows a user to install the app and instantly create a chat account with a random username,
provided that the username isn't already in use. The user can than choose from a list of other anonymouse users
and start a chat.

Server side provides REST interface for managing database records and communication between the apps. It also
provides web socket server for serving chat rooms.


Client apps
-----------

### iOS

On installation user generates a unique id, upon all of his accounts, created in the app, are
associated. Application is free for download but is limited to a single chat account, up to 5 accounts can be purchased as a part of an in app purchase.

User can register for chat each time with a different username, up to maximum 5 possible accounts. If the username has allready been taken, he will be prompted to choose another username. The application doesn't doesn't require any personal data at any moment.

User can then add any number of friend accounts to any of his chat accounts. He can start a single
active chat room at the time, where user can send instant text messages, send pictures, or a 10 second video. All the messages, images, or videos are deleted upon exiting the chat room.
During chat sessions, text messages are never stored on the serves or on the client, all the multimedia content is deleted after the receiver has viewed them.

For more detailed user manual and class list got to iOs Client part of documenation

> [iOs Client Documentation >](ios_client.html)

Server side
-----------
Server is used as CRUD REST server interface, for manipulating database rescords, Websocket server for managing chat rooms and 2-way client communication, and as a website. Server is writte in Ruby using [Sintra](http://www.sinatrarb.com) framework.

### Chat Server

Chat server relies on [sinatra-websocket](https://github.com/simulacre/sinatra-websocket) gem for creating socket connections to the clients.I also manages and creates chat rooms for individual chats. Chat server resides on url:

> http://www.servername.com/chat/

> [Chat Server Documentation coming soon! >]()

### API

REST api is used as a CRUD(*Create, Read, Update, Delete*) interface for managaing database records. For more detailed API documentation read up on the offical API documentation

> http://www.servername.com/api/

> [Turnt API Documentation >](api.html)

### Authentication  

Authentication is preformed using Http `Authorization:` Request-Header Filed witch contains a string
like the one provided.
```
Authorization: "TOKEN device_id=xxxdevice_idxxx,  api_key=xxxapi_keyxxx"
```
Authorization string starts with the keyword `TOKEN` and contains `device_id` and `api_key`. `device_id` is
generated on the client and is generated upon installing a client, or registering trough a new client. `api_key` is
also generted on a client and is used for the two part authentication in combination with `device_id`.

No personal data is sent or stored on the server, since no email or personal data is required to create new account.
Only prequisit for registering new account is that the username is not already used, or that the maximum available
of accounts per client isn't exceeded.

Authorization token is checked on each sent request.

### Request headers

Request headers must contain Authorization token in order for the request to be validated, otherwise the server
returns error `401`. All the data is transfered in a [json](http://www.json.org) fromat, so `Content-Type` header
should specify `application/json`

```
Authorization: "TOKEN device_id=xxxdevice_idxxx,  api_key=xxxapi_keyxxx"
Content-Type: application/json
```


TODO
----
+ Designe pattern 
+ Http requests test
+ Socket requests test
+ Basic architecture and folder structure
+ Data models
+ Controllers
+ Views