

<?php

$conn = mysqli_connect("localhost", "root", "", "gre");

if ($conn === false) {
    die("ERROR: Could not connect. "
        . mysqli_connect_error());
}

if (isset($_POST["word"]) && isset($_POST["answer"][0])) {
    $word =  $_REQUEST['word'];
    $reference = $_REQUEST['reference'];
    $add_info =  $_REQUEST['add_info'];
    $synonym = $_REQUEST['synonym'];
    $antonym = $_REQUEST['antonym'];
    $answer_example =  array_combine($_REQUEST['answer'], $_REQUEST['example']);
    $detail_example = json_encode($answer_example);

    $sql = "INSERT INTO gre_word (word,reference,add_info,answer_example,synonym,antonym) VALUES ('$word','$reference','$add_info','$detail_example','$synonym','$antonym')";

    if (mysqli_query($conn, $sql)) {
        echo json_encode(array('success' => 1));
        mysqli_close($conn);
    } else {
        echo json_encode(array('success' => 0));
        mysqli_close($conn);
    }
} else {

    echo json_encode(array('success' => 0));
    mysqli_close($conn);
}


?>