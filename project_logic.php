<?php 
require_once 'connect.php'; 
session_start();
$update=false;

function validate($data){
	$data = trim($data);
	$data = stripslashes($data);
	$data = htmlspecialchars($data);
	return $data;
}


if (isset($_GET['delete'])){
	$sid = $_GET['delete'];
	$mysqli->query("DELETE FROM students WHERE sid=$sid") or die($mysqli->error);

	$_SESSION['message'] = "Student removed.";
	$_SESSION['msg_type'] = "danger";
	header('location: project.php');
}

if(isset($_POST['create'])){
	$sfullname = validate($_POST['sfullname']);
	if($sfullname == ''){
		header('location: project.php');
		return;
	}

	$result = $mysqli->query("SELECT sfullname FROM students WHERE sfullname='$sfullname'") or die($mysqli->error);
	$result = $result->fetch_assoc();
	$getname = $result['sfullname'];

	if($getname == $sfullname){
		$_SESSION['message'] = "Student '$getname' already added.";
		$_SESSION['msg_type'] = "danger";
		header('location: project.php');
		return;
	}

	$result = $mysqli->query("SELECT pid FROM project") or die($mysqli->error);
	$result = $result->fetch_assoc();
	$pid = $result['pid'];

	$mysqli->query("INSERT INTO students (sfullname, pid) VALUES('$sfullname', '$pid')") or die($mysqli->error);
	$_SESSION['message'] = "Record created.";
	$_SESSION['msg_type'] = "success";
	header('location: project.php');
}

if(isset($_POST['name'])){
	$sfullname = validate($_POST['name']);
	$gid = validate($_POST['gid']);
	$studentnr = validate($_POST['studentnr']);

	unset($_SESSION);
	
	$mysqli->query("UPDATE students SET studentnr=0, gid=0 WHERE studentnr=$studentnr AND gid=$gid") or die($mysqli->error);

	$result = $mysqli->query("SELECT * FROM students WHERE sfullname='$sfullname'") or die($mysqli->error);
	$result = $result->fetch_assoc();
	$getname = $result['sfullname'];
	//if name exists, update
	if($getname == $sfullname){
		$mysqli->query("UPDATE students SET studentnr='$studentnr', gid='$gid' WHERE sfullname='$sfullname'") or die($mysqli->error);
	}
}



?>