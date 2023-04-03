<?php
    session_start();
    $conn = mysqli_connect("localhost", "lacaprose5bin", "", "my_lacaprose5bin");
    
    if (!$conn) {
        die("Connection failed: " . mysqli_connect_error());
    }
    
    $websites = array();
    $query = "SELECT w.Name AS Name, w.IsScriptActive AS IsScriptActive, w.Id AS Id,
              p.Url AS Url, p.CookieSelector AS cs, p.VideoNavigator AS vn,
              p.AdFrame AS af, p.AdUrl AS au, p.XOffset AS xo, p.YOffset AS yo,
              p.XAdOffset AS pao, p.YAdOffset AS yao, p.buffer_one AS bufferone,
              p.buffer_two AS buffertwo
              FROM Websites AS w
              LEFT JOIN Parameters AS p on w.Id=p.WebsiteId";
    $ris = mysqli_query($conn, $query);
    $counter = 0;
    while($row = mysqli_fetch_assoc($ris)) {
      $website = array();
      $website[0] = $row["Name"];
      $website[1] = $row["IsScriptActive"];
      $website[2] = $row["Id"];
      $website[3] = $row["Url"];
      $website[4] = $row["cs"];
      $website[5] = $row["vn"];
      $website[6] = $row["af"];
      $website[7] = $row["au"];
      $website[8] = $row["xo"];
      $website[9] = $row["yo"];
      $website[10] = $row["pao"];
      $website[11] = $row["yao"];
      $website[12] = $row["bufferone"];
      $website[13] = $row["buffertwo"];
      #$websites[$counter] = $website;
      #$counter++;
      
      $websites[$counter] = json_encode(array("Name"=>$row["Name"], "IsScriptActive"=>$row["IsScriptActive"], 
      "Id"=>$row["Id"], "Url"=>$row["Url"], "CookieSelector"=>$row["cs"], "VideoNavigator"=>$row["vn"],
      "AdFrame"=>$row["af"], "AdUrl"=>$row["au"], "XOffset"=>$row["xo"], "YOffset"=>$row["yo"],
      "XAdOffset"=>$row["pao"], "YAdOffset"=>$row["yao"], "BufferOne"=>$row["bufferone"],
      "BufferTwo"=>$row["buffertwo"]));
      $counter++;
    }
    echo json_encode($websites);
    mysqli_close($conn);
?>