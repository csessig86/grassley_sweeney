<?php
mysql_select_db("wcfcourier_com");
	$outputStream = "";
	
	$list = mysql_query("SELECT DISTINCT City FROM house50_sweeney_expenditures ORDER BY Expenditure");
	$list_dollar = mysql_query("SELECT DISTINCT Expenditure_Amount FROM house50_sweeney_expenditures ORDER BY Expenditure_Amount");
	
	if ($_GET["searchWord"] || $_GET["select"] || $_GET["select_dollar"] || $_GET["select_sort"]) {
		$word = $_GET["searchWord"];
		$select = $_GET["select"];
		$select_dollar = $_GET["select_dollar"];
		$select_sort = $_GET["select_sort"];
		
		if ($select == 'all') {
			$q = mysql_query("SELECT * FROM  house50_sweeney_expenditures WHERE Expenditure LIKE '%$word%' AND Expenditure_Amount>='$select_dollar' ORDER BY Expenditure");
		} else {
			$q = mysql_query("SELECT * FROM  house50_sweeney_expenditures WHERE Expenditure LIKE '%$word%' AND City='$select' AND Expenditure_Amount>='$select_dollar' ORDER BY Expenditure");
		}
		
		$URL = "searchWord=$word&select=$select&select_dollar=$select_dollar&select_sort=$select_sort";
		
		$a               = mysql_fetch_object($q);
		$total_items     = mysql_num_rows($q);
		$type            = $_GET['type'];
		$limit           = $_GET['limit'];
		$page            = $_GET['page'];
		
		//set default if: $limit is empty, non numerical, less than 10, greater than 50
		if((!$limit)  || (is_numeric($limit) == false) || ($limit < 10) || ($limit > 50)) {
			$limit = 15; //default
		}
		//set default if: $page is empty, non numerical, less than zero, greater than total available
		if((!$page) || (is_numeric($page) == false) || ($page < 0) || ($page > $total_items)) {
			$page = 1; //default
		}
	
		$set_limit       = $page * $limit - ($limit);
		$total_pages     = ceil($total_items / $limit);
		
		if ($select == 'all' && $select_sort == 'Expenditure_Amount') {
			$q = mysql_query("SELECT * FROM  house50_sweeney_expenditures WHERE Expenditure LIKE '%$word%' AND Expenditure_Amount>='$select_dollar' ORDER BY $select_sort DESC LIMIT $set_limit, $limit");
		} else if ($select == 'all') {
			$q = mysql_query("SELECT * FROM  house50_sweeney_expenditures WHERE Expenditure LIKE '%$word%' AND Expenditure_Amount>='$select_dollar' ORDER BY $select_sort LIMIT $set_limit, $limit");
		} else if ($select_sort == 'Expenditure_Amount') {
			$q = mysql_query("SELECT * FROM  house50_sweeney_expenditures WHERE Expenditure LIKE '%$word%' AND City='$select' AND Expenditure_Amount>='$select_dollar' ORDER BY $select_sort DESC LIMIT $set_limit, $limit");
		} else {
			$q = mysql_query("SELECT * FROM  house50_sweeney_expenditures WHERE Expenditure LIKE '%$word%' AND City='$select' AND Expenditure_Amount>='$select_dollar' ORDER BY $select_sort LIMIT $set_limit, $limit");
		}
		
	} else {
		$q = mysql_query("SELECT * FROM house50_sweeney_expenditures ORDER BY Expenditure_Date");
		$URL = "";
		
		$a               = mysql_fetch_object($q);
		$total_items     = mysql_num_rows($q);
		$type            = $_GET['type'];
		$limit           = $_GET['limit'];
		$page            = $_GET['page'];
		
		//set default if: $limit is empty, non numerical, less than 10, greater than 50
		if((!$limit)  || (is_numeric($limit) == false) || ($limit < 10) || ($limit > 50)) {
			$limit = 15; //default
		}
		//set default if: $page is empty, non numerical, less than zero, greater than total available
		if((!$page) || (is_numeric($page) == false) || ($page < 0) || ($page > $total_items)) {
			$page = 1; //default
		}
	
		$set_limit       = $page * $limit - ($limit);
		$total_pages     = ceil($total_items / $limit);
		
		$q = mysql_query("SELECT * FROM house50_sweeney_expenditures ORDER BY Expenditure_Date LIMIT $set_limit, $limit");
	}
	
	//query: **EDIT TO YOUR TABLE NAME, ECT. 
	echo("<div class='row'>
				<div class='span12'>
					<h2>Expenditures by the Sweeney for State House</h2>
				</div>
			</div>
			<div class='candidate_bio'>
			<div class='row'>
				<div class='span8'>
					<table><tr>
					<td>
						<div class='hidden-phone'>
						<img src='http://wcfcourier.com/app/special/grassley_sweeney/sweeney_small.jpg' style='padding:10px;' />
						</div>
						<div class='visible-phone'>
						<img src='http://wcfcourier.com/app/special/grassley_sweeney/sweeney_mobile.jpg' style='padding-right:5px;' />
						</div>
					</td>
					<td>
					<p>Representative Annette Sweeney of Alden spent a total of $48,563 between last year and May 2012, according to her latest filing to the Iowa Ethics & Campaign Disclosure Board.</p>
					<div class='hidden-phone'>
					<p>After starting with $30,392, raising $10,050 and spending $28,521 during January and May 2012, Sweeney ended the filing period with $11,920.</p>
					<p>The finance disclosures show Sweeney's campaign made 122 expenditures, compared to just 37 by her opponent's campaign. But Sweeney was outspent by Representative Pat Grassley, who spent about $69,867.</p>
					<div class='hidden-tablet'>
					<p>Almost all expenditures by both candidates were made to people and businesses within Iowa. These included expenditures for newspaper advertising, campaign merchandise and postage for campaign items. Sweeney's largest expenditure was to Ackley Publishing Co. Inc. for $1,982.</p>
					<p>To search our database, use the options on the right and click the 'Search' button to see the results.</p>
					</div>
					</div>
					</td>
					</tr></table>
				<div class='visible-phone'>
					<ul>
					<li><h3>
					<a href='http://wcfcourier.com/app/special/grassley_sweeney/expenditures/grassley/'>Compare with Representative Pat Grassley</a>
					</h3></l>
					</ul>
				</div>
				<div class='hidden-phone'>
					<div class='btn-group'>
						<button class='btn'>Listings Per Page</button>
						<button class='btn dropdown-toggle' data-toggle='dropdown'><span class='caret'></span></button>
						<ul class='dropdown-menu'>
            				<li><a href=/app/special/grassley_sweeney/expenditures/sweeney/index.php?$URL&limit=15&page=1>15</a></li>
							<li><a href=/app/special/grassley_sweeney/expenditures/sweeney/index.php?$URL&limit=25&page=1>25</a></li>
							<li><a href=/app/special/grassley_sweeney/expenditures/sweeney/index.php?$URL&limit=50&page=1>50</a></li>
          				</ul>
					</div>
				</div>
			</div>
			<div class='span4'>
				<div class='hidden-tablet'>
					<h2>Search Expenditures</h2>
				</div>
				<div class='visible-tablet'>
					<h3>Search Expenditures</h3>
				</div>
					<form name='search' method='get'>
						<label><strong>Search By Business</strong></label>
						<input name='searchWord' type='text' placeholder='Type here...' />
						<label><strong>Search By City</strong></label>
						<select name='select'>
							<option value='all'>All</option>");
							while($row_list=mysql_fetch_assoc($list)){
								echo "<option value='";
								echo $row_list['City'];
								echo "'>";
								echo $row_list['City'];
								echo "</option>";
							}	
							echo ("</select>
						<label><strong>Search by Expenditure Amount</strong></label>
						<select name='select_dollar'>
							<option value='1'>$1 or More</option>
							<option value='50'>$50 or More</option>
							<option value='100'>$100 or More</option>
							<option value='250'>$250 or More</option>
							<option value='500'>$500 or More</option>
							<option value='1000'>$1000 or More</option>
							<option value='1000'>$1000 or More</option>
							<option value='1250'>$1250 or More</option>
							<option value='1500'>$1500 or More</option>
							<option value='1750'>$1750 or More</option>
						</select>
						<label><strong>Sort by: </strong></label>
						<select name='select_sort'>
							<option value='Expenditure_Date'>Expenditure Date</option>
							<option value='Expenditure'>Business</option>
							<option value='City'>City</option>
							<option value='Expenditure_Amount'>Expenditure Amount</option>
						</select>
						<button type='submit' class='btn'>Search</button>
					</form>
				</div>
			</div></div>
			<div class='visible-phone'>
					<div class='btn-group'>
						<button class='btn'>Listings Per Page</button>
						<button class='btn dropdown-toggle' data-toggle='dropdown'><span class='caret'></span></button>
						<ul class='dropdown-menu'>
            				<li><a href=/app/special/grassley_sweeney/expenditures/sweeney/index.php?$URL&limit=15&page=1>15</a></li>
							<li><a href=/app/special/grassley_sweeney/expenditures/sweeney/index.php?$URL&limit=25&page=1>25</a></li>
							<li><a href=/app/special/grassley_sweeney/expenditures/sweeney/index.php?$URL&limit=50&page=1>50</a></li>
          				</ul>
					</div>
				</div>");
	
	//prev. page: **EDIT LINK PATH** 
	$prev_page = $page - 1;
					  
	//$numberOfRecords = 0;
	// $currentIndex = -1;
	echo "<div class='contributions'>
			<div class='hidden-phone'><div class='contributions_header'><div class='row'>
				<div class='span1'><strong>Date</strong></div>
				<div class='span1'><strong>Business</strong></div>
				<div class='span1'><strong>Address</strong></div>
				<div class='span1'><strong>City</strong></div>
				<div class='span1'><strong>State</strong></div>
				<div class='span1'><strong>Zip Code</strong></div>
				<div class='span2'><strong>Purpose</strong></div>
				<div class='span2'><strong>Description</strong></div>
				<div class='span1'><strong>Amount</strong></div>
			</div></div></div>
			<div class='visible-phone'><div class='contributions_header'><strong>Full list of expenditures:</strong></div></div>";
		
		while($r = mysql_fetch_array($q)) {
			// if($r["recipe_id"] != $currentIndex) {
			// $currentIndex = $r["recipe_id"];
			// $numberOfRecords = $numberOfRecords + 1;
			$sweeney_id = $r["sweeney_id"];
			$Expenditure_Date = $r["Expenditure_Date"];
			$Expenditure = $r["Expenditure"];
			$Address = $r["Address"];
			$City = $r["City"];
			$State = $r["State"];
			$Zip_Code = $r["Zip_Code"];
			$Purpose = $r["Purpose"];
			$Description = $r["Description"];
			$Expenditure_Amount = $r["Expenditure_Amount"];
			
			//$outputStream = "";
			// $outputStream = "<div id='divWrapper'><table width='410' border='0' cellspacing='0' cellpadding='0'>";
			echo "<div class='contributions_rows'><div class='row'>
					<div class='span1'>
						<div class='visible-phone'><strong>Expenditure Date: </strong>$Expenditure_Date</div>
						<div class='hidden-phone'>$Expenditure_Date</div>
					</div>
					<div class='span1'>
						<div class='visible-phone'><strong>Business: </strong>$Expenditure</div>
						<div class='hidden-phone'>$Expenditure</div>
					</div>
					<div class='span1'>
						<div class='visible-phone'><strong>Address: </strong>$Address</div>
						<div class='hidden-phone'>$Address</div>
					</div>
					<div class='span1'>
						<div class='visible-phone'><strong>City: </strong>$City</div>
						<div class='hidden-phone'>$City</div>
					</div>
					<div class='span1'>
						<div class='visible-phone'><strong>State: </strong>$State</div>
						<div class='hidden-phone'>$State</div>
					</div>
					<div class='span1'>
						<div class='visible-phone'><strong>Zip Code: </strong>$Zip_Code</div>
						<div class='hidden-phone'>$Zip_Code</div>
					</div>
					<div class='span2'>
						<div class='visible-phone'><strong>Purpose: </strong>$Purpose</div>
						<div class='hidden-phone'>$Purpose</div>
					</div>
					<div class='span2'>
						<div class='visible-phone'><strong>Description: </strong>$Description</div>
						<div class='hidden-phone'>$Description</div>
					</div>
					<div class='span1'>
						<div class='visible-phone'><strong>Expenditure Amount: </strong>\$$Expenditure_Amount</div>
						<div class='hidden-phone'>\$$Expenditure_Amount</div>
					</div>
				</div></div>"; 
		}
		echo "</div>";
		
		$select2 = urlencode($select2); //makes browser friendly 
		
		//prev. page: **EDIT LINK PATH** 
	
	$prev_page = $page - 1; 
	echo "<div class='pagination'><ul>";
	
	if($prev_page >= 1) {
		echo("<li><a class='moreListings' href=/app/special/grassley_sweeney/expenditures/sweeney/index.php?$URL&limit=$limit&page=$prev_page>&laquo;Previous</a></li>");
	}
	
	//Display middle pages: **EDIT LINK PATH** 
	for($a = 1; $a <= $total_pages; $a++){
		if($a == $page) {
			echo("<li class='active'><a class='moreListings'>$a</a></li>"); //no link
		} else {
			echo(" <li><a class='moreListings' href=/app/special/grassley_sweeney/expenditures/sweeney/index.php?$URL&limit=$limit&page=$a>$a</a></li>");
		}
	}
	
	//next page: **EDIT THIS LINK PATH**
	$next_page = $page + 1; 
	
	if($next_page <= $total_pages) {
		echo("<li><a class='moreListings' href=/app/special/grassley_sweeney/expenditures/sweeney/index.php?$URL&limit=$limit&page=$next_page>Next&raquo;</a></li>");
	}
	echo "</ul></div>";
	//all done
mysql_close();
?>