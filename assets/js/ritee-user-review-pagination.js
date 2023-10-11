/* global ritee_user_review_display_script_params */
jQuery(function($) {
    $(document).on('click', "#ritee-pagination-result a", function(e) {
        e.preventDefault();
        e.stopPropagation();
        var pagination_type = $(this).data('pagination-button');
        
		var page_no = $(".ritee-page-nav").data('current-page-no');
        var total_page = $(".nav-total-count").data('total-page');
        console.log(total_page);
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
        formData.append(
            "total_page",
            total_page
          );
		// console.log(ritee_user_review_display_script_params.ajax_url);
        console.log(formData);
        $.ajax({
            url: ritee_user_review_display_script_params.ajax_url,
            type: 'POST',
			data:formData,
            processData: false,
            contentType: false,
            success: function(response) {
                console.log(formData.values);
                console.log(formData)
                $('.ritee-review-display').remove();
                $('.ritee-page-nav').remove();
                var html;
                html = "<div class='row-fluid d-flex flex-wrap ritee-review-display'>";
                $('.ritee-review-display-parent').html(html);
                var data = response.data;
                $.each(data,function(index,value){
                    var name = value.first_name + " " + value.last_name;
                    var username = value.fullname;
                    var email = value.email;
                    var review = value.review;
                    var rating = value.rating;

                // Create HTML tags within the div for displaying data
                $('.ritee-review-display').append($("<div class='col-md-6'><div class='card mx-5 my-5'><div class='card-body'><h3><strong>FullName: </strong></h3><h4 class='card-title'>" + value.first_name + ' ' + value.last_name + "</h4><h3><strong>Username: </strong></h3><h4 class='card-title'>" + value.username + "</h4><h3><strong>Email: </strong></h3><h4 class='card-title'>" + value.email+"</h4><h3><strong>Review: </strong></h3><h4 class='card-title'>" + value.review + "</h4><h3><strong>Rating: </strong></h3><h4 class='card-title'>" + value.rating + "</h4></div></div></div>"));

                });

               var current_page_num = formData.get('current_page_no');
               if(formData.get('pagination_type') == "first"){
                $('.ritee-review-display-parent').append($("<nav class='d-flex ritee-page-nav' id = 'ritee-pagination-result' data-current-page-no= "+current_page_num+"><a class='nav-links nav-first button disabled' data-pagination-button = 'first'>&#171;</a><a class='nav-links nav-prev button disabled' data-pagination-button = 'prev'>&#60;</a><p class='nav-links nav-current-count'>"+formData.get('current_page_no')+" of </p><p class='nav-links nav-total-count' data-total-page ="+ formData.get('total_page')+">"+ formData.get('total_page')+"</p><a class='nav-links nav-next button' data-pagination-button = 'next'>&#62;</a><a class='nav-links nav-last button' data-pagination-button = 'last'>&#187;</a></nav>"));
               }else if(formData.get('pagination_type') == "prev"){
                    current_page_num = current_page_num--;
                    $('.ritee-review-display-parent').append($("<nav class='d-flex ritee-page-nav' id = 'ritee-pagination-result' data-current-page-no= "+current_page_num+"><a class='nav-links nav-first button' data-pagination-button = 'first'>&#171;</a><a class='nav-links nav-prev button' data-pagination-button = 'prev'>&#60;</a><p class='nav-links nav-current-count'>"+formData.get('current_page_no')+" of </p><p class='nav-links nav-total-count' data-total-page ="+ formData.get('total_page')+">"+ formData.get('total_page')+"</p><a class='nav-links nav-next button' data-pagination-button = 'next'>&#62;</a><a class='nav-links nav-last button' data-pagination-button = 'last'>&#187;</a></nav>"));
                }
                 else if(formData.get('pagination_type') == "next"){
                    current_page_num = current_page_num++;
                    console.log(current_page_num);
                    $('.ritee-review-display-parent').append($("<nav class='d-flex ritee-page-nav' id = 'ritee-pagination-result' data-current-page-no= "+current_page_num+"><a class='nav-links nav-first button' data-pagination-button = 'first'>&#171;</a><a class='nav-links nav-prev button' data-pagination-button = 'prev'>&#60;</a><p class='nav-links nav-current-count'>"+formData.get('current_page_no')+" of </p><p class='nav-links nav-total-count' data-total-page ="+ formData.get('total_page')+">"+ formData.get('total_page')+"</p><a class='nav-links nav-next button' data-pagination-button = 'next'>&#62;</a><a class='nav-links nav-last button' data-pagination-button = 'last'>&#187;</a></nav>"));
                }else if(formData.get('pagination_type') == "last"){
                    current_page_num = current_page_num++;                    
                    $('.ritee-review-display-parent').append($("<nav class='d-flex ritee-page-nav' id = 'ritee-pagination-result' data-current-page-no= "+current_page_num+"><a class='nav-links nav-first button' data-pagination-button = 'first'>&#171;</a><a class='nav-links nav-prev button' data-pagination-button = 'prev'>&#60;</a><p class='nav-links nav-current-count'>"+formData.get('current_page_no')+" of </p><p class='nav-links nav-total-count' data-total-page ="+ formData.get('total_page')+">"+ formData.get('total_page')+"</p><a class='nav-links nav-next button disabled' data-pagination-button = 'next'>&#62;</a><a class='nav-links nav-last button disabled' data-pagination-button = 'last'>&#187;</a></nav>"));
                }

                console.log(formData.get('pagination_type'));
                console.log(current_page_num);

            },
            error: function(){

            }
        });
    });
});