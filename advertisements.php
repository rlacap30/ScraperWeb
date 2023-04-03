 <!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE-edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Advertisements</title>
  
  <link rel="preload" href="mystyleh.css" as="style" />
  <link rel="preload" href="indexadss.js" as="script" />  
  <link rel = "stylesheet" type="text/css" href = "mystyleh.css">
  <link href="https://fonts.googleapis.com/icon?family=Material+Icons+Sharp" rel="stylesheet">
</head>
<body>
    <?php
    session_start();
    if (!isset($_SESSION["username"])) {
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
                <a href="advertisements.php" class="active">
                    <span class="material-icons-sharp">grid_view</span>
                    <h3>Dashboard</h3>
                </a>
                <a href="execute.php">
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
            <h2>Advertisements</h2>
            <?php
                if (!isset($_GET["filter"])) {
                    echo "<div class='filter'>";
                    echo '<input type="text" id="myInput" placeholder="Advertisement Name">';
                    echo '<input type="button" name="submit" onclick="filterWesbite()" value="Search">';
                    echo "</div>";
                }
                
                if (isset($_GET["filter"])) {
                    $value = $_GET["filter"];
                    echo "<div class='filter'>";
                    echo "<input type='text' value='$value' id='myInput' placeholder='Advertisement Name'>";
                    echo '<input type="button" name="submit" onclick="filterWesbite()" value="Search">';
                    echo "</div>";
                }
            ?>
            <table id="myTable">
              <thead>
                <tr>
                  <th> Name </th>
                  <th> Ad Site </th>
                  <th> Link </th>
                  <th></th>
                </tr>
              </thead>
              <tbody id="mainBody">
                <?php
                session_start();
                $limit = 10;
                if (isset($_GET["adpage"])) {
                    $page_number = $_GET["adpage"];
                } else {
                    $page_number = 1;
                }

                $initial_page = ($page_number - 1) * $limit;

                $conn = mysqli_connect(
                    "localhost",
                    "lacaprose5bin",
                    "",
                    "my_lacaprose5bin"
                );
                if (!$conn) {
                    die("Connection failed: " . mysqli_connect_error());
                }
                
                if(!isset($_GET["filter"])) {
                    $sql = "SELECT * FROM Advertisements GROUP BY Name LIMIT $initial_page, $limit";
                }
                
                if(isset($_GET["filter"])) {
                    $filter = $_GET["filter"];
                    $sql = "SELECT * FROM Advertisements WHERE Name LIKE '%$filter%' GROUP BY Name LIMIT $initial_page, $limit";
                }

                $rows = mysqli_query($conn, $sql);
                while ($row = mysqli_fetch_assoc($rows)) {
                    echo "<tr>";
                    echo "<td>" . $row["Name"] . "</td>";
                    echo "<td class='primary'><a target='_blank' href='" .
                        $row["Site"] .
                        "'>Advertisement Link</a></td>";
                    echo "<td class='primary'><a target='_blank' href='" .
                        $row["Link"] .
                        "'>Advertisement Video</a></td>";
                    #echo "<td class='primary'><a href='index.php?name=".$row["Name"]."&adpage=".(1)."'>Details</a></td>";
                    echo "<td class='primary'><a id='myBtn' onclick='showModal(" .
                        $row["Id"] .
                        ")'>Details</a></td>";
                    echo "</tr>";
                }
                ?>
              </tbody>
            </table>
            
            <?php
            $adname = $_GET["adname"];
            if (isset($adname)) {
                echo '<div id="myModal" class="modal" style="display:block">';
            } else {
                echo '<div id="myModal" class="modal" style="display:none">';
            }
            ?>
                                                                                                                                                                        
                <div class="modal-content">
                    <span onclick="closeModal()" class="close">&times;</span>
                    <table>
                        <thead>
                            <tr>
                                <th>Website Name</th>
                                <th>Date</th>
                            </tr>
                        </thead>
                        <tbody>
                           <?php
                           session_start();
                           $adid = intval($_GET["adname"]);
                           $conn = mysqli_connect(
                               "localhost",
                               "lacaprose5bin",
                               "",
                               "my_lacaprose5bin"
                           );
                           if (!$conn) {
                               die(
                                   "Connection failed: " .
                                       mysqli_connect_error()
                               );
                           }

                           $adnamesql = "SELECT * From Advertisements WHERE Id = $adid";
                           #echo $adnamesql;
                           $adnamerows = mysqli_query($conn, $adnamesql);

                           while (
                               $adnamerow = mysqli_fetch_assoc($adnamerows)
                           ) {
                               $adname = $adnamerow["Name"];
                               #echo $adname;
                               $sql = "SELECT DISTINCT(Websites.Name) AS Name, Websites.CheckedDate AS Date, Parameters.Url AS Url
                                        FROM Websites
                                        LEFT JOIN Advertisements on Websites.Id = Advertisements.WebsiteId
                                        LEFT JOIN Parameters on Websites.Id = Parameters.WebsiteId
                                        WHERE Advertisements.Name = '$adname'";
                               $rows = mysqli_query($conn, $sql);
                               while ($row = mysqli_fetch_assoc($rows)) {
                                   echo "<tr>";
                                   echo "<td class='primary'><a target='_blank' href='" .
                                       $row["Url"] .
                                       "'>" .
                                       $row["Name"] .
                                       "</a></td>";
                                   echo "<td>" . $row["Date"] . "</td>";
                                   echo "</tr>";
                               }
                           }
                           ?>
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="items">
                <?php
                if(!isset($_GET["filter"])) {
                    $getQuery = "SELECT COUNT(DISTINCT Name) FROM Advertisements";
                }
                
                if(isset($_GET["filter"])) {
                    $filter = $_GET["filter"];
                    $getQuery = "SELECT COUNT(DISTINCT Name) FROM Advertisements WHERE Name LIKE '%$filter%'";
                }

                $result = mysqli_query($conn, $getQuery);
                $row = mysqli_fetch_row($result);
                $total_rows = $row[0];
                echo "</br>";
                $total_pages = ceil($total_rows / $limit);
                $pageURL = "";
                if ($page_number >= 2) {
                    echo "<a href='advertisements.php?adpage=" .
                        ($page_number - 1) .
                        "'>  Prev </a>";
                }
                for ($i = 1; $i <= $total_pages; $i++) {
                    if ($i == $page_number) {
                        $pageURL .=
                            "<a class = 'activePage' href='advertisements.php?adpage=" .
                            $i .
                            "'>" .
                            $i .
                            " </a>";
                    } else {
                        $pageURL .=
                            "<a href='advertisements.php?adpage=" .
                            $i .
                            "'>" .
                            $i .
                            " </a>";
                    }
                }
                echo $pageURL;
                if ($page_number < $total_pages) {
                    echo "<a href='advertisements.php?adpage=" .
                        ($page_number + 1) .
                        "'>  Next </a>";
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
                <p>Hey, <b><?php echo $_SESSION["username"]; ?></b></p>
                <small class="text-muted">User</small>
              </div>
            </div>
          </div>
        </div>
    </div>
    <script src="indexadss.js"></script>
        <script>        
        function showModal(adname) { 
            //document.cookie = "adname = " + adname.ToString();
            //location.reload('advertisements.php');
            var url = window.location.href;
            const urlObj = new URL(url);
            urlObj.searchParams.delete('adname');
            //urlObj.searchParams.delete('filter');
            var finalUrl = urlObj.toString();
            var input = !document.getElementById("myInput") ?
                        document.getElementById("myInput").value : null;
            //console.log(input);
            if(finalUrl.includes("adpage") || finalUrl.includes("filter")){
                window.location.href = finalUrl + "&adname=" + adname;  
            } else {
                window.location.href = finalUrl + "?adname=" + adname;  
            }
            
            document.getElementById("myModal").style.display = "block";
        }
        
        function closeModal(){
            document.getElementById("myModal").style.display = "none";
            document.getElementById("myModal").remove();
            //document.cookie = "adname = ";
        }
        
      function filterWesbite() {
        var input = document.getElementById("myInput");
        var filter = input.value.toLowerCase();
        if (filter !== null || filter !== undefined || filter !== ' '){
            if (filter.length > 0 ) {
                var url = window.location.href;
                const urlObj = new URL(url);
                urlObj.searchParams.delete('adname');
                urlObj.searchParams.delete('filter');
                var finalUrl = urlObj.toString();
                window.location.href = finalUrl + "?filter=" + filter;
            } else {
                window.location.href = "advertisements.php";
            }
        } else {
            window.location.href = "advertisements.php";
        }
      }      
    </script>
</body>
</html>
