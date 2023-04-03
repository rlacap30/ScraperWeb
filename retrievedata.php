<?php    
     $data = file_get_contents("php://input");
     session_start();
     $conn = mysqli_connect("localhost", "lacaprose5bin", "", "my_lacaprose5bin");
        
     if (!$conn) {
         die("Connection failed: " . mysqli_connect_error());
     }
     
     $query = "INSERT INTO MonitorScraperAPICalls (Data) VALUES ('$data')";
     $ris = mysqli_query($conn, $query);
     
     $decoded_data = json_decode($data, true);
     
     $websites = $decoded_data['Websites'];
     
     foreach($websites as $website){
         $website_name =  $website['website_name'];    
         $datetime = strtotime($website['date_checked']);
         $website_id =  $website['id'];    
         $date_checked = date('Y-m-d H:i:s',$datetime);
         $nr_ads = $website['number_advertisements_found'];
         $script_active = $website['is_script_active'] ==  true ? 1 : 0;
         $query_save_website = "INSERT INTO Websites (Id, Name, CheckedDate, NrAds, IsScriptActive)
                                VALUES('$website_id', '$website_name', '$date_checked', '$nr_ads', '$script_active')";
         $risSaveWebsite = mysqli_query($conn, $query_save_website);
         
         if ($risSaveWebsite) {
             $last_id = $website_id;
             $ads = $website['advertisement_info'];
             if (true) {
                 foreach($ads as $ad){
                     $ad_name = $ad['ad_name'];
                     $ad_site = $ad['ad_site'];
                     $ad_link = $ad['ad_link']; 
                     $query_save_ads = "INSERT INTO Advertisements (Name, Site, Link, WebsiteId)
                                    VALUES('$ad_name', '$ad_site', '$ad_link', '$last_id')";
                     $risSaveAds = mysqli_query($conn, $query_save_ads);
                 } 
             }
             $parameters = $website['Parameters'];
             if(true){
                 $parameter_url = $parameters['url'];
                 $cookie_selector = $parameters['cookieSelector'];
                 $video_navigator = $parameters['videoNavigator'];
                 $ad_frame = $parameters['adFrame'];
                 $ad_url = $parameters['adUrl'];
                 $x_offset = $parameters['x_offset'];
                 $y_offset = $parameters['y_offset'];
                 $x_ad_offset = $parameters['x_ad_offset'];
                 $y_ad_offset = $parameters['y_ad_offset'];
                 $buffer_one = $parameters['buffer_one'];
                 $buffer_two = $parameters['buffer_two'];
                 
                 $query_save_params = "INSERT INTO Parameters (Url, CookieSelector, VideoNavigator, AdFrame,
                                       AdUrl, XOffset, YOffset, XAdOffset, YAdOffset, buffer_one, buffer_two,
                                       WebsiteId)
                                       VALUES('$parameter_url', '$cookie_selector', '$video_navigator', 
                                       '$ad_frame', '$ad_url', '$x_offset', '$y_offset', '$x_ad_offset',
                                       '$y_ad_offset', '$buffer_one', '$buffer_two', '$last_id')";
                $risSaveParams = mysqli_query($conn, $query_save_params);
             }
         }
     }
     
     mysqli_close($conn);
?>
