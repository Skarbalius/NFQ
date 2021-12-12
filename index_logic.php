<?php 
require_once 'connect.php'; 

session_start();

function validate($data){
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}

if (isset($_POST['create'])){
	$ptitle = validate($_POST['ptitle']);
	$pgroupnr =  validate($_POST['pgroupnr']);
    $pstudentnr = validate($_POST['pstudentnr']);

    $pgroupnr = (int)$pgroupnr;
    $pstudentnr = (int)$pstudentnr;


    if($ptitle == ''){
        $_SESSION['message'] = "Please create project title.";
	    $_SESSION['msg_type'] = "danger";
        header('location: index.php');
        return;
    }
	if($pgroupnr == 0){
        $_SESSION['message'] = "'Number of groups' must be a number greater than 0.";
	    $_SESSION['msg_type'] = "danger";
        header('location: index.php');
        return;
    }
    if($pstudentnr == 0){
        $_SESSION['message'] = "'Number of students per group' must be a number greater than 0.";
	    $_SESSION['msg_type'] = "danger";
        header('location: index.php');
        return;
    }

	$mysqli->query("INSERT INTO project (ptitle, pgroupnr, pstudentnr) VALUES('$ptitle', '$pgroupnr', '$pstudentnr')") or die($mysqli->error);
    $result = $mysqli->query("SELECT pid from project where ptitle='$ptitle'") or die($mysqli->error);
    $result = $result->fetch_assoc();
    $pid = $result['pid'];

    if($pid == null){
        $_SESSION['message'] = "Something went wrong.";
	    $_SESSION['msg_type'] = "danger";
        header('location: index.php');
        return;
    }

    for ($i=0; $i < $pgroupnr; $i++) { 
        $mysqli->query("INSERT INTO groups (fk_pid, gnr, snr) VALUES('$pid','$i'+1,'$pstudentnr')") or die($mysqli->error);
    }

	$_SESSION['message'] = "Record created.";
	$_SESSION['msg_type'] = "success";
	header('location: index.php');
}



?>