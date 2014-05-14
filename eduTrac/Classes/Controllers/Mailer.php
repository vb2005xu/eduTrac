<?php namespace eduTrac\Classes\Controllers;
if ( ! defined('BASE_PATH') ) exit('No direct script access allowed');
/**
 * Mailer Controller
 *  
 * PHP 5.4+
 *
 * eduTrac(tm) : Student Information System (http://www.7mediaws.org/)
 * @copyright (c) 2013 7 Media Web Solutions, LLC
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
 * @license     http://www.gnu.org/licenses/gpl-3.0.html GNU General Public License, version 3
 * @link        http://www.7mediaws.org/
 * @since       3.0.0
 * @package     eduTrac
 * @author      Joshua Parker <josh@7mediaws.org>
 */

class Mailer extends \eduTrac\Classes\Core\Controller {

	public function __construct() {
		parent::__construct();
        if(!hasPermission('access_email_template_screen')) { redirect( BASE_URL . 'dashboard/' ); }
		/**
		 * If user is logged in and the lockscreen cookie is set, 
		 * redirect user to the lock screen until he/she enters 
		 * his/her password to gain access.
		 */
		if(isset($_COOKIE['SCREENLOCK'])) {
			redirect( BASE_URL . 'lock/' );
		}
	}
	
	public function index() {
		$this->view->staticTitle = array(_t('Email Templates'));
		$this->view->less = [ 'less/admin/module.admin.page.form_elements.less','less/admin/module.admin.page.tables.less' ];
		$this->view->css = [ 'css/admin/module.admin.page.form_elements.min.css','css/admin/module.admin.page.tables.min.css' ];
        $this->view->js = [ 
                            'components/modules/admin/forms/elements/bootstrap-select/assets/lib/js/bootstrap-select.js?v=v2.1.0',
                            'components/modules/admin/forms/elements/bootstrap-select/assets/custom/js/bootstrap-select.init.js?v=v2.1.0',
                            'components/modules/admin/forms/elements/select2/assets/lib/js/select2.js?v=v2.1.0',
                            'components/modules/admin/forms/elements/select2/assets/custom/js/select2.init.js?v=v2.1.0',
                            'components/modules/admin/forms/elements/bootstrap-datepicker/assets/lib/js/bootstrap-datepicker.js?v=v2.1.0',
                            'components/modules/admin/forms/elements/bootstrap-datepicker/assets/custom/js/bootstrap-datepicker.init.js?v=v2.1.0',
                            'components/modules/admin/tables/datatables/assets/lib/js/jquery.dataTables.min.js?v=v2.1.0',
                            'components/modules/admin/tables/datatables/assets/lib/extras/TableTools/media/js/TableTools.min.js?v=v2.1.0',
                            'components/modules/admin/tables/datatables/assets/custom/js/DT_bootstrap.js?v=v2.1.0',
                            'components/modules/admin/tables/datatables/assets/custom/js/datatables.init.js?v=v2.1.0'
                            ];
		$this->view->cmgmtList = $this->model->cmgmtList();
		$this->view->render('mailer/index');
	}
    
    public function add() {
        $this->view->staticTitle = array(_t('Add Email Template'));
        $this->view->deptID = $this->model->deptID();
		$this->view->less = [ 'less/admin/module.admin.page.form_elements.less' ];
		$this->view->css = [ 'css/admin/module.admin.page.form_elements.min.css' ];
        $this->view->js = [ 
                            'components/modules/admin/forms/elements/bootstrap-select/assets/lib/js/bootstrap-select.js?v=v2.1.0',
                            'components/modules/admin/forms/elements/bootstrap-select/assets/custom/js/bootstrap-select.init.js?v=v2.1.0',
                            'components/modules/admin/forms/elements/select2/assets/lib/js/select2.js?v=v2.1.0',
                            'components/modules/admin/forms/elements/select2/assets/custom/js/select2.init.js?v=v2.1.0',
                            'components/modules/admin/forms/editors/wysihtml5/assets/lib/js/wysihtml5-0.3.0_rc2.min.js?v=v2.1.0',
                            'components/modules/admin/forms/editors/wysihtml5/assets/lib/js/bootstrap-wysihtml5-0.0.2.js?v=v2.1.0',
                            'components/modules/admin/forms/editors/wysihtml5/assets/custom/wysihtml5.init.js?v=v2.1.0'
                            ];
        $this->view->render('mailer/add');
    }
    
