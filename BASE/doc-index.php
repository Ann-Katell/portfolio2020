//-------------------------------------//
// NOM ET AGE FORMULAIRE
//-------------------------------------//
<?php
if( $_POST["name"] || $_POST["age"] ) {
    if (preg_match("/[^A-Za-z'-]/",$_POST['name'] )) {
        die ("invalid name and name should be alpha");
    }

    echo "Welcome ". $_POST['name']. "<br />";
    echo "You are ". $_POST['age']. " years old.";
    exit();
}
<?php
if( $_GET["name"] || $_GET["age"] ) {
    echo "Welcome ". $_GET['name']. "<br />";
    echo "You are ". $_GET['age']. " years old.";
    
    exit();
}
?>
<form action = "<?php $_PHP_SELF ?>" method = "GET">
        Name: <input type = "text" name = "name" />
        Age: <input type = "text" name = "age" />
        <input type = "submit" />
</form>
?>
    <form action = "<?php $_PHP_SELF ?>" method = "POST">
        Name: <input type = "text" name = "name" />
        Age: <input type = "text" name = "age" />
        <input type = "submit" />
    </form>
//-----------------------------//
// CHOISIR UN SITE A VISITER
//-----------------------------//
<p>Choose a site to visit :</p>

    <form action = "<?php $_SERVER['PHP_SELF'] ?>" method ="POST">
        <select name = "location">.

            <option value = "http://www.tutorialspoint.com">
            Tutorialspoint.com
            </option>

            <option value = "http://www.google.com">
            Google Search Page
            </option>

        </select>
        <input type = "submit" />
    </form>
//-------------------------------------//
INSERER UN MENU DANS DIFFERENTES PAGES
//------------------------------------//
créer un file menu.php 
<a href="http://www.tutorialspoint.com/index.htm">Home</a> - 
<a href="http://www.tutorialspoint.com/ebxml">ebXML</a> - 
<a href="http://www.tutorialspoint.com/ajax">AJAX</a> - 
<a href="http://www.tutorialspoint.com/perl">PERL</a> <br /> 
<?php include("menu.php"); ?>
//-------------------------------------//
OUVRIR UN DOSSIER EN LECTURE
//-------------------------------------//
<?php
        $filename = "tmp.txt";
        $file = fopen( $filename, "r" );
    
        if( $file == false ) {
            echo ( "Error in opening file" );
            exit();
        }
    
        $filesize = filesize( $filename );
        $filetext = fread( $file, $filesize );
        fclose( $file );
        
        echo ( "File size : $filesize bytes" );
        echo ( "<pre>$filetext</pre>" );
    ?>
    <?php
if(!file_exists("/tmp.txt")) {
    die("File not found");
}else {
    $file = fopen("/tmp.txt","r");
    print "Opend file sucessfully";
}
   // Test of the code here.
?>
    //---------------------------------------//
    SET COOKIE
    //----------------------------------//
<?php
setcookie( "name", "", time()- 60, "/","", 0);
setcookie( "age", "", time()- 60, "/","", 0);
?>
<?php echo "Set Cookies"?>
//delete
<?php echo "Deleted Cookies" ?>
<?php
        echo $_COOKIE["name"]. "<br />";
        
        /* is equivalent to */
        echo $HTTP_COOKIE_VARS["name"]. "<br />";
        
        echo $_COOKIE["age"] . "<br />";
        
         /* is equivalent to */
        echo $HTTP_COOKIE_VARS["age"] . "<br />";
    ?>
    //------------------------------//
    UPLOAD PHOTOS
    //-------------------------//
    <?php
if(isset($_FILES['image'])){
    $errors= array();
    $file_name = $_FILES['image']['name'];
    $file_size =$_FILES['image']['size'];
    $file_tmp =$_FILES['image']['tmp_name'];
    $file_type=$_FILES['image']['type'];
    $file_ext=strtolower(end(explode('.',$_FILES['image']['name'])));
    
    $extensions= array("jpeg","jpg","png");
    
    if(in_array($file_ext,$extensions)=== false){
        $errors[]="extension not allowed, please choose a JPEG or PNG file.";
    }
    
    if($file_size > 2097152){
        $errors[]='File size must be excately 2 MB';
    }
    
    if(empty($errors)==true){
        move_uploaded_file($file_tmp,"images/".$file_name);
        echo "Success";
    }else{
        print_r($errors);
    }
}
?>
<form action="" method="POST" enctype="multipart/form-data">
        <input type="file" name="image" />
        <input type="submit"/>
    </form>
    <?php
    //upload
if(isset($_FILES['image'])){
    $errors= array();
    $file_name = $_FILES['image']['name'];
    $file_size = $_FILES['image']['size'];
    $file_tmp = $_FILES['image']['tmp_name'];
    $file_type = $_FILES['image']['type'];
    $file_ext=strtolower(end(explode('.',$_FILES['image']['name'])));
    
    $extensions= array("jpeg","jpg","png");
    
    if(in_array($file_ext,$extensions)=== false){
        $errors[]="extension not allowed, please choose a JPEG or PNG file.";
    }
    
    if($file_size > 2097152) {
        $errors[]='File size must be excately 2 MB';
    }
    
    if(empty($errors)==true) {
        move_uploaded_file($file_tmp,"images/".$file_name);
        echo "Success";
    }else{
        print_r($errors);
    }
}
?>
<form action = "" method = "POST" enctype = "multipart/form-data">
        <input type = "file" name = "image" />
        <input type = "submit"/>
			
        <ul>
            <li>Sent file: <?php echo $_FILES['image']['name'];  ?>
            <li>File size: <?php echo $_FILES['image']['size'];  ?>
            <li>File type: <?php echo $_FILES['image']['type'] ?>
        </ul>
			
    </form>
