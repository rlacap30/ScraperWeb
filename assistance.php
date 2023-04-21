<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE-edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Request New Source</title>
  
  <link rel="preload" href="assistancestylel.css" as="style" />
  <link rel="preload" href="indextest.js" as="script" />  
  <link rel = "stylesheet" type="text/css" href = "assistancestylel.css">
  <link href="https://fonts.googleapis.com/icon?family=Material+Icons+Sharp" rel="stylesheet">
</head>
<body>
    <?php
         session_start();
         if (!isset($_SESSION['username'])) {
    		 #header("Location: login.php"); 
         } 
         if(isset($_POST['submit'])){             
             $assistanceAddress = 'assistancescraper@gmail.com'; // this is your Email address
             $clientAddress = 'assistancescrapersv@gmail.com';
             $subject = 'A new source has been requested!';
             $name = $_POST['name'];
             $url = $_POST['url'];
             $isPending = true;
             
             #$clientMessage = "Source Name: " + $name + " Source Url: " + $url;
             $clientMessage = "Source Name: " . $name . " Source Url: " . $url;
             $headers = "From:" . $assistanceAddress;
             mail($assistanceAddress,$subject,$clientMessage,$headers);
             
             $conn = mysqli_connect("localhost", "lacaprose5bin", "", "my_lacaprose5bin");
             if (!$conn) {
                 die("Connection failed: " . mysqli_connect_error());
             }
             
             $query = "INSERT INTO SourceRequests (Url, Name, IsPending) VALUES ('$url', '$name', '$isPending')";
             $ris = mysqli_query($conn, $query);
             
             echo '<script>alert("Request sent.")</script>';
         }
    ?>
    <div class="container">
        <aside>
            <div class="top">
                <div class="logo">
                    <img src="https://static.wixstatic.com/media/74a2a6_b67528bf9d6b47ba997e189415b1a733~mv2.png/v1/fill/w_138,h_163,al_c,q_85,usm_0.66_1.00_0.01,enc_auto/Reflex_Logo_RGB_blue_1000px.png">
                    <h2>Reflex Scraper</h2>
                </div>
                <div class="close" id="close-btn">
                    <span class="material-icons-sharp">close</span>
                </div>
            </div>
            <div class="sidebar">
                <div class="dropdown">
                    <a href="advertisements.php" class="dropdown-anchor">
                        <span class="material-icons-sharp">grid_view</span>
                        <h3 style="display:inline-flex">
                          Dashboards 
                          <span class="material-icons-sharp">keyboard_arrow_down</span>
                        </h3>
                    </a>
                    <div class="dropdown-content">
                        <a href="germany.php"> Germany </a>
                        <a href="switzerland.php"> Switzerland </a>
                        <a href="sweden.php"> Sweden </a>
                        <a href="poland.php"> Poland </a>
                        <a href="uk.php"> UK </a>
                        <a href="#" style="display:none">  </a>
                    </div>
                </div>
                <a href="execute.php">
                    <span class="material-icons-sharp">receipt_long</span>
                    <h3>Sources</h3>
                </a>
                <a href="assistance.php"  class="active">
                    <span class="material-icons-sharp">add</span>
                    <h3>Request New Source</h3>
                </a>
                <a href="logout.php">
                    <span class="material-icons-sharp">logout</span>
                    <h3>Logout</h3>
                </a>
            </div>
        </aside>
        
        <main>
          <div class="websites">
            <h2>Request New Source</h2>
            <form action="assistance.php" method="post">
                <input type="text" name="url" placeholder="Url" required>
                <input type="text" name="name" placeholder="Name" required>
                <input type="submit" name="submit" value="Submit">
            </form>
            
            <div class="requests">
                <h2> Requests </h2>
                <table id="myTable">
                  <thead>
                      <th> Source Name </th>
                      <th> Source Url </th>
                      <th> Status </th>
                      <th> Date Requested </th>
                  </thead>
                  <tbody>
                      <?php
                          session_start();
                          $limit = 10;  
                          if (isset($_GET["page"])) {
                              $page_number = $_GET["page"];   
                          } else {
                              $page_number=1;  
                          }
                          
                          $initial_page = ($page_number-1) * $limit;   
                          $conn = mysqli_connect("localhost", "lacaprose5bin", "", "my_lacaprose5bin");
                          if (!$conn) {
                              die("Connection failed: " . mysqli_connect_error());
                          }
                          
                          $sql = "SELECT * FROM SourceRequests LIMIT $initial_page, $limit";
                          $rows = mysqli_query($conn, $sql);
                          while($row = mysqli_fetch_assoc($rows)) {
                              echo "<tr>";
                              echo "<td>".$row["Name"]."</td>";
                              echo "<td class='primary'><a target='_blank' href='" . $row["Url"] . "'> Click Here </a></td>";
                              if($row["IsPending"]){
                                  echo "<td class='warning'> Pending </td>";
                              } else {
                                  echo "<td class='success'> Done </td>";
                              }
                              echo "<td>".$row["CreatedDate"]."</td>";
                              echo "</tr>";
                          }
                      ?>
                  </tbody>
              </table>
                <div class="items">
                  <?php 
                      $getQuery = "SELECT COUNT(*) FROM SourceRequests";
                      $result = mysqli_query($conn, $getQuery);  
                      $row = mysqli_fetch_row($result);  
                      $total_rows = $row[0]; 
                      echo "</br>";
                      $total_pages = ceil($total_rows / $limit);  
                      $pageURL = "";   
                      if($page_number>=2){
                          echo "<a href='assistance.php?page=".($page_number-1)."'>  Prev </a>"; 
                      }
                      
                      for ($i=1; $i<=$total_pages; $i++) {
                          if ($i == $page_number) {
                              $pageURL .= "<a class = 'activePage' href='assistance.php?page=".$i."'>".$i." </a>";
                          } else {
                              $pageURL .= "<a href='assistance.php?page=".$i."'>".$i." </a>";
                          }
                      }
                      echo $pageURL; 
                      if($page_number<$total_pages){
                          echo "<a href='assistance.php?page=".($page_number+1)."'>  Next </a>"; 
                      }
                  ?>
              </div>
            </div>
          </div>
        </main>
        
        <div class ="right">
          <div class ="top">
            <button id="menu-btn">
              <span class="material-icons-sharp">menu</span>
            </button>
            <div class="theme-toggler">
              <span class="material-icons-sharp active">light_mode</span>
              <span class="material-icons-sharp">dark_mode</span>
            </div>
            <div class="profile">
              <div class="info">
                <p>Hey, <b><?php echo $_SESSION['username']; ?></b></p>
                <small class="text-muted">User</small>
              </div>
            </div>
          </div>
        </div>
    </div>
    <script src="indextest.js"></script>
</body>
</html>
