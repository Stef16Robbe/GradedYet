<?php 
require_once("Autoloader.php");

class LoginView
{
	private $LoginController;
	private $LoginModel;
	private $LoginAccountErrorMessage;

	public function __construct($LoginController, $LoginModel)
	{
		$this->LoginController = $LoginController;
		$this->LoginModel = $LoginModel;
	}

	public function output() {
    $this->RegisterAccountErrorMessage = $this->LoginController->LoginTeacher();
		$page = "";
		$page .= $this->Header();
		$page .= $this->Body();
		$page .= $this->Footer();
		return $page;
	}

	private function Header() {
		return "
		<!DOCTYPE HTML>
		<html>
			<head> 
				<title> GradedYet </title>
				<link rel='stylesheet' type='text/css' href='./CSS/LoginStyle.css'>
        <link rel='stylesheet' href='https://fonts.googleapis.com/css?family=Roboto&display=swap'>
        <link rel='stylesheet' href='https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.bundle.min.js'>
        <link rel='stylesheet' href='https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css'>
        <script src='https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.bundle.min.js'></script>
			</head>
		</html>
		";
	}

	private function Body() {
		return "
		<body>
        <div class='container-fluid'>
        <div class='row no-gutter'>
          <div class='d-none d-md-flex col-md-4 col-lg-6 bg-image'></div>
          <div class='col-md-8 col-lg-6'>
            <div class='login d-flex align-items-center py-5'>
              <div class='container'>
                <div class='row'>
                  <div class='col-md-9 col-lg-8 mx-auto'>
                    <h3 class='login-heading mb-4'>Welcome back!</h3>
                    <form type='post' action=''>
                      <div class='form-label-group'>
                        <input type='email' id='inputEmail' name='email' class='form-control' placeholder='Email address' value='".$this->LoginController->CheckCookie()."' required autofocus>
                        <label for='inputEmail'>Email address</label>
                      </div>
      
                      <div class='form-label-group'>
                        <input type='password' id='inputPassword' name='password' class='form-control' placeholder='Password' required>
                        <label for='inputPassword'>Password</label>
                      </div>
      
                      <div class='custom-control custom-checkbox mb-3'>
                        <input type='checkbox' class='custom-control-input' id='rememberPasswordCheck' name='rememberPasswordCheck'>
                        <label class='custom-control-label' for='rememberPasswordCheck'>Remember password</label>
                      </div>
                      <!-- userfeedback box -->
                      <p id='negativeFeedbackText'> ".$this->LoginAccountErrorMessage."</p>
                      <button class='btn btn-lg btn-primary btn-block btn-login text-uppercase font-weight-bold mb-2' name='loginBtn' formmethod='post' type='submit'>Sign in</button>
                      <div class='text-center'>
                        <a class='medium' href='#'>Forgot password?</a>
                      </div>
                      <div class='text-center'>
                        <a class='small' href='Register.php'>New Teacher?</a>
                      </div>
                    </form>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
		</body>
		";
	}

	private function Footer() {
		return "";
	}
}
?>