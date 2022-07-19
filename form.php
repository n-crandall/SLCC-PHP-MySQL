<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>PHP - Form</title>
  </head>
  <body>
    <?php
      $firstErr = $lastErr = $emailErr = $subErr = "";
      $first = $last = $email = $subscribe = $msg = "";
      $formErr = false;

      if ($_SERVER["REQUEST_METHOD"] == "POST") {

        if (empty($_POST["fname"])) {
          $firstErr = "First name is required.";
	  $formErr = true;
        }
        if (empty($_POST["lname"])) {
          $lastErr = "Last name is required.";
	  $formErr = true;
        } else {
	    $first = cleanInput($_POST["fname"]);
            $last = cleanInput($_POST["lname"]);
	    
	// REGEX name validation
	if (!preg_match("/^[a-zA-Z ]*$/", $first)) {
          $firstErr = "Only letters and spaces allowed.";
	  $formErr = true;
	}
        if (!preg_match("/^[a-zA-Z ]*$/", $last)) {
	  $lastErr = "Only letters and spaces allowed.";
	  $formErr = true;
	}
      }
            
      if (empty($_POST["email"])) {
        $emailErr = "Email is required.";
	$formErr = true;
      } else {
	$email = cleanInput($_POST["email"]);
	
      // Email validation
      if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
	$emailErr = "Please enter a valid email address.";
	$formErr = true;
      }
    }
      if (empty($_POST["subscribe"])) {
	$subErr = "Please choose an option.";
	$formErr = true;
      } else {
	$subscribe = cleanInput($_POST["subscribe"]);
      }

        $msg = cleanInput($_POST["message"]);
      }

      function cleanInput($data) {
        $data = trim($data);
	$data = stripslashes($data);
        $data = htmlspecialchars($data);
	return $data;
      }
    ?>
    <h1>PHP - Week 3</h1>
    <!-- Beginning of form -->
    <form action=<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?> method="POST" novalidate>
      <label for="fname">First name:</label><br>
      <input type="text" id="fname" name="fname">
      <span><?php echo $firstErr; ?></span><br>

      <label for="lname">Last name:</label><br>        
      <input type="text" id="lname" name="lname">
      <span><?php echo $lastErr; ?></span><br>

      <label for="email">Email:</label><br>
      <input type="text" id="email" name="email">
      <span><?php echo $emailErr; ?></span><br>

      <p><strong>Do you want to subscribe?</strong></p>
      <input type="radio" id="yes" name="subscribe" value="yes">
      <label for="yes">Yes</label><br>
      <input type="radio" id="no" name="subscribe" value="no">
      <label for="no">No</label>
      <span><?php echo $subErr; ?></span><br>
      <br>

      <textarea name="message" rows="5" cols="30" placeholder="Leave a comment"></textarea><br>
      <br>
      <button type="submit" role="button" name="submit">Submit</button>
    </form>

    <?php if (($_SERVER["REQUEST_METHOD"] == "POST") && (!($formErr))) { ?>
      <section>
	<h1>Form Entries: </h1>
	   <ul>
	      <?php
	        if ($first !== "") { echo "<li>FIRST NAME: $first </li>"; }
                if ($last !== "") { echo "<li>LAST NAME: $last </li>"; } 
        	if ($email !== "") { echo "<li>EMAIL: $email </li>"; }
		if ($subscribe !== "") { echo "<li>SUBSCRIBE: $subscribe </li>"; }			
	        if ($msg !== "") { echo "<li>MESSAGE: $msg </li>"; }
	      ?>
	   </ul>		
       </section>
     <?php } ?>
  </body>
</html>
