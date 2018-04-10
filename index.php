<html><body><?php
require_once "jpgraph/jpgraph.php";
require_once "jpgraph/jpgraph_line.php";
//require_once("jpgraph/jpgraph_bar.php");

$width = 600; $height = 200;
 
// Create a graph instance
$graph = new Graph($width,$height);
 
// Specify what scale we want to use,
// int = integer scale for the X-axis
// int = integer scale for the Y-axis
$graph->SetScale('intint');
 
// Setup a title for the graph
$graph->title->Set('data');
 
// Setup titles and X-axis labels
$graph->xaxis->title->Set('annees');

// Setup Y-axis title
$graph->yaxis->title->Set('personnes');
 
// Create the linear plot
$lineplot=new LinePlot(array(20,50));
 
// Add the plot to the graph
$graph->Add($lineplot);

// Display the graph
$graph->Stroke();
?></body></html>
