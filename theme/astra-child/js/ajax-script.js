jQuery(document).ready(function($) {
    function fetchAtendimentos() {
        $.ajax({
            url: ajax_params.ajax_url,
            type: 'POST',
            data: {
                action: 'fetch_atendimentos'
            },
            success: function(response) {
                if (response.success) {
                    $('#atendimentos-container').html(response.data);
                } else {
                    console.error(response.data);
                }
            },
            error: function(xhr, status, error) {
                console.error(xhr.responseText);
            }
        });
    }

    // Fetch atendimentos on page load
    fetchAtendimentos();

    // Set interval to fetch atendimentos every 5 seconds (5000 milliseconds)
    setInterval(fetchAtendimentos, 1000);
});

