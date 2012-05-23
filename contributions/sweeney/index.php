<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <title>WCFCourier.com | Grassley v. Sweeney</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="">

    <style type="text/css">
      body {
        padding-top: 60px;
        padding-bottom: 40px;
      }
    </style>
    <script type="text/javascript" src="http://code.jquery.com/jquery-1.7.1.js"></script>
	<script type="text/javascript" src="http://wcfcourier.com/app/special/grassley_sweeney/bootstrap/js/bootstrap-dropdown.js"></script>
    <script type="text/javascript" src="http://wcfcourier.com/app/special/grassley_sweeney/bootstrap/js/bootstrap-collapse.js"></script>
    <script type="text/javascript" src="http://wcfcourier.com/app/special/grassley_sweeney/bootstrap/js/bootstrap-tab.js"></script>

<script type="text/javascript" src="http://www.google.com/jsapi"></script>
<script type="text/javascript">
	google.load('visualization', '1', {packages: ['corechart']});
</script>
<script type="text/javascript">
	function drawVisualization() {
			// Create and populate the data table.
			var data = new google.visualization.DataTable();
			var raw_data = [['In-state contributions', 47645, 31301],
			['Out-of-state contributions', 2376, 20668]];
			
			var candidates = ['Annette Sweeney', 'Pat Grassley'];
			
			data.addColumn('string', 'Year');
			
			for (var i = 0; i  < raw_data.length; ++i) {
				data.addColumn('number', raw_data[i][0]);
			}
			
			data.addRows(candidates.length);
			
			for (var j = 0; j < candidates.length; ++j) {    
				data.setValue(j, 0, candidates[j].toString());
			}
			
			for (var i = 0; i  < raw_data.length; ++i) {
				for (var j = 1; j  < raw_data[i].length; ++j) {
					data.setValue(j-1, i+1, raw_data[i][j]);
					data.setFormattedValue(j-1, i+1, numberFormat(raw_data[i][j]));
				}
			}
			
	// Create and draw the visualization.
	new google.visualization.BarChart(document.getElementById('visualization')).
		draw(data,
			{title:"Where the contributions are coming from",
			titleTextStyle: {fontSize: 18},
            chartArea: {left: 150, right: 40, width: 650, height: 200},
            width:750, height:300,
            isStacked: true,
            legend: {position: "top", textStyle: {fontSize: 13}},
            hAxis: {title: "Dollars"}}
		);
	}

function numberFormat(nStr){
        nStr += '';
        x = nStr.split('.');
        x1 = x[0];
        x2 = x.length > 1 ? '.' + x[1] : '';
        var rgx = /(\d+)(\d{3})/;
        while (rgx.test(x1))
        x1 = x1.replace(rgx, '$1' + ',' + '$2');
        return x1 + x2;
}
</script>
    
    <link href="http://wcfcourier.com/app/special/grassley_sweeney/bootstrap/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
    <link href="http://wcfcourier.com/app/special/grassley_sweeney/bootstrap/css/bootstrap-responsive.css" rel="stylesheet" type="text/css" />

    <!-- Le HTML5 shim, for IE6-8 support of HTML5 elements -->
    <!--[if lt IE 9]>
      <script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
    <![endif]-->
  </head>

  <body>
  	<div class="container">
    <?php require_once('sweeney_contributions.php'); ?>
    </div>  
  </body>
</html>