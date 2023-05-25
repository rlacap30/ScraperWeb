 <!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE-edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Advertisements</title>
  
  <link rel="preload" href="adsg.css" as="style" />
  <link rel="preload" href="indexadss.js" as="script" />  
  <link rel = "stylesheet" type="text/css" href = "adsg.css">
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
                <div class="dropdown">
                    <a href="advertisements.php" class="dropdown-anchor active">
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
                <div class="dropdown">
                    <a href="execute.php" class="dropdown-anchor">
                        <span class="material-icons-sharp">receipt_long</span>
                        <h3 style="display:inline-flex">
                          Sources 
                          <span class="material-icons-sharp">keyboard_arrow_down</span>
                        </h3>
                    </a>
                    <div class="dropdown-content">
                        <a href="germanySources.php"> Germany </a>
                        <a href="switzerlandSources.php"> Switzerland </a>
                        <a href="swedenSources.php"> Sweden </a>
                        <a href="polandSources.php"> Poland </a>
                        <a href="ukSources.php"> UK </a>
                        <a href="#" style="display:none">  </a>
                    </div>
                </div>
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
            <h2>Poland Advertisements</h2>
            <?php
            if (
                !isset($_GET["filter"]) &&
                !isset($_GET["dateFromFilter"]) &&
                !isset($_GET["dateToFilter"])
            ) {
                echo "<div class='filter'>";
                echo '<input type="text" id="myInput" placeholder="Advertisement Name">';
                echo '<label for="myDateInput">From</label>';
                echo '<input type="date" id="myDateInput">';
                echo '<label for="myDateInputTo">To</label>';
                echo '<input type="date" id="myDateInputTo">';
                echo '<input type="button" name="submit" onclick="filterWesbite()" value="Search">';
                echo "</div>";
            }

            if (
                isset($_GET["filter"]) &&
                !isset($_GET["dateFromFilter"]) &&
                !isset($_GET["dateToFilter"])
            ) {
                $value = $_GET["filter"];
                echo "<div class='filter'>";
                echo "<input type='text' value='$value' id='myInput' placeholder='Advertisement Name'>";
                echo '<label for="myDateInput">From</label>';
                echo '<input type="date" id="myDateInput">';
                echo '<label for="myDateInputTo">To</label>';
                echo '<input type="date" id="myDateInputTo">';
                echo '<input type="button" name="submit" onclick="filterWesbite()" value="Search">';
                echo "</div>";
            }

            if (
                !isset($_GET["filter"]) &&
                isset($_GET["dateFromFilter"]) &&
                isset($_GET["dateToFilter"])
            ) {
                $dateTo = $_GET["dateToFilter"];
                $dateFrom = $_GET["dateFromFilter"];
                echo "<div class='filter'>";
                echo '<input type="text" id="myInput" placeholder="Advertisement Name">';
                echo '<label for="myDateInput">From</label>';
                echo "<input type='date' id='myDateInput' value='$dateFrom'>";
                echo '<label for="myDateInputTo">To</label>';
                echo "<input type='date' id='myDateInputTo' value='$dateTo'>";
                echo '<input type="button" name="submit" onclick="filterWesbite()" value="Search">';
                echo "</div>";
            }

            if (
                !isset($_GET["filter"]) &&
                !isset($_GET["dateFromFilter"]) &&
                isset($_GET["dateToFilter"])
            ) {
                $dateTo = $_GET["dateToFilter"];
                echo "<div class='filter'>";
                echo '<input type="text" id="myInput" placeholder="Advertisement Name">';
                echo '<label for="myDateInput">From</label>';
                echo '<input type="date" id="myDateInput">';
                echo '<label for="myDateInputTo">To</label>';
                echo "<input type='date' id='myDateInputTo' value='$dateTo'>";
                echo '<input type="button" name="submit" onclick="filterWesbite()" value="Search">';
                echo "</div>";
            }

            if (
                !isset($_GET["filter"]) &&
                isset($_GET["dateFromFilter"]) &&
                !isset($_GET["dateToFilter"])
            ) {
                $dateFrom = $_GET["dateFromFilter"];
                echo "<div class='filter'>";
                echo '<input type="text" id="myInput" placeholder="Advertisement Name">';
                echo '<label for="myDateInput">From</label>';
                echo "<input type='date' id='myDateInput' value='$dateFrom'>";
                echo '<label for="myDateInputTo">To</label>';
                echo '<input type="date" id="myDateInputTo">';
                echo '<input type="button" name="submit" onclick="filterWesbite()" value="Search">';
                echo "</div>";
            }

            if (
                isset($_GET["filter"]) &&
                !isset($_GET["dateFromFilter"]) &&
                isset($_GET["dateToFilter"])
            ) {
                $value = $_GET["filter"];
                $dateTo = $_GET["dateToFilter"];
                echo "<div class='filter'>";
                echo "<input type='text' id='myInput' placeholder='Advertisement Name' value='$value'>";
                echo '<label for="myDateInput">From</label>';
                echo '<input type="date" id="myDateInput">';
                echo '<label for="myDateInputTo">To</label>';
                echo "<input type='date' id='myDateInputTo' value='$dateTo'>";
                echo '<input type="button" name="submit" onclick="filterWesbite()" value="Search">';
                echo "</div>";
            }

            if (
                isset($_GET["filter"]) &&
                isset($_GET["dateFromFilter"]) &&
                !isset($_GET["dateToFilter"])
            ) {
                $value = $_GET["filter"];
                $dateFrom = $_GET["dateFromFilter"];
                echo "<div class='filter'>";
                echo "<input type='text' id='myInput' placeholder='Advertisement Name' value='$value'>";
                echo '<label for="myDateInput">From</label>';
                echo "<input type='date' id='myDateInput' value='$dateFrom'>";
                echo '<label for="myDateInputTo">To</label>';
                echo '<input type="date" id="myDateInputTo">';
                echo '<input type="button" name="submit" onclick="filterWesbite()" value="Search">';
                echo "</div>";
            }

            if (
                isset($_GET["filter"]) &&
                isset($_GET["dateFromFilter"]) &&
                isset($_GET["dateToFilter"])
            ) {
                $value = $_GET["filter"];
                $dateFrom = $_GET["dateFromFilter"];
                $dateTo = $_GET["dateToFilter"];
                echo "<div class='filter'>";
                echo "<input type='text' id='myInput' placeholder='Advertisement Name' value='$value'>";
                echo '<label for="myDateInput">From</label>';
                echo "<input type='date' id='myDateInput' value='$dateFrom'>";
                echo '<label for="myDateInputTo">To</label>';
                echo "<input type='date' id='myDateInputTo' value='$dateTo'>";
                echo '<input type="button" name="submit" onclick="filterWesbite()" value="Search">';
                echo "</div>";
            }
            ?>
            <table id="myTable">
              <thead>
                <tr>
                  <th> Name </th>
                  <th> Date </th>
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

                if (
                    !isset($_GET["filter"]) &&
                    !isset($_GET["dateFromFilter"]) &&
                    !isset($_GET["dateToFilter"])
                ) {
                    $sql = "SELECT * FROM Advertisements WHERE
                    WebsiteId IN 
                            (SELECT WebsiteId FROM Parameters
                                    WHERE buffer_two='poland') and
                    Id IN (SELECT MAX(Id) FROM Advertisements GROUP BY Name) 
                    ORDER BY CreatedDate DESC LIMIT $initial_page, $limit";
                }

                if (
                    isset($_GET["filter"]) &&
                    !isset($_GET["dateFromFilter"]) &&
                    !isset($_GET["dateToFilter"])
                ) {
                    $filter = $_GET["filter"];
                    $sql = "SELECT * FROM Advertisements WHERE 
                    WebsiteId IN 
                            (SELECT WebsiteId FROM Parameters
                                    WHERE buffer_two='poland') and
                    Name LIKE '%$filter%' AND Id IN (SELECT MAX(Id) FROM Advertisements GROUP BY Name) 
                    ORDER BY CreatedDate DESC LIMIT $initial_page, $limit";
                }

                if (
                    !isset($_GET["filter"]) &&
                    isset($_GET["dateFromFilter"]) &&
                    isset($_GET["dateToFilter"])
                ) {
                    $dateFromFilter = $_GET["dateFromFilter"];
                    $dateToFilter = $_GET["dateToFilter"];
                    $sql = "SELECT * FROM Advertisements WHERE 
                    WebsiteId IN 
                            (SELECT WebsiteId FROM Parameters
                                    WHERE buffer_two='poland') and
                    CreatedDate BETWEEN '$dateFromFilter' AND '$dateToFilter' AND Id IN (SELECT MAX(Id) FROM Advertisements GROUP BY Name) 
                    ORDER BY CreatedDate DESC LIMIT $initial_page, $limit";
                }

                if (
                    !isset($_GET["filter"]) &&
                    !isset($_GET["dateFromFilter"]) &&
                    isset($_GET["dateToFilter"])
                ) {
                    $dateToFilter = $_GET["dateToFilter"];
                    $sql = "SELECT * FROM Advertisements WHERE 
                    WebsiteId IN 
                            (SELECT WebsiteId FROM Parameters
                                    WHERE buffer_two='poland') and
                    CreatedDate <= '$dateToFilter' AND Id IN (SELECT MAX(Id) FROM Advertisements GROUP BY Name) 
                    ORDER BY CreatedDate DESC LIMIT $initial_page, $limit";
                }

                if (
                    !isset($_GET["filter"]) &&
                    isset($_GET["dateFromFilter"]) &&
                    !isset($_GET["dateToFilter"])
                ) {
                    $dateFromFilter = $_GET["dateFromFilter"];
                    $sql = "SELECT * FROM Advertisements WHERE 
                    WebsiteId IN 
                            (SELECT WebsiteId FROM Parameters
                                    WHERE buffer_two='poland') and
                    CreatedDate >= '$dateFromFilter' AND Id IN (SELECT MAX(Id) FROM Advertisements GROUP BY Name) 
                    ORDER BY CreatedDate DESC LIMIT $initial_page, $limit";
                }

                if (
                    isset($_GET["filter"]) &&
                    !isset($_GET["dateFromFilter"]) &&
                    isset($_GET["dateToFilter"])
                ) {
                    $dateToFilter = $_GET["dateToFilter"];
                    $filter = $_GET["filter"];
                    $sql = "SELECT * FROM Advertisements WHERE 
                    WebsiteId IN 
                            (SELECT WebsiteId FROM Parameters
                                    WHERE buffer_two='poland') and
                    CreatedDate <= '$dateToFilter' AND Name LIKE '%$filter%' AND Id IN (SELECT MAX(Id) FROM Advertisements GROUP BY Name) 
                    ORDER BY CreatedDate DESC LIMIT $initial_page, $limit";
                }

                if (
                    isset($_GET["filter"]) &&
                    isset($_GET["dateFromFilter"]) &&
                    !isset($_GET["dateToFilter"])
                ) {
                    $dateFromFilter = $_GET["dateFromFilter"];
                    $filter = $_GET["filter"];
                    $sql = "SELECT * FROM Advertisements WHERE 
                    WebsiteId IN 
                            (SELECT WebsiteId FROM Parameters
                                    WHERE buffer_two='poland') and
                    CreatedDate >= '$dateFromFilter' AND Name LIKE '%$filter%' AND Id IN (SELECT MAX(Id) FROM Advertisements GROUP BY Name) 
                    ORDER BY CreatedDate DESC LIMIT $initial_page, $limit";
                }

                if (
                    isset($_GET["filter"]) &&
                    isset($_GET["dateFromFilter"]) &&
                    isset($_GET["dateToFilter"])
                ) {
                    $dateFromFilter = $_GET["dateFromFilter"];
                    $dateToFilter = $_GET["dateToFilter"];
                    $filter = $_GET["filter"];
                    $sql = "SELECT * FROM Advertisements WHERE 
                    WebsiteId IN 
                            (SELECT WebsiteId FROM Parameters
                                    WHERE buffer_two='poland') and
                    CreatedDate BETWEEN '$dateFromFilter' AND '$dateToFilter'
                    AND Name LIKE '%$filter%'
                    AND Id IN (SELECT MAX(Id) FROM Advertisements GROUP BY Name) 
                    ORDER BY CreatedDate DESC LIMIT $initial_page, $limit";
                }

                $rows = mysqli_query($conn, $sql);
                while ($row = mysqli_fetch_assoc($rows)) {
                    echo "<tr>";
                    echo "<td>" . $row["Name"] . "</td>";
                    echo "<td>" . $row["CreatedDate"] . "</td>";
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

                           $adnamesql = "SELECT * From Advertisements WHERE Id = $adid 
                           AND WebsiteId IN (SELECT WebsiteId FROM Parameters
                                    WHERE buffer_two='poland')";
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
                                        WHERE Advertisements.Name = '$adname' AND Parameters.buffer_two='poland'";
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
                if (
                    !isset($_GET["filter"]) &&
                    !isset($_GET["dateFromFilter"]) &&
                    !isset($_GET["dateToFilter"])
                ) {
                    $getQuery = "SELECT COUNT(DISTINCT Name) FROM Advertisements WHERE WebsiteId IN 
                                 (SELECT WebsiteId FROM Parameters
                                  WHERE buffer_two='poland')";
                }

                if (
                    isset($_GET["filter"]) &&
                    !isset($_GET["dateFromFilter"]) &&
                    !isset($_GET["dateToFilter"])
                ) {
                    $filter = $_GET["filter"];
                    $getQuery = "SELECT COUNT(DISTINCT Name) FROM Advertisements WHERE Name LIKE '%$filter%'
                    AND WebsiteId IN 
                                 (SELECT WebsiteId FROM Parameters
                                  WHERE buffer_two='poland')";
                }

                if (
                    !isset($_GET["filter"]) &&
                    isset($_GET["dateFromFilter"]) &&
                    isset($_GET["dateToFilter"])
                ) {
                    $dateFromFilter = $_GET["dateFromFilter"];
                    $dateToFilter = $_GET["dateToFilter"];
                    $getQuery = "SELECT COUNT(DISTINCT Name) FROM Advertisements WHERE CreatedDate BETWEEN '$dateFromFilter' AND '$dateToFilter'
                    AND WebsiteId IN 
                                 (SELECT WebsiteId FROM Parameters
                                  WHERE buffer_two='poland')";
                }

                if (
                    !isset($_GET["filter"]) &&
                    !isset($_GET["dateFromFilter"]) &&
                    isset($_GET["dateToFilter"])
                ) {
                    $dateToFilter = $_GET["dateToFilter"];
                    $getQuery = "SELECT COUNT(DISTINCT Name) FROM Advertisements WHERE CreatedDate <= '$dateToFilter'
                    AND WebsiteId IN 
                                 (SELECT WebsiteId FROM Parameters
                                  WHERE buffer_two='poland')";
                }

                if (
                    !isset($_GET["filter"]) &&
                    isset($_GET["dateFromFilter"]) &&
                    !isset($_GET["dateToFilter"])
                ) {
                    $dateFromFilter = $_GET["dateFromFilter"];
                    $getQuery = "SELECT COUNT(DISTINCT Name) FROM Advertisements WHERE CreatedDate >= '$dateFromFilter'
                    AND WebsiteId IN 
                                 (SELECT WebsiteId FROM Parameters
                                  WHERE buffer_two='poland')";
                }

                if (
                    isset($_GET["filter"]) &&
                    !isset($_GET["dateFromFilter"]) &&
                    isset($_GET["dateToFilter"])
                ) {
                    $dateToFilter = $_GET["dateToFilter"];
                    $filter = $_GET["filter"];
                    $getQuery = "SELECT COUNT(DISTINCT Name) FROM Advertisements WHERE CreatedDate <= '$dateToFilter' AND Name LIKE '%$filter%'
                    AND WebsiteId IN 
                                 (SELECT WebsiteId FROM Parameters
                                  WHERE buffer_two='poland')";
                }

                if (
                    isset($_GET["filter"]) &&
                    isset($_GET["dateFromFilter"]) &&
                    !isset($_GET["dateToFilter"])
                ) {
                    $dateFromFilter = $_GET["dateFromFilter"];
                    $filter = $_GET["filter"];
                    $getQuery = "SELECT COUNT(DISTINCT Name) FROM Advertisements WHERE CreatedDate >= '$dateFromFilter' AND Name LIKE '%$filter%'
                    AND WebsiteId IN 
                                 (SELECT WebsiteId FROM Parameters
                                  WHERE buffer_two='poland')";
                }

                if (
                    isset($_GET["filter"]) &&
                    isset($_GET["dateFromFilter"]) &&
                    isset($_GET["dateToFilter"])
                ) {
                    $dateFromFilter = $_GET["dateFromFilter"];
                    $filter = $_GET["filter"];
                    $dateToFilter = $_GET["dateToFilter"];
                    $getQuery = "SELECT COUNT(DISTINCT Name) FROM Advertisements WHERE CreatedDate BETWEEN '$dateFromFilter' AND '$dateToFilter'
                    AND Name LIKE '%$filter%'
                    AND WebsiteId IN 
                                 (SELECT WebsiteId FROM Parameters
                                  WHERE buffer_two='poland')";
                }

                $result = mysqli_query($conn, $getQuery);
                $row = mysqli_fetch_row($result);
                $total_rows = $row[0];
                echo "</br>";
                $total_pages = ceil($total_rows / $limit);
                $pageURL = "";
                if ($page_number >= 2) {
                    if (
                        !isset($_GET["filter"]) &&
                        !isset($_GET["dateFromFilter"]) &&
                        !isset($_GET["dateToFilter"])
                    ) {
                        echo "<a href='poland.php?adpage=" .
                            ($page_number - 1) .
                            "'>  Prev </a>";
                    }

                    if (
                        isset($_GET["filter"]) &&
                        !isset($_GET["dateFromFilter"]) &&
                        !isset($_GET["dateToFilter"])
                    ) {
                        $filter = $_GET["filter"];
                        echo "<a href='poland.php?filter=" .
                            $filter .
                            "&adpage=" .
                            ($page_number - 1) .
                            "'>  Prev </a>";
                    }

                    if (
                        !isset($_GET["filter"]) &&
                        isset($_GET["dateFromFilter"]) &&
                        isset($_GET["dateToFilter"])
                    ) {
                        $dateFromFilter = $_GET["dateFromFilter"];
                        $dateToFilter = $_GET["dateToFilter"];
                        echo "<a href='poland.php?dateFromFilter=" .
                            $dateFromFilter .
                            "&dateToFilter=" .
                            $dateToFilter .
                            "&adpage=" .
                            ($page_number - 1) .
                            "'>  Prev </a>";
                    }

                    if (
                        !isset($_GET["filter"]) &&
                        !isset($_GET["dateFromFilter"]) &&
                        isset($_GET["dateToFilter"])
                    ) {
                        $dateToFilter = $_GET["dateToFilter"];
                        echo "<a href='poland.php?dateToFilter=" .
                            $dateToFilter .
                            "&adpage=" .
                            ($page_number - 1) .
                            "'>  Prev </a>";
                    }

                    if (
                        !isset($_GET["filter"]) &&
                        isset($_GET["dateFromFilter"]) &&
                        !isset($_GET["dateToFilter"])
                    ) {
                        $dateFromFilter = $_GET["dateFromFilter"];
                        echo "<a href='poland.php?dateFromFilter=" .
                            $dateFromFilter .
                            "&adpage=" .
                            ($page_number - 1) .
                            "'>  Prev </a>";
                    }

                    if (
                        isset($_GET["filter"]) &&
                        isset($_GET["dateFromFilter"]) &&
                        !isset($_GET["dateToFilter"])
                    ) {
                        $dateFromFilter = $_GET["dateFromFilter"];
                        $filter = $_GET["filter"];
                        echo "<a href='poland.php?filter=" .
                            $filter .
                            "&dateFromFilter=" .
                            $dateFromFilter .
                            "&adpage=" .
                            ($page_number - 1) .
                            "'>  Prev </a>";
                    }

                    if (
                        isset($_GET["filter"]) &&
                        !isset($_GET["dateFromFilter"]) &&
                        isset($_GET["dateToFilter"])
                    ) {
                        $dateToFilter = $_GET["dateToFilter"];
                        $filter = $_GET["filter"];
                        echo "<a href='poland.php?filter=" .
                            $filter .
                            "&dateToFilter=" .
                            $dateToFilter .
                            "&adpage=" .
                            ($page_number - 1) .
                            "'>  Prev </a>";
                    }

                    if (
                        isset($_GET["filter"]) &&
                        isset($_GET["dateFromFilter"]) &&
                        isset($_GET["dateToFilter"])
                    ) {
                        $dateFromFilter = $_GET["dateFromFilter"];
                        $dateToFilter = $_GET["dateToFilter"];
                        $filter = $_GET["filter"];
                        echo "<a href='poland.php?filter=" .
                            $filter .
                            "&dateToFilter=" .
                            $dateToFilter .
                            "&dateFromFilter=" .
                            $dateFromFilter .
                            "&adpage=" .
                            ($page_number - 1) .
                            "'>  Prev </a>";
                    }
                }

                if ($total_pages > 10) {
                    // Show arrows only when total pages is more than 10
                    if ($page_number > 1) {
                        echo "<a href='poland.php?adpage=1'> << </a>";
                        echo "<a href='poland.php?adpage=" .
                            ($page_number - 1) .
                            "'> < </a>";
                    }

                    for (
                        $i = max(1, $page_number - 5);
                        $i <= min($page_number + 5, $total_pages);
                        $i++
                    ) {
                        if ($i == $page_number) {
                            echo "<a class='activePage'>$i</a>";
                        } else {
                            echo "<a href='poland.php?adpage=$i'>$i</a>";
                        }
                    }

                    if ($page_number < $total_pages) {
                        echo "<a href='poland.php?adpage=" .
                            ($page_number + 1) .
                            "'> > </a>";
                        echo "<a href='poland.php?adpage=$total_pages'> >> </a>";
                    }
                } else {
                    for ($i = 1; $i <= $total_pages; $i++) {
                        if ($i == $page_number) {
                            if (
                                !isset($_GET["filter"]) &&
                                !isset($_GET["dateFromFilter"]) &&
                                !isset($_GET["dateToFilter"])
                            ) {
                                $pageURL .=
                                    "<a class = 'activePage' href='poland.php?adpage=" .
                                    $i .
                                    "'>" .
                                    $i .
                                    " </a>";
                            }

                            if (
                                isset($_GET["filter"]) &&
                                !isset($_GET["dateFromFilter"]) &&
                                !isset($_GET["dateToFilter"])
                            ) {
                                $filter = $_GET["filter"];
                                $pageURL .=
                                    "<a class = 'activePage' href='poland.php?filter=" .
                                    $filter .
                                    "&adpage=" .
                                    $i .
                                    "'>" .
                                    $i .
                                    " </a>";
                            }

                            if (
                                !isset($_GET["filter"]) &&
                                isset($_GET["dateFromFilter"]) &&
                                isset($_GET["dateToFilter"])
                            ) {
                                $dateFromFilter = $_GET["dateFromFilter"];
                                $dateToFilter = $_GET["dateToFilter"];
                                $pageURL .=
                                    "<a class = 'activePage' href='poland.php?dateFromFilter=" .
                                    $dateFromFilter .
                                    "&dateToFilter=" .
                                    $dateToFilter .
                                    "&adpage=" .
                                    $i .
                                    "'>" .
                                    $i .
                                    " </a>";
                            }

                            if (
                                !isset($_GET["filter"]) &&
                                !isset($_GET["dateFromFilter"]) &&
                                isset($_GET["dateToFilter"])
                            ) {
                                $dateToFilter = $_GET["dateToFilter"];
                                $pageURL .=
                                    "<a class = 'activePage' href='poland.php?dateToFilter=" .
                                    $dateToFilter .
                                    "&adpage=" .
                                    $i .
                                    "'>" .
                                    $i .
                                    " </a>";
                            }

                            if (
                                !isset($_GET["filter"]) &&
                                isset($_GET["dateFromFilter"]) &&
                                !isset($_GET["dateToFilter"])
                            ) {
                                $dateFromFilter = $_GET["dateFromFilter"];
                                $pageURL .=
                                    "<a class = 'activePage' href='poland.php?dateFromFilter=" .
                                    $dateFromFilter .
                                    "&adpage=" .
                                    $i .
                                    "'>" .
                                    $i .
                                    " </a>";
                            }

                            if (
                                isset($_GET["filter"]) &&
                                !isset($_GET["dateFromFilter"]) &&
                                isset($_GET["dateToFilter"])
                            ) {
                                $dateToFilter = $_GET["dateToFilter"];
                                $filter = $_GET["filter"];
                                $pageURL .=
                                    "<a class = 'activePage' href='poland.php?filter=" .
                                    $filter .
                                    "&dateToFilter=" .
                                    $dateToFilter .
                                    "&adpage=" .
                                    $i .
                                    "'>" .
                                    $i .
                                    " </a>";
                            }

                            if (
                                isset($_GET["filter"]) &&
                                isset($_GET["dateFromFilter"]) &&
                                !isset($_GET["dateToFilter"])
                            ) {
                                $dateFromFilter = $_GET["dateFromFilter"];
                                $filter = $_GET["filter"];
                                $pageURL .=
                                    "<a class = 'activePage' href='poland.php?filter=" .
                                    $filter .
                                    "&dateFromFilter=" .
                                    $dateFromFilter .
                                    "&adpage=" .
                                    $i .
                                    "'>" .
                                    $i .
                                    " </a>";
                            }

                            if (
                                isset($_GET["filter"]) &&
                                isset($_GET["dateFromFilter"]) &&
                                isset($_GET["dateToFilter"])
                            ) {
                                $dateFromFilter = $_GET["dateFromFilter"];
                                $dateToFilter = $_GET["dateToFilter"];
                                $filter = $_GET["filter"];
                                $pageURL .=
                                    "<a class = 'activePage' href='poland.php?filter=" .
                                    $filter .
                                    "&dateFromFilter=" .
                                    $dateFromFilter .
                                    "&dateToFilter=" .
                                    $dateToFilter .
                                    "&adpage=" .
                                    $i .
                                    "'>" .
                                    $i .
                                    " </a>";
                            }
                        } else {
                            if (
                                !isset($_GET["filter"]) &&
                                !isset($_GET["dateFromFilter"]) &&
                                !isset($_GET["dateToFilter"])
                            ) {
                                $pageURL .=
                                    "<a href='poland.php?adpage=" .
                                    $i .
                                    "'>" .
                                    $i .
                                    " </a>";
                            }

                            if (
                                isset($_GET["filter"]) &&
                                !isset($_GET["dateFromFilter"]) &&
                                !isset($_GET["dateToFilter"])
                            ) {
                                $filter = $_GET["filter"];
                                $pageURL .=
                                    "<a href='poland.php?filter=" .
                                    $filter .
                                    "&adpage=" .
                                    $i .
                                    "'>" .
                                    $i .
                                    " </a>";
                            }

                            if (
                                !isset($_GET["filter"]) &&
                                isset($_GET["dateFromFilter"]) &&
                                isset($_GET["dateToFilter"])
                            ) {
                                $dateFromFilter = $_GET["dateFromFilter"];
                                $dateToFilter = $_GET["dateToFilter"];
                                $pageURL .=
                                    "<a href='poland.php?dateFromFilter=" .
                                    $dateFromFilter .
                                    "&dateToFilter=" .
                                    $dateToFilter .
                                    "&adpage=" .
                                    $i .
                                    "'>" .
                                    $i .
                                    " </a>";
                            }

                            if (
                                !isset($_GET["filter"]) &&
                                !isset($_GET["dateFromFilter"]) &&
                                isset($_GET["dateToFilter"])
                            ) {
                                $dateToFilter = $_GET["dateToFilter"];
                                $pageURL .=
                                    "<a href='poland.php?dateToFilter=" .
                                    $dateToFilter .
                                    "&adpage=" .
                                    $i .
                                    "'>" .
                                    $i .
                                    " </a>";
                            }

                            if (
                                !isset($_GET["filter"]) &&
                                isset($_GET["dateFromFilter"]) &&
                                !isset($_GET["dateToFilter"])
                            ) {
                                $dateFromFilter = $_GET["dateFromFilter"];
                                $pageURL .=
                                    "<a href='poland.php?dateFromFilter=" .
                                    $dateFromFilter .
                                    "&adpage=" .
                                    $i .
                                    "'>" .
                                    $i .
                                    " </a>";
                            }

                            if (
                                isset($_GET["filter"]) &&
                                !isset($_GET["dateFromFilter"]) &&
                                isset($_GET["dateToFilter"])
                            ) {
                                $dateToFilter = $_GET["dateToFilter"];
                                $filter = $_GET["filter"];
                                $pageURL .=
                                    "<a href='poland.php?filter=" .
                                    $filter .
                                    "&dateToFilter=" .
                                    $dateToFilter .
                                    "&adpage=" .
                                    $i .
                                    "'>" .
                                    $i .
                                    " </a>";
                            }

                            if (
                                isset($_GET["filter"]) &&
                                isset($_GET["dateFromFilter"]) &&
                                !isset($_GET["dateToFilter"])
                            ) {
                                $dateFromFilter = $_GET["dateFromFilter"];
                                $filter = $_GET["filter"];
                                $pageURL .=
                                    "<a href='poland.php?filter=" .
                                    $filter .
                                    "&dateFromFilter=" .
                                    $dateFromFilter .
                                    "&adpage=" .
                                    $i .
                                    "'>" .
                                    $i .
                                    " </a>";
                            }

                            if (
                                isset($_GET["filter"]) &&
                                isset($_GET["dateFromFilter"]) &&
                                isset($_GET["dateToFilter"])
                            ) {
                                $dateFromFilter = $_GET["dateFromFilter"];
                                $dateToFilter = $_GET["dateToFilter"];
                                $filter = $_GET["filter"];
                                $pageURL .=
                                    "<a href='poland.php?filter=" .
                                    $filter .
                                    "&dateFromFilter=" .
                                    $dateFromFilter .
                                    "&dateToFilter=" .
                                    $dateToFilter .
                                    "&adpage=" .
                                    $i .
                                    "'>" .
                                    $i .
                                    " </a>";
                            }
                        }
                    }
                }

                echo $pageURL;
                if ($page_number < $total_pages) {
                    if (
                        !isset($_GET["filter"]) &&
                        !isset($_GET["dateFromFilter"]) &&
                        !isset($_GET["dateToFilter"])
                    ) {
                        echo "<a href='poland.php?adpage=" .
                            ($page_number + 1) .
                            "'>  Next </a>";
                    }

                    if (
                        isset($_GET["filter"]) &&
                        !isset($_GET["dateFromFilter"]) &&
                        !isset($_GET["dateToFilter"])
                    ) {
                        $filter = $_GET["filter"];
                        echo "<a href='poland.php?filter=" .
                            $filter .
                            "&adpage=" .
                            ($page_number + 1) .
                            "'>  Next </a>";
                    }

                    if (
                        !isset($_GET["filter"]) &&
                        isset($_GET["dateFromFilter"]) &&
                        isset($_GET["dateToFilter"])
                    ) {
                        $dateFromFilter = $_GET["dateFromFilter"];
                        $dateToFilter = $_GET["dateToFilter"];
                        echo "<a href='poland.php?dateFromFilter=" .
                            $dateFromFilter .
                            "&dateToFilter=" .
                            $dateToFilter .
                            "&adpage=" .
                            ($page_number + 1) .
                            "'>  Next </a>";
                    }

                    if (
                        !isset($_GET["filter"]) &&
                        !isset($_GET["dateFromFilter"]) &&
                        isset($_GET["dateToFilter"])
                    ) {
                        $dateToFilter = $_GET["dateToFilter"];
                        echo "<a href='poland.php?dateToFilter=" .
                            $dateToFilter .
                            "&adpage=" .
                            ($page_number + 1) .
                            "'>  Next </a>";
                    }

                    if (
                        !isset($_GET["filter"]) &&
                        isset($_GET["dateFromFilter"]) &&
                        !isset($_GET["dateToFilter"])
                    ) {
                        $dateFromFilter = $_GET["dateFromFilter"];
                        echo "<a href='poland.php?dateFromFilter=" .
                            $dateFromFilter .
                            "&adpage=" .
                            ($page_number + 1) .
                            "'>  Next </a>";
                    }

                    if (
                        isset($_GET["filter"]) &&
                        isset($_GET["dateFromFilter"]) &&
                        !isset($_GET["dateToFilter"])
                    ) {
                        $dateFromFilter = $_GET["dateFromFilter"];
                        $filter = $_GET["filter"];
                        echo "<a href='poland.php?filter=" .
                            $filter .
                            "&dateFromFilter=" .
                            $dateFromFilter .
                            "&adpage=" .
                            ($page_number + 1) .
                            "'>  Next </a>";
                    }

                    if (
                        isset($_GET["filter"]) &&
                        !isset($_GET["dateFromFilter"]) &&
                        isset($_GET["dateToFilter"])
                    ) {
                        $dateToFilter = $_GET["dateToFilter"];
                        $filter = $_GET["filter"];
                        echo "<a href='poland.php?filter=" .
                            $filter .
                            "&dateToFilter=" .
                            $dateToFilter .
                            "&adpage=" .
                            ($page_number + 1) .
                            "'>  Next </a>";
                    }

                    if (
                        isset($_GET["filter"]) &&
                        isset($_GET["dateFromFilter"]) &&
                        isset($_GET["dateToFilter"])
                    ) {
                        $dateFromFilter = $_GET["dateFromFilter"];
                        $dateToFilter = $_GET["dateToFilter"];
                        $filter = $_GET["filter"];
                        echo "<a href='poland.php?filter=" .
                            $filter .
                            "&dateToFilter=" .
                            $dateToFilter .
                            "&dateFromFilter=" .
                            $dateFromFilter .
                            "&adpage=" .
                            ($page_number + 1) .
                            "'>  Next </a>";
                    }
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
            if(finalUrl.includes("adpage") || finalUrl.includes("filter") || finalUrl.includes("dateFromFilter") || finalUrl.includes("dateToFilter")){
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
        var dateFromInput = document.getElementById("myDateInput").value;
        var dateToInput = document.getElementById("myDateInputTo").value;

        var filter = input.value.toLowerCase();
        var url = window.location.href;
        const urlObj = new URL(url);
        urlObj.searchParams.delete('adpage');
        urlObj.searchParams.delete('adname');
        urlObj.searchParams.delete('filter');
        urlObj.searchParams.delete('dateFromFilter');
        urlObj.searchParams.delete('dateToFilter');
        var finalUrl = urlObj.toString();
        
        if (true){
            if (filter.length > 0 && dateFromInput.length > 0 && dateToInput.length > 0) {
                window.location.href = finalUrl + "?filter=" + filter + "&dateFromFilter=" + dateFromInput + "&dateToFilter=" + dateToInput;
            } else if (filter.length > 0 && !dateFromInput && !dateToInput) {
                window.location.href = finalUrl + "?filter=" + filter;
            } else if (!filter && dateFromInput.length > 0 && dateToInput.length > 0) {
                window.location.href = finalUrl + "?dateFromFilter=" + dateFromInput + "&dateToFilter=" + dateToInput;
            } else if (!filter && !dateFromInput && dateToInput.length > 0) {
                window.location.href = finalUrl + "?dateToFilter=" + dateToInput;
            } else if (!filter && dateFromInput.length > 0 && !dateToInput) {
                window.location.href = finalUrl + "?dateFromFilter=" + dateFromInput;
            } else if (filter.length > 0 && !dateFromInput && dateToInput.length > 0) {
                window.location.href = finalUrl + "?filter=" + filter + "&dateToFilter=" + dateToInput;
            } else if (filter.length > 0 && dateFromInput.length > 0 && !dateToInput) {
                window.location.href = finalUrl + "?filter=" + filter + "&dateFromFilter=" + dateFromInput;
            } else {
                window.location.href = "poland.php";
            }
        } else {
            window.location.href = "poland.php";
        }
      }    
    </script>
</body>
</html>
