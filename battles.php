<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <title>Practice Pokemon Database</title>

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Kanit:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">

  </head>

  <body>
  <div class="container">
      <nav class="navigator">
        <img src="images/beastball.png" class="nav-img">
        <div class="nav-links">
          <a href="index.php">Home Page</a>
          <a href="trainer.php">Trainer</a>
          <a href="pokemon.php">Pokemon</a>
          <a href="pc_box.php">PC BOX</a>
        </div>
      </nav>
    </div>  
      <div class = "content-container">
        <div class="standard-container">
          <div class = "content">
            <div class="welcome-lines">
              <span class="welcome-message">Welcome to Pokemon Battles!</span>
              <span class="fan-made"><i>a fan-made Pokemon League Database Project</i></span>
            </div>
            <div class="welcome-paired-section">
              <div class="welcome-paragraph">
                <p>
                  Have you ever been in a fierce battle before? Come look at a history of Pokemon                    
                  battles and see how they have turned out!
                </p>
              </div>
              <div class="battle-images-div">
                <img class="battle-images" src="images/battlestuff.JPG">
                <img class="battle-images" src = "images/pikagun.JPG">
              </div>
            </div>

            <h2 class="lower-page-title">
              Look at Previous Battles!
            <h2>

            <div class="mid-sect-form">

              <div class="form-div">

                <form method="post"  id="searchForm">
                  <label for="trainerInvolved">Trainer ID:</label>
                  <input type="text" name="trainerInvolved" id="trainerInvolved">
                  <input type="submit" name="trainerBattleFind" value="Submit">
                </form>

                <?php
                  // Check if the form is submitted
                  if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['trainerBattleFind'])) {
                    // Get the user input
                    $trainerInvolved = $_POST["trainerInvolved"];

                    // Connect to your database
                    $servername = "localhost";
                    $username = "root";
                    $password = "Secret23$@user";
                    $dbname = "arceus_po_box";

                    $conn = new mysqli($servername, $username, $password, $dbname);

                    // Check connection
                    if ($conn->connect_error) {
                        die("Connection failed: " . $conn->connect_error);
                    }

                    // Construct the SQL query
                    $sqll = "SELECT * FROM BATTLE WHERE trainer2 = $trainerInvolved";
                      
                    // Execute the query
                    $result = $conn->query($sqll);

                      // Display results within HTML
                    if ($result->num_rows > 0) {
                      echo '<table border="1" class="table  trainer-page-table">';
                      echo '<thead>
                              <tr>
                                <td>Battle ID</td>
                                <td>Trainer Fighting</td>
                                <td>Date</td>
                                <td>Place</td>
                                <td>Amount of Challengers Fainted Pokemon</td>
                                <td>Amount of Initiators Fainted Pokemon</td>
                              </tr>
                            </thead>';

                      while ($row = $result->fetch_assoc()) {
                        echo '<tr>';
                        echo '<td>' . $row["battleID"] . '</td>';
                        echo '<td>' . $row["trainer2"] . '</td>';
                        echo '<td>' . $row["date"] . '</td>';
                        echo '<td>' . $row["place"] . '</td>';
                        echo '<td>' . $row["trainer1_faint"] . '</td>';
                        echo '<td>' . $row["trainer2_faint"] . '</td>';
                        echo '</tr>';
                      }

                      echo '</table>';
                          
                    } else {
                        echo "0 results";
                    }
                    $conn->close();
                  }
                ?>
                <div id="results"></div>

              </div>

              
            </div>

        </div>
      </div>




      </div>


    </div>
  </body>

  </html>