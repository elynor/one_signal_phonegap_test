#OneSignal test application

This is basic PhoneGap test application to check the functionality of OneSignal push notifications

It consists of 2 parts:
- PhoneGap application
- PHP api
 
#Api endpoints

**action** - *user/mass* - type of notification action to be executed. 
User - you will send message to the user by his device id
Mass - you will send notifications to all users

**message** - *string* - message that will be sent to devices

**device_id** - *string* - parameter only for user action. Specifies the id of device

#Tests

To run tests add autoloader to phpunit, i.e:
```
phpunit --bootstrap autoload.php tests/NotificationApiTest.php
```