<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Present list of transactions
 */
?>
<div>
	<h1>Stock Certificates Issued</h1>
	<table class="table">
		<tr><th>#</th><th>Stock</th><th>Agent</th><th>Player</th><th>Amount</th><th>Date/Time</th></tr>
		{issued}
		<tr>
			<td>{token}</td>
			<td>{stock}</td>
			<td>{agent}</td>
			<td>{player}</td>
			<td>{amount}</td>
			<td>{datetime}</td>
		</tr>
		{/issued}
	</table>
	<div class="alert alert-info">The stock certificates shown above are those 
		outstanding at the end of the most recent round of trading.</div>
</div>
