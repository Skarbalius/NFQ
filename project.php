<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    
    <title>Project</title>
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
	<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="style.css">
    <script src="main.js"></script>
    <?php 
        require_once 'connect.php';  
        require_once 'project_logic.php';
    ?>

</head>
<body>
<?php if(isset($_SESSION['message'])):?>

<div class="alert-<?=$_SESSION['msg_type']?>">
    <?php 
        echo $_SESSION['message'];
        unset($_SESSION['message']);
     ?>
</div>
<?php endif ?>
    <?php 
        $result = $mysqli->query("SELECT * from project") or die($mysqli->error);
        $result = $result->fetch_assoc();
    ?>
    <div class="container" id="container" style="margin-top:20px">
        <div class="con2">
            <p>Project: <b><?php echo $result['ptitle']; ?></b></p>
            <p>Number of groups: <b><?php echo $result['pgroupnr']; ?></b></p>
            <p>Students per group: <b><?php echo $result['pstudentnr']; ?></b></p>

            <h1>Students</h1>
        </div>
        <div class="row justify-content-left" id="students">
            <table class="tbl1" id="tbl1">
                <tr>
                    <th>Student</th>
                    <th>Group</th>
                    <th colspan="2">Actions</th>
                </tr>
                <?php 
                    $result = $mysqli->query("SELECT * FROM students"); 
                    while($row = $result->fetch_assoc()):
                ?>
                    <tr>
                        <td><?php echo $row['sfullname'];?></td>
                        <td><?php echo ($row['gid']) ? $row['gid'] : '-'; ?></td>
                        <td>
                            <a href="project_logic.php?delete=<?php echo $row['id'] ?>" class="btn btn-danger" style="margin:0%">Delete</a>
                        </td>
                    </tr>
                <?php endwhile; ?>
            </table>
        
        </div>
    
        <div class="row justify-content-left">
            <div class="con2">
                <form action="project_logic.php" method="POST">
                    <div class="form-group">
                        <label>Student Full Name</label>
                        <input type="text" name="sfullname" placeholder="" class="form-control" >
                        <input type="hidden" name="id" value="<?php echo $sid; ?>">
                        <button type="submit" class="btn btn-primary" name="create">Add New Student</button>
                    </div>
                </form>
            </div>
        </div>
    
    
        <div class="con2">
            <h1>Groups</h1>
        </div>

        <div class="row justify-content-left" id="groups">

            <?php 
                $result = $mysqli->query("SELECT * FROM groups"); 
                while($row = $result->fetch_assoc()):
            ?>
                <table class="tbl2">
                    <tr>
                        <th><?php echo 'Group #'.$row['gnr']; ?></th>
                    </tr>
                    <?php for ($i=0; $i < $row['snr']; $i++): ?>
                        <tr>
                            <td>
                                <?php 
                                    $gnr = $row['gnr'];
                                    $studentnr = $i + 1;
                                 ?>
                                <select id="<?php echo $gnr . '-' . $studentnr;?>" name="<?php echo $row['gnr'] . '-' . $i;?>" onchange="changed(id)">
                                    <?php
                                        $optionResult = $mysqli->query("SELECT * FROM students WHERE gid=$gnr AND studentnr=$studentnr");
                                        $optres = $optionResult->fetch_assoc();
                                        if($optres['sfullname'] != ''):
                                    ?>
                                    <option 
                                    value="<?php echo $optres['sfullname']; ?>" id="<?php $optres['sfullname']; ?>">
                                    <?php echo $optres['sfullname']; ?>
                                    </option>
                                    <?php endif; ?>
                                    <option value="" >Assign Student</option>
                                    <?php 
                                        $selectResult = $mysqli->query("SELECT * FROM students WHERE gid=0");
                                        while($subrow = $selectResult->fetch_assoc()):
                                    ?>
                                        <option value="<?php echo $subrow['sfullname']; ?>" id="<?php $subrow['sfullname']; ?>">
                                            <?php echo $subrow['sfullname']; ?>
                                        </option>
                                    <?php endwhile; ?>
                                </select>
                            </td>
                        </tr>
                    <?php endfor; ?>
                </table>
            <?php endwhile; ?>

        </div> 
    
    </div>
    
</body>
</html>