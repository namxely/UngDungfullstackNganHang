# Full Stack Bank

## Table of Contents
- [Full Stack Bank](#full-stack-bank)
  - [Table of Contents](#table-of-contents)
  - [About ](#about-)
  - [Getting Started ](#getting-started-)
    - [Prerequisites](#prerequisites)
    - [Installing](#installing)
  - [Usage ](#usage-)
  - [Built Using ](#built-using-)

## About <a name="about"></a>
The Full Stack Bank is a web-based banking system that allows users to perform various banking operations. It provides features such as account management, fund transfers, transaction history, and user administration. The application is built using a combination of PHP, HTML, CSS, and JavaScript, with the frontend designed using the Bootstrap framework.

## Getting Started <a name="getting-started"></a>
These instructions will get you a copy of the project up and running on your local machine for development and testing purposes.

### Prerequisites
You need to have the following installed:
+ [XAMPP](https://www.apachefriends.org/pl/download.html)
+ [PHP 8.0+](https://www.php.net/downloads.php)
+ [Papercut SMTP](https://github.com/ChangemakerStudios/Papercut-SMTP)

### Installing
1. Open `XAMPP Control Panel` and start the `Apache` and `MySQL` modules.
2. Go to the `xampp/htdocs` folder. You can find it by clicking the `Explorer` button in the control panel.
3. Inside this folder, clone the project from git by running the following command:
   ```sh
   git clone https://github.com/PKrystian/Full-Stack-Bankt.git
   ```
   Alternatively, you can download the project [here](https://github.com/PKrystian/Full-Stack-Bank/archive/refs/heads/main.zip) and unzip it.
4. Create a new file named `.env` inside the `xampp/htdocs/Full-Stack-Bank/scripts` folder. The contents of the `.env` file should look like this:
   ```md
   SERVER = 'localhost'
   DATABASE = '<data-base-name>'
   USERNAME = 'root'
   PASSWORD = '<password>'
   ```
   Configure the values according to your preferences.
5. Next, go to the `XAMPP Control Panel` and click `Admin` on the `MySQL` module. This should open the phpMyAdmin panel. In phpMyAdmin, create a new database with the same name as the one specified in the `.env` file (`DATABASE = '<data-base-name>'`).
6. Execute the following SQL query to create the required tables:
    ```sql
    SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
    SET AUTOCOMMIT = 0;
    START TRANSACTION;
    SET time_zone = "+00:00";

    CREATE TABLE `transfers` (
      `transfer_id` int(11) NOT NULL,
      `title` varchar(50) NOT NULL,
      `description` varchar(250) NOT NULL,
      `amount` float NOT NULL,
      `sender_account_number` varchar(26) NOT NULL,
      `receiver_account_number` varchar(26) NOT NULL,
      `sender_address` varchar(50) NOT NULL,
      `receiver_address` varchar(50) NOT NULL,
      `date` date NOT NULL,
      `sender_id` int(11) NOT NULL,
      `receiver_id` int(11) NOT NULL,
      `transfer_type` char(1) NOT NULL
    ) ENGINE=InnoDB DEFAULT CHARSET=utf8;

    CREATE TABLE `user` (
      `account_id` int(11) NOT NULL,
      `first_name` varchar(50) NOT NULL,
      `last_name` varchar(50) NOT NULL,
      `password` varchar(60

    ) NOT NULL,
        `address` varchar(50) NOT NULL,
        `PESEL` varchar(11) NOT NULL,
        `email` varchar(50) NOT NULL,
        `balance` float NOT NULL,
        `phone_number` varchar(15) NOT NULL,
        `date_opened` date NOT NULL,
        `role_id` char(1) NOT NULL,
        `account_number` varchar(26) NOT NULL
      ) ENGINE=InnoDB DEFAULT CHARSET=utf8;

      ALTER TABLE `transfers`
        ADD PRIMARY KEY (`transfer_id`),
        ADD KEY `sender_account_number` (`sender_account_number`,`receiver_account_number`),
        ADD KEY `receiver_account_number` (`receiver_account_number`);

      ALTER TABLE `user`
        ADD PRIMARY KEY (`account_id`),
        ADD UNIQUE KEY `password` (`password`,`phone_number`,`account_number`),
        ADD UNIQUE KEY `PESEL` (`PESEL`),
        ADD KEY `account_number` (`account_number`);

      ALTER TABLE `transfers`
        MODIFY `transfer_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

      ALTER TABLE `user`
        MODIFY `account_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

      ALTER TABLE `transfers`
        ADD CONSTRAINT `transfers_ibfk_1` FOREIGN KEY (`sender_account_number`) REFERENCES `user` (`account_number`),
        ADD CONSTRAINT `transfers_ibfk_2` FOREIGN KEY (`receiver_account_number`) REFERENCES `user` (`account_number`);
        COMMIT;
    ```
  

    
7. Once the setup is complete, you can create an admin account by executing the following SQL command:

    ```sql
    INSERT INTO `user` (`account_id`, `first_name`, `last_name`, `password`, `address`, `PESEL`, `email`, `balance`, `phone_number`, `date_opened`, `role_id`, `account_number`) VALUES ('1', 'Admin', 'Admin', '$2y$10$WdsovTLBMeTmzF//JG6juOHOjnHn7Gy6xOzD12Bvje0iptvgMNJiu', 'Admin Address', '12345678901', 'admin@example.com', '1000', '1234567890', '2023-05-16', 'a', '12345678901234567890123456')
    ```
   The password for the admin account is `zaq1@WSX`, and the email is `admin@example.com`.
   
8. Now, you can log in to this account or register a new account by visiting `http://localhost/Full-Stack-Bank/` in your browser (make sure to have Papercut SMTP active for email verification).

## Usage <a name="usage"></a>
This project functions as a simple bank application. It includes a desktop view, transfer history, and a transfer tab for regular users. Admin users can perform CRUD operations on users, and consultant users can perform CRUD operations on transfers. To use the application as a regular user, you need to register or log in to the bank. If you want to log in as an admin/consultant, you need to create a new account and change the `role_id` cell to the corresponding role: `a` for admin, `c` for consultant, and `u` for user (default).

## Built Using <a name="built-using"></a>
The project is built using the following technologies and tools:

<div align="left">
  <img src="https://cdn.jsdelivr.net/gh/devicons/devicon/icons/php/php-original.svg" height="40" alt="php logo" />
  <img width="12" />
  <img src="https://cdn.jsdelivr.net/gh/devicons/devicon/icons/html5/html5-original.svg" height="40" alt="html5 logo"  />
  <img width="12" />
  <img src="https://cdn.jsdelivr.net/gh/devicons/devicon/icons/css3/css3-original.svg" height="40" alt="css3 logo"  />
  <img width="12" />
  <img src="https://cdn.jsdelivr.net/gh/devicons/devicon/icons/javascript/javascript-original.svg" height="40" alt="javascript logo"  />
  <img width="12" />
  <img src="https://cdn.jsdelivr.net/gh/devicons/devicon/icons/bootstrap/bootstrap-original.svg" height="40" alt="bootstrap logo"  />
</div>