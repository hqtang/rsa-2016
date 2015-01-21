<?php

class Session
{
	
	public function __construct()
	{
		session_start();
	}

	public function get_userdata($key = "")
	{
		 if($key == "")
		 {
		 	return $_SESSION;
		 }
		 else
		 {
		 	$value = false;
		 	$sessions = $_SESSION;
		 	foreach($sessions as $session_key => $session_value)
		 	{
		 		if($session_key == $key)
		 		{
		 			$value = $session_value;
		 		}
		 	}
		 	return $value;
		 }
	}

	public function set_userdata($key = "", $value = "")
	{
		if($key != "" && ( $value != "" || !empty($value) ) )
		{
			$_SESSION[$key] = $value;
			return true;
		}
		else
		{
			return false;
		}
	}

	public function set_userdatas($values = array())
	{
		if(!empty($values))
		{
			foreach($values as $key => $value)
			{
				$_SESSION[$key] = $value;
			}
			return true;
		}
		else
		{
			return false;
		}
	}


	public function set_flashdata($key, $value)
	{
		$this->set_userdata($key, $value);
	}

	public function get_flashdata($key)
	{
		$value = $this->get_userdata($key);
		$this->unset_userdata($key);
		return $value; 
	}

	public function unset_userdata($key)
	{
		unset($_SESSION[$key]);
	}
	public function destroy()
	{
		// remove all session variables
		session_unset(); 

		// destroy the session 
		session_destroy(); 
	}

}