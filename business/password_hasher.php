<?php
	class PasswordHasher {
		public static function Hash($password_to_hash) {
			$hashed_password = password_hash($password_to_hash, PASSWORD_DEFAULT);
			
			return $hashed_password;	
		}
	}
?>