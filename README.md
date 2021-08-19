# orderProcessor

 This code was taken from a fully functional CMS platform and re-constituted for demonstration purposes.

 The main functional elements include:

 * Basic User Auth
 * orderProcessor 

 The orderProcessor portion of this demonstration was modled of on existing system.

 A user may supply a list or orders exported from a seperate platfrom. 

 The orderProcessor will parse and validate each row of the CSV, before contining to process the valid rows as specified.

 Errors are logged as well as reported to the user after parsing.

 ### Installing

 Clone the repo

 ```
 git clone https://github.com/rovvp/orderProcessor.git
 ```

 Please run artisan:migrate to execute the database migrations. 


 ### Configuring

 Please configure the .env file with specified paramaters. The following settings are required for this sample to work


 ## Requirements

 PHP 8.0 +
 A working version of composer 
 A MySQL Server for user auth and queue management 
 A SMTP Host for sending email


 ## Running a Local copy

 Provided the requirements are met the code could be run with 

 php artisan serve

 ```
 ## To Do

 * Implement and include unit tests


 ## Deployment

 ## Built With

 * [Laravel](https://laravel.com) 

 ## Contributing

 ## Versioning

 ## Authors

 Rowan Pronk

 ## License

 ## Acknowledgments