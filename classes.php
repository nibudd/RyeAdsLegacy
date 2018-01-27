<?php

class Page{
		
		private $title;
		private $main;
		private $keywordString;
		private $descriptionString;
		private $mainFile;
		
		public function setKeyword($word){
			$this->keywordString = "Ryerson classifieds, Ryerson classified ads, Ryerson ads, Ryerson univeristy classifieds, Ryerson university classified ads, Ryerson university ads";
			$this->keywordString .= ', '.$word;
			$this->title = $word;
		}
		
		public function setDescription($description){
			$this->descriptionString = "Classified ads for Ryerson University students and faculty";
			$this->descriptionString .= $description . ".";
		}
		
		public function setTitle($title){
			$this->title = $title;
		}
		
		public function setMain($file){
			$this->mainFile = $file;
		}
		
		public function writePage(){
?>
			
<!DOCTYPE html>
<html>
<head>

	<title>RyeAds - <?php echo $this->title; ?></title>

	<link rel="stylesheet" href="http://ryeads.com/style.css" type="text/css" />
	<link rel="shortcut icon" href="/home/ryeadsco/public_html/favicon.ico" />

	<meta name='keywords' content="<?php echo $this->keywordString; ?>" />
	<meta name='description' content="<?php echo $this->descriptionString; ?>" />
	

	<!--Google Analytics Stuff -->
	<script type="text/javascript">

		var _gaq = _gaq || [];
		_gaq.push(['_setAccount', 'UA-34279412-1']);
		_gaq.push(['_trackPageview']);

		(function() {
  			var ga = document.createElement('script'); ga.type = 'text/javascript'; ga.async = true;
   			ga.src = ('https:' == document.location.protocol ? 'https://ssl' : 'http://www') + '.google-analytics.com/ga.js';
   			var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(ga, s);
		})();
	</script>
				
</head>
<body>
			
	<div id='column'>

		<!-- for Facebook Button -->
		<div id="fb-root"></div>
			<script>(function(d, s, id) {
				var js, fjs = d.getElementsByTagName(s)[0];
				if (d.getElementById(id)) return;
				js = d.createElement(s); js.id = id;
				js.src = "//connect.facebook.net/en_US/all.js#xfbml=1&appId=181267415234261";
				fjs.parentNode.insertBefore(js, fjs);
			}(document, 'script', 'facebook-jssdk'));</script>
		
		<!-- HEADER -->
		<?php require '/home/ryeadsco/public_html/header.txt'; ?>
		
		<!-- NAVBAR -->
		<?php require 'navbar.txt'; ?>
	
		<!-- MAIN BODY -->
		<div id='main'>
			<?php require $this->mainFile; ?>
		</div>
	</div>
				
</body>
</html>
<?php
		}
}
	
?>