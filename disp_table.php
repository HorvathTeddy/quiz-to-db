<?php


$username = "java";
$password = "java";

$connect_string =
            "(DESCRIPTION = (ADDRESS = (PROTOCOL = TCP)
                                       (HOST = cedar.humboldt.edu)
                                       (PORT = 1521))
                            (CONNECT_DATA = (SID = STUDENT)))";

$connect = oci_connect($username, $password, $connect_string);

if (!$connect) {
    echo 'COULD NOT CONNECT TO THE DATABASE';
}


// Select all rows from DB
$quiz_table = '
        select * from grade
';


$quiz_table_query = oci_parse($connect, $quiz_table);

oci_execute($quiz_table_query, OCI_DEFAULT);


$results = array();
while ($row = oci_fetch_array($quiz_table_query, OCI_ASSOC)) {
    array_push($results, $row);
}

echo json_encode($results);

oci_free_statement($quiz_table_query);


oci_close($connect);


?>