<?php    
     $data = file_get_contents("php://input");
     session_start();
     $conn = mysqli_connect("localhost", "lacaprose5bin", "", "my_lacaprose5bin");
        
     if (!$conn) {
         die("Connection failed: " . mysqli_connect_error());
     }
     
     $query = "INSERT INTO MonitorScraperUpdateAPICalls (Data) VALUES ('$data')";
     $ris = mysqli_query($conn, $query);
     
     $decoded_data = json_decode($data, true);
     
     $websites = $decoded_data['Websites'];
     
     foreach($websites as $website){
         $website_id =  $website['id'];  
         $query = "SELECT * FROM Websites WHERE Id = '$website_id'";
         $result = mysqli_query($conn, $query);
         if (mysqli_num_rows($result) > 0) {   
             while($row = mysqli_fetch_assoc($result)) {
                 $nr_ads = $row['NrAds'] + count($website['advertisement_info']);
             }
             $query_update_website = "UPDATE Websites SET 
                                      NrAds='$nr_ads', CheckedDate=now()
                                      WHERE Id='$website_id'";
             $risUpdateWebsite = mysqli_query($conn, $query_update_website);
             
             $ads = $website['advertisement_info'];
             if($ads != null){
                 foreach($ads as $ad){
                     $ad_name = $ad['ad_name'];
                     $ad_site = $ad['ad_site'];
                     $ad_link = $ad['ad_link']; 
                     $query_save_ads = "INSERT INTO Advertisements (Name, Site, Link, WebsiteId)
                                    VALUES('$ad_name', '$ad_site', '$ad_link', '$website_id')";
                     $risSaveAds = mysqli_query($conn, $query_save_ads);
                 }
             }         
         }
     }
     
     mysqli_close($conn);
?>
