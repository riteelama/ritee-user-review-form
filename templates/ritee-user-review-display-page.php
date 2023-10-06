<?php
/**
 * USer Review Display Layout
 *
 * @package UserReviewForm/Templates
 * @version 1.0.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

global $wpdb;

$sql = "SELECT * FROM {$wpdb->prefix}user_review_form";

$result = $wpdb->get_results( $sql, 'ARRAY_A' );
?>
<div class="row-fluid d-flex flex-wrap">
<?php
foreach($result as $review){
   ?>
   <div class="col-md-6">
        <div class="card mx-5 my-5">
            <div class="card-body">
                <h3><strong>Full Name: </strong></h3><h4 class="card-title"><?php echo $review['first_name'].' ' .$review['last_name'];?></h4>
                <h3><strong>Username: </strong><p class="card-subtitle"><?php echo $review['username']?></p>
                <h3><strong>Email: </strong><p class="card-subtitle"><?php echo $review['email']?></p>
                <h3><strong>Review: </strong><p class="card-text"><?php echo $review['review']?></p>
                <h3><strong>Rating: </strong><p class="card-text"><?php echo $review['rating']?></p>
            </div>
        </div>
   </div>

<?php
}

?>
    <div id="pagination-result">
        <input type="hidden" name="rowcount" id="rowcount" />
    </div>
</div>

