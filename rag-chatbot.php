<?php
/*
Plugin Name: RAG Chatbot
Description: A chatbot integrated with Retrieval-Augmented Generation and Chain of Thought for WordPress sites.
Version: 1.0
Author: Your Name
*/

// Enqueue scripts and styles
function rag_chatbot_enqueue_scripts() {
    wp_enqueue_script('rag-chatbot-js', plugins_url('/static/js/rag-chatbot.js', __FILE__), array('jquery'), '1.0', true);
    wp_enqueue_style('rag-chatbot-css', plugins_url('/static/css/rag-chatbot.css', __FILE__));
}
add_action('wp_enqueue_scripts', 'rag_chatbot_enqueue_scripts');

// Add chatbot HTML to footer
function rag_chatbot_html() {
    echo '<div id="rag-chatbot">
            <div id="rag-chatbot-window">
                <div id="rag-chatbot-messages"></div>
                <input type="text" id="rag-chatbot-input" placeholder="Ask me anything..."/>
            </div>
          </div>';
}
add_action('wp_footer', 'rag_chatbot_html');

// Handle AJAX request
function rag_chatbot_handle_query() {
    if (isset($_POST['query'])) {
        $query = sanitize_text_field($_POST['query']);
        $response = wp_remote_post('http://your-backend-url/process_query', array(
            'method' => 'POST',
            'body' => json_encode(array('query' => $query)),
            'headers' => array('Content-Type' => 'application/json')
        ));
        echo wp_remote_retrieve_body($response);
    }
    wp_die();
}
add_action('wp_ajax_nopriv_rag_chatbot_query', 'rag_chatbot_handle_query');
add_action('wp_ajax_rag_chatbot_query', 'rag_chatbot_handle_query');
?>
