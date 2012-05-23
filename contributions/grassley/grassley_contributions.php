<?php
mysql_select_db("wcfcourier_com");
	$outputStream = "";
	
	$list = mysql_query("SELECT DISTINCT State FROM house50_grassley_contributions ORDER BY Name_of_Contributor");
	$list_dollar = mysql_query("SELECT DISTINCT Contribution_Amount FROM house50_grassley_contributions ORDER BY Contribution_Amount");
	
	if ($_GET["searchWord"] || $_GET["select"] || $_GET["select_dollar"] || $_GET["select_sort"]) {
		$word = $_GET["searchWord"];
		$select = $_GET["select"];
		$select_dollar = $_GET["select_dollar"];
		$select_sort = $_GET["select_sort"];
		
		if ($select == 'all') {
			$q = mysql_query("SELECT * FROM  house50_grassley_contributions WHERE Name_of_Contributor LIKE '%$word%' AND Contribution_Amount>='$select_dollar' ORDER BY Name_of_Contributor");
		} else {
			$q = mysql_query("SELECT * FROM  house50_grassley_contributions WHERE Name_of_Contributor LIKE '%$word%' AND State='$select' AND Contribution_Amount>='$select_dollar' ORDER BY Name_of_Contributor");
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
		
		if ($select == 'all' && $select_sort == 'Contribution_Amount') {
			$q = mysql_query("SELECT * FROM  house50_grassley_contributions WHERE Name_of_Contributor LIKE '%$word%' AND Contribution_Amount>='$select_dollar' ORDER BY $select_sort DESC LIMIT $set_limit, $limit");
		} else if ($select == 'all') {
			$q = mysql_query("SELECT * FROM  house50_grassley_contributions WHERE Name_of_Contributor LIKE '%$word%' AND Contribution_Amount>='$select_dollar' ORDER BY $select_sort LIMIT $set_limit, $limit");
		} else if ($select_sort == 'Contribution_Amount') {
			$q = mysql_query("SELECT * FROM  house50_grassley_contributions WHERE Name_of_Contributor LIKE '%$word%' AND State='$select' AND Contribution_Amount>='$select_dollar' ORDER BY $select_sort DESC LIMIT $set_limit, $limit");
		} else {
			$q = mysql_query("SELECT * FROM  house50_grassley_contributions WHERE Name_of_Contributor LIKE '%$word%' AND State='$select' AND Contribution_Amount>='$select_dollar' ORDER BY $select_sort LIMIT $set_limit, $limit");
		}
		
	} else {
		$q = mysql_query("SELECT * FROM house50_grassley_contributions ORDER BY Contribution_Date");
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
		
		$q = mysql_query("SELECT * FROM house50_grassley_contributions ORDER BY Contribution_Date LIMIT $set_limit, $limit");
	}
	
	//query: **EDIT TO YOUR TABLE NAME, ECT. 
	echo("<div class='row'>
				<div class='span12'>
					<h2>Where the money comes from</h2>
					<table class='table'>
						<thead>
							<tr>
								<th>Candidate</th>
								<th>In-state contributions</th>
								<th>Out-of-state contributions</th>
								<th>Percentage of contributors from Iowa</th>
							</tr>
						</thead>
						<tbody>
							<tr>
								<td><strong>Pat Grassley</strong></td>
								<td>$43,240</td>
								<td>$43,236</td>
								<td>
									<div class='bar-container'>
										<div class='bar' style='width:50%;'>50%</div>
									</div>
								</td>
							</tr>
							<tr>
								<td><strong>Annette Sweeney</strong></td>
								<td>$56,835</td>
								<td>$3,236</td>
								<td>
									<div class='bar-container'>
										<div class='bar' style='width:94.6%;'>94.6%</div>
									</div>
								</td>
							</tr>
						</tbody>
					</table>
					<h2>Contributions to Citizens for Pat Grassley</h2>
				</div>
			</div>
			<div class='candidate_bio'>
			<div class='row'>
				<div class='span8'>
					<table><tr>
					<td>
						<div class='hidden-phone'>
						<img src='http://wcfcourier.com/app/special/grassley_sweeney/grassley_small.jpg' style='padding:10px;' />
						</div>
						<div class='visible-phone'>
						<img src='http://wcfcourier.com/app/special/grassley_sweeney/grassley_mobile.jpg' style='padding-right:5px;' />
						</div>
					</td>
					<td>
					<p>Representative Pat Grassley of New Hartford raised a total of $86,476 between April 2011 and May 2012, according to his latest filing to the Iowa Ethics & Campaign Disclosure Board.</p>
					<div class='hidden-phone'>
					<p>After starting with $39,798, raising $34,506 and spending $49,616 during January and May 2012, Grassley had $24,689 as of the end of the filing period.</p>
					<p>Grassley relied heavily on small donations with just 30 of his 650 contributions valued at $1000 or more. His largest donation came from Russell Bruemmer of Arlington, Virginia, which was valued at $4000.</p>
					<div class='hidden-tablet'>
					<p>Grassley also raised more money out of state than Sweeney, with about 50 percent of his money coming from donors in Iowa, compared to 95 percent for Sweeney. In all, Grassley picked up 67 donations out of Iowa. This does not include the 260 small contributions that did not list a state.</p>
					<p>To search our database, use the options on the right and click the 'Search' button to see the results.</p>
					</div>
					</div>
					</td>
					</tr></table>
				<div class='visible-phone'>
					<ul>
					<li><h3>
					<a href='http://wcfcourier.com/app/special/grassley_sweeney/'>Compare with Representative Annette Sweeney</a>
					</h3></l>
					</ul>
				</div>
				<div class='hidden-phone'>
					<div class='btn-group'>
						<button class='btn'>Listings Per Page</button>
						<button class='btn dropdown-toggle' data-toggle='dropdown'><span class='caret'></span></button>
						<ul class='dropdown-menu'>
            				<li><a href=/app/special/grassley_sweeney/contributions/grassley/index.php?$URL&limit=15&page=1>15</a></li>
							<li><a href=/app/special/grassley_sweeney/contributions/grassley/index.php?$URL&limit=25&page=1>25</a></li>
							<li><a href=/app/special/grassley_sweeney/contributions/grassley/index.php?$URL&limit=50&page=1>50</a></li>
          				</ul>
					</div>
				</div>
			</div>
				<div class='span4'>
				<div class='hidden-tablet'>
					<h2>Search Contributions</h2>
				</div>
				<div class='visible-tablet'>
					<h3>Search Contributions</h3>
				</div>
					<form name='search' method='get'>
						<label><strong>Search By Contributor</strong></label>
						<input name='searchWord' type='text' placeholder='Type here...' />
						<label><strong>Search By State</strong></label>
						<select name='select'>
							<option value='all'>All</option>");
							while($row_list=mysql_fetch_assoc($list)){
								echo "<option value='";
								echo $row_list['State'];
								echo "'>";
								echo $row_list['State'];
								echo "</option>";
							}	
							echo ("</select>
						<label><strong>Search by Contribution Amount</strong></label>
						<select name='select_dollar'>");
							while($row_list=mysql_fetch_assoc($list_dollar)){
								echo "<option value='";
								echo $row_list['Contribution_Amount'];
								echo "'>$";
								echo $row_list['Contribution_Amount'];
								echo " or More</option>";
							}	
							echo ("</select>
						<label><strong>Sort by: </strong></label>
						<select name='select_sort'>
							<option value='Contribution_Date'>Contribution Date</option>
							<option value='Name_of_Contributor'>Name of Contributor</option>
							<option value='City'>City</option>
							<option value='Contribution_Amount'>Contribution Amount</option>
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
            				<li><a href=/app/special/grassley_sweeney/index.php?$URL&limit=15&page=1>15</a></li>
							<li><a href=/app/special/grassley_sweeney/index.php?$URL&limit=25&page=1>25</a></li>
							<li><a href=/app/special/grassley_sweeney/index.php?$URL&limit=50&page=1>50</a></li>
          				</ul>
					</div>
				</div>");
	
	//prev. page: **EDIT LINK PATH** 
	$prev_page = $page - 1;
					  
	//$numberOfRecords = 0;
	// $currentIndex = -1;
	echo "<div class='contributions'>
			<div class='hidden-phone'><div class='contributions_header'><div class='row'>
				<div class='span2'><strong>Contribution Date</strong></div>
				<div class='span2'><strong>Contributor</strong></div>
				<div class='span2'><strong>Address</strong></div>
				<div class='span2'><strong>City</strong></div>
				<div class='span1'><strong>State</strong></div>
				<div class='span1'><strong>Zip Code</strong></div>
				<div class='span1'><strong>Amount</strong></div>
			</div></div></div>
			<div class='visible-phone'><div class='contributions_header'><strong>Full list of contributions:</strong></div></div>";
		
		while($r = mysql_fetch_array($q)) {
			// if($r["recipe_id"] != $currentIndex) {
			// $currentIndex = $r["recipe_id"];
			// $numberOfRecords = $numberOfRecords + 1;
			$sweeney_id = $r["sweeney_id"];
			$Contribution_Date = $r["Contribution_Date"];
			$Name_of_Contributor = $r["Name_of_Contributor"];
			$Address = $r["Address"];
			$City = $r["City"];
			$State = $r["State"];
			$Zip_Code = $r["Zip_Code"];
			$Relationship_To_Candidate = $r["Relationship_To_Candidate"];
			$Contribution_Amount = $r["Contribution_Amount"];
			
			//$outputStream = "";
			// $outputStream = "<div id='divWrapper'><table width='410' border='0' cellspacing='0' cellpadding='0'>";
			echo "<div class='contributions_rows'><div class='row'>
					<div class='span2'>
						<div class='visible-phone'><strong>Contribution Date: </strong>$Contribution_Date</div>
						<div class='hidden-phone'>$Contribution_Date</div>
					</div>
					<div class='span2'>
						<div class='visible-phone'><strong>Contributor: </strong>$Name_of_Contributor</div>
						<div class='hidden-phone'>$Name_of_Contributor</div>
					</div>
					<div class='span2'>
						<div class='visible-phone'><strong>Address: </strong>$Address</div>
						<div class='hidden-phone'>$Address</div>
					</div>
					<div class='span2'>
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
					<div class='span1'>
						<div class='visible-phone'><strong>Contribution Amount: </strong>\$$Contribution_Amount</div>
						<div class='hidden-phone'>\$$Contribution_Amount</div>
					</div>
				</div></div>"; 
		}
		echo "</div>";
		
		$select2 = urlencode($select2); //makes browser friendly 
		
		//prev. page: **EDIT LINK PATH** 
	
	$prev_page = $page - 1; 
	echo "<div class='pagination'><ul>";
	
	if($prev_page >= 1) {
		echo("<li><a class='moreListings' href=/app/special/grassley_sweeney/contributions/grassley/index.php?$URL&limit=$limit&page=$prev_page>&laquo;Previous</a></li>");
	}
	
	//Display middle pages: **EDIT LINK PATH** 
	for($a = 1; $a <= $total_pages; $a++){
		if($a == $page) {
			echo("<li class='active'><a class='moreListings'>$a</a></li>"); //no link
		} else {
			echo(" <li><a class='moreListings' href=/app/special/grassley_sweeney/contributions/grassley/index.php?$URL&limit=$limit&page=$a>$a</a></li>");
		}
	}
	
	//next page: **EDIT THIS LINK PATH**
	$next_page = $page + 1; 
	
	if($next_page <= $total_pages) {
		echo("<li><a class='moreListings' href=/app/special/grassley_sweeney/contributions/grassley/index.php?$URL&limit=$limit&page=$next_page>Next&raquo;</a></li>");
	}
	echo "</ul></div>";
	//all done
mysql_close();
?>