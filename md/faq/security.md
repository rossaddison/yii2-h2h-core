**How does House2house incorporate the security features of Yii2 according to https://www.yiiframework.com/doc/guide/2.0/en/security-overview ?**

   1. **Authentication:** H2H uses sjaakp/pluto's yii\web\IdentityInterface.  [Back](/md/faq/faqs.md)

   1. **Authorization:** All data-input is regulated by the Model View Controller regime providing Access Control Filters to all data-input.
The database has been normalized ensuring efficiency and appropriate integrity constraint provisions filter through to the Controllers.
The package adopts a very cautious approach of **NO ACTION** where relations between tables exist ensuring a **last-in-first-out (LIFO) methodology** and also ensuring the safety of the data provided when attempts are made by unauthorized users to perform delete actions.   [Back](/md/faq/faqs.md)

   1. **Working with passwords:** All login passwords must contain an uppercase, lowercase, and one digit mix.

   1. **Cryptography:** The sjaakp/pluto/models/User  uses the yii\web\IdentityInterface. Also it uses the following function:
   
          public function encryptPassword($attribute, $params)
          {
          $this->password_hash = Yii::$app->security->generatePasswordHash($this->$attribute);
          } 
      
      This function incorporates the **Blowfish hash algorithm** by default through Yii2.  The **$cost** parameter can be added to the above GeneratePasswordHash parameters.   [Back](/md/faq/faqs.md)
      
      For further reading  https://www.yiiframework.com/doc/api/2.0/yii-base-security#generatePasswordHash()-detail  [Back](/md/faq/faqs.md)
   
   1. **Views security:** Cross Site Request Forgery (CSRF) built into frontend/config/main.php.  [Back](/md/faq/faqs.md)

   1. **Data Protection and Privacy:** It is the responsibility of the administrator to ensure data is backed up regularly and to ensure that users signing up are familiar with the Privacy and Data Protection Policy.   [Back](/md/faq/faqs.md)

   1. **Security best practices:** Active Record uses prepared statements to avoid SQL injections.   [Back](/md/faq/faqs.md)

**I appreciate the security features that Yii2 offers but how do I ensure that only users that I have signed up can access the site?**

The sjaakp/pluto login can be set to **'fence mode'** in frontend/config/main.php. This will restrict external users from accessing the site. Fence mode can be set to true. Currently it is set to **!'User can Login but not Signup - Fence Mode On'**. All users, including Admin, inherit the **Fencemode role**. Take the **'User can Login but not Signup - Fence Mode On'** permission away from the Fencemode role if you are intending to allow guests to your site.  [Back](/md/faq/faqs.md)
