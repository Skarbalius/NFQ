<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    
    <title>Project Creation</title>
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
	<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="style.css">

    <?php 
        require_once 'connect.php'; 
        require_once 'index_logic.php'; 
    ?>


</head>
<body>
    <?php 
        $result = $mysqli->query("SELECT pid from project limit 1") or die($mysqli->error);
        $result = $result->fetch_assoc();
        if($result['pid'] != null){
            header('location: groups.php');
        }
    ?>
    <?php if(isset($_SESSION['message'])):?>

		<div class="alert-<?=$_SESSION['msg_type']?>">
			<?php 
				echo $_SESSION['message'];
				unset($_SESSION['message']);
			 ?>
		</div>
	<?php endif; ?>

    <div class="container">
        <form action="index_logic.php" method="POST">
                <input type="hidden" name="id" value="<?php echo $id; ?>">
                <div class="form-group">
                <label>Project Title</label>
                <input type="text" name="ptitle" value="" placeholder="" class="form-control" >
                </div>
                <div class="form-group">
                <label>Number of groups</label>
                <input type="text" name="pgroupnr" value="" placeholder="" class="form-control" >
                </div>
                <div class="form-group">
                <label>Number of students per group</label>
                <input type="text" name="pstudentnr" value="" placeholder="" class="form-control" >
                </div>
                <div class="form-group">
                    <button type="submit" class="btn btn-primary" name="create">Create</button>
                </div>
            </form>
        </div>
</body>
</html>