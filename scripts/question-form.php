<?php
if (isset($_POST['send-question'])) {
	$name = trim($_POST['name']);
	$email = trim($_POST['email']);
	$question = trim($_POST['question']);

	$errors = [];

	if ($name == '') {
		$errors[] = 'Enter your name';
	} elseif (strlen($name) > 50) {
		$errors[] = 'Name too long';
	}
	if ($email == '') {
		$errors[] = 'Enter your email';
	} elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
		$errors[] = 'Invalid email';
	}
	if ($question == '') {
		$errors[] = 'Enter your question';
	} elseif (strlen($question) > 300) {
		$errors[] = 'Question too long';
	}

	if (empty($errors)) {
		$message = "Имя: $name \nE-mail: $email \nТема: Вопрос \nТекст: $question";
		$sendTo = "valromrin@mail.ru";

		$send = mail($sendTo, "Вопрос", $message);

		if ($send == 'true') {
			echo '<div class="send-successful">Your message has been sent</div>';
		} else {
			echo '<script type="text/javascript">let err = document.querySelector(".send-error");
					err.style.display = "block";
			</script>';
		}
	} else {
		echo '<div class="errors">';
		foreach ($errors as $error) {
			echo '<div class="error">'.$error.'</div>';
		};
		echo '</div>';
		
	}
	echo "<script type='text/javascript'>document.querySelector('.block5').scrollIntoView({
			block: 'start'
	    })</script>";
}
?>