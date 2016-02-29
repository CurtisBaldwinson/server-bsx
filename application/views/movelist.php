<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Present list of transactions
 */
?>
<div>
	<h1>Stock Movement</h1>
	<table class="table">
		<tr><th>#</th><th>Date/Time</th><th>Stock</th><th>Action</th><th>Amount</th></tr>
		{movement}
		<tr>
			<td>{id}</td>
			<td>{datetime}</td>
			<td>{code}</td>
			<td>{action}</td>
			<td>{amount}</td>
		</tr>
		{/movement}
	</table>
	<div class="alert alert-info">The stock movements shown above are those for 
		the current or most recent round of trading.</div>
</div>
