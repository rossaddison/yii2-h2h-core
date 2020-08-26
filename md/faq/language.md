

**No.** You must generate a language by using the **Google Translate User Interface**. **+800** English sentences can be translated into 26 different languages. Yii2 provides the Yii::t('app','Convert this text into another language.') function which has been incorporated in this package. At the console/command prompt running the following command will generate a language specific folder under frontend\messages eg. frontend\messages\nl for the Dutch language. 

        yii message/extract @frontend/messages/template.php
        
This command looks at all the occurances of the Yii::t function in all files, takes the relevant text, looks up the languages setting in the template.php file and, for each two letter abbreviation eg. nl, creates a sub-folder under messages ie. messages/nl and inserts a app.php file which contains all these occurances. Using Google translate you can then translate these sentences and insert the results into the app.php file. app.php is now the **Php**MessageSource.

To generate a **Db**MessageSource. Go a little further down the template.php file and uncomment the db, format, and sourceMessageTable settings. Perform the following command to generate the **source_message** and **message** tables under database db.

        yii migrate --db=db --migrationPath=@yii/i18n/migrations
        
 Perform the following command:
 
        yii message/extract @frontend/messages/template.php
        
This fills the **source_message table** with English extracts, and you will be able to use the **Google Translate** grid to translate the English extracts to whatever languages are in the **languages array** under template.php.   [Back](/md/faq/faqs.md)
