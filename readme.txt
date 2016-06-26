1.) Inititally make the directory permission for the storage and the bootstrap/cache folders.  directories should be writable by your web server.

2.) Go to the root directory use the command "composer install" to add dependencies.

3.) Rename the .env.example file to .env in the root directory.

4.) Create the empty mysql database "Harver"

5.) Change the DB_USERNAME="XXXX" and DB_PASSWORD="XXXXX in .env file according to your db configuration.

6.) Run the following artisan commands in the root directory.

	php artisan key:generate
	php artisan migrate
	php artisan doctrine:schema:create

7.) In the browser go to the "HOST/test-api-laravel/public/register"
	(ex -: http://localhost/test-api-laravel/public/register)
	and register for the user.

8.) It will show the error response once created the user, it was a bug on mysite. But it will save the user to the database.(user creation is not in the task list in test, i have not focused to it)

9.) Once you created the user you can log in to the system.I have used the postman in crome to test the api.

can add/edit/delete the department, employees have not restricted the api end points. Please check the sample postman collection.

10.) Postman request must be in this format

http://localhost/test-api-laravel/public/api/v1/employee?token=




Note - As i got initially in the error of making the test cases properly, written after the implementation.With the time period, i have not set unit test properly. However check the Department, Employee tests filed in the /test folder. It failed the some of the test cases.
	


	

