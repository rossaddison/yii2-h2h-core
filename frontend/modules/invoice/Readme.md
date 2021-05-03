3rd May 2021

I have modified about 30% of the Invoiceplane Opensource software which is written in php codeigniter into php Yii2. 
The language folder here is entirely Invoiceplane's. I have consistently used the language cues so that other 
languages can use this system. This module is tied into the frontend and is not a standalone module. 
In addition a large portion of Invoiceplane's javascript is used here and has also been adapted. Right now the module:

1.  Creates email templates allowing for the input of field information.
2.  Uses modified pdf templates normal, overdue, and paid.
3.  Archives pdfs when the email is sent.
4.  Allows for attachments to the email and keeps record of these attachments in the database.
5.  As mentioned above, allows a multilanguage interface in the settings section.
6.  Complies with not displaying or using the Invoiceplane name or logo anywhere in the package according to the 
    licence here https://wiki.invoiceplane.com/en/1.0/general/license although the pdf templates use the 
    invoiceplane graphics overdue, and paid. 
7.  Does not use the codeigniter framework which Invoiceplane uses. Codeigniter libraries have been adapted into Yii2 classes using the 
    yii\base\Component.  

Hopefully some of this code will be useful to Invoiceplane developers if they decide to move to
Yii2 although this is not likely since Yii3 is on its way at this stage. 