    public function view($id) {
        $this->view->staticTitle = array(_t('View Email Template'));
        $this->view->emailTemp = $this->model->emailTemp($id);
        $this->view->deptID = $this->model->deptID();
        $this->view->less = [ 'less/admin/module.admin.page.form_elements.less' ];
		$this->view->css = [ 'css/admin/module.admin.page.form_elements.min.css' ];
        $this->view->js = [ 
                            'components/modules/admin/forms/elements/bootstrap-select/assets/lib/js/bootstrap-select.js?v=v2.1.0',
                            'components/modules/admin/forms/elements/bootstrap-select/assets/custom/js/bootstrap-select.init.js?v=v2.1.0',
                            'components/modules/admin/forms/elements/select2/assets/lib/js/select2.js?v=v2.1.0',
                            'components/modules/admin/forms/elements/select2/assets/custom/js/select2.init.js?v=v2.1.0',
                            'components/modules/admin/forms/editors/wysihtml5/assets/lib/js/wysihtml5-0.3.0_rc2.min.js?v=v2.1.0',
                            'components/modules/admin/forms/editors/wysihtml5/assets/lib/js/bootstrap-wysihtml5-0.0.2.js?v=v2.1.0',
                            'components/modules/admin/forms/editors/wysihtml5/assets/custom/wysihtml5.init.js?v=v2.1.0'
                            ];
        if(empty($this->view->emailTemp)) {
            redirect( BASE_URL . 'error/invalid_record/' );
        }
        
        $this->view->render('mailer/view');
    }
    
    public function schedule() {
        $this->view->staticTitle = array(_t('Schedule Mailer'));
        $this->view->cmgmtList = $this->model->cmgmtList();
		$this->view->less = [ 'less/admin/module.admin.page.form_elements.less' ];
		$this->view->css = [ 'css/admin/module.admin.page.form_elements.min.css' ];
        $this->view->js = [ 
                            'components/modules/admin/forms/elements/bootstrap-select/assets/lib/js/bootstrap-select.js?v=v2.1.0',
                            'components/modules/admin/forms/elements/bootstrap-select/assets/custom/js/bootstrap-select.init.js?v=v2.1.0',
                            'components/modules/admin/forms/elements/select2/assets/lib/js/select2.js?v=v2.1.0',
                            'components/modules/admin/forms/elements/select2/assets/custom/js/select2.init.js?v=v2.1.0',
                            'components/modules/admin/forms/elements/bootstrap-datepicker/assets/lib/js/bootstrap-datepicker.js?v=v2.1.0',
                            'components/modules/admin/forms/elements/bootstrap-datepicker/assets/custom/js/bootstrap-datepicker.init.js?v=v2.1.0'
                            ];
        $this->view->render('mailer/schedule');
    }
    
    public function queue() {
        $this->view->staticTitle = array(_t('Email Queue'));
        $this->view->less = [ 'less/admin/module.admin.page.form_elements.less','less/admin/module.admin.page.tables.less' ];
		$this->view->css = [ 'css/admin/module.admin.page.form_elements.min.css','css/admin/module.admin.page.tables.min.css' ];
        $this->view->js = [ 
                            'components/modules/admin/forms/elements/bootstrap-select/assets/lib/js/bootstrap-select.js?v=v2.1.0',
                            'components/modules/admin/forms/elements/bootstrap-select/assets/custom/js/bootstrap-select.init.js?v=v2.1.0',
                            'components/modules/admin/forms/elements/select2/assets/lib/js/select2.js?v=v2.1.0',
                            'components/modules/admin/forms/elements/select2/assets/custom/js/select2.init.js?v=v2.1.0',
                            'components/modules/admin/forms/elements/bootstrap-datepicker/assets/lib/js/bootstrap-datepicker.js?v=v2.1.0',
                            'components/modules/admin/forms/elements/bootstrap-datepicker/assets/custom/js/bootstrap-datepicker.init.js?v=v2.1.0',
                            'components/modules/admin/tables/datatables/assets/lib/js/jquery.dataTables.min.js?v=v2.1.0',
                            'components/modules/admin/tables/datatables/assets/lib/extras/TableTools/media/js/TableTools.min.js?v=v2.1.0',
                            'components/modules/admin/tables/datatables/assets/custom/js/DT_bootstrap.js?v=v2.1.0',
                            'components/modules/admin/tables/datatables/assets/custom/js/datatables.init.js?v=v2.1.0'
                            ];
        $this->view->queue = $this->model->queue();
        $this->view->render('mailer/queue');
    }
    
    public function runTemplate() {
        $data = [];
        $data['email_key'] = isPostSet('email_key');
        $data['email_name'] = isPostSet('email_name');
        $data['email_value'] = isPostSet('email_value');
        $data['deptCode'] = isPostSet('deptCode');
        $this->model->runTemplate($data);
    }
    
    public function runEditTemplate() {
        $data = [];
        $data['email_key'] = isPostSet('email_key');
        $data['email_name'] = isPostSet('email_name');
        $data['email_value'] = isPostSet('email_value');
        $data['deptCode'] = isPostSet('deptCode');
        $data['etID'] = isPostSet('etID');
        $this->model->runEditTemplate($data);
    }
    
    public function runSchedule() {
        $data = [];
        $data['personID'] = isPostSet('personID');
        $data['fromName'] = isPostSet('fromName');
        $data['fromEmail'] = isPostSet('fromEmail');
        $data['queryID'] = isPostSet('queryID');
        $data['subject'] = isPostSet('subject');
        $data['etID'] = isPostSet('etID');
        $this->model->runSchedule($data);
    }
    
    public function deleteQueue($id) {
        $this->model->deleteQueue($id);
    }
    
}