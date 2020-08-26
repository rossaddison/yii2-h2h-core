

By editing the **Instruction list** table under **settings** which appears as a **dropdown** in the Daily Cleans list of houses. Each house that has been transferred to the Salesorderdetails or Daily Clean details has a **specific code** from the Instruction list. eg. FBS which stands for Front, Back and Sides. Also you can change attributes or descriptions under frontend/models to give a more personal feel to your business. 

The House is the customer. So there is **no Customer database because it is a cash business.** House is actually a **frontend/models/Product** according to the Adventure Works hierarchy of **Productcategory (Postcode)**, **Productsubcategory (Street)**, and **Product (House)**. This helps quick searching. Similarly **SalesorderHeader (Daily Clean)**, **SalesorderDetail (Individual cleans for that particular day).** 

This database relational design works hand in glove with **Kartik-v's** three tiered **dependency dropdown**. This thee tiered functionality works perfectly well in the Search Models and also in Kartik's grid's filters enabling quick retrieval of house records.

The Default is **shared hosting** with a subscription through **paypal's rest-api-sdk***. 
**10** companies/divisions/units can signup to your site. Users all get a **Free Subscription Privilege permission** from either their **Udb role for employees** or their **Mdb role for managers**. All Udb roles fall under the **employee role**. All Mdb roles fall under the **support role**. As a result the **paypal** service config details do **not** have to be setup if all users keep their **Subscription Free Privilege**. (frontend/modules/subscription/components/Configpaypal).

Each database works separately from the others. Each database shares the frontend code. How does this happen? Each model has the userDb() function. This function gives a database to  a user at login by using the function **frontend/components/ Utiilites::userLogin_set_database**. When the user registers, the administrator must match a role to the user . Each database has 2 roles. **eg. Mdb1 and Udb1 for db1** . Both have the permission **Access db1**. So when the administrator matches the user to a role eg. Udb1, and makes this connection 'active', the user can access db1.  

The first user to sign up gets the admin role. Admin matches all users of companies or divisions to role.   [Back](/md/faq/faqs.md)
