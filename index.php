<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta content="width=device-width, initial-scale=1" name="viewport" />
    <title>Bank Savemander</title>
    <link rel="stylesheet" href="style/login-styles.css">
</head>
<body>
    <?php 
        session_start();

        echo '<a href="./index.php?user_login=1"></a>'; 
        
        if (isset($_SESSION['error_message']))
        {
            echo "<script>alert('" . $_SESSION['error_message'] . "');</script>";
            unset($_SESSION['error_message']);
        }

        $EMAIL_PATTERN = "[^@\s]+@[^@\s]+\.[^@\s]+";
        $PASSWORD_PATTERN = "^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[!@#$%^&*])[A-Za-z\d!@#$%^&*]{8,}$";

    ?>

    <?php
        // echo <<< USER_ACTION
        //     <a href="index.php?user_login=1"><input type="button" value="Login"></a>
        //     <a href="index.php?user_login=0"><input type="button" value="Register"></a>
        // USER_ACTION;



        // Display login form if user_login is not set or is true
        if (!isset($_GET["user_login"]) || $_GET["user_login"]) {
            echo <<< LOGIN_FORM
                <div class="navbar-logo-left wf-section">
                    <div
                    data-animation="default"
                    data-collapse="medium"
                    data-duration="400"
                    data-easing="ease"
                    data-easing2="ease"
                    role="banner"
                    class="navbar-logo-left-container shadow-three w-nav"
                    >
                        <div class="container-3">
                            <img
                            src="./pages/img/brand-name.svg"
                            class="image-3"
                            />
                        </div>
                    </div>
                </div>
                <section class="section-3 wf-section">
                    <div class="container-l w-container">
                        <h1 class="heading">
                            Login
                        </h1>
                        <div class="w-form">
                            <form
                            id="email-form"
                            name="email-form"
                            data-name="Email Form"
                            action="scripts/handlers/user_handler.php?user_action=l"
                            method="POST"
                            >
                                <label for="login-mail" class="field-label">Enter login</label>
                                    <input
                                    type="text"
                                    class="text-field-2 w-input"
                                    autofocus="true"
                                    maxlength="50"
                                    name="email"
                                    data-name="login-mail"
                                    placeholder="Enter your email"
                                    pattern="$EMAIL_PATTERN"
                                    title="Invalid email address"
                                    id="login-mail"
                                    required
                                    />
                                <label for="password" class="field-label">Enter password</label>
                                    <input
                                    type="password"
                                    class="text-field-2 w-input"
                                    maxlength="60"
                                    name="password"
                                    data-name="password"
                                    placeholder="Enter password"
                                    id="password"
                                    required
                                    />
                                <input
                                type="submit"
                                value="Login"
                                data-wait="Please wait..."
                                class="submit-button w-button"
                                />
                            </form>
                        </div>
                        <a href="./index.php?user_login=0" class="link">
                            Click here if you want to create an account.
                        </a>
                    </div>
                </section>
            LOGIN_FORM;

            // <form action="scripts/handlers/user_handler.php?user_action=l" method="POST">
            // <input type="text" name="email" pattern="$EMAIL_PATTERN" title="Invalid email address" placeholder="Email" required> <br>
            // <input type="password" name="password" placeholder="Password" required> <br>
            // <input type="submit" value="Login">
            // </form>
        }
        // Display register form if user_login is false
        else if (!$_GET["user_login"]) {
            echo <<< REGISTER_FORM
                <div class="navbar-logo-left wf-section">
                    <div class="container-3">
                        <img
                            src="./pages/img/brand-name.svg"
                            loading="lazy"
                            alt=""
                            class="image-3"
                        />
                    </div>
                </div>
                <section class="section-3 wf-section">
                    <div class="container-r w-container">
                        <h1 class="heading">
                            Register
                        </h1>
                        <div class="w-form">
                            <form
                            id="email-form"
                            name="email-form"
                            data-name="Email Form"
                            action="scripts/handlers/user_handler.php?user_action=r"
                            method="POST"
                            class="form"
                            >
                            <div class="div-block-8">
                            <div class="div-block-9">
                              <label for="first-name" class="field-label">FIRST NAME</label>
                              <input
                              type="text"
                              class="text-field-2 w-input"
                              autofocus="true"
                              maxlength="50"
                              name="first_name"
                              data-name="first-name"
                              placeholder="Enter your first name"
                              id="first-name"
                              required
                              /><label for="last-name" class="field-label">LAST NAME</label>
                              <input
                              type="text"
                              class="text-field-2 w-input"
                              maxlength="50"
                              name="last_name"
                              data-name="last-name"
                              placeholder="Enter your last name"
                              id="last-name"
                              required
                              /><label for="email" class="field-label">Email</label>
                              <input
                              type="text"
                              class="text-field-2 w-input"
                              maxlength="50"
                              name="email"
                              data-name="email"
                              placeholder="Enter your email"
                              id="email"
                              pattern="$EMAIL_PATTERN"
                              title="Invalid email address"
                              required
                              /><label for="street-adress-4" class="field-label">Password</label>
                              <input
                              type="password"
                              class="text-field-2 w-input"
                              maxlength="60"
                              name="password"
                              data-name="street-adress-2"
                              placeholder="Enter your password"
                              id="street-adress-5"
                              minlength="8"
                              pattern="$PASSWORD_PATTERN" 
                              title="Password needs to include one lowercase letter, one uppercase letter, one number and one special character"
                              required
                              />
                            </div>
                            <div class="div-block-10">
                            <label for="street-adress-3" class="field-label">Address</label>
                            <input
                            type="text"
                            class="text-field-2 w-input"
                            maxlength="50"
                            name="address"
                            data-name="street-adress"
                            placeholder="Enter your street address"
                            id="street-adress-3"
                            required
                            /><label for="phone-number" class="field-label">phone number</label>
                            <input
                            type="tel"
                            class="text-field-2 w-input"
                            maxlength="9"
                            name="phone_number"
                            data-name="phone-number"
                            placeholder="e.g. 123456789"
                            id="phone-number"
                            required
                            />
                              <div class="div-block-5">
                                <div class="div-block-6">
                                <label for="pesel" class="field-label">PESEL</label>
                                <input
                                type="text"
                                class="text-field-2 w-input"
                                minlength="11"
                                maxlength="11"
                                name="pesel"
                                data-name="City 2"
                                id="pesel"
                                placeholder="e.g. 01123456789"
                                required
                                />
                                </div>
                                <div class="div-block-12">
                                  <label class="w-checkbox"
                                    ><span class="w-form-label" 
                                      >By registering, I agree to:
                                      <a href="http://www.example.com" target="_blank"
                                        >terms &amp; conditions.</a
                                      ></span
                                    ></label
                                  >
                                </div>
                              </div>
                            </div>
                          </div>
                                <input
                                type="submit"
                                value="Register"
                                data-wait="Please wait..."
                                class="submit-button w-button"
                                />
                            </form>
                        </div>
                        <a href="./index.php?user_login=1" class="link">Click here if you have an account.</a>
                    </div>
                </section>
            REGISTER_FORM;

            // <form action="scripts/handlers/user_handler.php?user_action=r" method="POST">
            // <input type="text" name="first_name" placeholder="First name" required> <br>
            // <input type="text" name="last_name" placeholder="Last name" required> <br>
            // <input type="text" name="email" pattern="$EMAIL_PATTERN" title="Invalid email address" placeholder="Email" required> <br>
            // <input type="password" minlength="8" name="password" pattern="$PASSWORD_PATTERN" title="Password needs to include one lowercase letter, one uppercase letter, one number and one special character" placeholder="Password" required> <br>
            // <input type="text" minlength="11" maxlength="11" name="pesel" placeholder="PESEL" required> <br>
            // <input type="text" name="address" placeholder="Address" required> <br>
            // <input type="text" minlength="9" maxlength="9" name="phone_number" placeholder="Phone number" required> <br>
            // <input type="submit" value="Register">
            // </form>
        }
    ?>

    </body>
</html>