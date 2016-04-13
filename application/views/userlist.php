<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Present list of agents & users
 */
?>
<div>
	<h1>Our Community</h1>
	<table class="table">
		<tr><th>Team</th><th>Name</th><th>Role</th><th>Players</th></tr>
		{users}
		<tr>
			<td>{code}</td>
			<td>{name}</td>
			<td>{role}</td>
			<td>{players}</td>
		</tr>
		{/users}
	</table>
	<div class="alert alert-info">The agents shown above have either registered for the next round or they 
		were active during the last round of trading.</div>
</div>
