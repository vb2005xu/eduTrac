<?php if ( ! defined('BASE_PATH') ) exit('No direct script access allowed');
/**
 * View CCD View
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
?>

<ul class="breadcrumb">
	<li><?=_t( 'You are here');?></li>
	<li><a href="<?=BASE_URL;?>dashbaord/<?=bm();?>" class="glyphicons dashboard"><i></i> <?=_t( 'Dashboard' );?></a></li>
	<li class="divider"></li>
	<li><a href="<?=BASE_URL;?>form/ccd/<?=bm();?>" class="glyphicons pin_flag"><i></i> <?=_t( 'CCD' );?></a></li>
	<li class="divider"></li>
	<li><?=_t( 'View CCD' );?></li>
</ul>

<h3><?=_t( 'Viewing ' );?><?=_h($this->ccd[0]['ccdName']);?></h3>
<div class="innerLR">

	<!-- Form -->
	<form class="form-horizontal margin-none" action="<?=BASE_URL; ?>form/runEditCCD/" id="validateSubmitForm" method="post" autocomplete="off">
		
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
                            <label class="col-md-3 control-label" for="ccdCode"><font color="red">*</font> <?=_t( 'CCD Code' );?></label>
							<div class="col-md-8"><input class="form-control" id="ccdCode"<?=gio();?> name="ccdCode" type="text" value="<?=_h($this->ccd[0]['ccdCode']);?>" required /></div>
						</div>
						<!-- // Group END -->
						
						<!-- Group -->
						<div class="form-group">
                            <label class="col-md-3 control-label" for="ccdName"><font color="red">*</font> <?=_t( 'CCD Name' );?></label>
							<div class="col-md-8"><input class="form-control" id="ccdName"<?=gio();?> name="ccdName" type="text" value="<?=_h($this->ccd[0]['ccdName']);?>" required /></div>
						</div>
						<!-- // Group END -->
						
					</div>
					<!-- // Column END -->
					
				</div>
				<!-- // Row END -->
			
				<hr class="separator" />
				
				<!-- Form actions -->
				<div class="form-actions">
					<input name="ccdID" type="hidden" value="<?=_h($this->ccd[0]['ccdID']);?>" />
					<button type="submit"<?=gids();?> class="btn btn-icon btn-primary glyphicons circle_ok"><i></i><?=_t( 'Save' );?></button>
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