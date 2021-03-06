<?php if ( ! defined('BASE_PATH') ) exit('No direct script access allowed');
/**
 * Create Save Query View
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
	<li><a href="<?=BASE_URL;?>savequery/<?=bm();?>" class="glyphicons database_plus"><i></i> <?=_t( 'Saved Queries' );?></a></li>
    <li class="divider"></li>
	<li><?=_t( 'View Saved Query' );?></li>
</ul>

<h3><?=_t( 'View Saved Query' );?></h3>
<div class="innerLR">
	
	<!-- Form -->
	<form class="form-horizontal margin-none" action="<?=BASE_URL;?>savequery/edit/" id="validateSubmitForm" method="post" onsubmit="return confirmDel()">
		
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
							<label class="col-md-3 control-label"><font color="red">*</font> <?=_t( 'Save Query Name' );?></label>
							<div class="col-md-8">
								<input type="text" name="savedQueryName" class="form-control" value="<?=_h($this->query[0]['savedQueryName']);?>" required/>
							</div>
						</div>
						<!-- // Group END -->
					
						<!-- Group -->
						<div class="form-group">
							<label class="col-md-3 control-label" for="term"><font color="red">*</font> <?=_t( 'Query' );?></label>
							<div class="col-md-8">
								<textarea id="mustHaveId" class="form-control" rows="5" style="width:65em;" name="savedQuery" required><?=_h($this->query[0]['savedQuery']);?></textarea>
							</div>
						</div>
						<!-- // Group END -->
						
						<!-- Group -->
						<div class="form-group">
                            <label class="col-md-3 control-label" for="term"><?=_t( 'Auto Purge' );?></label>
                            <div class="col-md-8 uniformjs">
                                <label class="radio">
                                    <input type="radio" name="purgeQuery" class="radio" value="1" <?=checked(_h($this->query[0]['purgeQuery']), '1', false);?> />Yes
                                </label>
                                <br />
                                <label class="radio">
                                    <input type="radio" name="purgeQuery" class="radio" value="0" <?=checked(_h($this->query[0]['purgeQuery']), '0', false);?> />No &nbsp;
                                    <a href="#myModal" data-toggle="modal"><img src="<?=BASE_URL;?>static/common/theme/images/help.png" /></a>
                                </label>
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
					<input type="hidden" name="personID" value="<?=$auth->getPersonField('personID');?>" />
					<input type="hidden" name="savedQueryID" value="<?=_h($this->query[0]['savedQueryID']);?>" />
					<button type="submit" name="submit" class="btn btn-icon btn-primary glyphicons circle_ok"><i></i><?=_t( 'Save' );?></button>
                    <button type="button" class="btn btn-icon btn-primary glyphicons circle_minus" onclick="window.location='<?=BASE_URL;?>savequery/<?=bm();?>'"><i></i><?=_t( 'Cancel' );?></button>
				</div>
				<!-- // Form actions END -->
				
			</div>
		</div>
		<!-- // Widget END -->
		
	</form>
	<!-- // Form END -->
	
	<div class="separator bottom"></div>
	
	<div class="modal fade" id="myModal">
		<div class="modal-dialog">
			<div class="modal-content">

				<!-- Modal heading -->
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
					<h3 class="modal-title"><?=_t( 'Auto Purge' );?></h3>
				</div>
				<!-- // Modal heading END -->
		        <div class="modal-body">
		            <p><?=_t( 'If enabled, saved queries get purged every 30 days. If you use your saved query on a regular basis, you should set this option to no.' );?></p>
		        </div>
		        <div class="modal-footer">
		            <a href="#" data-dismiss="modal" class="btn btn-primary"><?=_t( 'Cancel' );?></a>
		        </div>
	       	</div>
      	</div>
    </div>
    
	<!-- // Widget END -->
	
</div>	
	
		
		</div>
		<!-- // Content END -->