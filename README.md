Bank Application
This is a bank application built using Laravel 10, MySQL, and Bootstrap.

Features
Login: Users can log in using their email and password via the LoginController.
Registration: Users can register by providing their email, password, and confirm password through the RegistrationController.
Two-Factor Authentication: After login, users are required to verify their identity with a two-factor authentication code sent to their registered email.
Dashboard:
Admin Dashboard: Admin users can create new accounts and view all accounts.
User Dashboard: Regular users can view and manage their own accounts.
Transaction Management: Both admin and user roles can perform fund transfers. The TransactionController handles the logic for transferring funds and recording transactions.
Technologies Used
Laravel 10: PHP framework for the backend logic and structure.
MySQL: Database to store user and account data.
Bootstrap: Frontend framework for responsive design and layout.
using mailtrap to check notifaction for code of twofactor