/-------------------//
Form validation
//------------------//
<?php
        
        // define variables and set to empty values
        $name = $email = $gender = $comment = $website = "";
        
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $name = test_input($_POST["name"]);
            $email = test_input($_POST["email"]);
            $website = test_input($_POST["website"]);
            $comment = test_input($_POST["comment"]);
            $gender = test_input($_POST["gender"]);
        }
        
        function test_input($data) {
            $data = trim($data);
            $data = stripslashes($data);
            $data = htmlspecialchars($data);
            return $data;
        }
    ?>

    <h2>Tutorials Point Absolute classes registration</h2>
    
    <form method = "post" action = "/php/php_form_introduction.htm">
        <table>
            <tr>
            <td>Name:</td> 
            <td><input type = "text" name = "name"></td>
            </tr>
            
            <tr>
            <td>E-mail:</td>
            <td><input type = "text" name = "email"></td>
            </tr>
            
            <tr>
            <td>Specific Time:</td>
            <td><input type = "text" name = "website"></td>
            </tr>
            
            <tr>
            <td>Class details:</td>
            <td><textarea name = "comment" rows = "5" cols = "40"></textarea></td>
            </tr>
            
            <tr>
            <td>Gender:</td>
            <td>
                <input type = "radio" name = "gender" value = "female">Female
                <input type = "radio" name = "gender" value = "male">Male
            </td>
            </tr>
            
            <tr>
            <td>
                <input type = "submit" name = "submit" value = "Submit"> 
            </td>
            </tr>
        </table>
    </form>
    
    <?php
        echo "<h2>Your Given details are as :</h2>";
        echo $name;
        echo "<br>";
        
        echo $email;
        echo "<br>";
        
        echo $website;
        echo "<br>";
        
        echo $comment;
        echo "<br>";
        
        echo $gender;
    ?>
    //------------------------//
    VALIDATION URL
    //-----------------------//
    $website = input($_POST["site"]);

if (!preg_match("/\b(?:(?:https?|ftp):\/\/|www\.)[-a-z0-9+&@#\/%?=~_|!:,.;]*[-a-z0-9+&@#\/%=~_|]/i",$website)) {
$websiteErr = "Invalid URL"; 
}
//-------------------------------//
VALIDE EMAIL
//-----------------------------//
$email = input($_POST["email"]);

if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
$emailErr = "Invalid format and please re-enter valid email"; 
}
//----------------------------------------------//
REQUIRE FIELD IN A FORM
//---------------------------------------------//
<style>
        .error {color: #FF0000;}
    </style>
<?php
        // define variables and set to empty values
        $nameErr = $emailErr = $genderErr = $websiteErr = "";
        $name = $email = $gender = $comment = $website = "";
        
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            if (empty($_POST["name"])) {
            $nameErr = "Name is required";
            }else {
            $name = test_input($_POST["name"]);
            }
            
            if (empty($_POST["email"])) {
            $emailErr = "Email is required";
            }else {
            $email = test_input($_POST["email"]);
            
               // check if e-mail address is well-formed
            if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                $emailErr = "Invalid email format"; 
            }
            }
            
            if (empty($_POST["website"])) {
            $website = "";
            }else {
            $website = test_input($_POST["website"]);
            }
            
            if (empty($_POST["comment"])) {
            $comment = "";
            }else {
            $comment = test_input($_POST["comment"]);
            }
            
            if (empty($_POST["gender"])) {
            $genderErr = "Gender is required";
            }else {
            $gender = test_input($_POST["gender"]);
            }
        }
        
        function test_input($data) {
            $data = trim($data);
            $data = stripslashes($data);
            $data = htmlspecialchars($data);
            return $data;
        }
    ?>
    
    <h2>Absolute classes registration</h2>
    
    <p><span class = "error">* required field.</span></p>
    
    <form method = "post" action = "<?php 
        echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
        <table>
            <tr>
            <td>Name:</td>
            <td><input type = "text" name = "name">
                <span class = "error">* <?php echo $nameErr;?></span>
            </td>
            </tr>
        
            <tr>
            <td>E-mail: </td>
            <td><input type = "text" name = "email">
                <span class = "error">* <?php echo $emailErr;?></span>
            </td>
            </tr>
        
            <tr>
            <td>Time:</td>
            <td> <input type = "text" name = "website">
                <span class = "error"><?php echo $websiteErr;?></span>
            </td>
            </tr>
            
            <tr>
            <td>Classes:</td>
            <td> <textarea name = "comment" rows = "5" cols = "40"></textarea></td>
            </tr>
            
            <tr>
            <td>Gender:</td>
            <td>
                <input type = "radio" name = "gender" value = "female">Female
                <input type = "radio" name = "gender" value = "male">Male
                <span class = "error">* <?php echo $genderErr;?></span>
            </td>
            </tr>
				
            <td>
            <input type = "submit" name = "submit" value = "Submit"> 
            </td>
				
        </table>
			
    </form>
    
    <?php
        echo "<h2>Your given values are as:</h2>";
        echo $name;
        echo "<br>";
        
        echo $email;
        echo "<br>";
        
        echo $website;
        echo "<br>";
        
        echo $comment;
        echo "<br>";
        
        echo $gender;
    ?>