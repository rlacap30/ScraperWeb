<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE-edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Websites</title>
  
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
            <div class="sidebar">
                <a href="advertisements.php">
                    <span class="material-icons-sharp">keyboard_return</span>
                    <h3>Advertisements</h3>
                </a>
            </div>
        </aside>
        
        <main>
          <div class="websites">
            <h2>Websites</h2>
            <input type="text" id="myInput" onkeyup="filterWesbite()" placeholder="Website Name">
            <table id="myTable">
              <thead>
                <tr>
                  <th> Website Name </th>
                </tr>
              </thead>
              <tbody id="mainData">
                <?php
                    session_start();
                    $ad_name = $_GET['name'];
                    if($ad_name === null) {
                        header("Location: advertisements.php"); 
                    }
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
                    
                    $sql = "SELECT DISTINCT Websites.Name AS Name FROM Websites
                            JOIN Advertisements on Websites.Id = Advertisements.WebsiteId
                            WHERE Advertisements.Name = '$ad_name' LIMIT $initial_page, $limit";
                    $rows = mysqli_query($conn, $sql);
                    while($row = mysqli_fetch_assoc($rows)) {
                        echo "<tr>";
                        echo "<td>".$row["Name"]."</td>";
                        echo "</tr>";
                    }
                ?>
              </tbody>
                    <tbody id="allData" style="display:none">
                <?php
                    session_start();
                    $ad_name = $_GET['name'];
                    if($ad_name === null) {
                        header("Location: advertisements.php"); 
                    }                    
                
                    $conn = mysqli_connect("localhost", "lacaprose5bin", "", "my_lacaprose5bin");
                    if (!$conn) {
                        die("Connection failed: " . mysqli_connect_error());
                    }                  
                    
                    $sql = "SELECT DISTINCT Websites.Name AS Name FROM Websites
                            JOIN Advertisements on Websites.Id = Advertisements.WebsiteId
                            WHERE Advertisements.Name = '$ad_name'";
                    $rows = mysqli_query($conn, $sql);
                    while($row = mysqli_fetch_assoc($rows)) {
                        echo "<tr>";
                        echo "<td>".$row["Name"]."</td>";
                        echo "</tr>";
                    }
                ?>
              </tbody>
            </table>
            <div class="items">
                <?php  
                    $getQuery = "SELECT COUNT(DISTINCT Websites.Name) FROM Websites
                            JOIN Advertisements on Websites.Id = Advertisements.WebsiteId
                            WHERE Advertisements.Name = '$ad_name'";
                    $result = mysqli_query($conn, $getQuery);    
                    $row = mysqli_fetch_row($result);  
                    $total_rows = $row[0];  
                    echo "</br>";    
                    $total_pages = ceil($total_rows / $limit);     
                    $pageURL = "";     
                    if($page_number>=2){   
                        echo "<a href='index.php?name=".$ad_name."&page=".($page_number-1)."'>  Prev </a>";   
                    }
                    for ($i=1; $i<=$total_pages; $i++) {   
                        if ($i == $page_number) {   
                            $pageURL .= "<a class = 'activePage' href='index.php?name=".$ad_name."&page=".$i."'>".$i." </a>";   
                        } else {
                            $pageURL .= "<a href='index.php?name=".$ad_name."&page=".$i."'>".$i." </a>";   
                        }
                    }
                    echo $pageURL;  
                    if($page_number<$total_pages){   
                        echo "<a href='index.php?name=".$ad_name."&page=".($page_number+1)."'>  Next </a>";   
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
        var input, filter, table, tr, td, i, txtValue;
        input = document.getElementById("myInput");
        filter = input.value.toUpperCase();
        table = document.getElementById("myTable");
        tr = table.getElementsByTagName("tr");
        document.getElementById("mainData").style.display = "none";
        document.getElementById("allData").style.display = "block";
        
        for (i = 0; i < tr.length; i++) {
            td = tr[i].getElementsByTagName("td")[0];
            if (td) {
                txtValue = td.textContent || td.innerText;
                if (txtValue.toUpperCase().indexOf(filter) > -1) {
                    tr[i].style.display = "";
                } else {
                    tr[i].style.display = "none";
                }
            }
        }
      }
    </script>
</body>
</html>
