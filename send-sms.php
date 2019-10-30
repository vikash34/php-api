<?php
	                 $SMS="Your SMS"; //sms

					$SMS=strip_tags($SMS); //remove special characters
					$SMS=str_replace("&","and",str_replace(" ","%20",$SMS)); 

					$Mobile=9999999999;  //phone umber
				
					    $url="http://smsbhejo.org/submitsms.jsp?user=USER_NAME&key=API_KEY&mobile=".$Mobile."&message=".$SMS."&senderid=SENDER_ID&accusage=1";

					 // create a new cURL resource
					$ch = curl_init();
					// set URL and other appropriate options
					curl_setopt($ch, CURLOPT_URL, $url);
					curl_setopt($ch, CURLOPT_HEADER, 0);
					// grab URL and pass it to the browser
					curl_exec($ch);
					// close cURL resource, and free up system resources
					if(curl_errno($ch))
					{ 
						echo 'Curl error: ' . curl_error($ch); 
					}
					curl_close($ch);

?>