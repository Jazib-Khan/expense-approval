# expense-approval

## Project Setup
php artisan db:seed to add an employee and admin account.
Admin account is admin@example.com with default password.
Any registered account from there is automatically assigned an employee role.

## Email setup
.env
MAIL_MAILER=smtp
MAIL_HOST=smtp.mailtrap.io
MAIL_PORT=2525
MAIL_USERNAME={{ your_mailtrap_username }}
MAIL_PASSWORD={{ your_mailtrap_password }}
MAIL_ENCRYPTION=tls
MAIL_FROM_ADDRESS=your_email@example.com
MAIL_FROM_NAME="${APP_NAME}"
