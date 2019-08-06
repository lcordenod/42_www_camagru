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

![User limited access](https://user-images.githubusercontent.com/45239771/62544221-ad469a00-b85f-11e9-97ca-61c7857fa7be.png)
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
* Checking the image isn't empty by verifying the image object size

### Montage

Montage will be processed by PHP with javascript helping by providing the images (picture, filter) data and specifications (base64, width, height...).

Montage will be temporarily saved, if user decides to save it to his gallery, it will saved permanently, otherwise, it will be removed.

![Montage](https://user-images.githubusercontent.com/45239771/62536778-225da380-b84f-11e9-88ad-a9ae52017c0c.png)
<p align=center><i>Montage</i></p>

User can see a preview of his recently taken pictures or access his full list of pictures in his gallery.

## User interactions

### Home/Feed

From the homepage, if the user isn't logged in, he will have a presentation of the app and a look at the montages posted by users of the platform.

![Logged out HP](https://user-images.githubusercontent.com/45239771/62544758-b2f0af80-b860-11e9-8b82-83b3520eb176.png)
<p align=center><i>Logged out HP</i></p>

If the user is logged in, he will have access to the same montages feed but he will be able to comment and like montages.

![Logged in HP](https://user-images.githubusercontent.com/45239771/62544946-02cf7680-b861-11e9-8fb3-8e3990ca1ee1.png)
<p align=center><i>Logged in HP</i></p>

Which brings us to user interactions.

### Interactions

User can interact with each by:
* Liking/Unliking pictures
* Commenting on pictures
* Sharing on Facebook

#### Like/Comments

![Like/Comments](https://user-images.githubusercontent.com/45239771/62545858-c6047f00-b862-11e9-897a-7a4cf8cf7348.png)
<p align=center><i>Montage with like/comments</i></p>

Whenever a user comment on another user's picture, this user will receive a notification by email if he is subscribed to notifications. Users commenting on their own pictures won't get notification for themselves, only when it's another user.

The link sent on this email notification will lead to a preview of the montage commented so that the user can see in details what happenned on this picture.

#### Montage review link

As described above, user can review a specific montage in details, depending on whether the montage belongs to the user or not, he will have the option to delete it.

![Montage link review](https://user-images.githubusercontent.com/45239771/62546484-d9641a00-b863-11e9-907b-d2f07dcfae94.png)
<p align=center><i>Montage link review</i></p>

Facebook sharing has been implemented as well so that user can share on Facebook this montage with his friends and see how many times the montage has been shared on Facebook.

## Responsive design

The platform has been completely designed with Responsive Design in mind with multiple breakpoints to accommodate most common screen sizes (from iPhone 5 range to desktop/tablet resolutions):
* 545px
* 680px
* 830px
* 920px
* 1200px

*Depends of the page*

![Snap a picture view](https://user-images.githubusercontent.com/45239771/62547452-83907180-b865-11e9-931f-dac764e746c8.png)
<p align=center><i>Snap a picture view</i></p>

![User account](https://user-images.githubusercontent.com/45239771/62547453-83907180-b865-11e9-89e9-8110985d21aa.png)
<p align=center><i>User account</i></p>

![User gallery](https://user-images.githubusercontent.com/45239771/62547454-83907180-b865-11e9-9208-ba97e9dee679.png)
<p align=center><i>User gallery</i></p>

![Registration page](https://user-images.githubusercontent.com/45239771/62547455-83907180-b865-11e9-88c8-2382db9e888c.png)
<p><i>Registration page</i></p>

## Configuration (DB) and Additionnal security

* Injections
....
