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
    <link href="https://fonts.googleapis.com/css2?family=Archivo+Black&display=swap" rel="stylesheet">

  </head>

  <body>
    <div class="nav-container">
      <nav class="navigator">
        <img src="images/beastball.png" class="nav-img">
        <div class="nav-links">
          <a href="index.php">Home</a>
          <a href="pokemon.php">Pokemon</a>
          <a href="battles.php">Battles</a>
          <a href="pc_box.php">PC BOX</a>
        </div>
      </nav>
    </div>  
    
    <div class="content-container">
      <div class="trainer-page-container">
        <div class="content">

          <h2 class="lower-page-title">
            Trainer
          </h2>

          <div class="trainer-page-info">
            <div class="trainer-page-header">
              <p>
                If this your first time here, welcome new Trainer! If not, then welcome back! Regardless of when was
                the last time that you visited us, a lot must of happened. Here you'll be able to register your trainer account
                within our database to start keeping track of your achievements. Remember that as your repetoire and strength grows
                so will your pokemon's. So remember to praise them too! We all realize sooner or later that this a joint journey,
                and no one will understand your struggle as much as those that have been at your side the entire time. Welcome to
                the wide world or Pokemon, may your journey be Legendary!
              </p>
              <img alt="image of ash ketchum from pokemon journey's after becoming champion" class="ash-img" src="images/champions/100px-Ash_JN.png">
            </div>
            


            <div class="champion-recruitment-header">
              <div>
                <p class="champion-recruitment">YOU TOO CAN BECOME A CHAMPION</p>
              </div>

              <div>
                <p class="champion-recruitment">EARN 8 GYM BADGES AND JOIN OUR RANKS TODAY</p>
              </div>
            </div>

            <div class="mid-sect champion-mid-sect">
              <img alt="image of steven from pokemon ruby and sapphire" class="champion-img" id="steven-img" src="images/champions/481px-Steven_Stone_JN_2.png">
              <img alt="image cynthia for diamond and pearl" class="champion-img" id="cynthia-img" src="images/champions/506px-Cynthia_JN.png">
              <img alt="image of iris from black 2 and white 2" class="champion-img" id="iris-img" src="images/champions/174px-Iris_JN.png">
              <img alt="image of diana from x and y" class="champion-img" id="diana-img" src="images/champions/150px-Diantha_JN.png">              
              <img alt="image of leon from sword and shield" class="champion-img" id="leon-img" src="images/champions/188px-Leon_anime_JN.png">
              <img alt="image of geeta from scarlet and violet" class="champion-img" id="geeta-img" src="images/champions/93px-Geeta_anime_2.png">
            </div>

            <h2 class="lower-page-title">
              Look Up a Trainer
            </h2>

            <div class="mid-sect-form">

              <div class="form-div">

                <form method="post"  id="searchForm">
                  <label for="search">Trainer ID:</label>
                  <input type="text" name="search" id="search">
                  <input type="submit" name="findTrainer" value="Submit">
                </form>

                <?php
                  // Check if the form is submitted
                  if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['findTrainer'])) {
                    // Get the user input
                    $search = $_POST["search"];

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
                    $sqll = "SELECT * FROM TRAINER LEFT JOIN POKEMON_TEAM ON TRAINER.trainerID = POKEMON_TEAM.team_trainerID WHERE TRAINER.trainerID = $search;";
                      
                    // Execute the query
                    $result = $conn->query($sqll);

                      // Display results within HTML
                    if ($result->num_rows > 0) {
                      echo '<table border="1" class="table  trainer-page-table">';
                      echo '<thead>
                              <tr>
                                <td>Trainer ID</td>
                                <td>Name</td>
                                <td>P1</td>
                                <td>P2</td>
                                <td>P3</td>
                                <td>P4</td>
                                <td>P5</td>
                                <td>P6</td>
                              </tr>
                            </thead>';

                      while ($row = $result->fetch_assoc()) {
                        echo '<tr>';
                        echo '<td>' . $row["trainerID"] . '</td>';
                        echo '<td>' . $row["trainerName"] . '</td>';
                        echo '<td>' . $row["p_1"] . '</td>';
                        echo '<td>' . $row["p_2"] . '</td>';
                        echo '<td>' . $row["p_3"] . '</td>';
                        echo '<td>' . $row["p_4"] . '</td>';
                        echo '<td>' . $row["p_5"] . '</td>';
                        echo '<td>' . $row["p_6"] . '</td>';
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

            <h2 class="lower-page-title">
                Update Your Information
            </h2>

            <div class="mid-sect-form">
              <div class="form-div-trainer-update">

                <form method="post" id="searchForm">

                  <label for="trainerID">Trainer ID:</label>
                  <input type="text" name="trainerID" id="trainerID">

                  <label for="thingToChange">Thing to Change:</label>
                  <select id="thingToChange" name="thingToChange">
                    <option value="trainerName">Trainer Name</option>
                    <option value="p_1">P1</option>
                    <option value="p_2">P2</option>
                    <option value="p_3">P3</option>
                    <option value="p_4">P4</option>
                    <option value="p_5">P5</option>
                    <option value="p_6">P6</option>
                  </select>

                  <label for="valueOfChange">Value:</label>
                  <input type="text" name="valueOfChange" id="valueOfChange">
                  
                  <input type="submit" name="changeTrainerInfo" value="Submit">
                </form>

                <?php
                  // Check if the form is submitted
                  // By having the && check the name of the related submit button I can make sure it doesn't depend on info from any other submit button
                  if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['changeTrainerInfo'])) {
                    // Get the user input
                    $trainerID = $_POST["trainerID"];
                    $thingToChange = $_POST["thingToChange"];
                    $valueOfChange = $_POST["valueOfChange"];

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
                    if (isset($trainerID) && isset($thingToChange) && isset($valueOfChange)) {

                      $sql = "UPDATE TRAINER LEFT JOIN POKEMON_TEAM ON TRAINER.trainerID = POKEMON_TEAM.team_trainerID SET $thingToChange = '$valueOfChange' WHERE TRAINER.trainerID = $trainerID";

                      // Execute the query
                      $result = $conn->query($sql);
                    }
                    conn->close();
                  }
                ?>
                <div id="results"></div>

              </div>
            </div>

              
            </div>

            <h2 class="lower-page-title">
                Add Your Trainer Profile
            </h2>
          </div>

        </div>
      </div>
    </div>
  </body>

  </html>