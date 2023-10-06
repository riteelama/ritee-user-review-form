<?php
/**
 * User Review Form Table List
 *
 * @version 1.0.0
 * @package  UserReviewForm/ListTable
 */

namespace  UserReviewForm\Admin;

defined( 'ABSPATH' ) || exit;

if( ! class_exists( 'WP_List_Table' ) ) {
	require_once( ABSPATH . 'wp-admin/includes/class-wp-list-table.php' );
}

/**
 * Appications table list class.
 */
class ListTable extends \WP_List_Table {

	/**
	 * Initialize the Appications table list.
	 */
	public function __construct() {
		parent::__construct(
			array(
				'singular' => 'review',
				'plural'   => 'reviews',
				'ajax'     => false,
			)
		);
	}

	/**
	 * Get applications columns.
	 *
	 * @return array
	 */
	public function get_columns(){
		$columns = array(

			'cb'             => '<input type="checkbox" />',
			'full_name'     => esc_html__( 'Full Name', 'ritee-user-review-form' ),
			'email'          => esc_html__( 'Email', 'ritee-user-review-form' ),
			'username'       => esc_html__( 'Username', 'ritee-user-review-form' ),
			'review'         => esc_html__( 'Review', 'ritee-user-review-form' ),
			'rating'         => esc_html__( 'Rating', 'ritee-user-review-form' ),
			'submitted_at'   => esc_html__( 'Submission Date', 'ritee-user-review-form' ),
		);

		return $columns;
	}

	/**
	 * Render the bulk edit checkbox
	 *
	 * @param array $item
	 *
	 * @return string
	 */
	function column_cb( $item ) {
		return sprintf(
			'<input type="checkbox" name="bulk-item-selection[]" value="%s" />', $item['ID']
		);
	}

	/**
	 * Prepare table list items.
	*/
	public function prepare_items() {
		$this->_column_headers = $this->get_column_info();

		/** Process bulk action */
		$this->process_bulk_action();

		$per_page     = $this->get_items_per_page( 'ritee_user_reviews_per_page', 5 );
		$current_page = $this->get_pagenum();
		$total_items  = self::record_count();
		$search = '';

		// Handle the search query.
		if ( ! empty( $_REQUEST['s'] ) ) {
			$search = sanitize_text_field( trim( wp_unslash( $_REQUEST['s'] ) ) );
		}

		$this->set_pagination_args( [
			'total_items' => $total_items, //WE have to calculate the total number of items
			'per_page'    => $per_page //WE have to determine how many items to show on a page
		] );

		$this->items = self::get_reviews( $search, $per_page, $current_page );
	}

	/**
	 * Counts the total applications in database.
	 *
	 * @return null|string
	 */
	public static function record_count() {
		global $wpdb;

		$sql = "SELECT COUNT(*) FROM {$wpdb->prefix}user_review_form";

		return $wpdb->get_var( $sql );
	}

	/**
	 * Renders the columns.
	 *
	 * @param  object $review Review object.
	 * @param  string $column_name Column Name.
	 * @return string
	 */
	public function column_default( $review, $column_name ) {
		switch( $column_name ) {
			case 'full_name':
				$delete_nonce = wp_create_nonce( 'ritee-user-review-form-delete-review' );

				$title = '<strong>' . $review['first_name'] . ' ' . $review['last_name']. '</strong>';
				$actions = [
					'delete' => sprintf(
						'<a href="?page=%s&action=%s&review=%s&_wpnonce=%s">'. esc_html__( "Delete", "ritee-user-review-form" ) . '</a>',
						 esc_attr( $_REQUEST['page'] ),
						  'delete',
						   absint( $review['ID'] ),
						    $delete_nonce
							 )
				];
				return $title . $this->row_actions( $actions );
				break;

			case 'email':
			case 'username':
			case 'review':
				return $review[ 'review' ];
				break;
			case 'rating':
				return $review['rating'];
				break;
			case 'submitted_at':
				return $review[ 'submitted_at' ];
				break;
			default:
			return print_r( $review, true ) ; //Show the whole array for troubleshooting purposes
		}
	}


