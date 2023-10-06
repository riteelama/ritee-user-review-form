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
$per_page = 5;
$data = array();
$current_page = 0;
$page_number = 1;

$sql .= " LIMIT $per_page";
		$sql .= ' OFFSET ' . ( (int) $page_number - 1 ) * $per_page;

		$result = $wpdb->get_results( $sql, 'ARRAY_A' );

$startFrom = ($page_number-1) * $per_page;  
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

wp_enqueue_script( "ritee-user-review-form-script", RITEE_USER_REVIEW_FORM_ASSETS_URL . '/js/ritee-user-review-form.js', array( 'jquery' ), RITEE_USER_REVIEW_FORM_VERSION );
wp_enqueue_script('ritee-user-review-pagination-script',RITEE_USER_REVIEW_FORM_ASSETS_URL . '/js/ritee-user-review-pagination.js');
wp_enqueue_script( "ritee-user-review-form-script", RITEE_USER_REVIEW_FORM_ASSETS_URL . '/css/ritee-user-review-form.css', RITEE_USER_REVIEW_FORM_VERSION );
?>

</div>

<?php 

 

    $count_sql = "SELECT COUNT(*) FROM {$wpdb->prefix}user_review_form";
    $count = $wpdb->get_results($count_sql);
    $total_page = ceil((int)$count/$per_page);
    if($count > $per_page){
        ?>
        <nav aria-label="Page navigation example" class="d-flex page-nav">
            <a href="" class="nav-links nav-first button disabled">&#171;</a>
            <a href="" class="nav-links nav-prev button disabled">&#60;</a>
            <p class="nav-links nav-current-count"><?php echo $page_number .' of ' ;?></p>
            <p class="nav-links nav-total-count"> <?php echo ' '.$total_page; ?> </p>
            <a href="" class="nav-links nav-next button">&#62;</a>
            <a href="" class="nav-links nav-last button">&#187;</a>
        </nav>
    <?php
    }
?>