<?php
	$email = $_POST["inputEmail"];

	//var_dump($_POST);

	$ch = curl_init();
	curl_setopt($ch, CURLOPT_URL, "https://www.google.com/recaptcha/api/siteverify");
	curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
	curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);

	curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query(array(
		"secret"=>"",  //adicionar a chave disponibilizada pela Google
		"response"=>$_POST["g-recaptcha-response"],
		"remoteip"=>$_SERVER["REMOTE_ADDR"]  //captura o ip do usuário
	)));

	curl_setopt($ch, CURLOPT_RETURNTRANSFER, true); 

	$recaptcha = json_decode(curl_exec($ch), true); //resposta do Google

	curl_close($ch);

	//var_dump($recaptcha);

	if ($recaptcha["success"] === true) {
		echo "Email ".$_POST["inputEmail"]." cadastrado com sucesso!";
	} else {
		header("Location: index.html");
	}

?>