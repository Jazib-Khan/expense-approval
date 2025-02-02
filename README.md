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
