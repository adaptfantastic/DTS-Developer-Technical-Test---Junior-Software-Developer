<?php
    function add_json_error($field, $error_message, $error_ID,&$error_array) {

        if (empty($field)) {
            $error_array[$error_ID] = $error_message;
        }
    }

    function get_and_sanitize_post($field_name) {
    if (isset($_POST[$field_name])) {
        $raw_value = $_POST[$field_name];
        $trimmed_value = trim($raw_value);
        $sanitized_value = filter_var($trimmed_value, FILTER_SANITIZE_SPECIAL_CHARS);
        
        return $sanitized_value;
    }

}
   

?>