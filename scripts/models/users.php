<?php

    class Users
    {
        /**
         * @property first_name
         * @property last_name
         * @property password
         * @property address
         * @property pesel
         * @property email
         * @property balance
         * @property role_id
         * @property account_number
         * @property phone_number
         * @property sql
         */

        private const TABLE_NAME = 'user';

        public const ACCOUNT_ID = 'account_id';
        public const FIRST_NAME = 'first_name';
        public const LAST_NAME = 'last_name';
        public const PASSWORD = 'password';
        public const ADDRESS = 'address';
        public const PESEL = 'pesel';
        public const EMAIL = 'email';
        public const BALANCE = 'balance';
        public const ROLE_ID = 'role_id';
        public const DATE_OPENED = 'date_opened';
        public const ACCOUNT_NUMBER = 'account_number';
        public const PHONE_NUMBER = 'phone_number';

        public function login($conn)
        {
            $this->sql = "SELECT " . $this::PASSWORD . ", " . $this::ROLE_ID . " FROM " 
                . $this::TABLE_NAME . " WHERE " 
                . $this::EMAIL . " = ?";

            $stmt = $conn->prepare($this->sql);

            $stmt->bind_param('s', $this->email);

            $stmt->execute();

            $result = $stmt->get_result();

            if ($result->num_rows === 0) 
            {
                $_SESSION['error_message'] = 'Invalid email or password';
                header("Location: ../../index.php?user_login=1");
                exit;
            }

            $row = $result->fetch_assoc();

            $hashed_password = $row[$this::PASSWORD];
            
            $this->role_id = $row[$this::ROLE_ID];

            session_start();

            if ($this->role_id === 'i') {
                $code = $this->generate_random_code();
                
                $this->mail_code($code, $this->email);

                $_SESSION['saved_activation_code'] = $code;
                $_SESSION['verification_role_id'] = $this->role_id;
                $_SESSION['verification_email'] = $this->email;

                header("Location: ../activation.php");

                exit;
            }

            if (!password_verify($this->password, $hashed_password)) {
                $_SESSION['error_message'] = 'Invalid email or password';
                header("Location: ../../index.php?user_login=1");
                exit;
            }

            $_SESSION['success_message'] = 'Logged in successfully!';

            $this->assign_session_attributes($conn);

            $_SESSION['current_user_role'] = $_SESSION[$this::ROLE_ID];

            switch($_SESSION[$this::ROLE_ID])
            {
                case "a":
                    header("Location: ../../pages/panels/admin_panel.php");
                    break;
                case "c":
                    header("Location: ../../pages/panels/consultant_panel.php");
                    break;
                default:
                    header("Location: ../../pages/panels/user_panel.php");
                    break;
            }
            exit;
        }

        public function register($conn)
        {
            $register_date = date('Y-m-d');
            $this->generate_account_number($conn);

            $this->role_id = 'i';

            $this->sql = "INSERT INTO " . $this::TABLE_NAME . " ("
                . $this::FIRST_NAME . ", " 
                . $this::LAST_NAME . ", "
                . $this::PASSWORD . ", "
                . $this::ADDRESS . ", "
                . $this::PESEL . ", "
                . $this::EMAIL . ", "
                . $this::BALANCE . ", "
                . $this::PHONE_NUMBER . ", "
                . $this::DATE_OPENED . ", "
                . $this::ROLE_ID . ", "
                . $this::ACCOUNT_NUMBER . ") " .
            "VALUES (?, ?, ?, ?, ?, ?, 0, ?, ?, ?, ?);";
            
            $stmt = $conn->prepare($this->sql);

            $hashed_password = password_hash($this->password, PASSWORD_BCRYPT);

            $stmt->bind_param('ssssssssss',
                $this->first_name,
                $this->last_name,
                $hashed_password,
                $this->address,
                $this->pesel,
                $this->email,
                $this->phone_number,
                $register_date,
                $this->role_id,
                $this->account_number
            );

            $stmt->execute();

            session_start();

            if($stmt->error)
            {
                $_SESSION['error_message'] = 'Could not register';
                header("Location: ../../index.php?user_login=0");
            }

            $code = $this->generate_random_code();

            $this->mail_code($code, $this->email);

            $_SESSION['saved_activation_code'] = $code;
            $_SESSION['verification_role_id'] = $this->role_id;
            $_SESSION['verification_email'] = $this->email;
            $_SESSION['current_user_role'] = $this->role_id;

            header("Location: ../activation.php");

            exit;
        }

        private function assign_session_attributes($conn)
        {
            $this->sql = 'SELECT ' 
                    . $this::FIRST_NAME . ', ' 
                    . $this::LAST_NAME . ', '
                    . $this::BALANCE . ', '
                    . $this::ACCOUNT_NUMBER . ', '
                    . $this::ROLE_ID .
                ' FROM ' 
                    . $this::TABLE_NAME .
                ' WHERE '
                    . $this::EMAIL . ' = ?';

            $stmt = $conn->prepare($this->sql);

            $stmt->bind_param('s', $this->email);

            $stmt->execute();

            $result = $stmt->get_result();

            while ($row = $result->fetch_assoc()) 
            {
                $_SESSION[$this::FIRST_NAME] = $row[$this::FIRST_NAME];
                $_SESSION[$this::LAST_NAME] = $row[$this::LAST_NAME];
                $_SESSION[$this::BALANCE] = $row[$this::BALANCE];
                $_SESSION[$this::ACCOUNT_NUMBER] = $row[$this::ACCOUNT_NUMBER];
                $_SESSION[$this::ROLE_ID] = $row[$this::ROLE_ID];
            }
        }

        private function generate_account_number($conn)
        {
            $exists = true;

            while($exists) 
            {
                $acc_num = "SAVE220";
                $suffix = strlen($acc_num);

                for ($i = 0; $i < 26 - $suffix; $i++)
                    $acc_num .= strval(rand(0, 9));

                $this->account_number = $acc_num;
                $exists = $this->check_for_existing_acc_num($conn);
            }
        }
        
        private function check_for_existing_acc_num($conn)
        {
            $this->sql = 'SELECT count(*) FROM '
                . $this::TABLE_NAME
                . ' WHERE '
                . $this::ACCOUNT_NUMBER . ' = ?';

            $stmt = $conn->prepare($this->sql);
            $stmt->bind_param('s', $this->account_number);
            $stmt->execute();

            $result = $stmt->get_result();
            $row = $result->fetch_assoc();
            $count = $row['count(*)'];

            return $count > 0;
        }
        
        private function generate_random_code()
        {
            $numbers = "0123456789";
            $length = 4;
            $code = "";

            for ($i = 0; $i < $length; $i++) {
                $ran_index = rand(0, strlen($numbers) - 1);
                $code .= $numbers[$ran_index];
            }

            return $code;
        }

        private function mail_code($saved_code_to, $mail_to)
        {
            $code = $saved_code_to;
            $to = $mail_to;
            $subject = "Your Savemander Code";
            $message = "Dear User,<br><br>";
            $message .= "Thank you for registering with Savemander. Your verification code is:<br><br>";
            $message .= "<strong>$code</strong><br><br>";
            $message .= "Please enter this code on our website to complete your registration.<br><br>";
            $message .= "If you have any questions or need further assistance, please feel free to contact us.<br><br>";
            $message .= "Best regards,<br>";
            $message .= "The Savemander Team";
        
            $headers = "From: savemander@example.com\r\n";
            $headers .= "Reply-To: savemander@example.com\r\n";
            $headers .= "MIME-Version: 1.0\r\n";
            $headers .= "Content-Type: text/html; charset=utf-8\r\n";
        
            mail($to, $subject, $message, $headers);
        } 
    }
?>