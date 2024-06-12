# Dynamic-Form-Creation
Requirement: Create a Laravel project to manage a dynamic form

Follow the below steps.

1. Create .env file in the root project by taking the copy of .env.example file.
2. Confugure the DB settings.
3. Give command `composer install` for installing composer.lock file.
4. For installing node modules use `npm i` command or `npm i --legacy-peer-deps`.
5. You can import the sql or either you can create db and make migarte for migrating the tables to db. Use `php artisan migrate`.
   [Attachhing the sql file to the mail reply.if you want to import the tables into the db.]

6. LandingPage==>http://127.0.0.1:8000
7. Register====>http://127.0.0.1:8000/register
8. Login======>	http://127.0.0.1:8000/login

9. Note! All the registered users are considered as admin user, so any user who are registered in this project can create,edit and delete the forms.

10. [If you got any error related with php version,when using `composer install` command, it meansyour system's php version is different from the project, 
    you can set the configuration to the composer.json file by changing php version. Then give command `composer install`]

11. To see the admin created forms as public====>http://127.0.0.1:8000/user_forms

12. A job file named `SendMail.php` is created inside the jobs folder, for sending an email notification on successful form creation with queue.

13. When you are creating a new form, there is a field named `options`, 
    that is mandatory for all the fields. so u should add entry to options also, otherwise error will thrown.

14. After created a form, then comes to the `http://127.0.0.1:8000/user_forms` any public user can save their actions in any form fields.
    These entries are going to the table `form_response` in the DB.


