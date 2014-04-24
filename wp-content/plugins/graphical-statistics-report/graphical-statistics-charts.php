<?php
function encodeDataURL($strDataURL, $addNoCacheStr=false) {
    if ($addNoCacheStr==true) {
		if (strpos(strDataURL,"?")<>0)
			$strDataURL .= "&FCCurrTime=" . Date("H_i_s");
		else
			$strDataURL .= "?FCCurrTime=" . Date("H_i_s");
    }
	return urlencode($strDataURL);
}

function datePart($mask, $dateTimeStr) {
    @list($datePt, $timePt) = explode(" ", $dateTimeStr);
    $arDatePt = explode("-", $datePt);
    $dataStr = "";
    if (count($arDatePt) == 3) {
        list($year, $month, $day) = $arDatePt;
        switch ($mask) {
        case "m": return (int)$month;
        case "d": return (int)$day;
        case "y": return (int)$year;
        }
        return (trim($month . "/" . $day . "/" . $year));
    }
    return $dataStr;
}
function renderChart($chartSWF, $strURL, $strXML, $chartId, $chartWidth, $chartHeight) {
	if ($strXML=="")
        $tempData = "//Set the dataURL of the chart\n\t\tchart_$chartId.setDataURL(\"$strURL\")";
    else
        $tempData = "//Provide entire XML data using dataXML method\n\t\tchart_$chartId.setDataXML(\"$strXML\")";

    $chartIdDiv = $chartId . "Div";

	$render_chart = <<<RENDERCHART
	<!-- START Script Block for Chart $chartId -->
	<div id="$chartIdDiv" align="center">
		Chart.
	</div>
	<script type="text/javascript">	
		var chart_$chartId = new FusionCharts("$chartSWF", "$chartId", "$chartWidth", "$chartHeight");
		$tempData
		chart_$chartId.render("$chartIdDiv");
	</script>	
	<!-- END Script Block for Chart $chartId -->
RENDERCHART;

  return $render_chart;
}


//renderChartHTML function renders the HTML code for the JavaScript. This
//method does NOT embed the chart using JavaScript class. Instead, it uses
//direct HTML embedding. So, if you see the charts on IE 6 (or above), you'll
//see the "Click to activate..." message on the chart.
// $chartSWF - SWF File Name (and Path) of the chart which you intend to plot
// $strURL - If you intend to use dataURL method for this chart, pass the URL as this parameter. Else, set it to "" (in case of dataXML method)
// $strXML - If you intend to use dataXML method for this chart, pass the XML data as this parameter. Else, set it to "" (in case of dataURL method)
// $chartId - Id for the chart, using which it will be recognized in the HTML page. Each chart on the page needs to have a unique Id.
// $chartWidth - Intended width for the chart (in pixels)
// $chartHeight - Intended height for the chart (in pixels)
function renderChartHTML($chartSWF, $strURL, $strXML, $chartId, $chartWidth, $chartHeight) {
    // Generate the FlashVars string based on whether dataURL has been provided
    // or dataXML.
    $strFlashVars = "&chartWidth=" . $chartWidth . "&chartHeight=" . $chartHeight ;
    if ($strXML=="")
        // DataURL Mode
        $strFlashVars .= "&dataURL=" . $strURL;
    else
        //DataXML Mode
        $strFlashVars .= "&dataXML=" . $strXML;

$HTML_chart = <<<HTMLCHART
	<!-- START Code Block for Chart $chartId -->
	<OBJECT classid="clsid:D27CDB6E-AE6D-11cf-96B8-444553540000" codebase=http://download.macromedia.com/pub/shockwave/cabs/flash/swflash.cab#version=6,0,0,0"  width="$chartWidth" height="$chartHeight" id="$chartId">
		<param name="allowScriptAccess" value="always" />
		<param name="movie" value="$chartSWF"/>		
		<param name="FlashVars" value="$strFlashVars" />
		<param name="quality" value="high" />
		<embed src="$chartSWF" FlashVars="$strFlashVars" quality="high" width="$chartWidth" height="$chartHeight" name="$chartId" allowScriptAccess="always" type="application/x-shockwave-flash" pluginspage="http://www.macromedia.com/go/getflashplayer" />
	</object>
	<!-- END Code Block for Chart $chartId -->
HTMLCHART;

  return $HTML_chart;
}

// boolToNum function converts boolean values to numeric (1/0)
function boolToNum($bVal) {
    return (($bVal==true) ? 1 : 0);
}

?>
