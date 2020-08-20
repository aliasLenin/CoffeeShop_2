<?php

	define('METHOD','AES-256-CBC');
	define('SECRET_KEY','$JOSE@2020');
	define('SECRET_IV','101712');

	class encriptar {
		public function encryption($clave){
			$output=FALSE;
			$key=hash('sha256', SECRET_KEY);
			$iv=substr(hash('sha256', SECRET_IV), 0, 16);
			$output=openssl_encrypt($clave, METHOD, $key, 0, $iv);
			$output=base64_encode($output);
			return $output;
		}
		public function decryption($clave){
			$key=hash('sha256', SECRET_KEY);
			$iv=substr(hash('sha256', SECRET_IV), 0, 16);
			$output=openssl_decrypt(base64_decode($clave), METHOD, $key, 0, $iv);
			return $output;
		}
	}

?>