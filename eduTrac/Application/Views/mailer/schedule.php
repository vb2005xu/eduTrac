<?php if ( ! defined('BASE_PATH') ) exit('No direct script access allowed');
/**
 * View Mailer View
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
$auth = new \eduTrac\Classes\Libraries\Cookies;
?>

<ul class="breadcrumb">
	<li><?=_t( 'You are here' );?></li>
	<li><a href="<?=BASE_URL;?>dashboard/<?=bm();?>" class="glyphicons dashboard"><i></i> <?=_t( 'Dashboard' );?></a></li>
	<li class="divider"></li>
	<li><a href="<?=BASE_URL;?>mailer/<?=bm();?>" class="glyphicons e-mail"><i></i> <?=_t( 'Email Templates' );?></a></li>
	<li class="divider"></li>
	<li><?=_t( 'Schedule Email' );?></li>
</ul>

<h3><?=_t( 'Schedule Email' );?></h3>
<div class="innerLR">
	
	<!-- Form -->
	<form class="form-horizontal margin-none" action="<?=BASE_URL;?>mailer/runSchedule/" id="validateSubmitForm" method="post">
		
		<!-- Widget -->
		<div class="widget widget-heading-simple widget-body-gray">
		
			<!-- Widget heading -->
			<div class="widget-head">
				<h4 class="heading"><font color="red">*</font> <?=_t( 'Indicates field is required' );?></h4>
			</div>
			<!-- // Widget heading END -->
			
			<div class="widget-body">
			
				<!-- Row -->
				<div class="row">
					
					<!-- Column -->
					<div class="col-md-6">
					    
					    <!-- Group -->
						<div class="form-group">
							<label class="col-md-3 control-label" for="subject"><font color="red">*</font> <?=_t( 'Email Subject' );?></label>
							<div class="col-md-8"><input class="form-control" id="subject" name="subject" type="text" required/></div>
						</div>
						<!-- // Group END -->
						
						<!-- Group -->
						<div class="form-group">
							<label class="col-md-3 control-label" for="fromName"><font color="red">*</font> <?=_t( 'From Name' );?></label>
							<div class="col-md-8"><input class="form-control" id="fromName" name="fromName" type="text" required/></div>
						</div>
						<!-- // Group END -->
						
						<!-- Group -->
						<div class="form-group">
							<label class="col-md-3 control-label" for="fromEmail"><font color="red">*</font> <?=_t( 'From Email' );?></label>
							<div class="col-md-8"><input class="form-control" id="fromEmail" name="fromEmail" type="text" required/></div>
						</div>
						<!-- // Group END -->
						
					</div>
					<!-- // Column END -->
					
					<!-- Column -->
					<div class="col-md-6">
						
						<!-- Group -->
						<div class="form-group">
							<label class="col-md-3 control-label" for="etID"><font color="red">*</font> <?=_t( 'Email Template' );?></label>
							<div class="col-md-8">
							    <select name="etID" class="selectpicker form-control" data-style="btn-info" data-size="10" data-live-search="true">
							        <option value="">&nbsp;</option>
							        <?php emailTemplates(); ?>
						        </select>
							</div>
						</div>
						<!-- // Group END -->
						
						<!-- Group -->
						<div class="form-group">
							<label class="col-md-3 control-label" for="queryID"><font color="red">*</font> <?=_t( 'Saved Query' );?></label>
							<div class="col-md-8">
							    <select name="queryID" class="selectpicker form-control" data-style="btn-info" data-size="10" data-live-search="true">
							        <option value="">&nbsp;</option>
							        <?php userQuery(); ?>
						        </select>
							</div>
						</div>
						<!-- // Group END -->
						
					</div>
					<!-- // Column END -->
					
				</div>
				<!-- // Row END -->
			
				<hr class="separator" />
				
				<!-- Form actions -->
				<div class="form-actions">
				    <input name="personID" type="hidden" value="<?=$auth->getPersonField('personID');?>" />
					<button type="submit" name="submit" class="btn btn-icon btn-primary glyphicons circle_ok"><i></i><?=_t( 'Submit' );?></button>
					<button type="button" class="btn btn-icon btn-primary glyphicons circle_minus" onclick="window.location='<?=BASE_URL;?>mailer/<?=bm();?>'"><i></i><?=_t( 'Cancel' );?></button>
				</div>
				<!-- // Form actions END -->
				
			</div>
		</div>
		<!-- // Widget END -->
		
	</form>
	<!-- // Form END -->
	<div class="separator bottom"></div>
	<!-- // Widget END -->
	
</div>	
	
		
		</div>
		<!-- // Content END -->