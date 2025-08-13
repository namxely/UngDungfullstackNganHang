# Ngân hàng Full Stack

## Mục lục
- [Ngân hàng Full Stack](#ngân-hàng-full-stack)
  - [Mục lục](#mục-lục)
  - [Giới thiệu](#giới-thiệu)
  - [Bắt đầu](#bắt-đầu)
    - [Yêu cầu](#yêu-cầu)
    - [Cài đặt](#cài-đặt)
  - [Cách sử dụng](#cách-sử-dụng)
  - [Công nghệ sử dụng](#công-nghệ-sử-dụng)

## Giới thiệu
Full Stack Bank là một hệ thống ngân hàng trên nền web cho phép người dùng thực hiện các nghiệp vụ cơ bản: quản lý tài khoản, chuyển khoản, xem lịch sử giao dịch và quản trị người dùng. Ứng dụng sử dụng PHP, HTML, CSS, JavaScript và giao diện được xây dựng dựa trên Bootstrap.

## Bắt đầu
Hướng dẫn dưới đây giúp bạn chạy dự án trên máy cá nhân để phát triển và thử nghiệm.

### Yêu cầu
Bạn cần cài đặt các phần mềm sau:
- [XAMPP](https://www.apachefriends.org/pl/download.html)
- [PHP 8.0+](https://www.php.net/downloads.php)
- [Papercut SMTP](https://github.com/ChangemakerStudios/Papercut-SMTP)

### Cài đặt
1. Mở `XAMPP Control Panel` và khởi động hai dịch vụ `Apache` và `MySQL`.
2. Mở thư mục `xampp/htdocs` (bấm nút `Explorer` trong XAMPP để mở nhanh).
3. Trong thư mục này, sao chép mã nguồn dự án:
   ```sh
   git clone https://github.com/namxely/UngDungfullstackNganHang.git
   ```
   Hoặc tải ZIP tại `https://github.com/namxely/UngDungfullstackNganHang` và giải nén vào `htdocs`.
4. Tạo file `.env` trong thư mục `xampp/htdocs/Full-Stack-Bank/scripts` với nội dung:
   ```md
   SERVER = 'localhost'
   DATABASE = '<ten-co-so-du-lieu>'
   USERNAME = 'root'
   PASSWORD = '<mat-khau>'
   ```
   Thay các giá trị theo môi trường của bạn.
5. Mở phpMyAdmin từ `XAMPP Control Panel` (nút `Admin` tại MySQL). Tạo mới một database trùng tên với biến `DATABASE` ở bước trên.
6. Tạo các bảng cần thiết bằng cách chạy truy vấn SQL dưới đây:
    ```sql
    SET SQL_MODE = 'NO_AUTO_VALUE_ON_ZERO';
    SET AUTOCOMMIT = 0;
    START TRANSACTION;
    SET time_zone = '+00:00';

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
      `password` varchar(60) NOT NULL,
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

7. Tạo tài khoản quản trị (admin) bằng câu lệnh sau:
    ```sql
    INSERT INTO `user` (`account_id`, `first_name`, `last_name`, `password`, `address`, `PESEL`, `email`, `balance`, `phone_number`, `date_opened`, `role_id`, `account_number`) VALUES ('1', 'Admin', 'Admin', '$2y$10$WdsovTLBMeTmzF//JG6juOHOjnHn7Gy6xOzD12Bvje0iptvgMNJiu', 'Admin Address', '12345678901', 'admin@example.com', '1000', '1234567890', '2023-05-16', 'a', '12345678901234567890123456');
    ```
    Mật khẩu mặc định: `zaq1@WSX`, email: `admin@example.com`.

8. Truy cập `http://localhost/Full-Stack-Bank/` để đăng nhập hoặc đăng ký tài khoản mới (hãy bật Papercut SMTP để nhận email xác thực).

## Cách sử dụng
Ứng dụng cung cấp giao diện desktop, lịch sử giao dịch và chức năng chuyển khoản cho người dùng thường. Tài khoản quản trị (admin) có thể thực hiện CRUD người dùng; tài khoản tư vấn (consultant) có thể CRUD giao dịch. Để đăng nhập với vai trò admin/consultant, hãy tạo tài khoản rồi cập nhật cột `role_id` tương ứng: `a` (admin), `c` (consultant), `u` (user - mặc định).

## Công nghệ sử dụng
Ứng dụng được xây dựng bằng các công nghệ sau:

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