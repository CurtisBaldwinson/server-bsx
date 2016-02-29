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
    <h1>Rule! The! Market!</h1>
	<p>Active agents: {theagents}</p>
	<p>Current stocks: {thestocks}</p>
	<p>Stocks issued: {thecerts}</p>
	<div class="row">
		<div class="col-xs-6">
			<h2>Recent Movements</h2>
			<table class="table">
				{themoves}
			</table>
		</div>
		<div class="col-xs-6">
			<h2>Recent Transactions</h2>
			<table class="table">
				{thetrans}
			</table>
		</div>
	</div>
</div>
