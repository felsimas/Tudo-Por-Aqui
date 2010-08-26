

				<span class="clear"></span>




		</div>
           	<?
			  $banner = system_showBanner("TOP", $category_id, $banner_section);
				if ($banner) {
					?><center><blockquote class="topBanner"><?=$banner?></blockquote></center><br><?
				}
				$banner="";
				?>
		
        <?php include(INCLUDES_DIR."/code/statisticreport.php"); ?>

		<?php
            /* googlemap */
            if (strpos($_SERVER["PHP_SELF"], 'results.php') !== false) {

                if($itemRSSSection == 'listing')    $searchResults = $listings;
                if($itemRSSSection == 'classified') $searchResults = $classifieds;
                if($itemRSSSection == 'event')      $searchResults = $events;
                
                if(!isset($itemRSSSection) and ($promotions)) {
                    $searchResults = array();
                    $promotionTitle[] = array();
                    if ($promotions) {
                        foreach($promotions as $promotion){
                            $listings = $listingObj->retrieveListingsbyPromotion_id($promotion->getNumber("id"));            
                            foreach($listings as $listing){
                                $searchResults[] = $listing;
                                $promotionTitle[$listing->getNumber('id')] = $promotion->getString('name', true);
                            }
                        }
                    }
                }
                
                //include(INCLUDES_DIR.'/views/view_resultsmap.php');
            }
        ?>

		<?
		// GOOGLE ANALYTICS FEATURE 
		if (GOOGLE_ANALYTICS_ENABLED == "on") {
			$google_analytics_page = "front";
			include(INCLUDES_DIR."/code/google_analytics.php");
		}
		?>
         <script type="text/javascript">

  var _gaq = _gaq || [];
  _gaq.push(['_setAccount', 'UA-17085729-1']);
  _gaq.push(['_trackPageview']);

  (function() {
    var ga = document.createElement('script'); ga.type = 'text/javascript'; ga.async = true;
    ga.src = ('https:' == document.location.protocol ? 'https://ssl' : 'http://www') + '.google-analytics.com/ga.js';
    var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(ga, s);
  })();

</script>

	</body>

</html>