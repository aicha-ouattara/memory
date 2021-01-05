<?php

class messages
{
    public $messages;

    public function __construct(array $messages)
    {
        $this->messages = $messages;
    }

    public function renderMessage()
    {
        $message = $this->messages;
        if (!empty($message)) {
            $output = "";
            if (count($message) > 0) {
                $output .= "<ul id='error'>";
                foreach ($message as $errors) {
                    $output .= "<li class=text-danger text-justify>" . $errors . "</li><br>";
                }
                $output .= "</ul>";
            } else {
                $output = $message[0];
            }
            return "<div id='error'>"
                . $output .
                "</div>";
        } else {
            return "";
        }
    }
}