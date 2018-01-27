<?php
	// set server access variables
		
	global $host, $user, $db, $pass;
		
	$host = "localhost";
	$user = 'ryeadsco_nib';
	$db = 'ryeadsco_1';
	$pass = 'rFblo*jj3Y';
	
	// sets server variables and opens connection to mySQL database
	
	function queryAndClose($query){
		
		// set server access variables
		
		$host = "localhost";
		$user = 'ryeadsco_nib';
		$db = 'ryeadsco_1';
		$pass = 'rFblo*jj3Y';
		
		// create mysqli object
		// open connection
	
		$mysqli = new mysqli($host, $user, $pass, $db);
	
		// check for connection errors
	
		if (mysqli_connect_errno()) die("Unable to connect!");
		
		// executing query to bring up ad for entered code

		$result = $mysqli->query($query) or die ("Error in query: $query. ".mysqli_error($mysqli));
			
		// free result set memory
		
		$mysqli->close();
		
		return $result;
		
	}
	
	// for viewad.txt: displays appropriate number of links for the number of pages in that category
	
	function displayPageLinks($totalPages, $category){
		echo '<ul>';
		$i = 1;
		while($i <= $totalPages){
			echo '<li id=\'pageList\'>';
			echo '<a href="'.$_SERVER["PHP_SELF"].'?category='.$category.'&page='.$i.'"> '.$i.' </a>';
			echo '</li>';
			$i++;
		}
		echo '</ul>';
	}
	
	// for viewad.txt: displays body of ad in proper format
	
	function displayAds($result){
		// display query in format
					
		while($row = $result->fetch_array()){
					
					$date = explode(" ",$row['date']);	//splits timestamp into (date, time)
			?>
				<div class="ad">
					<div class="adTitle"> <?php echo $row['title']; ?> </div>
					<div class="adDate"> <?php echo 'Posted: '.$date[0]; ?> </div>
					<div class="adMessage"> <?php echo $row['message']; ?> </div>
					<div class="adReply"> <a href= <?php echo $_SERVER["PHP_SELF"].'?category=replyad&id='.$row['id']; ?>>Reply to this ad</a></div>
				</div>
			<?php
		}
				
		// free result set memory
	
		$result->close();
	}
	
	// validates email addresses
	
	function isValidEmail($email){
    	return preg_match("^[_a-zA-Z0-9-]+(\.[_a-zA-Z0-9-]+)*@[a-zA-Z0-9-]+(\.[a-zA-Z0-9-]+)*(\.[a-zA-Z]{2,5})$^", $email);
	}
	
	// validates Ryerson email address
	
	function isRyersonEmail($email){
    	return preg_match("^[_a-zA-Z0-9-]+(\.[_a-zA-Z0-9-]+)*@[a-zA-Z0-9-]*(\.)*ryerson\.ca$^", $email);
	}
	
	// sets the txt file to load as the main body of the page
	function setFile($category){
		
		switch($category){
			
			case 'submitpost':
				$file = 'submitad.txt';
				break;
					
			case 'editpost':
				$file = 'editad.txt';
				break;
					
			case 'replyad':
				$file = 'replyad.txt';
				break;
					
			case 'contact':
				$file = 'contact.txt';
				break;
					
			case 'about':
				$file = 'about.txt';
				break;
					
			default:
				$file = 'viewad.txt';
		}
		return $file;
	}
	
	// sets header/meta information (title, keywords, description)
	function setMeta($category){
		
		$metaString = array();
		$metaString['title'] = "RyeAds - ";
		$metaString['keyword'] = "Ryerson classifieds, Ryerson classified ads, Ryerson ads, Ryerson univeristy classifieds, Ryerson university classified ads, Ryerson university ads";
		$metaString['description'] = "Classified ads for Ryerson University students and faculty";
		
		switch ($category){
				
			case 'about':
				$metaString['title'] .= 'About';
				$metaString['keyword'] .= ', about';
				$metaString['description'] .= ' - About.';
				break;
			
			case 'contact':
				$metaString['title'] .= 'Contact';
				$metaString['keyword'] .= ', contact';
				$metaString['description'] .= ' - Contact.';
				break;
				
			case 'editpost':
				$metaString['title'] .= 'Edit an Ad';
				$metaString['keyword'] .= ', edit ad';
				$metaString['description'] .= ' - Edit an Ad.';
				break;
				
			case 'replyad':
				$metaString['title'] .= 'Reply to an Ad';
				$metaString['keyword'] .= ', reply ad';
				$metaString['description'] .= ' - Reply to an Ad.';
				break;
				
			case 'submitpost':
				$metaString['title'] .= 'Submit an Ad';
				$metaString['keyword'] .= ', submit ad';
				$metaString['description'] .= ' - Reply to an Ad.';
				break;
				
			case 'bikes':
				$metaString['title'] .= 'Bikes';
				$metaString['keyword'] .= ', bikes, bicycles, bike, bicycle';
				$metaString['description'] .= ' - Bikes.';
				break;
			
			case 'books':
				$metaString['title'] .= 'Books';
				$metaString['keyword'] .= ', books, text books, book, text book';
				$metaString['description'] .= ' - Books.';
				break;
		
			case 'cars':
				$metaString['title'] .= 'Cars';
				$metaString['keyword'] .= ', cars, automobiles, car, automobile';
				$metaString['description'] .= ' - Cars.';
				break;
		
			case 'electronics':
				$metaString['title'] .= 'Electronics';
				$metaString['keyword'] .= ', electronics, computer, cell phone, console, mp3 player, television, monitor';
				$metaString['description'] .= ' - Electronics.';
				break;
			
			case 'employment':
				$metaString['title'] .= 'Employment';
				$metaString['keyword'] .= ', employment, jobs';
				$metaString['description'] .= ' - Employment.';
				break;
		
			case 'furniture':
				$metaString['title'] .= 'Furniture';
				$metaString['keyword'] .= ', furniture, couch, table, bed, chair, desk';
				$metaString['description'] .= ' - Furniture.';
				break;
			
			case 'housing':
				$metaString['title'] .= 'Housing';
				$metaString['keyword'] .= ', rent, apartment, condo, roommate';
				$metaString['description'] .= ' - Housing.';
				break;
			
			case 'groupsandservices':
				$metaString['title'] .= 'Groups and Services';
				$metaString['keyword'] .= ', groups, services, clubs';
				$metaString['description'] .= ' - Groups and Services.';
				break;
		
			case 'musicvideoandsoftware':
				$metaString['title'] .= 'Music, Video, and Software';
				$metaString['keyword'] .= ', music, video, software, games';
				$metaString['description'] .= ' - Music, Video, and Software.';
				break;
			
			case 'ridesharesandtransportation':
				$metaString['title'] .= 'Ride Sharing and Transportation';
				$metaString['keyword'] .= ', rides, ride share, rideshare, carpool, car pool, transportation';
				$metaString['description'] .= ' - Ride Sharing and Transportation.';
				break;
			
			case 'tutoringandlessons':
				$metaString['title'] .= 'Tutoring and Lessons';
				$metaString['keyword'] .= ', tutoring, lessons';
				$metaString['description'] .= ' - Tutoring and Lessons.';
				break;
		
			default:
				echo 'error in switch statement (setMeta)';
		}
		return $metaString;
	}
?>