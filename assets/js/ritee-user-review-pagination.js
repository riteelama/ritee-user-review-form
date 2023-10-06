// jQuery(function($) {
//     $(document).on('click', "#pagination-result a", function(e) {
//         e.preventDefault();
//         alert('called');
//         var link = $(this).attr('href');
//         ajax_pagination(link);
//     });

//     function ajax_pagination(link) {
//         $.ajax({
//             type: 'POST',
//             url: link,
//             success: function(response) {
//                 $('.products').html(response);
//             }
//         });
//     }
// });

function getresult(url) {
	$.ajax({
		url: document.location.href,
		type: "GET",
		data:  {rowcount:$("#rowcount").val(),"pagination_setting":$("#pagination-setting").val()},
		beforeSend: function(){$("#overlay").show();},
		success: function(data){
		$("#pagination-result").html(data);
		setInterval(function() {$("#overlay").hide(); },500);
		},
		error: function() 
		{} 	        
   });
}
function changePagination(option) {
	if(option!= "") {
		getresult("ritee-user-review-display-page.php");
	}
}

console.log(document.location.href);