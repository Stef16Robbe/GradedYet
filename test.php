<!DOCTYPE html >
<html>
    <head>
        <link rel='stylesheet' type='text/css' href='./test.css'>
        <link href='https://fonts.googleapis.com/css?family=Roboto&display=swap' rel='stylesheet'>
        <meta name='viewport' content='width=device-width, initial-scale=1'>
    </head>
    <body>
        <form action='index.php' method='post'>
            <input type='submit' value='log in'>
        </form>

        <div class='loginForm'>
            <div class='formItems'>
                <div class='formTitle'>
                    <h2 id='formTitleH2'>Teacher Login</h2>
                </div>
                <div class='formEmailSection'>
                    <img src='./Images/Email.png' class='formEmailImg'>
                    <input type='email' placeholder='Email' name='Email' class='formEmail'>
                </div>
                <div class='formPasswordSection'>
                    <img src='./Images/Lock.png' class='formPasswordImg'>
                    <input type='password' placeholder='Password' name='Password' class='formPassword'>
                </div>
                <div class='formLogin'>
                    <input type='submit' value='Login' class='formLoginBtn'>
                </div>
                <br />
                <div class='forgotUPSection'>
                    <span id='forgotUPSpan'>Forgot <a href='#'> Username / Password ?</a></span>
                </div>
                <br />
                <div class='createAccountSection'>
                    <span id='createAccountSpan'>
                        <a href='#'>Create your account ➡ </a>
                    </span>
                </div>
            </div>
        </div>
    </body>
</html>