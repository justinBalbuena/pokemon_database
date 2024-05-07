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
    <div class="nav-container">
      <nav class="navigator">
        <img src="images/beastball.png" class="nav-img">
        <div class="nav-links">
          <a href="index.php">Home</a>
          <a href="trainer.php">Trainer</a>
          <a href="pokemon.php">Pokemon</a>
          <a href="battles.php">Battles</a>
        </div>
      </nav>
    </div>  
    
    <div class="content-container">
      <div class="pcbox-standard-container">

        <div class="content">

          <h2 class="lower-page-title">
              PC Box
          </h2>

          <div class="pcbox-page-info">
            <div class="mid-sect">

              <div class="pcbox-description-div">
                <p class="pcbox-description">
                  The PC stands for "Personal Computer." This is where you can place any pokemon that you aren't actively using within your team.
                  Don't worry becase your pokemon will be safe within!
                </p>

                <p class="pcbox-description">
                  <br />
                  Lorem ipsum, dolor sit amet consectetur adipisicing elit. <br />Nisi illum numquam modi dolorem tempore non vero quaerat maiores quisquam cumque, nihil a eius officia, libero sequi architecto. Neque, sequi nobis? 
                  Lorem ipsum, dolor sit amet consectetur adipisicing elit. Nisi illum numquam modi dolorem tempore non vero quaerat maiores quisquam cumque, nihil a eius officia, libero sequi architecto.
                </p>
              </div>

              <div class="mid-sect-img-pair">
                <img class="mid-sect-img" alt="pokemon pc box interpretation made by Squishybo, very cute art of the pokemon enjoying themselves" src="images/pcBoxImageBySquishyBo.webp" />
                <p class="image-credits">Made by <a target="_blank" rel="noopener noreferrer" href="https://twitter.com/squishybo_?lang=en">Squishybo</a></p>
              </div>
            </div>
          </div>

          <h2 class="lower-page-title">
              Access PC Box
          </h2>

          <div class="mid-sect-form">
              <div class="form-div">

                <form method="post"  id="searchForm">
                  <label for="insertID">Insert ID:</label>
                  <input type="text" name="insertID" id="insertID">
                  <input type="submit" name="getPC" value="Submit">
                </form>

                <?php
                  // Check if the form is submitted
                  if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['getPC'])) {
                    // Get the user input
                    $insertID = $_POST["insertID"];

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
                    $sql = "SELECT * FROM pc_box WHERE pc_trainerID = $insertID";

                    // Execute the query
                    $result = $conn->query($sql);

                      // Display results within HTML
                    if ($result->num_rows > 0) {
                      echo '<table border="1" class="table">';
                      echo '<thead>
                              <tr>
                                <td>Trainer ID</td>
                                <td>Pokemon In PC</td>
                              </tr>
                            </thead>';

                      while ($row = $result->fetch_assoc()) {
                        echo '<tr>';
                        echo '<td>' . $row["pc_trainerID"] . '</td>';
                        echo '<td>' . $row["p_name"] . '</td>';
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
              Add to PC Box
          </h2>

          <div class="mid-sect-form">
              <div class="form-div">

                <form method="post" id="searchForm">

                  <label for="searchAdd">PC ID:</label>
                  <input type="text" name="searchAdd" id="searchAdd">

                  <label for="pname">Pokemon Name:</label>
                  <input type="text" name="pname" id="pname">
                  
                  <input type="submit" name="addToBox" value="Submit">
                </form>

                <?php
                  // Check if the form is submitted
                  // By having the && check the name of the related submit button I can make sure it doesn't depend on info from any other submit button
                  if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['addToBox'])) {
                    // Get the user input
                    $searchAdd = $_POST["searchAdd"];
                    $pname = $_POST["pname"];

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
                    if (isset($searchAdd) && isset($pname)) {
                      $sql = "UPDATE PC_BOX SET p_name = CONCAT(p_name, ' $pname') where pc_trainerID = $searchAdd;";

                      // Execute the query
                      $result = $conn->query($sql);
                    }

                  }
                ?>
                <div id="results"></div>

              </div>
            </div>

          <h2 class="lower-page-title">
              Create PC Box
          </h2>

        </div>

      </div>
    </div>
  </body>

  </html>