<?php namespace tinyPHP\Classes\Models;
/**
 *
 * Save Query Model
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

use \tinyPHP\Classes\Core\DB;
class SavequeryModel {
    
    private $_auth;
    
    public function __construct() {
        $this->_auth = new \tinyPHP\Classes\Libraries\Cookies;
    }
	
	public function index() {}
	
	public function save($data) {
	    $date = date('Y-m-d');   		
		$bind = array( 
            "personID" => $data['personID'], "savedQueryName" => $data['savedQueryName'],
            "savedQuery" => $data['savedQuery'],"createdDate" => $date,"purgeQuery" => $data['purgeQuery']
		);
					
		$q = DB::inst()->insert( "saved_query", $bind );
		
		if(!$q) {
			redirect( BASE_URL . 'error/save_query' );
		} else {
			redirect( BASE_URL . 'savequery/' . bm() );
		}
	}
    
    public function edit($data) {
        $update = array( 
            "savedQueryName" => $data['savedQueryName'],"savedQuery" => $data['savedQuery'],
            "purgeQuery" => $data['purgeQuery']
        );
            
        $bind = array( ":savedQueryID" => $data['savedQueryID'],":personID" => $data['personID'] );
        
        $q = DB::inst()->update( "saved_query",$update,"savedQueryID = :savedQueryID AND personID = :personID",$bind );
                
        redirect( BASE_URL . 'savequery/view/' . $data['savedQueryID'] . '/' . bm() );
    }
    
    public function queryList() {
        $bind = array(":user" => $this->_auth->getPersonField('personID'));
        $q = DB::inst()->select( "saved_query","personID = :user","savedQueryID","*",$bind );
        foreach($q as $k => $v) {
            $array[] = $v;
        }
        return $array;
    }
    
    public function query($id) {
        $bind = array( ":id" => $id, ":user" => $this->_auth->getPersonField('personID') );
        $q = DB::inst()->query( "SELECT * FROM saved_query WHERE savedQueryID = :id AND personID = :user LIMIT 1", $bind );
        foreach($q as $k => $v) {
            $array[] = $v;
        }
        return $array;
    }
    
    public function delete($id) {
        $bind = array( ":savedQueryID" => $id, ":user" => $this->_auth->getPersonField('personID') );
        $q = DB::inst()->query( "DELETE FROM saved_query WHERE savedQueryID = :savedQueryID AND personID = :user", $bind );
        
        if($q) {
            redirect( BASE_URL . 'savequery/' . bm() );
        } else {
            redirect( BASE_URL . 'error/delete_record/');
        }
    }
    
    public function __destruct() {
        DB::inst()->close();
    }

}