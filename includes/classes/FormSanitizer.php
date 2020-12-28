<?php

class FormSanitizer {

    public static function sanitizeFormString($inputText) {
        // remove html tags from input text
        $inputText = strip_tags($inputText);
        $inputText = str_replace(" ", "", $inputText);
        //$inputText = trim($inputText); removes any spaces before or after string
        $inputText = strtolower($inputText);
        $inputText = ucfirst($inputText);

        return $inputText;
    }

    public static function sanitizeFormUsername($inputText) {
        // remove html tags from input text
        $inputText = strip_tags($inputText);
        $inputText = str_replace(" ", "", $inputText);

        return $inputText;
    }

    public static function sanitizeFormPassword($inputText) {
        // remove html tags from input text
        $inputText = strip_tags($inputText);        
        return $inputText;
    }

    public static function sanitizeFormEmail($inputText) {
        // remove html tags from input text
        $inputText = strip_tags($inputText);
        $inputText = str_replace(" ", "", $inputText);
        
        return $inputText;
    }


}


?>