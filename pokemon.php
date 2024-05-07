<?php 

require_once('config/db.php');
$queryGen1 = "select * from pokemon WHERE pokedexnum < 152 order by pokedexnum asc;";
$resultGen1 = mysqli_query($con, $queryGen1);

$queryGen2 = "select * from pokemon WHERE pokedexnum > 151 and pokedexnum < 252 order by pokedexnum asc;";
$resultGen2 = mysqli_query($con, $queryGen2);

$queryGen3 = "select * from pokemon WHERE pokedexnum > 251 and pokedexnum < 387 order by pokedexnum asc;";
$resultGen3 = mysqli_query($con, $queryGen3);

$queryGen4 = "select * from pokemon WHERE pokedexnum > 386 and pokedexnum < 494 order by pokedexnum asc;";
$resultGen4 = mysqli_query($con, $queryGen4);

$queryGen5 = "select * from pokemon WHERE pokedexnum > 493 and pokedexnum < 650 order by pokedexnum asc;";
$resultGen5 = mysqli_query($con, $queryGen5);

$queryGen6 = "select * from pokemon WHERE pokedexnum > 649 order by pokedexnum asc;";
$resultGen6 = mysqli_query($con, $queryGen6);
?>



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
          <a href="battles.php">Battles</a>
          <a href="pc_box.php">PC BOX</a>
        </div>
      </nav>
    </div>  
    
    <div class="content-container">
      <div class="pokemon-standard-container">
        <div class="content">

          <h2 class="lower-page-title">
            List of Pokemon by National Dex
          </h2>

          <div class="pokemon-page-info">
            <p>
              As you can probably guess, this is the page where all pokemon are desplayed. It will be taken from our
              pokemon table from our database. Because it goes in order of the national dex number assigned
              to every pokemon, they will appear in order of generation from 1-7. Johto, Hoenn, Sinnoh, Unova, Kalos.
            </p>

            <div class="mid-sect">
              <div class="dex-nav">
                <p class="list-box-title">Generations</p>

                <ol class="gen-list">
                  <li><a href="#gen1-table">Generation 1</a></li>
                  <li><a href="#gen2-table">Generation 2</a></li>
                  <li><a href="#gen3-table">Generation 3</a></li>
                  <li><a href="#gen4-table">Generation 4</a></li>
                  <li><a href="#gen5-table">Generation 5</a></li>
                  <li><a href="#gen6-table">Generation 6</a></li>
                </ol>
              </div>

              <div>
                <img class="mid-sect-img-region" src="images/regionMap.jpg" />
                <p class="image-credits">Official Pokemon Paldea Region Art<p>
              </div>
            </div>

            <h2 class="lower-page-title">
              Search a Pokemon
            </h2>

            <div class="mid-sect-form">

              <div class="form-div">

                <form method="post"  id="searchForm">
                  <label for="search">Pokemon Name:</label>
                  <input type="text" name="search" id="search">
                  <input type="submit" value="Submit">
                </form>

                <?php
                  // Check if the form is submitted
                  if ($_SERVER["REQUEST_METHOD"] == "POST") {
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
                    $sql = "SELECT * FROM pokemon WHERE pokemon_name LIKE '$search%'";

                    // Execute the query
                    $result = $conn->query($sql);

                      // Display results within HTML
                    if ($result->num_rows > 0) {
                      echo '<table border="1" class="gen1-table table">';
                      echo '<thead>
                              <tr>
                                <td>Pokedex Num</td>
                                <td>Name</td>
                                <td>Type 1</td>
                                <td>Type 2</td>
                                <td>Weight</td>
                                <td>Height</td>
                              </tr>
                            </thead>';

                      while ($row = $result->fetch_assoc()) {
                        echo '<tr>';
                        echo '<td>' . $row["pokedexnum"] . '</td>';
                        echo '<td>' . $row["pokemon_name"] . '</td>';
                        echo '<td>' . $row["type1"] . '</td>';
                        echo '<td>' . $row["type2"] . '</td>';
                        echo '<td>' . $row["weight"] . '</td>';
                        echo '<td>' . $row["height"] . '</td>';
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



            <div class="gen1-section" id="gen1-table">
              <h2 class="lower-page-title">
                Generation 1
              </h2>

              <div class="table-div">
                <table class="gen1-table table">
                  <thead>
                    <tr>
                      <td>Pokedex Num</td>
                      <td>Name</td>
                      <td>Type 1</td>
                      <td>Type 2</td>
                      <td>Weight</td>
                      <td>Height</td>
                    </tr>
                  </thead>

                  <tbody>
                    <tr>
                      
                    <?php
                      while ($row = mysqli_fetch_assoc($resultGen1)) {
                    ?>
                      <td><?php echo $row['pokedexnum'];?></td>
                      <td><?php echo $row['pokemon_name'];?></td>
                      <td><?php echo $row['type1'];?></td>
                      <td><?php echo $row['type2'];?></td>
                      <td><?php echo $row['weight'];?></td>
                      <td><?php echo $row['height'];?></td>
                        
                    </tr>
                   <?php
                      }
                      
                    ?>


                  </tbody>
                  
                </table>
              </div>
            </div>

            <div class="gen2-section" id="gen2-table">
              <h2 class="lower-page-title">
                Generation 2
              </h2>

              <div class="table-div">
                <table class="gen2-table table">
                      
                  <thead>
                    <tr>
                      <td>Pokedex Num</td>
                      <td>Name</td>
                      <td>Type 1</td>
                      <td>Type 2</td>
                      <td>Weight</td>
                      <td>Height</td>
                    </tr>
                  </thead>

                  <tbody>
                    <tr>
                        
                    <?php
                      while ($row = mysqli_fetch_assoc($resultGen2)) {
                    ?>
                      <td><?php echo $row['pokedexnum'];?></td>
                      <td><?php echo $row['pokemon_name'];?></td>
                      <td><?php echo $row['type1'];?></td>
                      <td><?php echo $row['type2'];?></td>
                      <td><?php echo $row['weight'];?></td>
                      <td><?php echo $row['height'];?></td>
                          
                    </tr>
                  <?php
                      }  
                    ?>


                  </tbody>

                </table>
              </div>
            </div>

            <div class="gen3-section" id="gen3-table">
              <h2 class="lower-page-title">
                Generation 3
              </h2>

              <div class="table-div">
                <table class="gen3-table table">
                
                  <thead>
                    <tr>
                      <td>Pokedex Num</td>
                      <td>Name</td>
                      <td>Type 1</td>
                      <td>Type 2</td>
                      <td>Weight</td>
                      <td>Height</td>
                    </tr>
                  </thead>

                  <tbody>
                    <tr>
                      
                    <?php
                      while ($row = mysqli_fetch_assoc($resultGen3)) {
                    ?>
                      <td><?php echo $row['pokedexnum'];?></td>
                      <td><?php echo $row['pokemon_name'];?></td>
                      <td><?php echo $row['type1'];?></td>
                      <td><?php echo $row['type2'];?></td>
                      <td><?php echo $row['weight'];?></td>
                      <td><?php echo $row['height'];?></td>
                        
                    </tr>
                   <?php
                      }
                      
                    ?>
                  </tbody>

                </table>
              </div>
            </div>

            <div class="gen4-section" id="gen4-table">
              <h2 class="lower-page-title">
                Generation 4
              </h2>

              <div class="table-div">
                <table class="gen4-table table">
                
                  <thead>
                    <tr>
                      <td>Pokedex Num</td>
                      <td>Name</td>
                      <td>Type 1</td>
                      <td>Type 2</td>
                      <td>Weight</td>
                      <td>Height</td>
                    </tr>
                  </thead>

                  <tbody>
                    <tr>
                      
                    <?php
                      while ($row = mysqli_fetch_assoc($resultGen4)) {
                    ?>
                      <td><?php echo $row['pokedexnum'];?></td>
                      <td><?php echo $row['pokemon_name'];?></td>
                      <td><?php echo $row['type1'];?></td>
                      <td><?php echo $row['type2'];?></td>
                      <td><?php echo $row['weight'];?></td>
                      <td><?php echo $row['height'];?></td>
                        
                    </tr>
                   <?php
                      }
                      
                    ?>
                  </tbody>


                </table>
              </div>
            </div>

            <div class="gen5-section" id="gen5-table">
              <h2 class="lower-page-title">
                Generation 5
              </h2>

              <div class="table-div">
                <table class="gen5-table table">
                
                  <thead>
                    <tr>
                      <td>Pokedex Num</td>
                      <td>Name</td>
                      <td>Type 1</td>
                      <td>Type 2</td>
                      <td>Weight</td>
                      <td>Height</td>
                    </tr>
                  </thead>

                  <tbody>
                    <tr>
                      
                    <?php
                      while ($row = mysqli_fetch_assoc($resultGen5)) {
                    ?>
                      <td><?php echo $row['pokedexnum'];?></td>
                      <td><?php echo $row['pokemon_name'];?></td>
                      <td><?php echo $row['type1'];?></td>
                      <td><?php echo $row['type2'];?></td>
                      <td><?php echo $row['weight'];?></td>
                      <td><?php echo $row['height'];?></td>
                        
                    </tr>
                   <?php
                      }
                      
                    ?>
                  </tbody>


                </table>
              </div>
            </div>

            <div class="gen6-section" id="gen6-table">
              <h2 class="lower-page-title">
                Generation 6
              </h2>

              <div class="table-div">
                <table class="gen6-table table">

                  <thead>
                    <tr>
                      <td>Pokedex Num</td>
                      <td>Name</td>
                      <td>Type 1</td>
                      <td>Type 2</td>
                      <td>Weight</td>
                      <td>Height</td>
                    </tr>
                  </thead>

                  <tbody>
                    <tr>
                      
                    <?php
                      while ($row = mysqli_fetch_assoc($resultGen6)) {
                    ?>
                      <td><?php echo $row['pokedexnum'];?></td>
                      <td><?php echo $row['pokemon_name'];?></td>
                      <td><?php echo $row['type1'];?></td>
                      <td><?php echo $row['type2'];?></td>
                      <td><?php echo $row['weight'];?></td>
                      <td><?php echo $row['height'];?></td>
                        
                    </tr>
                   <?php
                      }
                      
                    ?>
                  </tbody>

                </table>
                <h2 class="lower-page-title">
                  
                </h2>
              </div>
            </div>
          
          </div>

        </div>
      </div>
      
      


     


      
    </div>
  </body>

  </html>