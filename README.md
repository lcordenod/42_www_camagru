# 42_www_camagru
Recreate a web version of Snapchat with filters and picture gallery from camera or upload

## Intro

Objective of this project is to create a complete website that allows users to make picture montages with filters, from camera upload or file upload.

My Camagru project handles:

* User creation and authentication
* .....


## User account

### User creation and authentication

User input has been secured on front and back end with immediate feedback for front end input validation. Also password security has been taken seriously with multiple layers of complexity validated on the go, including:
* A lowercase letter
* A uppercase letter
* A number
* A minimum of 8 characters

Password will be hashed (whirlpool) first before being saved in the DB.

![User creation screen with input errors](https://user-images.githubusercontent.com/45239771/62533143-48cb1100-b846-11e9-9621-a892ab947ce4.png)
<p align=center><i>User creation screen with input errors</i></p>

Before saving user, several checks will also be runned in the background, including:
* Verifying if user already exists
* Verifying if email is already used
* Verifying (as said earlier) if input is in the right format required

Once user is created, he will be receive an email to verify his account, while account isn't validated, he will have limited access to app, like not being able to make montages for example.

![User limited access](https://user-images.githubusercontent.com/45239771/62534534-b3ca1700-b849-11e9-8f73-d69cafdca119.png)
<p align=center><i>User limited access</i></p>

### Forgot and change of password

If user has forgotten his password, he will be able to retrieve using his email, a password reset link will be sent to his email address entered.

![Reset of password](https://user-images.githubusercontent.com/45239771/62534328-2e466700-b849-11e9-9c7a-5b6386c77665.png)
<p align=center><i>Reset of password link</i></p>

The reset of password link will have a unique ID, which will be the latest link sent, others will be made deprecated. This provides security to prevent intruders from resetting someone else password.

### User profile

#### Edition

User will be able to manage completely his profile if he has validated his account with his email. For example, he will be able to edit his:
* Username
* Email
* Password

Or even delete his account (with a confirmation using his password) and manage his notifications (new comments on his pictures for example).

![User account](https://user-images.githubusercontent.com/45239771/62535287-4cad6200-b84b-11e9-8b50-f8c8691b5c0d.png)
<p align=center><i>User account</i></p>

#### Gallery

He can also access his pictures in his own gallery.

![User gallery](https://user-images.githubusercontent.com/45239771/62535446-b7f73400-b84b-11e9-8116-4c582eb0bb6d.png)
<p align=center><i>User gallery</i></p>

If he doesn't have pictures yet, he will have a nice invitation to take a first one.

## Creating montages

### Camera upload

Using MediaDevices.getUserMedia() javascript method, I will access user's camera if he allowed it, then user will be able to take a picture if he selected a filter (following onboarding present on "Snap" page right).

![Create a montage](https://user-images.githubusercontent.com/45239771/62536217-b9c1f700-b84d-11e9-88dc-304000041a95.png)
<p align=center><i>Create a montage</i></p>

User will be able to move the filter using click or tap depending of the device used.

### Picture upload

If the user doesn't have a camera or didn't want to provide access to it, he will be able to upload pictures.

![Picture upload](https://user-images.githubusercontent.com/45239771/62536323-060d3700-b84e-11e9-9099-3df59e2c59d0.png)
<p align=center><i>Upload a picture</i></p>

There will be some security checks running to avoid uploading an incorrect file:
* Checking the file format is an image (png, jpg, jpeg)
* Checking the file size to avoid having too big images (< 5mb)
* Checking the image isn't empty by verifying the object size

## Additionnal security

* Injections
....
