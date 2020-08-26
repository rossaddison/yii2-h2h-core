

By editing the **Instruction list** table under **settings** which appears as a **dropdown** in the Daily Cleans list of houses. Each house that has been transferred to the Salesorderdetails or Daily Clean details has a **specific code** from the Instruction list. eg. FBS which stands for Front, Back and Sides. Also you can change attributes or descriptions under frontend/models to give a more personal feel to your business. 

The House is the customer. So there is **no Customer database because it is a cash business.** House is actually a **frontend/models/Product** according to the Adventure Works hierarchy of **Productcategory (Postcode)**, **Productsubcategory (Street)**, and **Product (House)**. This helps quick searching. Similarly **SalesorderHeader (Daily Clean)**, **SalesorderDetail (Individual cleans for that particular day).** 

This database relational design works hand in glove with **Kartik-v's** three tiered **dependency dropdown**. This thee tiered functionality works perfectly well in the Search Models and also in Kartik's grid's filters enabling quick retrieval of house records.

All Udb roles fall under the **employee role**. All Mdb roles fall under the **support role**. 

The first user to sign up gets the admin role. [Back](/md/faq/faqs.md)
