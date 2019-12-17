<?php
class Config
{
	private static $instance = null;	
	
	private function __construct(){	}
  
	public static function getInstance() {
		return new Config();
	}

	public function GetAPIKey() {
		//return APIKey
		return "";
	}

	public function SetFooter() {
		return "<div class='Footer'>
		<p id='DesignedBy'>Designed by: Chris Lips, Thijs van Tol, Tim Gras, Stan Roozendaal en Stef Robbe
		<image class='MediaIcons' src='Images/instagram-icon-black.png'>
		<image class='MediaIcons' src='Images/facebook-icon.png'>
		</p>
	</div>
	</body></html>";
	}
}
?>