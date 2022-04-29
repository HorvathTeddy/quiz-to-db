<?php

$username = "java";
$password = "java";


$connect_string =
            "(DESCRIPTION = (ADDRESS = (PROTOCOL = TCP)
                                       (HOST = cedar.humboldt.edu)
                                       (PORT = 1521))
                            (CONNECT_DATA = (SID = STUDENT)))";


// Connect to DB
$connect = oci_connect($username, $password, $connect_string);

if (!$connect) {
    echo 'COULD NOT CONNECT TO THE DATABASE';
}


// Drop table if exists
$quiz_table = "
drop table quiz
";

$quiz_table_query = oci_parse($conn, $quiz_table);

oci_execute($quiz_table_query, OCI_COMMIT_ON_SUCCESS);

oci_free_statement($quiz_table_query);




// Create table
$quiz_table = "
    create table grade(
        question_1 varchar(30),
        question_2 varchar(30),
        question_3 varchar(30),
        question_4 varchar(30),
        question_5 varchar(30),
        grade_out_of_5 number
    )
";

$quiz_table_query = oci_parse($conn, $quiz_table);

oci_execute($quiz_table_query, OCI_COMMIT_ON_SUCCESS);

oci_free_statement($quiz_table_query);

echo 'Table Created | Cleared';

oci_close($conn);


?>