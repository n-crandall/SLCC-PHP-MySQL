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

        if (($_SERVER["REQUEST_METHOD"] == "POST") && (!($formErr))) {
            $hostname = "hostname";
            $username = "username";
            $password = "password";
            $databasename = "databasename";

            try {
                $conn = new PDO("mysql:host=$hostname;dbname=$databasename",$username, $password);

                $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

                $sql = "INSERT INTO table_name (first, last, email, subscribe, msg) VALUES (:first, :last, :email, :subscribe, :msg);";

                $stmt = $conn->prepare($sql);

                $stmt->bindParam(':first', $first, PDO::PARAM_STR);
                $stmt->bindParam(':last', $last, PDO::PARAM_STR);
                $stmt->bindParam(':email', $email, PDO::PARAM_STR);
                $stmt->bindParam(':subscribe', $subscribe, PDO::PARAM_BOOL);
                $stmt->bindParam(':msg', $msg, PDO::PARAM_STR);

                $stmt->execute();

            }
            
            catch (PDOException $error) {

                echo "Execution error: <br>" . $sql . "<br>" . $error->getMessage();
            }

            $conn = null;
        }
    ?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>PHP - Week 6</title>
  </head>
  <body>
    <h1>PHP - Week 6</h1>
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
    
    
    <h2>The data currently in the database is:</h2>

        <!-- Table element start -->                
        <table>
            <thead>
                <tr>
                    <th>ID</th>
                    <th>First Name</th>
                    <th>Last Name</th>
                    <th>Email</th>
                    <th>Subscribe</th>
                    <th>Message</th>
                    <th>Date Sent</th>
                </tr>
            </thead>
            <tbody>
            <!-- Loop through data returned from database -->
                <?php
                
                $hostname = "hostname";
                $username = "username";
                $password = "password";
                $databasename = "databasename";
                
                try {
                    //Create new PDO Object with connection parameters
                    $conn = new PDO("mysql:host=$hostname;dbname=$databasename",$username, $password);
                    
                    //Set PDO error mode to exception
                    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION); 
                    
                    //Variable containing SQL command
                    $sql = "SELECT * FROM table_name;";
            
                    $stmt = $conn->prepare($sql);
            
                    $stmt->execute();
                    
            
                } catch (PDOException $error) {
            
                    //Return error code if one is created
                    echo "Execution error: <br>" . $sql . "<br>" . $error->getMessage();
                }
            
                $conn = null;

                    foreach ($stmt->fetchAll() as $row) {
                        echo "<tr>";
                        echo "<th>" . $row['contactID'] . "</th>";
                        echo "<td>" . $row['first'] . "</td>";
                        echo "<td>" . $row['last'] . "</td>";
                        echo "<td>" . $row['email'] . "</td>";
                        echo "<td>" . $row['subscribe'] . "</td>";
                        echo "<td>" . $row['msg'] . "</td>";
                        echo "<td>" . $row['date'] . "</td>";
                        echo "</tr>";
                    }
                ?>
            </tbody>
        </table>
  </body>
</html>