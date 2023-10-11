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
$current_page = 0;
$page_number = 1;
$start_from = ($page_number-1) * $per_page; 
// $count_sql = "SELECT COUNT(*) FROM {$wpdb->prefix}user_review_form LIMIT ".$startFrom.",".$per_page;
$count = $wpdb->get_results($sql);
$total_rows = $wpdb->num_rows;
$total_page = ceil((int)$total_rows/$per_page);

$sql .= " LIMIT $per_page";
		$sql .= ' OFFSET ' . ( (int) $page_number - 1 ) * $per_page;

// $sql .= " LIMIT $start_from, $per_page";

$result = $wpdb->get_results( $sql, 'ARRAY_A' );

?>
<div class="ritee-review-display-parent">
<div class="row-fluid d-flex flex-wrap ritee-review-display">
<?php
foreach($result as $review){
   ?>
   <div class="col-md-6">
        <div class="card mx-5 my-5">
            <div class="card-body">
                <h3><strong><?php esc_html_e("Full Name: ","ritee-user-review-form"); ?></strong></h3><h4 class="card-title"><?php echo $review['first_name'].' ' .$review['last_name'];?></h4>
                <h3><strong><?php esc_html_e("Username: ", "ritee-user-review-form");?></strong><p class="card-subtitle"><?php echo $review['username']?></p>
                <h3><strong><?php esc_html_e("Email: ","ritee-user-review-form")?></strong><p class="card-subtitle"><?php echo $review['email']?></p>
                <h3><strong><?php esc_html_e("Review: ","ritee-user-review-form")?></strong><p class="card-text"><?php echo $review['review']?></p>
                <h3><strong><?php esc_html_e("Rating: ","ritee-user-review-form")?></strong><p class="card-text"><?php echo $review['rating']?></p>
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
    if($count > $per_page){

        ?>
        <div class="riteea-page-nav-parent">
        <nav aria-label="Page navigation example" class="d-flex ritee-page-nav" id = "ritee-pagination-result" data-current-page-no="<?php echo $page_number;?>">
            <a href="" class="nav-links nav-first button disabled" data-pagination-button = "first">&#171;</a>
            <a href="" class="nav-links nav-prev button disabled" data-pagination-button = "prev">&#60;</a>
              <p class="nav-links nav-current-count"><?php echo $page_number .' of ' ;?></p>
            <p class="nav-links nav-total-count" data-total-page=<?php echo ' '.$total_page; ?>> <?php echo ' '.$total_page; ?></p>
            <a href="" class="nav-links nav-next button" data-pagination-button = "next">&#62;</a>
            <a href="" class="nav-links nav-last button" data-pagination-button = "last">&#187;</a>
        </nav>
        </div>
        </div>
    <?php
    // for($page_number = 1; $page_number<= $total_page; $page_number++) {  
        
        // echo '<a href = "index.php?page=' . $page_number . '">' . $page_number . ' </a>';  

    // }  
    }
?>