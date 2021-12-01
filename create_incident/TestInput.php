<?php
		//test user input to help prevent HTML injection
		function test_input($data){
		    $original = $data;
			
			/*convert 5 predefined characters into HTML values.		
			 They are > (&gt;), < (%lt;), " (&quot;), ' (&#039;), & (&amp;)   */			
			$data = htmlspecialchars($data);

			//check for possible html injection
			if ($data === $original) return $data; 			
			     else exit("Attempted HTML injection:    $data");
		}
		

?>