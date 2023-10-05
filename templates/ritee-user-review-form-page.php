<?php
/**
 * Job Application Form Layout
 *
 * @package UserReviewForm/Templates
 * @version 1.0.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

?>

<div class="ritee-user-review-form-wrap">
	<div id="alerts-box"></div>

	<form id="ritee-user-review-form" method="POST" enctype="multipart/form-data">
		<div class="ritee-user-review-form-row">
			<div class="ritee-user-review-input-row rur">
				<label for="first_name" class="ritee-user-review-form-label"><?php esc_html_e( 'First Name', 'ritee-user-review-form' ); ?><span class="form-required">*</span></label>
				<input type="text" class="input-text ritee-user-review-form-frontend-field" id="first_name" name="first_name" >
			</div>

			<div class="ritee-user-review-form-input-row">
				<label for="last_name" class="ritee-user-review-form-label"><?php esc_html_e( 'Last Name', 'ritee-user-review-form' ); ?></label>
				<input type="text" class="input-text ritee-user-review-form-frontend-field" id="last_name" name="last_name">
			</div>
		</div>

		<div class="ritee-user-review-form-row">
			<div class="ritee-user-review-input-row">
				<label for="user_email" class="ritee-user-review-form-label"><?php esc_html_e( 'Email', 'ritee-user-review-form' ); ?><span class="form-required">*</span></label>
				<input type="email" class="input-text ritee-user-review-form-frontend-field" id="user_email" name="user_email" placeholder="<?php esc_html_e( 'example@example.com', 'ritee-user-review-form' ); ?>" >
			</div>
			<div class="ritee-user-review-form-input-row">
				<label for="user_password" class="ritee-user-review-form-label"><?php esc_html_e( 'Password', 'ritee-user-review-form' ); ?><span class="form-required">*</span></label>
				<input type="password" class="input-text ritee-user-review-form-frontend-field" id="user_password" name="user_password" >
			</div>
		</div>

		<div class="ritee-user-review-form-row">
			<div class="ritee-user-review-form-input-row">
				<label for="user_review" class="ritee-user-review-form-label"><?php esc_html_e( 'User Review', 'ritee-user-review-form' ); ?></label>
				<textarea name="user_review" id="user_review" class="input-text"></textarea>
			</div>
		</div>

		<div class="ritee-user-review-form-row">
			<div class="ritee-user-review-form-input-row">
				<label for="user_rating" class="ritee-user-review-form-label"><?php esc_html_e( 'Product Rating', 'ritee-user-review-form' ); ?></label>
				<input type="number" min="0" max="5" class="input-text ritee-user-review-form-frontend-field" id="user_rating" name="user_rating">
			</div>
		</div>

		<div class="ritee-user-review-form-row">
			<button type="submit" class="btn btn-primary" name="ritee-user-review-form-submit" id="ritee-user-review-form-submit-btn"><?php esc_html_e( 'Submit', 'ritee-user-review-form' ); ?></button>
		</div>
	</form>
</div>
