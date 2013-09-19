<?php if ( ! defined('BASE_PATH') ) exit('No direct script access allowed');
/**
 * Course Section Grading View
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
 * @since       1.0.0
 * @package     eduTrac
 * @author      Joshua Parker <josh@7mediaws.org>
 */
?>

<ul class="breadcrumb">
	<li><?php _e( _t( 'You are here' ) ); ?></li>
	<li><a href="<?=BASE_URL;?>dashboard/<?=bm();?>" class="glyphicons dashboard"><i></i> <?php _e( _t( 'Dashboard' ) ); ?></a></li>
	<li class="divider"></li>
	<li><?php _e( _t( 'Grading' ) ); ?></li>
</ul>

<h3><?php _e( _t( 'Grading' ) ); ?></h3>
<div class="innerLR">

    <!-- Form -->
    <form class="form-horizontal margin-none" action="<?=BASE_URL;?>section/runGrades/" id="validateSubmitForm" method="post" autocomplete="off">

	<!-- Widget -->
	<div class="widget widget-heading-simple widget-body-gray">
		<div class="widget-body">
			
			<!-- Table -->
			<table class="dynamicTable tableTools table table-striped table-bordered table-condensed table-white">
			
				<!-- Table heading -->
				<thead>
					<tr>
                        <th class="center"><?php _e( _t( 'Course Section' ) ); ?></th>
						<th class="center"><?php _e( _t( 'Student ID' ) ); ?></th>
						<th class="center"><?php _e( _t( 'Grade' ) ); ?></th>
                        <th style="display:none;">&nbsp;</th>
					</tr>
				</thead>
				<!-- // Table heading END -->
				
				<!-- Table body -->
				<tbody>
                <?php if($this->grades != '') : foreach($this->grades as $k => $v) { ?>
                <tr class="gradeX">
                    <td class="center"><?=_h($v['termCode'].'-'.$v['courseSecCode']);?></td>
                    <td class="center">
                        <?=get_name(_h($v['stuID']));?>
                        <input type="hidden" name="stuID[]" value="<?=_h($v['stuID']);?>" />
                    </td>
                    <td class="center">
                        <?=grading_scale(_h($v['grade']));?>
                    </td>
                    <td style="display:none;">
                        <input type="hidden" name="courseSecID" value="<?=_h($v['courseSecID']);?>" />
                        <input type="hidden" name="termID" value="<?=_h($v['termID']);?>" />
                    </td>
                </tr>
                <?php } endif; ?>
				</tbody>
				<!-- // Table body END -->
				
			</table>
			<!-- // Table END -->
            
            <hr class="separator" />
    			
			<!-- Form actions -->
			<div class="form-actions">
				<button type="submit" class="btn btn-icon btn-primary glyphicons circle_ok"><i></i><?php _e( _t( 'Submit' ) ); ?></button>
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