<?php
/*
	Pokerb 'CV' page of all 4-fgure scores or better
	Author: Tom Getgood
*/

	include("header.php");
?>

<?php

	$rset = getCVByTypeAndThreshold(1, 1000, true);

?>
	<table cellspacing="0" cellpadding="0">
	<tr>
		<th>Date Time</th>
		<th>Site</th>
		<th>Length</th>
		<th>First</th>
		<th>Buy-In</th>
		<th>Rebuys</th>
		<th>Bounties</th>
		<th>Entrants</th>
		<th>Place</th>
		<th>Score</th>
		<th>Cash</th>
		<th>Comments</th>
<?php
	for($i=0; $i<mysql_numrows($rset); $i++)
	{
		$year = mysql_result($rset,$i,"year");
		switch($year)
		{
			case 2009:
				echo "<tr>";
				break;
			case 2010:
				echo "<tr style=\"background-color:#ccc\">";
				break;
			case 2011:
				echo "<tr style=\"background-color:#fc6\">";
				break;
			case 2012:
				echo "<tr style=\"background-color:#6c9\">";
				break;
			default:
				echo "<tr>";
		}
		
		$length = mysql_result($rset,$i,"tlength")/60;
		$buy_in = mysql_result($rset,$i,"buy_in")+(mysql_result($rset,$i,"rebuy_addon")*mysql_result($rset,$i,"rebuys"));
		
		echo "<td>".mysql_result($rset,$i,"tdate")." ".mysql_result($rset,$i,"start_time")."</td>";
		echo "<td>".mysql_result($rset,$i,"short_name")."</td>";
		echo "<td>".number_format($length,2)."</td>";
		if(mysql_result($rset,$i,"first_place")>0) echo "<td>$".number_format(mysql_result($rset,$i,"first_place"))."</td>";
		else echo "<td><i>unk</i></td>";
		echo "<td>$".number_format($buy_in,2)."</td>";
		if(mysql_result($rset,$i,"rebuys")>0) echo "<td>".mysql_result($rset,$i,"rebuys")."</td>";
		else echo "<td>-</td>";
		if(mysql_result($rset,$i,"bounties")>0) echo "<td>".mysql_result($rset,$i,"bounties")."</td>";
		else echo "<td>-</td>";
		echo "<td>".number_format(mysql_result($rset,$i,"entrants"))."</td>";
		echo "<td>".mysql_result($rset,$i,"place")."</td>";
		if(mysql_result($rset,$i,"score")>0) echo "<td>".mysql_result($rset,$i,"score")."</td>";
		else echo "<td>n/a</td>";
		echo "<td>$".number_format(mysql_result($rset,$i,"cash")+(mysql_result($rset,$i,"bounty")*mysql_result($rset,$i,"bounties")),2)."</td>";
		echo "<td style=\"width:50%\">".mysql_result($rset,$i,"comments")."</td>";
		echo "</tr>";
	}
?>
	</table>

<?php
	include("footer.php");
?>