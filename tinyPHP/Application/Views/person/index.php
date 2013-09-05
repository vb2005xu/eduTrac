<?php if ( ! defined('BASE_PATH') ) exit('No direct script access allowed');
/**
 *
 * Person Search View
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

$person = new \tinyPHP\Classes\DBObjects\Person;
?>

<ul class="breadcrumb">
	<li><?php _e( _t( 'You are here' ) ); ?></li>
	<li><a href="<?=BASE_URL;?>dashboard/<?=bm();?>" class="glyphicons dashboard"><i></i> <?php _e( _t( 'Dashboard' ) ); ?></a></li>
	<li class="divider"></li>
	<li><?php _e( _t( 'Person' ) ); ?></li>
</ul>

<h3><?php _e( _t( 'Search Person' ) ); ?></h3>
<div class="innerLR">

	<!-- Widget -->
	<div class="widget widget-heading-simple widget-body-gray">
		<div class="widget-body">
		
			<div class="tab-pane" id="search-users">
				<div class="widget widget-heading-simple widget-body-white margin-none">
					<div class="widget-body">
						
						<div class="widget widget-heading-simple widget-body-simple text-right">
							<form class="form-search center" action="<?=BASE_URL;?>person/" method="post">
							  	<input type="text" name="person" class="input-xxlarge" placeholder="Search by person id or name . . . " /> 
							  	<a href="#myModal" data-toggle="modal"><img src="<?=BASE_URL;?>static/common/theme/images/help.png" /></a>
							</form>
						</div>
						
					</div>
				</div>
			</div>
			
			<div class="break"></div>
			
			<?php if(isPostSet('person')) { ?>
			<!-- Table -->
			<table class="dynamicTable tableTools table table-striped table-bordered table-condensed table-white">
			
				<!-- Table heading -->
				<thead>
					<tr>
						<th class="center"><?php _e( _t( 'ID' ) ); ?></th>
						<th class="center"><?php _e( _t( 'Last Name' ) ); ?></th>
						<th class="center"><?php _e( _t( 'First Name' ) ); ?></th>
						<th class="center"><?php _e( _t( 'Actions' ) ); ?></th>
					</tr>
				</thead>
				<!-- // Table heading END -->
				
				<!-- Table body -->
				<tbody>
				<?php if($this->search != '') : foreach($this->search as $k => $v) { ?>
                <tr class="gradeX">
                    <td class="center"><?=_h($v['personID']);?></td>
                    <td class="center"><?=_h($v['lname']);?></td>
                    <td class="center"><?=_h($v['fname']);?></td>
                    <td class="center">
                    	<a href="<?=BASE_URL;?>person/view/<?=_h($v['personID']);?>/<?=bm();?>" title="View Person" class="btn btn-circle"><i class="icon-eye-open"></i></a>
                    	
                    	<?php if($person->isFacID() != $v['personID']) { ?>
                    	<a href="<?=BASE_URL;?>faculty/add/<?=_h($v['personID']);?>/<?=bm();?>" title="Create Faculty Record" class="btn btn-circle"><i class="icon-user"></i></a>
                    	<?php } ?>
                    	
                    	<?php if($person->isStuID() != $v['personID']) { ?>
                    	<a href="<?=BASE_URL;?>student/add/<?=_h($v['personID']);?>/<?=bm();?>" title="Create Student Record" class="btn btn-circle"><i class="icon-user"></i></a>
                    	<?php } ?>
                    	
                    	<a href="<?=BASE_URL;?>person/role/<?=_h($v['personID']);?>/<?=bm();?>" title="Edit Person Role" class="btn btn-circle"><i class="icon-key"></i></a>
                    	<a href="<?=BASE_URL;?>person/perms/<?=_h($v['personID']);?>/<?=bm();?>" title="Edit Person Permissions" class="btn btn-circle"><i class="icon-lock"></i></a>
                    </td>
                </tr>
				<?php } endif; ?>
				</tbody>
				<!-- // Table body END -->
				
			</table>
			<!-- // Table END -->
			
			<?php } ?>
			
		</div>
	</div>
	<div class="separator bottom"></div>
	
	<div class="modal hide fade" id="myModal">
        <div class="modal-body">
            <?=file_get_contents( APP_PATH . 'Info/person-search.txt' );?>
        </div>
        <div class="modal-footer">
            <a href="#" data-dismiss="modal" class="btn btn-primary"><?php _e( _t( 'Cancel' ) ); ?></a>
        </div>
    </div>
	
	<!-- // Widget END -->
	
</div>	
	
		
		</div>
		<!-- // Content END -->