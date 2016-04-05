<?php

defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * views/organizer.php
 *
 * Present learning activities by week
 *
 */
?>
<div>
	<h1>BSX Stock Detailss</h1>
	<table class="table">
		<tr><th>Code</th><th>Name</th><th>Category</th><th>Value</th></tr>
		{stocks}
		<tr>
			<td>{code}</td>
			<td>{name}</td>
			<td>{category}</td>
			<td>{value}</td>
		</tr>
		{/stocks}
	</table>
	<div class="row">
		<div class="col-xs-6">
			<h2>Movements</h2>
			<table class="table">
				{themoves}
			</table>
		</div>
		<div class="col-xs-6">
			<h2>Transactions</h2>
			<table class="table">
				{thetrans}
			</table>
		</div>
	</div>
</div>
