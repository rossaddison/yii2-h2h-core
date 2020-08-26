**How do I create a Daily Clean?**

Go to **Daily Clean** and click the create button. A **Daily Clean** appears on the Grid. Having setup your Postcodes, Streets, and Houses, **under Houses**, select your houses by means of ticking them in the grid and copying them to the selected Daily Clean. Postcodes and Streets have to be manually entered. An optional SQL update/migration in the future is proposed to update the UK's postcodes and streets. 

**How do I see the individual cleans for the day?**

Under the **Daily Clean**, if you click on the + sign, the grid will expand and you will be able to see all the cleans for that day. You will be able to mark as paid those that have paid you. Click on **'cleans'** and you will see a more **detailed** list of the overall cleans.  [Back](/md/faq/faqs.md)

A useful feature is, if you are lost, you will be able to click on the address button to take you to **Google maps.**  If the postcode is not descriptive use Google's latitude and longitude **coordinates** for the beginning and end of the street. These streets will appear **highlighted** on the map if you choose good 'begin' and 'end' **coordinates** for each street.   [Back](/md/faq/faqs.md)

**How do I change the sequence or order of my streets to clean?**

Give the street an **sequence / order number**. Each order number should be unique.  The Daily Clean will be sorted according to the order of the streets if you have more than one street under the Daily Clean. If the run is difficult to follow, **'directions to next clean'** is a field that you can use to direct the cleaner to the **next street.**  [Back](/md/faq/faqs.md)

**What should I put under 'job code' in the Daily Clean?**

eg. Bridgestone and Whitley run.
 
You should preferably not include a number since this run is going to occur at least once a month. 

**Once the houses have been copied from 'House' how do I repeat the Daily Clean for a future clean?** 
Tick the relevant Daily Clean and then tick on the **Ticked (copy)** button to get your choices of weekly, fortnightly etc.   [Back](/md/faq/faqs.md)

**How do I get a balance of the amount that my customer owes me?** 

If you go to houses and look at the far right side of the grid you will see the column **Debt** represented by a set of scales. Click on this icon and you will get a break down of the overall debt. You will have the ability to go to the individual debt. **SOD** (**Sales Order Detail**) stands for Sales Order Detail and represents a single house or clean on the Daily Clean **SOH** (**Sales Order Header**).

**I have several cleans in one area but do not want to enter them individually as this is time consuming. How can I speed the process up?**

Use the **Quick Build** facility situated between Street and Houses. Under the specific street, set the sequence or sort order to **500**, and simply move the house numbers on the left to the right. Set the sequence number back to the default of **99** once you have completed your build.  [Back](/md/faq/faqs.md)

**How do I find my turnover or costs?** 

Your turnover can be determined under Daily Clean.  Your expenditure can be determined under Costs. Since this is a cash collection software package the amount is merely incremental and has no connection to an accounting package.  The paid amount could be modified in the frontend/models to facilitate quantity delivery if keeping stock of what has been delivered to a household.  [Back](/md/faq/faqs.md)

**How do I integrate the Gocardless payment solution**

Each  Company/Division/Unit setup can set their **Gocardless access token.** This will enable them to send a **Direct Debit Mandate** by email to their customers requesting them initially to give their **approval** to take payment(s) from their account. When a payment is due, you send them a **recurring or one-off variable** payment direct debit  amount which they must authorise within a period prior to the amount coming off their account. Each company will have to setup their **SMTP settings** for their Mailserver in order for this to function correctly. These settings are available under Company. These mailserver settings will be specific to the company. If a company has not set their mailserver settings then the default mailserver settings under frontend/config/main.php - mailer will apply. 

Once setup you will be able to use the two Gocardless related buttons under House. Tick the relevant house and click on either one of the following buttons:

1. 'Email Direct Debit Link to Customer for their Approval (tick)'  
1. 'Email Payment Request to Customer (tick)'

Email templates have been built into the controllers and as a future endeavour will be created separately.  [Back](/md/faq/faqs.md)

**How do I use Twilio Text Messaging**

Multiple text message reminders can be sent by Twilio. You can set this under Company. You will have to **buy** a Twilio telephone number for this purpose. The Twilio telephone number is personal to your company  and is the channel that is used to send text messages.

**How do I use Alternative text messaging**

If your householder has consented to using their mobile number you can list this under Houses and you will have access to this under the Daily Cleans. Simply press their mobile number while online and **Android** will present its options. Your company will not be able to use the multiple text messaging that is available through Twilio.  [Back](/md/faq/faqs.md)

**Can I import houses into the system?**

Yes there is an import facility although you will probably find it quicker to use the **Quick Build tool** depending on the number of houses you will use per street. The import facility requires you to download a template file and then to upload it once completed. The Import Houses tool is located at the bottom of the **Database** menu using Admin rights.   [Back](/md/faq/faqs.md)
