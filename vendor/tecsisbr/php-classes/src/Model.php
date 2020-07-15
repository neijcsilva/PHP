<?php 

namespace Tecsis;

class Model {

	private $values = [];

	public function __call($name, $args)
	{

		$method = substr($name, 0, 3);                      //"Pega" os primeiros três caracteres 
		$fieldName = substr($name, 3, strlen($name));       //"Pega" o resto dos caracteres
	
		switch ($method)
		{

			case "get":
				return (isset($this->values[$fieldName])) ? $this->values[$fieldName] : NULL;
			break;

			case "set":
				$this->values[$fieldName] = $args[0];
			break;

		}

	}

	public function setData($data = array())
	{

		foreach ($data as $key => $value) {
			
			$this->{"set".$key}($value);

		}

	}

	public function getValues()
	{

		return $this->values;

	}

}

 ?>