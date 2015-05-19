<?php

function Mod_addslashes($string) {
    if (get_magic_quotes_gpc() == 1) {
        return ( $string );
    } else {
        return ( addslashes($string) );
    }
}

function sanitize($str, $remove_nl = true) {
    $str = StripSlashes($str);
    if ($remove_nl) {
        $injections = array('/(\n+)/i',
            '/(\r+)/i',
            '/(\t+)/i',
            '/(%0A+)/i',
            '/(%0D+)/i',
            '/(%08+)/i',
            '/(%09+)/i'
        );
        $str = preg_replace($injections, '', $str);
    }
    return $str;
}

function validate_mobile($mobile) {
    if (eregi("([0-9]{10})", $mobile) !== FALSE && strlen($mobile) === 10) {
        $temp = substr($mobile, 0, -9);
        if ($temp < 7) {
            return FALSE;
        } else {
            return TRUE;
        }
    } else {
        return FALSE;
    }
}

function validate_email($email) {
    return eregi("^[_\.0-9a-zA-Z-]+@([0-9a-zA-Z][0-9a-zA-Z-]+\.)+[a-zA-Z]{2,6}$", $email);
}

function validateJSON() {
    $args = func_get_args(); // gets the parameters passed to this func as an array;
    $json = $args[0];
    $count = func_num_args() - 1; // 0 is the json, so total count of arguments - 1;
    $error = array(); // contains the list of keys not found in $json;
    for ($i = 1; $i <= $count; $i++) {
        if (!isset($json->$args[$i]))
            $error[] = $args[$i];
    }
    return $error;
}

function makeJSON() {
    $args = func_get_args();
    $num = func_num_args();
    $jsonArray = array();
    for ($i = 0; $i < $num; $i = $i + 2) {
        $jsonArray[$args[$i]] = $args[$i + 1];
    }
    $json = json_encode($jsonArray);
    return $json;
}

function test_input($data) {
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}

function mailAttachments($to, $from, $subject, $message, $attachments = array(), $headers = array(), $additional_parameters = '') {
    $headers['From'] = $from;

    // Define the boundray we're going to use to separate our data with.
    $mime_boundary = '==MIME_BOUNDARY_' . md5(time());

    // Define attachment-specific headers
    $headers['MIME-Version'] = '1.0';
    $headers['Content-Type'] = 'multipart/mixed; boundary="' . $mime_boundary . '"';

    // Convert the array of header data into a single string.
    $headers_string = '';
    foreach ($headers as $header_name => $header_value) {
        if (!empty($headers_string)) {
            $headers_string .= "\r\n";
        }
        $headers_string .= $header_name . ': ' . $header_value;
    }

    // Message Body
    $message_string = '--' . $mime_boundary;
    $message_string .= "\r\n";
    $message_string .= 'Content-Type: text/plain; charset="iso-8859-1"';
    $message_string .= "\r\n";
    $message_string .= 'Content-Transfer-Encoding: 7bit';
    $message_string .= "\r\n";
    $message_string .= "\r\n";
    $message_string .= $message;
    $message_string .= "\r\n";
    $message_string .= "\r\n";

    // Add attachments to message body
    foreach ($attachments as $local_filename => $attachment_filename) {
        if (is_file($local_filename)) {
            $message_string .= '--' . $mime_boundary;
            $message_string .= "\r\n";
            $message_string .= 'Content-Type: application/octet-stream; name="' . $attachment_filename . '"';
            $message_string .= "\r\n";
            $message_string .= 'Content-Description: ' . $attachment_filename;
            $message_string .= "\r\n";

            $fp = @fopen($local_filename, 'rb'); // Create pointer to file
            $file_size = filesize($local_filename); // Read size of file
            $data = @fread($fp, $file_size); // Read file contents
            $data = chunk_split(base64_encode($data)); // Encode file contents for plain text sending

            $message_string .= 'Content-Disposition: attachment; filename="' . $attachment_filename . '"; size=' . $file_size . ';';
            $message_string .= "\r\n";
            $message_string .= 'Content-Transfer-Encoding: base64';
            $message_string .= "\r\n\r\n";
            $message_string .= $data;
            $message_string .= "\r\n\r\n";
        }
    }

    // Signal end of message
    $message_string .= '--' . $mime_boundary . '--';

    // Send the e-mail.
    return mail($to, $subject, $message_string, $headers_string, $additional_parameters);
}

?>