<?php

/**
 * New BSD License
 *
 * Copyright (C) 2013 Kevin Ryser (http://framework.koweb.ch) All rights reserved
 * See the LICENSE file for the full license text.
 */

/**
 * For the moment the library doesn't support multi-line editing.
 */

Class ConfigEditor
{
	private $_file_path = '';
	private $_file_data = '';

	public function __construct($file_path)
	{
		$this->_file_path = $file_path;
		if (is_file($this->_file_path))
			$this->_file_data = file_get_contents($this->_file_path);
	}

	public function to_text_array($value)
	{
		$arr = '';
		foreach ($value as $k => $v)
		{
			if (is_array($v))
				$arr .= ', \'' . $k . '\' => ' . $this->to_text_array($v);
			else
			{
				if (is_string($k))
				{
					$arr .= ((empty($arr)) ? 'array(' : ', ');
					$arr .= ((is_string($k)) ? '\'' . $k . '\'' : $k) . ' => ';
					$arr .= ((is_string($v)) ? '\'' . $v . '\'' : $v);
				}
				else
				{
					$arr .= ((empty($arr)) ? 'array(' : ', ');
					$arr .= ((is_string($v)) ? '\'' . $v . '\'' : $v);
				}
			}
		}

		$value = $arr . ')';
		return $value;
	}

	public function set($key, $value)
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

		if (preg_match('/\$config\[["\']' . $key . '["\']\] ?= ?["\']?.*["\']?;/', $this->_file_data))
			$this->_file_data = preg_replace('/\$config\[["\']' . $key . '["\']\] ?= ?["\']?.*["\']?;/', "\$config['" . $key . "'] = " . $value . ";", $this->_file_data);
		else
			$this->_file_data .= PHP_EOL . '$config[\'' .  $key . '\'] = ' . $value . ';';
	}

	public function save()
	{
		return file_put_contents($this->_file_path, $this->_file_data, LOCK_EX) !== false;
	}
}