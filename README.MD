
DATABASE : MYSQL
Create a database name : alli_demo.
import file .sql in folder database to alli_demo database.
- table : 
	+ access : token for safe api.
	+ users : table for save user.


----------------------------------

Source Code:

- Copy all file to run php eviroment (XAMPP, Nginx).
- Config to database in file config.php.


------------------------------------
Run: 
-Install POSTMAN to test : https://chrome.google.com/webstore/detail/postman/fhbjgbiflinjbdggehcddcbncdddomop?hl=vi.
-Run POSTMAN and copy and paste this link to url: http://<your domain>/user.php/nguyendatdh93@gmail.com (ex:http://localhost/user.php/nguyendatdh93@gmail.com)
-ADD headers field " token : 5cb648eb5d78031f333e846f6adaba69";
Method GET: click SEND.
 

Method POST : EDIT user
	+ body tab : add field to edit row: 
		name : usertest
		tel : 09124432323
 

Click Send.
------------
Image for use POSTMAN in folder : image_tutorial. 
FINISH



