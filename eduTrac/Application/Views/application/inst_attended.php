<?php if ( ! defined('BASE_PATH') ) exit('No direct script access allowed');
/**
 * Add Institution Attended View
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
 * @since       4.1.1
 * @package     eduTrac
 * @author      Joshua Parker <josh@7mediaws.org>
 */
?>

<script type="text/javascript">
jQuery(document).ready(function() {
    jQuery('#applicantID').live('change', function(event) {
        $.ajax({
            type    : 'POST',
            url     : '<?=BASE_URL;?>application/runApplicantLookup/',
            dataType: 'json',
            data    : $('#validateSubmitForm').serialize(),
            cache: false,
            success: function( data ) {
                   for(var id in data) {        
                          $(id).val( data[id] );
                   }
            }
        });
    });
});
</script>

<ul class="breadcrumb">
    <li><?=_t( 'You are here' );?></li>
    <li><a href="<?=BASE_URL;?>dashboard/<?=bm();?>" class="glyphicons dashboard"><i></i> <?=_t( 'Dashboard' );?></a></li>
    <li class="divider"></li>
    <li><a href="<?=BASE_URL;?>application/<?=bm();?>" class="glyphicons search"><i></i> <?=_t( 'Search Application' );?></a></li>
    <li class="divider"></li>
    <li><?=_t( 'Institution Attended' );?></li>
</ul>

<h3><?=_t( 'Institution Attended' );?></h3>
<div class="innerLR">

	<!-- Form -->
	<form class="form-horizontal margin-none" action="<?=BASE_URL;?>application/runInstAttended/" id="validateSubmitForm" method="post" autocomplete="off">
		
		<!-- Widget -->
		<div class="widget widget-heading-simple widget-body-gray">
		
			<!-- Widget heading -->
			<div class="widget-head">
				<h4 class="heading"><font color="red">*</font> <?=_t( 'Indicates field is required.' );?></h4>
			</div>
			<!-- // Widget heading END -->
			
			<div class="widget-body">
			
				<!-- Row -->
				<div class="row">
					
					<!-- Column -->
					<div class="col-md-6">
						
						<!-- Group -->
                        <div class="form-group">
                            <label class="col-md-3 control-label"><font color="red">*</font> <?=_t( 'Applicant ID' );?></label>
                            <div class="col-md-8">
                            	<input type="text" name="personID" id="applicantID" class="form-control" required/>
                                <input type="text" id="person" readonly="readonly" class="form-control text-center" />
                        	</div>
                        </div>
                        <!-- // Group END -->
						
						<!-- Group -->
                        <div class="form-group">
                            <label class="col-md-3 control-label"><?=_t( 'Institution' );?></label>
                            <div class="col-md-8">
                            	<select name="fice_ceeb" class="selectpicker form-control" data-style="btn-info" data-size="10" data-live-search="true">
                                    <option value="">&nbsp;</option>
                                    <?php table_dropdown('institution','','fice_ceeb','fice_ceeb','instName'); ?>
                                </select>
                        	</div>
                        </div>
                        <!-- // Group END -->
						
						<!-- Group -->
                        <div class="form-group">
                            <label class="col-md-3 control-label"><?=_t( 'Attend From Date' );?></label>
                            <div class="col-md-8">
                            	<div class="input-group date" id="datepicker6">
                                    <input class="form-control" name="fromDate" type="text" />
                                    <span class="input-group-addon"><i class="fa fa-th"></i></span>
                                </div>
                        	</div>
                        </div>
                        <!-- // Group END -->
                        
                        <!-- Group -->
                        <div class="form-group">
                            <label class="col-md-3 control-label"><?=_t( 'Attend To Date' );?></label>
                            <div class="col-md-8">
                            	<div class="input-group date" id="datepicker7">
                                    <input class="form-control" name="toDate" type="text" />
                                    <span class="input-group-addon"><i class="fa fa-th"></i></span>
                                </div>
                        	</div>
                        </div>
                        <!-- // Group END -->
						
					</div>
					<!-- // Column END -->
					
					<!-- Column -->
					<div class="col-md-6">
						
						<!-- Group -->
                        <div class="form-group">
                            <label class="col-md-3 control-label"><?=_t( 'Major' );?></label>
                            <div class="col-md-8">
                            	<input class="form-control" type="text" name="major" />
                        	</div>
                        </div>
                        <!-- // Group END -->
                        
                        <!-- Group -->
                        <div class="form-group">
                            <label class="col-md-3 control-label"><?=_t( 'GPA' );?></label>
                            <div class="col-md-8">
                            	<input class="form-control" type="text" name="GPA" />
                        	</div>
                        </div>
                        <!-- // Group END -->
                        
                        <!-- Group -->
                        <div class="form-group">
                            <label class="col-md-3 control-label"><?=_t( 'Degree' );?></label>
                            <div class="col-md-8">
                            	<input class="form-control" type="text" name="degree_awarded" />
                        	</div>
                        </div>
                        <!-- // Group END -->
                        
                        <!-- Group -->
                        <div class="form-group">
                            <label class="col-md-3 control-label"><?=_t( 'Conferral Date' );?></label>
                            <div class="col-md-8">
                            	<div class="input-group date" id="datepicker8">
                                    <input class="form-control" name="degree_conferred_date" type="text" />
                                    <span class="input-group-addon"><i class="fa fa-th"></i></span>
                                </div>
                        	</div>
                        </div>
                        <!-- // Group END -->
						
					</div>
					<!-- // Column END -->
					
				</div>
				<!-- // Row END -->
				
				<!-- Form actions -->
				<div class="form-actions">
                    <input type="hidden" name="addedBy" value="<?=$auth->getPersonField('personID');?>" />
					<button type="submit" class="btn btn-icon btn-primary glyphicons circle_ok"><i></i><?=_t( 'Submit' );?></button>
                    <button type="button" class="btn btn-icon btn-primary glyphicons circle_minus" onclick="window.location='<?=BASE_URL;?>application/<?=bm();?>'"><i></i><?=_t( 'Cancel' );?></button>
				</div>
				<!-- // Form actions END -->
				
			</div>
			
		</div>
		<!-- // Widget END -->
		
	</form>
	<!-- // Form END -->
	
</div>	
	
		
		</div>
		<!-- // Content END -->