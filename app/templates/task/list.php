<?php
	echo "<ul>";
	foreach $list as $task{
		
		echo "<li>";
		echo $task->getName();
		echo "</li>"


	}
	echo "</ul>";