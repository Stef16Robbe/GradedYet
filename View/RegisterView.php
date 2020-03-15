<?php 
require_once("Autoloader.php");

class RegisterView
{
	private $RegisterController;
	private $RegisterModel;
	private $RegisterAccountErrorMessage;

	public function __construct($RegisterController, $RegisterModel)
	{
		$this->RegisterController = $RegisterController;
		$this->RegisterModel = $RegisterModel;
		$this->ErrorMessageLogin = "";
	}


	public function output() {
    $this->RegisterAccountErrorMessage = $this->RegisterController->RegisterTeacher();
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
				<link rel='stylesheet' type='text/css' href='./CSS/RegisterStyle.css'>
        <!--<link rel='stylesheet' href='https://fonts.googleapis.com/css?family=Roboto&display=swap'>
        <link rel='stylesheet' href='https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.bundle.min.js'>
        <link rel='stylesheet' href='https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css'>
        <script src='https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.bundle.min.js'></script>-->
			</head>
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
                    <h3 class='login-heading mb-4'>Register Teacher Account</h3>
                    <form type='post' action=''>
                      <div class='form-list'>
                        <input list='schools' id='inputSchool' placeholder='Your School*' name='RegisterTeacherSchool' required>
                        <datalist id='schools'>
                          ".$this->RegisterController->GetExistingSchools()."
                        </datalist>
                      </div>

                      <br />

                      <div class='form-label-group'>
                        <input type='text' id='inputName' class='form-control' placeholder='First Name' name='RegisterTeacherName' required>
                        <label for='inputName'>First Name*</label>
                      </div>

                      <div class='form-label-group'>
                        <input type='text' id='inputPrefix' class='form-control' placeholder='Prefix' name='RegisterTeacherPrefix'>
                        <label for='inputPrefix'>Prefix</label>
                      </div>

                      <div class='form-label-group'>
                        <input type='text' id='inputLastName' class='form-control' placeholder='Last Name' name='RegisterTeacherLastName' required>
                        <label for='inputLastName'>Last Name*</label>
                      </div>

                      <div class='form-label-group'>
                        <input type='email' id='inputEmail' class='form-control' placeholder='Email address' name='RegisterTeacherEmail'  required>
                        <label for='inputEmail'>Email address*</label>
                        <!-- pattern='/[a-zA-Z]@inholland.nl/' -->
                      </div>

                      <div class='form-label-group'>
                        <input type='password' id='inputPassword' class='form-control' placeholder='Password' name='RegisterTeacherPassword'  required>
                        <label for='inputPassword'>Password*</label>
                        <!-- pattern='/^(?=[a-z])(?=[A-Z])[a-zA-Z]{8,}$/' -->
                      </div>

                      <!-- userfeedback box -->
                      <p id='negativeFeedbackText'> ".$this->RegisterAccountErrorMessage."</p>

                      <button class='btn btn-lg btn-primary btn-block btn-login text-uppercase font-weight-bold mb-2' type='submit' formmethod='post' name='RegisterTeacherBtn'>Register Account</button>
                    </form>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </body>
    </html>
		";
	}

	private function Footer() {
		return "";
	}
}
?>