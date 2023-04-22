<?php
/**
 * Some helper functions
*/

if ( ! function_exists( 'ddd' ) ) :
    function ddd($data)
    {
        echo '<pre>';
        var_dump($data);
        echo '</pre>';
        exit();
    }
endif;