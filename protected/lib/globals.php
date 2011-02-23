<?php
// Post types
define('POST_TYPE', 1);
define('PAGE_TYPE', 2);
// Post statuses
define('PUBLIC_POST', 1);
define('PRIVATE_POST', 2);
define('DRAFT_POST', 3);

function walktrim(&$val, $idx)
{
    $val = trim($val);
}
?>
