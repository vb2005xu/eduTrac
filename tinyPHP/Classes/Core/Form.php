<?php namespace tinyPHP\Classes\Core;
/**
 *
 * Form
 *  
 * PHP 5
 *
 * eduTrac(tm) : Student Information System (http://www.7mediaws.org/)
 * Copyright (C) 2013 Joshua Parker
 *
 * This program is free software; you can redistribute it and/or
 * modify it under the terms of the GNU General Public License
 * as published by the Free Software Foundation; either version 3
 * of the License, or (at your option) any later version.
 *
 * This program is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 * GNU General Public License for more details.
 * 
 * You should have received a copy of the GNU General Public License
 * along with this program. If not, see <http://www.gnu.org/licenses/>.
 * 
 * @since eduTrac(tm) v 1.0
 * @license GNU General Public License v3 (http://www.gnu.org/licenses/gpl-3.0.html)
 */

if ( ! defined('BASE_PATH') ) exit('No direct script access allowed');

class Form {
	
	/** @var array $_currentItem The immediately posted item*/
	private $_currentItem = null;
	
	/** @var array $_postData Stores the Posted Data */
	private $_postData = array();
	
	/** @var object $_val The validator object */
	private $_val = array();
	
	/** @var array $_error Holds the current forms errors */
	private $_error = array();
	
	/**
	 * __construct - Instantiates the validator class
	 * 
	 */
	public function __construct() {
		$this->_val = new \tinyPHP\Classes\Core\Val();
	}
	
	/**
	 * post - This is to run $_POST
	 * 
	 * @param string $field - The HTML fieldname to post
	 */
	public function post($field) {
		$this->_postData[$field] = $_POST[$field];
		$this->_currentItem = $field;
		
		return $this;
	}
	
	/**
	 * fetch - Return the posted data
	 * 
	 * @param mixed $fieldName
	 * 
	 * @return mixed String or array
	 */
	public function fetch($fieldName = false) {
		if ($fieldName) {
			if (isset($this->_postData[$fieldName]))
			return $this->_postData[$fieldName];
			
			else
			return false;
		} else {
			return $this->_postData;
		}
		
	}
	
	/**
	 * val - This is to validate
	 * 
	 * @param string $typeOfValidator A method from the Form/Val class
	 * @param string $arg A property to validate against
	 */
	public function val($typeOfValidator, $arg = null) {
		if ($arg == null)
		$error = $this->_val->{$typeOfValidator}($this->_postData[$this->_currentItem]);
		else
		$error = $this->_val->{$typeOfValidator}($this->_postData[$this->_currentItem], $arg);
		
		if ($error)
		$this->_error[$this->_currentItem] = $error;
		
		return $this;
	}
	
	/**
	 * submit - Handles the form, and throws an exception upon error.
	 * 
	 * @return boolean
	 * 
	 * @throws Exception 
	 */
	public function submit() {
		if (empty($this->_error)) {
			return true;
		} else {
			$str = '';
			foreach ($this->_error as $key => $value) {
				$str .= $key . ' => ' . $value . "\n";
			}
			throw new \Exception($str);
		}
	}
}