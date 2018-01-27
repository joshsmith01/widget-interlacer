jQuery(document).ready(function ($) {
    var interlacerSubmitButton = $('#email-newsletter-email-submit');

    var interlacerFormSubmit = function (formData, action) {
        $.ajax({
            type: 'POST',
            dataType: 'json',
            url: interlacerData.interlacerDataUrl,
            data: {
                action: action,
                data: formData,
                submission: document.getElementById('xyq').value,
                security: interlacerData.interlacerSecurity
            },
            success: function (response) {
                if (true === response.success) {
                    console.log('Form submitted successfully', response.data.responseSuperMessage)
                } else {
                    console.log('Form was not submitted successfully');
                }
            }

        })
    };
    interlacerSubmitButton.on('click', function(event) {
        event.preventDefault();
        console.log('hi');
        var formData = {
            'email': document.getElementById('widget-interlacer-email').value
        };
        interlacerFormSubmit(formData, 'process_newsletter_signup');
    });

});