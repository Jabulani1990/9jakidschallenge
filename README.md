Documentation of the Rest Api
API documentation for UserController:

Create new user
Route: POST api /user
Parameters:
1.	first_name: Required, string, max length 255
2.	last_name: Required, string, max length 255
3.	email: Required, string, email, max length 255, unique
4.	phone_number: Required, string, max length 11
5.	gender: Required
6.	home_address: Required, string, max length 255
7.	state_of_origin: Required
8.	city: Required
9.	password: Required, string, min length 8
Returns:
201: 'User Account Have Been Set Up Successfully'
400: Validation errors

Retrieve all users
Route: GET api /user
Parameters: None
Returns: Array of all users





Retrieve user by id
Route: GET api /user/{id}
Parameters:
id: Required, id of user to retrieve
Returns:
User object if found
404 error: 'User not found'

Update user record
Route: PUT api /users/{id}
Parameters:
id: Required, id of user to update
phone_number: Required, string, max length 11
gender: Required
home_address: Required, string, max length 255
state_of_origin: Required
city: Required
password: Required, string, min length 8
Returns:
200: 'User updated successfully'
400: Validation errors

Delete user
Route: DELETE api /user/{id}
Parameters:
id: Required, id of user to delete
Returns:
200: 'User deleted successfully'
404 error: 'User not found'
Note: The password field is hashed before being saved in the database using the Laravel's built-in Hash facade. The user_id is generated using the openssl_random_pseudo_bytes function. The account_status is initialized to 'active' upon creation of a new user.
