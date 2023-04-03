                           <?php 
                                session_start(); 
                                $adid = intval($_GET['adname']);
                                #echo $adname;
                                $conn = mysqli_connect("localhost", "lacaprose5bin", "", "my_lacaprose5bin");
                                if (!$conn) {
                                    die("Connection failed: " . mysqli_connect_error());
                                }
                                
                                $adnamesql = "SELECT * From Advertisements WHERE Id = $adid";
                                #echo $adnamesql;
                                $adnamerows = mysqli_query($conn, $adnamesql);
                                
                                while($adnamerow = mysqli_fetch_assoc($adnamerows)){
                                    $adname = $adnamerow["Name"];
                                    #echo $adname;
                                    $sql = "SELECT DISTINCT Websites.Name AS Name FROM Websites
                                        JOIN Advertisements on Websites.Id = Advertisements.WebsiteId
                                        WHERE Advertisements.Name = '$adname'";
                                $rows = mysqli_query($conn, $sql);
                                while($row = mysqli_fetch_assoc($rows)) {
                                     echo "<tr>";
                                     echo "<td>".$row["Name"]."</td>";
                                     echo "</tr>";
                                }
                                }
                                
                            ?>