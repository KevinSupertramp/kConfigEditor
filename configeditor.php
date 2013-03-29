<?php

/**
 * New BSD License
 *
 * Copyright (C) 2013 Kevin Ryser (http://framework.koweb.ch) All rights reserved
 * See the LICENSE file for the full license text.
 */

Class ConfigEditor
{
	private $_file_path = '';
	private $_file_data = '';
	private $_array_depth = 0;

	public function __construct($file_path)
	{
		$this->_file_path = $file_path;
		if (is_file($this->_file_path))
			$this->_file_data = file_get_contents($this->_file_path);
	}

	public function to_text_array($value)
	{
		$arr = '';
		++$this->_array_depth;

		foreach ($value as $k => $v)
		{
			if (empty($arr))
				$arr .= "array(\r\n";

			for ($i = 0; $i < $this->_array_depth; ++$i)
				$arr .= '	';

			if (is_array($v))
				$arr .= ((is_string($k)) ? '\'' . $k . '\'' : $k) . ' => ' . $this->to_text_array($v);
			else
			{
				// Not very clean but constant function throw an excepetion if the constant doesn't exist...
				if (DEBUG_MODE)
					error_reporting(0);

				if (is_string($k))
				{
					$arr .= ((!constant($k)) ? '\'' . $k . '\'' : $k) . ' => ';
					$arr .= ((is_string($v) and !constant($v)) ? '\'' . $v . '\'' : $v) . ",\r\n";
				}
				else
					$arr .= ((is_string($v) and !constant($v)) ? '\'' . $v . '\'' : $v) . ",\r\n";

				// Enable debug mode again
				if (DEBUG_MODE)
					error_reporting(E_ALL | E_STRICT);
			}
		}

		--$this->_array_depth;
		for ($i = 0; $i < $this->_array_depth; ++$i)
			$arr .= '	';

		$value = $arr . ')';
		if ($this->_array_depth != 0)
			$value .= "\r\n";
		return $value;
	}

	public function set($key, $value, $comment = null)
	{
		if (is_array($value))
			$value = $this->to_text_array($value);
		elseif (is_bool($value))
			$value = ($value) ? 'true' : 'false';
		elseif (is_float($value))
			$value = floatval($value);
		elseif (is_int($value))
			$value = intval($value);
		elseif (empty($value))
			$value = 'false';
		else
			$value = '\'' . addslashes($value) . '\'';

		if (preg_match('/\$config\[["\']' . $key . '["\']\](.*);/msU', $this->_file_data))
			$this->_file_data = preg_replace('/\$config\[["\']' . $key . '["\']\](.*);/msU', "\$config['" . $key . "'] = " . $value . ";", $this->_file_data);
		else
			$this->_file_data .= PHP_EOL . '$config[\'' .  $key . '\'] = ' . $value . ';';

		$this->_array_depth = 0;
	}

	public function save()
	{
		return file_put_contents($this->_file_path, $this->_file_data, LOCK_EX) !== false;
	}
}