	/**
	 * Get a list of sortable columns.
	 *
	 * @return array
	 */
	protected function get_sortable_columns() {
		$sortable_columns = array(
			'rating' => array('rating',false),
			'submitted_at'   => array( 'submitted_at', false ),
		);

		return $sortable_columns;
	}


	/**
	 * Get bulk actions.
	 *
	 * @return array
	 */

	protected function get_bulk_actions() {
		$actions = array(
			'bulk-delete'    => esc_html__('Delete', 'ritee-user-review-form' )
		);
		return $actions;
	}

	/**
	 * Render the list table page, including header, notices, status filters and table.
	 */
	public function display_page() {
		$this->prepare_items();
		?>
			<div class="wrap ritee-user-review-table">
				<h1 class="wp-heading-inline"><?php esc_html_e( 'User Reviews' ); ?></h1>
				<hr class="wp-header-end">
				<form id="user-review-list" method="get">
					<input type="hidden" name="page" value="user-review-form" />
					<?php
						$this->views();
						$this->search_box( esc_html__( 'Search Reviews', 'ritee-user-review-form' ), 'application' );
						$this->display();

						wp_nonce_field( 'save', 'ritee_user_review_list_nonce' );
					?>
				</form>
			</div>

		<?php
	}

	/**
	 * Retrieve applications data from the database
	 *
	 * @param int $per_page
	 * @param int $page_number
	 *
	 * @return mixed
	 */
	public static function get_reviews( $search, $per_page = 5, $page_number = 1 ) {

		global $wpdb;

		$sql = "SELECT * FROM {$wpdb->prefix}user_review_form";

		if ( '' !== $search ) {
			$sql .= $wpdb->prepare( " WHERE ( first_name LIKE %s ) OR  ( last_name LIKE %s ) OR  ( email LIKE %s ) OR  ( username LIKE %s ) OR  ( review LIKE %s ) OR  ( rating LIKE %s )", "%{$search}%", "%{$search}%", "%{$search}%", "%{$search}%", "%{$search}%", "%{$search}%");
		}

		if ( ! empty( $_REQUEST['orderby'] ) ) {
			$sql .= ' ORDER BY ' . esc_sql( $_REQUEST['orderby'] );
			$sql .= ! empty( $_REQUEST['order'] ) ? ' ' . esc_sql( $_REQUEST['order'] ) : ' ASC';
		}

		$sql .= " LIMIT $per_page";
		$sql .= ' OFFSET ' . ( (int) $page_number - 1 ) * $per_page;

		$result = $wpdb->get_results( $sql, 'ARRAY_A' );

		

		return $result;
	}

	/**
	 * Delete a application record.
	 *
	 * @param int $id application ID
	 */
	public static function delete_review( $id ) {
		global $wpdb;

		$wpdb->delete(
			"{$wpdb->prefix}user_review_form",
			[ 'ID' => $id ],
			[ '%d' ]
		);
	}

	/**
	 * Process Bulk Action.
	 */
	public function process_bulk_action() {

		//Detect when a bulk action is being triggered...
		if ( 'delete' === $this->current_action() ) {

			// In our file that handles the request, verify the nonce.
			$nonce = esc_attr( $_REQUEST['_wpnonce'] );

			if ( ! wp_verify_nonce( $nonce, 'ritee-user-review-form-delete-review' ) ) {
				die( esc_html__( 'Nonce error please reload', 'ritee-user-review-form' ) );
			}
			else {
				self::delete_review( absint( $_GET['review'] ) );
			}

		}

		// If the delete bulk action is triggered
		$action = $this->current_action();
		if ( $action == 'bulk-delete' ) {
			$delete_ids = esc_sql( $_GET['bulk-item-selection'] );

			// loop over the array of record IDs and delete them
			foreach ( $delete_ids as $id ) {
				self::delete_review( $id );
			}
		}
	}

}
