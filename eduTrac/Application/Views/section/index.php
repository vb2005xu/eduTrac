<?php if ( ! defined('BASE_PATH') ) exit('No direct script access allowed');
/**
 *
 * Search Section View
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
use \eduTrac\Classes\Libraries\Hooks;
?>

<ul class="breadcrumb">
	<li><?php _e( _t( 'You are here' ) ); ?></li>
	<li><a href="<?=BASE_URL;?>dashboard/<?=bm();?>" class="glyphicons dashboard"><i></i> <?php _e( _t( 'Dashboard' ) ); ?></a></li>
	<li class="divider"></li>
	<li><?php _e( _t( 'Sections' ) ); ?></li>
</ul>

<h3><?php _e( _t( 'Search Section' ) ); ?></h3>
<div class="innerLR">

	<!-- Widget -->
	<div class="widget widget-heading-simple widget-body-gray">
		<div class="widget-body">
		
			<div class="tab-pane" id="search-users">
				<div class="widget widget-heading-simple widget-body-white margin-none">
					<div class="widget-body">
						
						<div class="widget widget-heading-simple widget-body-simple text-right">
							<form class="form-search center" action="<?=BASE_URL;?>section/<?=bm();?>" method="post">
							  	<input type="text" name="sec" class="input-xxlarge" placeholder="Search by section code . . . " />
							</form>
						</div>
						
					</div>
				</div>
			</div>
			
			<div class="break"></div>
			
			<?php if(isPostSet('sec')) { ?>
			<!-- Table -->
			<table class="dynamicTable tableTools table table-striped table-bordered table-condensed table-white">
			
				<!-- Table heading -->
				<thead>
					<tr>
						<th class="center"><?php _e( _t( 'Course Sec ID' ) ); ?></th>
						<th class="center"><?php _e( _t( 'Section Code' ) ); ?></th>
						<th class="center"><?php _e( _t( 'Short Title' ) ); ?></th>
						<th class="center"><?php _e( _t( 'Status' ) ); ?></th>
						<th class="center"><?php _e( _t( 'Term' ) ); ?></th>
						<?php Hooks::do_action('search_course_sec_th'); ?>
						<th class="center"><?php _e( _t( 'Actions' ) ); ?></th>
					</tr>
				</thead>
				<!-- // Table heading END -->
				
				<!-- Table body -->
				<tbody>
				<?php if($this->search != '') : foreach($this->search as $k => $v) { ?>
                <tr class="gradeX">
                    <td class="center"><?=_h($v['courseSecID']);?></td>
                    <td class="center"><?=_h($v['courseSecCode']);?></td>
                    <td class="center"><?=_h($v['secShortTitle']);?></td>
                    <td class="center">
                    	<?php if(_h($v['currStatus']) == 'P') {
                    		echo 'Pending';
                    	} elseif(_h($v['currStatus']) == 'A') {
                    		echo 'Active';
                    	} else {
                    		echo 'Obsolete';
                    	}; ?>
                    </td>
                    <td class="center"><?=_h($v['termCode']);?></td>
                    <?php Hooks::do_action('search_course_sec_td'); ?>
                    <td class="center">
                    	<a href="<?=BASE_URL;?>section/view/<?=_h($v['courseSecID']);?>/<?=bm();?>" title="View Course Section" class="btn btn-circle"><i class="icon-eye-open"></i></a>
                    	<?php Hooks::do_action('search_course_sec_action'); ?>
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
	<!-- // Widget END -->
	
</div>	
	
		
		</div>
		<!-- // Content END -->