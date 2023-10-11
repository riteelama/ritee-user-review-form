/* global  ts_job_application_form_script_params  */
jQuery(document).ready(function ($) {
    // Submit application when form is submitted.
    $("#ritee-user-review-form").on("submit", function (e) {
      e.preventDefault();
      e.stopPropagation();
  
      $("#alerts-box").html("");
      $(".ritee-user-review-form-error").remove();
  
      var formData = new FormData(this);
      formData.append("action", "ritee_user_review_form_submit_form");
      formData.append(
        "security",
        ritee_user_review_form_script_params.ritee_user_review_form_submit_nonce
      );
  
      $.ajax({
        url: ritee_user_review_form_script_params.ajax_url,
        data: formData,
        type: "POST",
        contentType: false,
        processData: false,
        beforeSend: function () {
          $("#ritee-user-review-form-submit-btn")
            .text(
                ritee_user_review_form_script_params.ritee_user_review_form_submitting_button_text
            )
            .prop("disabled", true);
        },
        success: function (response) {
          if (response.success) {
            $("#alerts-box").html(
              $("#alerts-box").html() +
                "<div class='ritee-user-review-form-success'>" +
                response.data.message +
                "</div>"
            );
  
            $("#ritee-user-review-form").each(function () {
              this.reset();
            });
          } else {
            if (response.data.field_error) {
              Object.keys(response.data.field_error).map((field_key) => {
               var id =field_key.split("_error")[0];
                $("#" + id)
                  .closest("div")
                  .append(
                    '<label class="ritee-user-review-form-error" for="' +
                      field_key.split("_error")[0] +
                      '">' +
                      response.data.field_error[field_key] +
                      "</label>"
                  );
              });
            } else {
              $("#alerts-box").html(
                $("#alerts-box").html() +
                  "<div class='ritee-user-review-form-error'>" +
                  response.data.message +
                  "</div>"
              );
            }
          }
  
          $("#ritee-user-review-form-submit-btn")
            .text(
                ritee_user_review_form_script_params.ritee_user_review_form_submit_button_text
            )
            .prop("disabled", false);
  
          $(window).scrollTop(
            $(document)
              .find(".ritee-user-review-form-wrap")
              .find(
                ".ritee-user-review-form-success, .ritee-user-review-form-error"
              )
              .offset().top
          );
        },
      });
    });
  });
  