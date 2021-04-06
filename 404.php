<?php

// vars
$site = get_site_url();

header("HTTP/1.1 301 Moved Permanently");
header("Location: " . $site . "/pagina-niet-gevonden\/");
exit();
?>