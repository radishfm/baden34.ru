<?php
/**
 * Function for Debug by Admins
 * @param $result
 * @param bool $types
 */
function dump($result, $types = false)
{
	global $USER;
	if ($USER && $USER->IsAdmin())
	{
		echo "<pre>";
		if ($types) {
			var_dump($result);
		} else {
			print_r($result);
		}
		echo "</pre>";
	}
}