<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Present list of transactions
 */
?>
<div>
	<h1>Transaction History</h1>
	<table class="table">
		<tr><th>#</th><th>Date/Time</th><th>Agent</th><th>Player</th><th>Action</th><th>Quantity</th><th>Series</th></tr>
		{transactions}
		<tr>
			<td>{seq}</td>
			<td>{datetime}</td>
			<td>{agent}</td>
			<td>{player}</td>
			<td>{trans}</td>
			<td>{quantity}</td>
			<td>{stock}</td>
		</tr>
		{/transactions}
	</table>
	<div class="alert alert-info">The transactions shown above are those for 
		the current or most recent round of trading.</div>
</div>
