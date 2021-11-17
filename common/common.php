<?php
    function sanitize($before) {
        foreach ($before as $key => $value) {
            $after[$key] = htmlspecialchars($value, ENT_QUOTES, 'utf-8');
        }
        return $after;
    }
?>