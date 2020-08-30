**yii2-h2h-core**

**Licence**

Copyright 2020  House2House  [BSD-3-Clause](/licence.md)

**House to House Management Software eg. Cleaning Services**

[![Yii2](https://img.shields.io/badge/Powered_by-Yii_Framework-green.svg?style=flat)](https://www.yiiframework.com/) [![License](https://img.shields.io/badge/License-BSD%203--Clause-blue.svg)](https://opensource.org/licenses/BSD-3-Clause) ![stable](https://img.shields.io/static/v1?label=stable&message=1.0.1&color=9cf) ![Downloads](https://img.shields.io/static/v1?label=Downloads/week&message=8&color=9cf)

**Composer**

    "rossaddison\yii2-h2h-core": "*", 

[**Frequently Asked Questions ?**](/md/faq/faqs.md)

**Installation**
1. Clone repository, install composer from composer.org and run the following command at the web root command prompt or click on up8.bat in the web root: 

         composer update

1. Create database adapting [common/config/main-local.php.](/common/config/main-local.php) Use utf8mb4_unicode_ci.
1. Identify the following commands in [console/config/main.php](/console/config/main.php)
1. Console/command prompt command setting up database db.  

        yii migrate-db-namespaced

1. Insert [frontend/config/main.php](/frontend/config/main.php) Swiftmailer settings to signup first user.
1. Signup first user who will automatically be made active as administrator.
1. Signup addtional users. The administrator will have to be make them active.

[Roles and Permissions Diagram](/downloadfile/Roles%20and%20Permissions.pdf) 







 



