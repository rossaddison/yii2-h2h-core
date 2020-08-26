The first user to signup is automatically assigned the administrator or 'admin' role. This is as a result of employing **sjaakp/pluto** security login. There is no need to use the **Mdb0** or manager roles because the administrator is the manager.  [Back](/md/faq/faqs.md)

The admin role by default accesses the default db database because it is assigned the 'Access db' permission.  

Setup a Udb role similar to Udb1 for your employee with appropriate permissions. Signup your employee and assign the **Udb0** role to them. Make sure you have assigned the **'Access db'** permission to this user.  [Back](/md/faq/faqs.md)

**You will not need to setup the Mdb0 role.** The admin role by default has all the permissions that a manager has with their support role.  

You will be limiting this user to only being able to see what has to be cleaned for the day. Access the RBAC GUI and you will see all the Mdb and Udb roles for this purpose.  [Back](/md/faq/faqs.md)

The **Mdb# role** is used for the **manager** of a specific company/division and the **Udb# role** is used for employees.

All **Mdb roles** are linked to the **'support' role** so change the support role 'makeup' if you want this to be applicable to all
managers.

All **Udb roles** are linked to the **'employee' role** so change the employee role 'makeup' if you want this to be applicable to all
employees.
