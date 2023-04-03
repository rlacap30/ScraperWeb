<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE-edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Sources</title>
  
  <link rel="preload" href="mystyleh.css" as="style" />
  <link rel="preload" href="indextest.js" as="script" />  
  <link rel = "stylesheet" type="text/css" href = "mystyleh.css">
  <link href="https://fonts.googleapis.com/icon?family=Material+Icons+Sharp" rel="stylesheet">
</head>
<body>
    <?php
         session_start();
         if (!isset($_SESSION['username'])) {
    		 header("Location: login.php"); 
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
                <a href="advertisements.php">
                    <span class="material-icons-sharp">grid_view</span>
                    <h3>Dashboard</h3>
                </a>
                <a href="execute.php"  class="active">
                    <span class="material-icons-sharp">receipt_long</span>
                    <h3>Sources</h3>
                </a>
                <a href="assistance.php">
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
            <h2>Websites</h2>
            <?php
              if (!isset($_GET["filter"])) {
                    echo "<div class='filter'>";
                    echo '<input type="text" id="myInput" placeholder="Website Name">';
                    echo '<input type="button" name="submit" onclick="filterWesbite()" value="Search">';
                    echo "</div>";
                }
                
                if (isset($_GET["filter"])) {
                    $value = $_GET["filter"];
                    echo "<div class='filter'>";
                    echo "<input type='text' value='$value' id='myInput' placeholder='Website Name'>";
                    echo '<input type="button" name="submit" onclick="filterWesbite()" value="Search">';
                    echo "</div>";
                }
            ?>
            <table id="myTable">
              <thead>
                <tr>
                  <th> Website Name </th>
                  <th> Action </th>
                </tr>
              </thead>
              <tbody id="mainData">
                <?php
                    session_start();
                    $limit = 10;    
                    if (isset($_GET["page"])) {   
                        $page_number  = $_GET["page"];    
                    } else {
                        $page_number=1;    
                    }
                    
                    $initial_page = ($page_number-1) * $limit;       
                
                    $conn = mysqli_connect("localhost", "lacaprose5bin", "", "my_lacaprose5bin");
                    if (!$conn) {
                        die("Connection failed: " . mysqli_connect_error());
                    }                  
                    
                    if (!isset($_GET["filter"])) {
                        $sql = "SELECT * FROM Websites LIMIT $initial_page, $limit";
                    }
                    
                    if (isset($_GET["filter"])) {
                        $filter = $_GET["filter"];
                        $sql = "SELECT * FROM Websites WHERE Name LIKE '%$filter%' LIMIT $initial_page, $limit";
                    }
                    
                    $rows = mysqli_query($conn, $sql);
                    while($row = mysqli_fetch_assoc($rows)) {
                        $result_script = $row["IsScriptActive"] == 1 ? 'check_box' : 'check_box_outline_blank';
                        echo "<tr>";
                        echo "<td>".$row["Name"]."</td>";
                        echo "<td><a href='shouldActivateScript.php?id=".$row["Id"]."&value=".$row["IsScriptActive"]."' id='execute'><span id='executeValue' class='material-icons-sharp'>$result_script</span></a></td>";
                        echo "</tr>";
                    }
                ?>
              </tbody>           
            </table>
            <div class="items">
                <?php  
                    if (!isset($_GET["filter"])) {
                        $getQuery = "SELECT COUNT(*) FROM Websites Order By Name";
                    }
                    
                    if (isset($_GET["filter"])) {
                        $filter = $_GET["filter"];
                        $getQuery = "SELECT COUNT(*) FROM Websites WHERE Name LIKE '%$filter%' Order By Name";
                    }
                    
                    $result = mysqli_query($conn, $getQuery);    
                    $row = mysqli_fetch_row($result);  
                    $total_rows = $row[0];  
                    echo "</br>";    
                    $total_pages = ceil($total_rows / $limit);     
                    $pageURL = "";     
                    if($page_number>=2){   
                        echo "<a href='index.php?page=".($page_number-1)."'>  Prev </a>";   
                    }
                    for ($i=1; $i<=$total_pages; $i++) {   
                        if ($i == $page_number) {   
                            $pageURL .= "<a class = 'activePage' href='index.php?page=".$i."'>".$i." </a>";   
                        } else {
                            $pageURL .= "<a href='index.php?page=".$i."'>".$i." </a>";   
                        }
                    }
                    echo $pageURL;  
                    if($page_number<$total_pages){   
                        echo "<a href='index.php?page=".($page_number+1)."'>  Next </a>";   
                    }
                ?>
            </div>
            <!--<a href="#">Show More</a>-->
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
    <script>
           function filterWesbite() {
        var input = document.getElementById("myInput");
        var filter = input.value.toLowerCase();
        if (filter !== null || filter !== undefined || filter !== ' '){
            if (filter.length > 0 ) {
                var url = window.location.href;
                const urlObj = new URL(url);
                //urlObj.searchParams.delete('adname');
                urlObj.searchParams.delete('filter');
                var finalUrl = urlObj.toString();
                window.location.href = finalUrl + "?filter=" + filter;
            } else {
                window.location.href = "execute.php";
            }
        } else {
            window.location.href = "execute.php";
        }
      }     
    </script>
</body>
</html>
