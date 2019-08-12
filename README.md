# suitecrm_v8_api_btactic_doc

## 1.-  How to configure authentication, obtaining a session and chosing grant types in V8 api suitecrm.

<h3>There are two types of grant:</h3>

Firstly for any of the two grants, you must go into the admin panel of the suitecrm instance and search for `OAuth2 Clients and Tokens`. After that in the top-left corner you must see the following types of grants/clients.

![Grant_Types](https://github.com/btactic/suitecrm_v8_api_btactic_doc/blob/master/images/Point_1_1.png)

The difference between them are that the first one is focused on letting acces into crm for machines or services, whilist the other is more focused on letting users acces the application.

<h4>Client Credential Grant:</h4>

![Client_Credential](https://github.com/btactic/suitecrm_v8_api_btactic_doc/blob/master/images/Point_1_2.png)

<h4>Password Grant:</h4>

![Password_Credential](https://github.com/btactic/suitecrm_v8_api_btactic_doc/blob/master/images/Point_1_3.png)

## 2.- How to configure the user to only have permissions to create (create + check if it is easier for you) only objects from the accounts module.

<h3> Steps to follow in order to limit a user to only create accounts: </h3>

1. As an admin, create the user that will have the accounts limitation.
![Point 2 1](https://github.com/btactic/suitecrm_v8_api_btactic_doc/blob/master/images/Point_2_1.png)

2. As an admin, create the role that will have the permitions.
![Point 2 2](https://github.com/btactic/suitecrm_v8_api_btactic_doc/blob/master/images/Point_2_2.png)

3. In the following screens after the creation of the role, you will have to select that every option to be "Disabled" or "None", except for the Access option in the Accounts, which should be "Enabled" module and the Edit option in the same module, which should be "All".
![Point 2 3](https://github.com/btactic/suitecrm_v8_api_btactic_doc/blob/master/images/Point_2_3.png)

4. Assign the role to the user in question.
![Point 2 4](https://github.com/btactic/suitecrm_v8_api_btactic_doc/blob/master/images/Point_2_4.png)

5. If needed, you can create a security group that has said role assigned to it.
