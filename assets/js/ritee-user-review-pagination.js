/* global ritee_user_review_display_script_params */
jQuery(function($) {
    $(document).on('click', "#ritee-pagination-result a", function(e) {
        e.preventDefault();
        e.stopPropagation();
        var pagination_type = $(this).data('pagination-button');
        
		var page_no = $(".ritee-page-nav").data('current-page-no');
		var formData = new FormData();
		formData.append("action", "ritee_user_review_form_pagination");
		formData.append(
		  "security",
		  ritee_user_review_display_script_params.ritee_user_review_display_submit_nonce
		);
		formData.append(
		  "current_page_no",
		  page_no
		);
		formData.append(
		  "pagination_type",
          pagination_type
		);
		// console.log(ritee_user_review_display_script_params.ajax_url);
        $.ajax({
            url: ritee_user_review_display_script_params.ajax_url,
            type: 'POST',
			data:formData,
            processData: false,
            contentType: false,
            success: function(response) {
                $('.ritee-review-display').remove();
                $('.ritee-page-nav').remove();
                var html;
                html = "<div class='row-fluid d-flex flex-wrap ritee-review-display'>";
                html += "<div class='col-md-6'>";
                html += "<div class='card mx-5 my-5'>";
                html += "<div class='card-body'>";
                $('.ritee-review-display-parent').html(html);
                var data = response.data;
                $.each(data,function(index,value){
                    var name = value.first_name + " " + value.last_name;
                    var username = value.fullname;
                    var email = value.email;
                    var review = value.review;
                    var rating = value.rating;

                    // var $dataDiv = $('<div></div>');

                // Create HTML tags within the div for displaying data
                $('.card-body').append($("<h3><strong>FullName: </strong></h3>" +"<h4 class='card-title'>" + value.first_name +' ' + value.last_name + '</h4>'));
                $('.card-body').append($("<h3><strong>Username: </strong></h3>" +"<h4 class='card-title'>" + value.username+'</h4>'));
                $('.card-body').append($("<h3><strong>Email: </strong></h3>" +"<h4 class='card-title'>" + value.email+'</h4>'));
                $('.card-body').append($("<h3><strong>Review: </strong></h3>" +"<h4 class='card-title'>" + value.review+'</h4>'));
                $('.card-body').append($("<h3><strong>Rating: </strong></h3>" +"<h4 class='card-title'>" + value.rating+'</h4>'));

                // Append the div to the result container
                // .append($dataDiv);
                });
                console.log(data);
                // html += "</div>";

            },
            error: function(){

            }
        });
    });
});