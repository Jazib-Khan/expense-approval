# Expense Approval Workflow

## Project Setup
php artisan db:seed to add an employee and admin account.<br>
Admin account is admin@example.com with default password.<br>
Any registered account from there is automatically assigned an employee role.<br>

## Email setup
I used mailtrap for testing emails.
.env
<pre><code>
MAIL_MAILER=smtp
MAIL_HOST=smtp.mailtrap.io
MAIL_PORT=2525
MAIL_USERNAME={{ your_mailtrap_username }}
MAIL_PASSWORD={{ your_mailtrap_password }}
MAIL_ENCRYPTION=tls
MAIL_FROM_ADDRESS=your_email@example.com
MAIL_FROM_NAME="${APP_NAME}"
</code></pre>

## Extra Feature
I added an extra feature for a search filter on the admin dashboard.<br>
An admin can search for an expense via employee's name.<br>
I also added livewire pagination for all the expenses within the admin dashboard.

## Images
![image](https://github.com/user-attachments/assets/d8c518d4-8322-41cd-9cd8-ce20c79a5502)
![image](https://github.com/user-attachments/assets/e2020f45-d581-40d4-9c87-e8fcfc31482b)
![image](https://github.com/user-attachments/assets/0c4b53ac-643f-4446-909b-8cabcb39cb8c)
![image](https://github.com/user-attachments/assets/f71ea0cc-0f09-4b3b-9823-8d31cee41eb5)
![image](https://github.com/user-attachments/assets/2e098534-fc3f-4ce2-a67b-be2fa9030f4b)

