// Smooth scrolling to anchor links
$('a[href^="#"]').on('click', function(event) {
    event.preventDefault();
    var target = $(this.getAttribute('href'));
    if (target.length) {
        $('html, body').stop().animate({
            scrollTop: target.offset().top
        }, 1000);
    }
});

// Form submission using Ajax
$("#contact-form").on("submit", function(event) {
    event.preventDefault();
    var form = $(this);
    var formData = form.serialize();

    // Disable submit button during form submission
    form.find('input[type="submit"]').prop('disabled', true);

    $.ajax({
        type: "POST",
        url: form.attr("action"),
        data: formData,
        success: function(response) {
            // Show success message
            $("#contact-form-message").html(response).slideDown();
            // Reset form fields
            form[0].reset();
        },
        error: function(xhr, status, error) {
            // Show error message
            $("#contact-form-message").html("Failed to send message. Please try again later.").slideDown();
        },
        complete: function() {
            // Enable submit button after form submission
            form.find('input[type="submit"]').prop('disabled', false);
        }
    });
});
