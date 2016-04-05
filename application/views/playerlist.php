<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Present list of known series
 */
?>
<div>
	<h1>BSX Players</h1>
	<table class="table">
		<tr><th>Agent</th><th>Player</th><th>Cash</th><th>Last round</th></tr>
		{players}
		<tr>
			<td>{agent}</td>
			<td>{player}</td>
			<td>{cash}</td>
			<td>{round}</td>
		</tr>
		{/players}
	</table>
	<div class="alert alert-info">The players shown above are those 
		active during the current or previous round.
	</div>
</div>
