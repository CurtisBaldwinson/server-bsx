<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Present list of known series
 */
?>
<div>
	<h1>BSX Stocks</h1>
	<table class="table">
		<tr><th>Code</th><th>Name</th><th>Category</th><th>Value</th></tr>
		{stocks}
		<tr>
			<td><a href="/deck/show/{code}">{code}</a></td>
			<td>{name}</td>
			<td>{category}</td>
			<td>{value}</td>
		</tr>
		{/stocks}
	</table>
	<div class="alert alert-info">The stocks shown above are those 
		available for trading. Click on a stock's code to see its history.
	</div>
</div>
