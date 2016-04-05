<?php

defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * views/dataview.php
 *
 * Present the data that can be requested
 *
 */
?>
<div>
    <h1>Data available</h1>
	<p>The following data can be requested here, and will be returned as CSV.</p>
	<ul>
		{available}
		<li><a href="/data/{datum}">{datum}</a></li>
		{/available}
	</ul>
</div>
