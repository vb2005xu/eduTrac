<?php if ( ! defined('BASE_PATH') ) exit('No direct script access allowed');
/**
 *
 * Invalid Record View
 *  
 * PHP 5
 *
 * eduTrac(tm) : Student Information System (http://edutrac.org/)
 * Copyright 2013, eduTrac, LLC (http://edutrac.org/)
 *
 * Licensed under The MIT License
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright Copyright 2013, eduTrac, LLC (http://edutrac.org/)
 * @link http://edutrac.org/ eduTrac(tm) Project
 * @since eduTrac(tm) v 1.0
 * @license MIT License (http://www.opensource.org/licenses/mit-license.php)
 */
?>

<div class="innerLR errorView">
	
	<!-- Widget -->
	<div class="widget widget-heading-simple widget-body-gray">
		
		<div class="widget-body">
			
				<!-- Row -->
				<div class="row-fluid">

					<!-- Alert -->
					<div class="alert alert-error center">
						<strong><?php _e( _t( 'Error!' ) ); ?></strong> <?php _e( _t( 'The record your are looking for does not exist. Please try again.' ) ); ?>
					</div>
					<!-- // Alert END -->
			
				</div>
		
		</div>
	
	</div>
	
</div>	
	
		
		</div>
		<!-- // Content END -->