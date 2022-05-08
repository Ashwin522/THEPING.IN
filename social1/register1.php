<?php
require 'config/config.php';
require 'includes/form_handlers/register_handler.php';
require 'includes/form_handlers/login_handler.php';
?>


<html>

<head>
    <title>Welcome to PING!</title>
    <link rel="stylesheet" type="text/css" href="assets/css/register_style.css">
    <link href="https://fonts.googleapis.com/css2?family=Comfortaa&family=Expletus+Sans&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Nunito+Sans:wght@700&display=swap" rel="stylesheet">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
    <script src="assets/js/register.js"></script>
</head>

<body>

    <?php
    

    if (isset($_POST['register_button'])) {
        echo '
        <script>

        $(document).ready(function() {
            $("#first").hide();
            $("#second").show();
        });

        </script>

        ';
    }


    ?>

    <div class="wrapper">

        <div class="bgm">
            <svg xmlns="http://www.w3.org/2000/svg" preserveAspectRatio="xMidYMid meet"
                xmlns:xlink="http://www.w3.org/1999/xlink" viewBox="0 0 1458.93 1800.31">
                <defs>
                    <style>
                    .cls-1 {
                        fill: url(#linear-gradient);
                    }

                    .cls-2 {
                        fill: url(#linear-gradient-2);
                    }

                    .cls-3 {
                        fill: url(#linear-gradient-3);
                    }
                    </style>
                    <linearGradient id="linear-gradient" x1="-51.38" y1="902.12" x2="1484.65" y2="902.12"
                        gradientUnits="userSpaceOnUse">
                        <stop offset="0" stop-color="#39f" />
                        <stop offset="0.04" stop-color="#3e96fa" />
                        <stop offset="0.3" stop-color="#8285dd" />
                        <stop offset="0.54" stop-color="#b877c5" />
                        <stop offset="0.74" stop-color="#de6db4" />
                        <stop offset="0.9" stop-color="#f667aa" />
                        <stop offset="1" stop-color="#ff65a6" />
                    </linearGradient>
                    <linearGradient id="linear-gradient-2" x1="-51.38" y1="1743.23" x2="1484.65" y2="1743.23"
                        gradientTransform="translate(1300.59 346.55) rotate(45)" xlink:href="#linear-gradient" />
                    <linearGradient id="linear-gradient-3" x1="-51.38" y1="57.08" x2="1484.65" y2="57.08"
                        gradientTransform="translate(365.74 -768.82) rotate(45)" xlink:href="#linear-gradient" />
                </defs>
                <title>Asset 1</title>
                <g id="Layer_2" data-name="Layer 2">
                    <g id="Layer_1-2" data-name="Layer 1">
                        <path class="cls-1"
                            d="M1216.31,436h0a57.08,57.08,0,0,1,0-80.72l103.14-103.14a57.08,57.08,0,0,0,0-80.72h0a57.08,57.08,0,0,0-80.72,0l-186.1,186.11a57.08,57.08,0,0,1-80.72,0h0a57.08,57.08,0,0,1,0-80.72l49.32-49.33a57.06,57.06,0,0,0,0-80.72h0a57.08,57.08,0,0,0-80.72,0L16.72,1070.56a57.08,57.08,0,0,0,0,80.72h0a57.08,57.08,0,0,0,80.72,0L218.52,1030.2a57.08,57.08,0,0,1,80.72,0h0a57.08,57.08,0,0,0,80.72,0L419.2,991a57.08,57.08,0,0,1,80.72,0h0a57.08,57.08,0,0,1,0,80.72L321.66,1249.94a57.08,57.08,0,0,0,0,80.72h0a57.08,57.08,0,0,0,80.72,0l131.17-131.17a57.08,57.08,0,0,1,80.72,0h0a57.08,57.08,0,0,1,0,80.72L317.74,1576.75a57.08,57.08,0,0,0,0,80.72h0a57.08,57.08,0,0,0,80.72,0L1418.21,613.71a57.08,57.08,0,0,0,0-80.72h0a57.08,57.08,0,0,0-80.72,0L1221.91,672.57a57.08,57.08,0,0,1-80.72,0h0a57.08,57.08,0,0,1,0-80.72l75.12-75.12A57.08,57.08,0,0,0,1216.31,436Z" />
                        <rect class="cls-2" x="174.89" y="1686.15" width="114.16" height="114.16" rx="57.08" ry="57.08"
                            transform="translate(-1164.71 674.61) rotate(-45)" />
                        <rect class="cls-3" x="1053.85" width="114.16" height="114.16" rx="57.08" ry="57.08"
                            transform="translate(285.02 802.26) rotate(-45)" />
                    </g>
                </g>
            </svg>
        </div>

        <div class="login_box">

            <div class="login_header">
                <h1 style="font-family:Nunito Sans">PING!</h1>
                Login or sign up below!
            </div>
            <br>
            <div id="first">

                <form action="register1.php" method="POST">




                    <input type="email" name="log_email" placeholder="Email Address" value="<?php
                    if (isset($_SESSION['log_email'])) {
                        echo $_SESSION['log_email'];
                    }
                    ?>" required>
                    <br>
                    <input type="password" name="log_password" placeholder="Password">
                    <br>
                    <?php if (in_array("Email or password was incorrect<br>", $error_array)) {
                        echo  "Email or password was incorrect<br>";
                    } ?>
                    <input type="submit" class="submit" name="login_button" value="Login">
                    <a href="#" id="signup" class="signup">Need an account? Register here!</a>

                </form>

            </div>

            <div id="second">

                <form action="register1.php" method="POST">
                    <input type="text" name="reg_fname" placeholder="First Name" value="<?php
                    if (isset($_SESSION['reg_fname'])) {
                        echo $_SESSION['reg_fname'];
                    }
                    ?>" required>
                    <br>
                    <?php if (in_array("Your first name must be between 2 and 25 characters<br>", $error_array)) {
                        echo "Your first name must be between 2 and 25 characters<br>";
                    } ?>




                    <input type="text" name="reg_lname" placeholder="Last Name" value="<?php
                    if (isset($_SESSION['reg_lname'])) {
                        echo $_SESSION['reg_lname'];
                    }
                    ?>" required>
                    
                    <?php if (in_array("Your last name must be between 2 and 25 characters<br>", $error_array)) {
                        echo "Your last name must be between 2 and 25 characters<br>";
                    } ?>
                    <br>
                    <div class="gender-age-container">
                        <label for="gender">Gender</label>
                        <select class="gender" id="gender" name="gender" value="
                            <?php
                                if (isset($_SESSION['gender'])) {
                                    echo $_SESSION['gender'];}  
                            ?>
                        ">
                            <option value="--select--">--select--</option>
                            <option value="male">Male</option>
                            <option value="female">Female</option>
                            <option value="Others">Others</option>
                        </select>
                        
                        <?php if (in_array("not selected gender<br>", $error_array)) {
                            echo "NOT SELECTED GENDER<br>";
                        } 
                        ?>

                        <label for="age">Age</label>
                        <select class="age" name="age" value="<?php

                        if (isset($_SESSION['age'])) {
                            echo $_SESSION['age'];
                        }  ?>

                        " required>
                            <?php
                        for ($i=18; $i<50; $i++) {
                            ?>
                            <option value="0"></option>
                            <option value=".$i."><?php echo $i; ?></option>
                            <?php
                        }
                        ?>
                        </select>
                        <?php if (in_array("not selected age<br>", $error_array)) {
                            echo "NOT SELECTED AGE<br>";
                        } ?>
                        <br>
                        
                    </div>



                        <input type="email" name="reg_email" placeholder="Email" value="<?php
                    if (isset($_SESSION['reg_email'])) {
                        echo $_SESSION['reg_email'];
                    }
                    ?>" required>
                        <br>

                        <input type="email" name="reg_email2" placeholder="Confirm Email" value="<?php
                    if (isset($_SESSION['reg_email2'])) {
                        echo $_SESSION['reg_email2'];
                    }
                    ?>" required>
                        <br>
                        <?php if (in_array("Email already in use<br>", $error_array)) {
                        echo "Email already in use<br>";
                    } elseif (in_array("Invalid email format<br>", $error_array)) {
                        echo "Invalid email format<br>";
                    } elseif (in_array("Emails don't match<br>", $error_array)) {
                        echo "Emails don't match<br>";
                    } ?>


                        <input type="password" name="reg_password" placeholder="Password" required>
                        <br>
                        <input type="password" name="reg_password2" placeholder="Confirm Password" required>
                        <br>
                        <?php if (in_array("Your passwords do not match<br>", $error_array)) {
                        echo "Your passwords do not match<br>";
                    } elseif (in_array("Your password can only contain english characters or numbers<br>", $error_array)) {
                        echo "Your password can only contain english characters or numbers<br>";
                    } elseif (in_array("Your password must be betwen 5 and 30 characters<br>", $error_array)) {
                        echo "Your password must be betwen 5 and 30 characters<br>";
                    } ?>


                        <input type="submit" class="submit" name="register_button" value="Register">
                        <br>

                        <?php if (in_array("<span style='color: #14C800;'>You're all set! Go ahead and login!</span><br>", $error_array)) {
                        echo "<span style='color: #14C800;'>You're all set! Go ahead and login!</span><br>";
                    } ?>
                        <a href="#" id="signin" class="signup">Already have an account? Sign in here!</a>
                </form>
            </div>

        </div>

    </div>


</body>

</html>