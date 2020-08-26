
**How do we setup our site so that individuals who sign up will be charged a paypal subscription?**

You will need to configure the **frontend/modules/subscription/components/Configpaypal.php** file to **'live'** details. If you are not choosing to offer a subscription but you still want to keep this option open, you will need to get **'sandbox'** (experimental) details from Paypal.

**I do not want any subscription feature on my site?**

1. Replace the frontend/config/main.php with **no_subscription_main.php**. Change the name to main.php.
1. Replace the web/index.php file with **web/no_subscription_index.php**. Change the name to index.php.
1. Replace the frontend/views/layouts/main.php with **no_subscription_main.php**. Change the name to main.php.
    
**I do not want individuals who signup on behalf of their company/division/unit to be charged a paypal subscription although I still want to retain the subscription feature. How do I make sure they do not have to subscribe to our website?**

Ensure that the permission **'Subscription Free Privilege'** is assigned on a higher level. So for Mdb roles a.k.a manager roles that inherit the stronger 'support' role make sure that the 'support' role has the 'Subscription Free Privilege' permission. This will ensure that all managers who have been assigned the relevant mdb role eg. Mdb1 for database 1, will get a Subscription Free Privilege since their role eg. Mdb1 is linked to the higher 'support' role.   [Back](/md/faq/faqs.md)
