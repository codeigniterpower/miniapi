<?php
	/* Copyright (c) by Hugo Leisink <hugo@leisink.net>
	 * This file is part of the Banshee PHP framework
	 * https://www.banshee-php.org/
	 *
	 * Licensed under The MIT License
	 */

	class validator {
		private $msg = null;
		private $messages = array(
			"boolean"   => "El campo [label] debería contener un booleano",
			"charset"   => "El campo [label] contiene caracteres no válidos.",
			"email"     => "El campo [label] contiene una dirección de correo electrónico no válida.",
			"enum"      => "El campo [label] es invalido.",
			"integer"   => "The field [label] should contain an integer.",
			"float"     => "El campo [label] debe contener un número decimal.",
			"intmin"    => "El valor de [label] debe ser al menos [min].",
			"intmax"    => "El valor de [label] debe ser como máximo [max].",
			"pattern"   => "El campo [label] no coincide con el patrón requerido.",
			"required"  => "El campo [label] no puede estar vacío.",
			"timestamp" => "El campo [label] contiene una marca de tiempo no válida.",
			"minlen"    => "La longitud de [label] debe ser al menos [minlen].",
			"maxlen"    => "La longitud de [label] no debe exceder de [maxlen].."
        );
        private $arrayvars = null;

		/* Constructor
		 *
		 * INPUT:  object view
		 * OUTPUT: -
		 * ERROR:  -
		 */
		public function __construct($arrayvars = null) {
			if(is_array($arrayvars) and count($arrayvars) > 0)
				$this->arrayvars = $arrayvars;
			elseif(is_array($_POST) and count($_POST) > 0
				$this->arrayvars = $_POST;
			else
				$this->arrayvars = $_GET;
		}

		/* Add validation feedback to output
		 *
		 * INPUT:  int message index, array message replacements
		 * OUTPUT: -
		 * ERROR:  -
		 */
		private function add_message($msg_idx, $replacements) {
			if (isset($replacements["message"])) {
				$message = $replacements["message"];
			} else {
				$message = $this->messages[$msg_idx];
				foreach ($replacements as $from => $to) {
					$message = str_replace("[".$from."]", $to, $message);
				}
			}

			$this->msg = $message;
		}

		/* Start validation process
		 *
		 * INPUT:  array pattern to validate POST data
		 * OUTPUT: boolean validation oke
		 * ERROR:  -
		 */
		public function execute($pattern,$arrayvars = null) {

			if(is_array($arrayvars) and count($arrayvars) > 0)
				$this->arrayvars = $arrayvars;
			elseif(is_array($_POST) and count($_POST) > 0
				$this->arrayvars = $_POST;
			else
				$this->arrayvars = $_GET;
			$result = true;

			foreach ($pattern as $name => $rule) {
				if (isset($rule["label"]) == false) {
					$rule["label"] = $name;
				}

				if ($rule["required"] === true) {
					if ($this->arrayvars[$name] == "") {
						$this->add_message("required", $rule);
						$result = false;
						continue;
					}
				}

				switch ($rule["type"]) {
					case "boolean":
						if (($this->arrayvars[$name] != null) && ($this->arrayvars[$name] != "On")) {
							$this->add_message("boolean", $rule);
							$result = false;
						}
						break;
					case "email":
						if ($this->arrayvars[$name] != "") {
							if (valid_email($this->arrayvars[$name]) == false) {
								$this->add_message("email", $rule);
								$result = false;
							}
						}
						break;
					case "enum":
						if ($this->arrayvars[$name] != "") {
							if (in_array($this->arrayvars[$name], $rule["values"]) == false) {
								$this->add_message("enum", $rule);
								$result = false;
							}
						}
						break;
					case "integer":
						if (valid_input($this->arrayvars[$name], VALIDATE_NUMBERS) == false) {
							$this->add_message("integer", $rule);
							$result = false;
						} else {
							if (isset($rule["min"])) {
								if ($this->arrayvars[$name] < $rule["min"]) {
									$this->add_message("intmin", $rule);
									$result = false;
								}
							}

							if (isset($rule["max"])) {
								if ($this->arrayvars[$name] > $rule["max"]) {
									$this->add_message("intmax", $rule);
									$result = false;
								}
							}
						}
						break;
					case "float":
						if (is_numeric($this->arrayvars[$name]) == false) {
							$this->add_message("float", $rule);
							$result = false;
						}
						break;
					case "string":
						if (isset($rule["minlen"])) {
							if (strlen($this->arrayvars[$name]) < $rule["minlen"]) {
								$this->add_message("minlen", $rule);
								$result = false;
							}
						}

						if (isset($rule["maxlen"])) {
							if (strlen($this->arrayvars[$name]) > $rule["maxlen"]) {
								$this->add_message("maxlen", $rule);
								$result = false;
							}
						}

						if (isset($rule["charset"])) {
							if (valid_input($this->arrayvars[$name], $rule["charset"]) == false) {
								$this->add_message("charset", $rule);
								$result = false;
							}
						}

						if (isset($rule["pattern"])) {
							if (preg_match("/".$rule["pattern"]."/", $this->arrayvars[$name]) == false) {
								$this->add_message("pattern", $rule);
								$result = false;
							}
						}
						break;
					case "timestamp":
						if ($this->arrayvars[$name] != "") {
							if (valid_timestamp($this->arrayvars[$name]) == false) {
								$this->add_message("timestamp", $rule);
								$result = false;
							}
						}
						break;
					default:
						$this->view->add_message("Tipo de valor no válido para ".$rule["label"].".");
				}
			}

			return [$result, $this->msg];
		}
	}
?>
