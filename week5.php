<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PHP - Week 5</title>
</head>
<body>
    <?php
      $hostname = "hostname";
      $databasename = "databasename";
      $username = "username";
      $password = "password";

      try {
        //PDO Object with connection parameters
        $conn = new PDO("mysql:host=$hostname;dbname=$databasename", $username, $password);

        //Set PDO error mode to exception
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        //SQL Variable
        $sql = "SELECT * FROM dmc_threads_Table;";

        //Execute SQL statement on server
        $return = $conn->query($sql);

        //Print returned data to the screen
        echo "<b>The data currently in the database: </b><br>\n";
        foreach ($conn->query($sql) as $row) {
            echo $row['ID'] . " | ";
            echo $row['colorID'] . " | ";
            echo $row['colorName'] . " | ";
            echo $row['quantity'] . " | ";
            echo $row['dateSent'] . "<br>\n";}

      } catch (PDOException $error) {

        // Return error code
        echo "An error occurred: <br>" . $sql . "<br>" . $error->getMessage();
      }

      $conn = null;
    ?>
</body>
</html>