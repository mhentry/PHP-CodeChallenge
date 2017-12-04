<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Degrees Form</title>
    <meta name="viewport" content="width=device-width,initial-scale=1.0">
    <link rel="stylesheet" media="screen" href="css/style.css" >
</head>

<body>

<div class="wrapper">
        <div id="main" style="padding:50px 0 0 0;">

<?php

if (isset($_POST['submit']))
{
    
    require "templates/config.php";
    require "templates/common.php";

    try 
    {
        $connection = new PDO($dsn, $username, $password, $options);
        
        $new_user = array(
            "degreeid" => $_POST['degreeid'],
            "letter"  => $_POST['letter'],
            "bp" => $_POST['bp'],
            "mp"  => $_POST['mp'],
            "dp"  => $_POST['dp'],
            "link"  => $_POST['link'],
            "degreename"  => $_POST['degreename'],
            "school"  => $_POST['school']
        );

        $sql = sprintf(
                "INSERT INTO %s (%s) values (%s)",
                "degree",
                implode(", ", array_keys($new_user)),
                ":" . implode(", :", array_keys($new_user))
        );
        
        $statement = $connection->prepare($sql);
        $statement->execute($new_user);
    }

    catch(PDOException $error) 
    {
        echo $sql . "<br>" . $error->getMessage();
    }
    
}
?>

<h2>Add a Degree</h2>

<?php 
if (isset($_POST['submit']) && $statement) 
{ ?>
    <blockquote><?php echo $_POST['degreename']; ?> successfully added.</blockquote>
<?php 
} ?>

    <form class="contact_form" method="post" name="contact_form">
    <ul>
        <li>
             <h2>Degree Form</h2>
             <span class="required_notification">* Denotes Required Field</span>
        </li>
         <li>
            <label for="degreeid">Degree ID</label>
            <input type="text" name="degreeid" id="degreeid" placeholder="ID" required />
        </li>
                <li>
            <label for="letter">Letter</label>
            <input type="text" name="letter" id="letter" placeholder="Letter" required />
        </li>
        <li>
            <label for="bp">BP</label>
            <input type="text" name="bp" id="bp" placeholder="Bachelor Program" required />
        </li>
        <li>
            <label for="mp">MP</label>
            <input type="text" name="mp" id="mp" placeholder="Master Program" required />
        </li>
        <li>
            <label for="dp">DP</label>
            <input type="text" name="dp" id="dp" placeholder="Doctrate Program" required />
        </li>
        <li>
            <label for="link">Website:</label>
            <input type="url" name="link" id="link" placeholder="http://johndoe.com" required pattern="(http|https)://.+"/>
            <span class="form_hint">Proper format "http://someaddress.com"</span>
        </li>
        <li>
            <label for="degreename">Degre Name</label>
            <input type="text" name="degreename" id="degreename" placeholder="Degree Name" required />
        </li>
        <li>
            <label for="school">School</label>
            <input type="text" name="school" id="school" placeholder="School Name" required />
        </li>
        <li>
            <button type="submit" name="submit" value="Submit">Submit Form</button>
        </li>
    </ul>
</form>

        </div>
    </div>
<a href="index.php">Back to home</a>

</body>
</html>