<?php
$tns = "
(DESCRIPTION=
  (ADDRESS=(PROTOCOL=tcps)(HOST=adb.us-ashburn-1.oraclecloud.com)(PORT=1522))
  (CONNECT_DATA=(SERVICE_NAME=g9b520f80e45af7_advancedproject_high.adb.oraclecloud.com))
  (SECURITY=(SSL_SERVER_DN_MATCH=YES))
)";
$user = 'ADMIN';
$pass = 'OnePercent()12';

$conn = oci_connect($user, $pass, $tns, 'AL32UTF8');

if (!$conn) {
    $e = oci_error();
    echo "Connection failed: " . $e['message'] . PHP_EOL;
    exit;
}

echo "Connected!" . PHP_EOL;
oci_close($conn);
