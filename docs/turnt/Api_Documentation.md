Turnt API Documentation
===================

Main reference document for Turnt API server. Contains all the data needed to setup a RESTfull client.

Introduction
------------

API is written in Ruby, using [Sintra](http://www.sinatrarb.com) framework. All the data is stored in a
PostGresSQL database. API is based on REST (Representational State Transfer) architecture style, witch
servers as a CRUD (Create, Read, Update, Delete) interface for manipulating data models, and database content.

+ [Wikipedia](http://en.wikipedia.org/wiki/Representational_state_transfer)
+ [REST api tutorial](http://www.restapitutorial.com)

Authentication
--------------

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

Request Headers
---------------

Request headers must contain Authorization token in order for the request to be validated, otherwise the server
returns error `401`. All the data is transfered in a [json](http://www.json.org) fromat, so `Content-Type` header
should specify `application/json`

```
Authorization: "TOKEN device_id=xxxdevice_idxxx,  api_key=xxxapi_keyxxx"
Content-Type: application/json
```

Request Methods
---------------

Each request spceifies standard HTTP Request Method

+ `GET`
+ `PUT`
+ `DELETE`
+ `POST`

[REST Request Methodsl](http://www.restapitutorial.com/lessons/httpmethods.html)

Response codes
--------------

There are two types of response codes, Http codes are standard response code by a httpe server. Server error
codes are server generated erros status codes saved in `error` object in json response body

### Http

Http codes give information about the http server on receiving a http request. Usually the server will return
`200` on successful request, but the server can still return error or the data returned my not be valid or usable.
The `500` response error often indicates that there is a semantic bug in the code, a parse error or an unexcaped case.

###### Common responses

+ `200` - OK
+ `201` - Created
+ `400` - Bad Request
+ `401` - Unauthorized
+ `403` - Forbidden
+ `404` - Not Found
+ `500` - Internal Server Error

###### What the internet can teach you

+ [HTTP Status Codes ](http://www.restapitutorial.com/httpstatuscodes.html)
+ [Wikipedia](http://en.wikipedia.org/wiki/List_of_HTTP_status_codes)

### Server responses

+ `101` - username is in use
+ `102` - account not found
+ `106` - friend request allready sent

Request URIs
------------

Each request must specify a request method and an url endpoint. It also needs to contain the appropriate
request headers

Url example:

`http://www.server.com/api/login`

### Login
Upon user login in the client side, sends an authentication request to the server.
> POST /login

###### Request body

``` javascript
{
  "username" : (string) "USERNAME"
}
```

+ `"username"`: String containing username sent via authenticated client

###### Response body

``` javascript
{
  "logedIn": (bool) true,
  "accountCreated": (bool) false,
  "accountId": (int) 1
  "error": (int) undefined
}
```

+ `"logedIn"`: Boolean value stating if the login was successfull
+ `"AccountCreated"`: Boolean value stating if a new account was created on login, or user loged in with existing one
+ `"Accountid"`: Id of the account just loged in
+ `"error"`: code describing error in logic
  + `106` - username not found

### Create Account

>PUT /create_account

###### Request body
``` javascript
{
  "username" : (string) "USERNAME"
}
```
+ `"username"`: String containing username sent via authenticated client

###### Response body
``` javascript
{
  "accountCreated": (bool) false,
  "accountId": (int) 1
  "error": (int) undefined
}
```
+ `"AccountCreated"`: Boolean value stating if a new account was created on login, or user loged in with existing one
+ `"Accountid"`: Id of the account just loged in
+ `"error"`: code describing error in logic
  + `101` - username not found


### Get Acconuts
Returns all accounts associated to a device id. Accounts array keyes are account ids

>GET /get_user_accounts

###### Response body
``` javascript
{
  "userAccounts": {
    (int)"4": {
      "id": (int) 1,
      "username": (string) "USERNAME",
      "active": (bool) true,
      "image": (string) "IMAGE_DATA",
      "activated_on": (string)"DATE",
      "deactivated_on": (string)"DATE",
      "user_id": (int) 13,
      "buddies": (array) [
        {
          "id": (int) 1,
          "buddy_account_id": (int) 2,
          "username": (string) "USERNAME_2",
          "confirmed": (bool) false,
          "poked_me": (bool) false,
          "account_id": (int) 1
        }
      ]
    }
  },
  "userAccount": {
    "id": (int) 2,
    "username": (string)"USERNAME_2",
    "active": (bool) true,
    "image": (string) "<IMAGE_DATA>",
    "activated_on": (string) "DATE",
    "deactivated_on": (string) "DATE",
    "user_id": (int) 34,
    "buddies": (array) [
      {
        "id": (int) 2,
        "buddy_account_id": (int) 1,
        "username": (string) "USERNAME",
        "confirmed": (bool) false,
        "poked_me": (bool) false,
        "account_id": (int) 2
      }
    ]
  }
}
```
+ `"id"`: Account id
+ `"username"`: Account username
+ `"active"`: Boolean value stating if a the account is active
+ `"image"`: String containing encoded account profile image data
+ `"activated_on"`: Date when the account was activated
+ `"deactivated_on"`: Date when the account was deactivated
+ `"user_id"`: Id of accounts parent user
+ `"buddies"`: array of account ids and data associated to paticular account

### Account
>GET /get_user_account

###### Request body
``` javascript
{
  "account_id":(int) 5
}
```

###### Response body

``` javascript
{
  {
    "userAccount": {
      "id": (int) 5,
      "username": (string)"USERNAME",
      "active": (bool) true,
      "image": (string) "<IMAGE_DATA>",
      "activated_on": (string) "DATE",
      "deactivated_on": (string) "DATE",
      "user_id": (int) 3,
      "buddies": (array) [
        {
          "id": (int) 5,
          "buddy_account_id": (int) 5,
          "username": (string) "USERNAME_2",
          "confirmed": (bool) false,
          "poked_me": (bool) false,
          "account_id": (int) 4
        }
      ]
    }
  }
}
```

### Delete Account

>POST /delete_user_account

###### Request body

``` javascript
{
  "account_id":(int) 2
}
```

###### Response body

``` javascript
{
  "accountDeleted": (bool) true
}
```

### Send friend request

>PUT /send_buddy_request_for_user_account

###### Request body
``` javascript
{
  "account_id": (int) 4,  
  "target_account_id":(int) 5
}
```

###### Response body

``` javascript
{
  "sentFriendRequest": true,
  "userAccount": {
    "id": (int) 5,
    "username": (string)"USERNAME",
    "active": (bool) true,
    "image": (string) "<IMAGE_DATA>",
    "activated_on": (string) "DATE",
    "deactivated_on": (string) "DATE",
    "user_id": (int) 3,
    "buddies": (array) [
      {
        "id": (int) 5,
        "buddy_account_id": (int) 5,
        "username": (string) "USERNAME_2",
        "confirmed": (bool) false,
        "poked_me": (bool) false,
        "account_id": (int) 4
      }
    ]
  }
}
```

### Confirm friend request

>PUT /confirm_buddy_for_user_account

###### Request body

``` javascript
{
  "account_id": (int) 5,
  "target_account_id":(int) 4
}
```
###### Response body

``` javascript
{
  "buddyConfirmed": true,
  "userAccount": {
    "id": (int) 5,
    "username": (string)"USERNAME",
    "active": (bool) true,
    "image": (string) "<IMAGE_DATA>",
    "activated_on": (string) "DATE",
    "deactivated_on": (string) "DATE",
    "user_id": (int) 3,
    "buddies": (array) [
      {
        "id": (int) 5,
        "buddy_account_id": (int) 5,
        "username": (string) "USERNAME_2",
        "confirmed": (bool) false,
        "poked_me": (bool) false,
        "account_id": (int) 4
      }
    ]
  }
}
```

### Get Friends

>POST /get_buddies_for_user_account

###### Request body

``` javascript
{
  "account_id":(int) 4
}
```

###### Response body

``` javascript
{
  "buddies": [
    {
      "id": 5,
      "buddy_account_id": 5,
      "username": "SimunPaw",
      "confirmed": true,
      "poked_me": false,
      "account_id": 4
    },
    {
      "id": (int) 5,
      "buddy_account_id": (int) 5,
      "username": (string) "USERNAME_2",
      "confirmed": (bool) false,
      "poked_me": (bool) false,
      "account_id": (int) 4
    }
  ]
}
```

### Friend

>POST /get_buddy_for_user_account

###### Request body

``` javascript
{
  "account_id":(int) 4,
  "buddy_account_id":(int( 5
}
```

###### Response body

``` javascript
{
  "buddy": {
    "id": (int) 5,
    "buddy_account_id": (int) 5,
    "username": (string) "USERNAME_2",
    "confirmed": (bool) false,
    "poked_me": (bool) false,
    "account_id": (int) 4
  }
}
```

### Delete Friend

>POST /delete_buddy_from_user_account

###### Request body

``` javascript
{
  "account_id":(int) 1,
  "buddy_account_id":(int) 4
}
```

###### Response body

``` javascript
{
  "buddyDeleted": (bool) true
}
```

### Search friends

>GET /search_buddies

###### Response body

``` javascript
{
  "searchBuddies": [
    {
      "id": (int) 2,
      "buddy_account_id": (int) 1,
      "username": (string) "USERNAME",
      "confirmed": (bool) false,
      "poked_me": (bool) false,
      "account_id": (int) 3
    },
    {
      "id": (int) 5,
      "buddy_account_id": (int) 5,
      "username": (string) "USERNAME_2",
      "confirmed": (bool) false,
      "poked_me": (bool) false,
      "account_id": (int) 4
    }
  ]
}
```

### Poke

>PUT /poke

###### Request body

``` javascript
{
  "account_id": (int) 4,
  "target_account_id":(int) 5
}
```

###### Response body


``` javascript
{
  "userPoked": (bool)true
}
```

### Dismis poke

>PUT /dismiss_poke

###### Request body

``` javascript
{
  "account_id": (int) 5,
  "target_account_id":(int) 4
}
```

###### Response body

``` javascript
{
  "pokeDissmised": (bool)true
}
```


TODO
----
+ Replace create account/friend with save account/friend with internal update or create logic
