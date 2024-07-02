jQuery(document).ready(function($) {
    $('#rag-chatbot-input').keypress(function(e) {
        if (e.which == 13) {
            var query = $(this).val();
            if (query.trim() != '') {
                $('#rag-chatbot-messages').append('<div class="user-message">' + query + '</div>');
                $(this).val('');
                $.ajax({
                    url: ajaxurl,
                    type: 'POST',
                    data: {
                        action: 'rag_chatbot_query',
                        query: query
                    },
                    success: function(response) {
                        $('#rag-chatbot-messages').append('<div class="bot-message">' + response + '</div>');
                    }
                });
            }
        }
    });
});
