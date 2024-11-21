jQuery(document).ready(function ($) {
    // Handle button clicks
    $('.question-button').on('click', function () {
        let answer = $(this).data('answer');
        console.log('Answer selected:', answer);

        // AJAX request to process the answer
        $.ajax({
            url: msFwp.ajax_url,
            type: 'POST',
            data: {
                action: 'save_answer',
                answer: answer,
            },
            success: function (response) {
                console.log(response);
                alert('Answer saved: ' + response.data);
            },
            error: function () {
                alert('There was an error.');
            }
        });
    });
});
