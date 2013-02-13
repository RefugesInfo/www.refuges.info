<?php

/***************************************************************************
 *                           functions_admin_rebuild_search.php
 *                           ----------------------------------
 *     begin                : Mon Aug 22 2005
 *     copyright            : (C) 2001 The phpBB Group
 *     email                : support@phpbb.com
 *
 *     $Id: functions_admin_rebuild_search.php,v 2.4.0.0 2006/02/04 18:38:17 chatasos Exp $
 *
 ****************************************************************************/

/***************************************************************************
 *
 *   This program is free software; you can redistribute it and/or modify
 *   it under the terms of the GNU General Public License as published by
 *   the Free Software Foundation; either version 2 of the License, or
 *   (at your option) any later version.
 *
 ***************************************************************************/

function get_db_sizes()
{
	global $db, $table_prefix, $dbname;

	// some code taken from admin/index.php
	//
	// DB size ... MySQL only
	//
	// This code is heavily influenced by a similar routine
	// in phpMyAdmin 2.2.0
	//
	if( preg_match("/^mysql/", SQL_LAYER) )
	{
		$sql = "SELECT VERSION() AS mysql_version";
		if($result = $db->sql_query($sql))
		{
			$row = $db->sql_fetchrow($result);
			$version = $row['mysql_version'];

			if( preg_match("/^(3\.23|4\.|5\.)/", $version) )
			{
				$db_name = ( preg_match("/^(3\.23\.[6-9])|(3\.23\.[1-9][1-9])|(4\.)|(5\.)/", $version) ) ? "`$dbname`" : $dbname;

				$sql = "SHOW TABLE STATUS
					FROM " . $db_name;

				if($result = $db->sql_query($sql))
				{
					$tabledata_ary = $db->sql_fetchrowset($result);

					$db_size = 0;
					$search_size = 0;	// added

					for($i = 0; $i < count($tabledata_ary); $i++)
					{
						if( $tabledata_ary[$i]['Type'] != "MRG_MyISAM" )
						{
							if( $table_prefix != "" )
							{
								if( strstr($tabledata_ary[$i]['Name'], $table_prefix) )
								{
									$db_size += $tabledata_ary[$i]['Data_length'] + $tabledata_ary[$i]['Index_length'];
								}
							}
							else
							{
								$db_size += $tabledata_ary[$i]['Data_length'] + $tabledata_ary[$i]['Index_length'];
							}

							// calculate the size of the search tables only
							if ( $tabledata_ary[$i]['Name'] == SEARCH_WORD_TABLE || $tabledata_ary[$i]['Name'] == SEARCH_MATCH_TABLE )
							{
								$search_size += $tabledata_ary[$i]['Data_length'] + $tabledata_ary[$i]['Index_length'];
							}
						}
					}
				} // Else we couldn't get the table status.
			}
			else
			{
				$db_size = '';			// changed
				$search_size = '';	// changed
			}
		}
		else
		{
			$db_size = '';			// changed
			$search_size = '';	// changed
		}
	}
	else if( preg_match("/^mssql/", SQL_LAYER) )
	{
		$sql = "SELECT ((SUM(size) * 8.0) * 1024.0) as dbsize
			FROM sysfiles";

		if( $result = $db->sql_query($sql) )
		{
			$db_size = ( $row = $db->sql_fetchrow($result) ) ? intval($row['dbsize']) : '';	// changed
			$search_size = '';	// added
		}
		else
		{
			$db_size = '';			// changed
			$search_size = '';	// added
		}
	}
	else
	{
		$db_size = '';				// changed
		$search_size = '';		// added
	}

	return array($db_size, $search_size);
}

// convert numeric value to x Bytes string
function create_db_size($db_size)
{
	global $lang;

	if ( $db_size != '' && is_numeric($db_size) )
	{
		if( $db_size >= 1048576 )
		{
			$db_size = sprintf("%.2f MB", ( $db_size / 1048576 ));
		}
		else if( $db_size >= 1024 )
		{
			$db_size = sprintf("%.2f KB", ( $db_size / 1024 ));
		}
		else
		{
			$db_size = sprintf("%.2f ".$lang['Bytes'], $db_size);
		}
	}
	else
	{
		$db_size = $lang['Not_available'];
	}

	return $db_size;
}

// convert time values (seconds) to "number of days, hours, minutes and seconds"
function create_time($seconds)
{
	global $lang;

	$days = 0;
	$hours = 0;
	$minutes = 0;

	while ( $seconds >= 60 )
	{
		if ( $seconds >= 86400 )
		{
			// more than 1 day
			$days = floor($seconds / 86400);
			$seconds = $seconds - ($days * 86400);
		}
		elseif ( $seconds >= 3600 )
		{
			// more than 1 hour
			$hours = floor($seconds / 3600);
			$seconds = $seconds - ($hours * 3600);
		}
		elseif ( $seconds >= 60 )
		{
			$minutes = floor($seconds / 60);
			$seconds = $seconds - ($minutes * 60);
		}
	}

	return sprintf("%02d", $days).' '.$lang['days'].', '.sprintf("%02d", $hours).' '.$lang['hours'].', '.sprintf("%02d", $minutes).' '.$lang['minutes'].', '.sprintf("%02d", $seconds).' '.$lang['seconds'];
}

// get the latest post_id in the forum
function get_latest_post_id()
{
	global $db;

	$sql = "SELECT post_id FROM " . POSTS_TEXT_TABLE . "
		ORDER BY post_id DESC
		LIMIT 1";

	if ( !($result = $db->sql_query($sql)) )
	{
		message_die(GENERAL_ERROR, 'Could not obtain latest post', '', __LINE__, __FILE__, $sql);
	}

	$row = $db->sql_fetchrow($result);

	return ( $row['post_id'] ) ? $row['post_id'] : 0;
}

// get the last rebuild_session_id
function get_last_rebuild_session_id()
{
	global $db;

	$sql = "SELECT rebuild_session_id FROM " . SEARCH_REBUILD_TABLE . "
		ORDER BY rebuild_session_id DESC
		LIMIT 1";

	if ( !($result = $db->sql_query($sql)) )
	{
		message_die(GENERAL_ERROR, 'Could not obtain rebuild session id', '', __LINE__, __FILE__, $sql);
	}

	$row = $db->sql_fetchrow($result);

	return ( $row['rebuild_session_id'] ) ? $row['rebuild_session_id'] : 0;
}


// get some or all of the rebuild details of a specific session or of the last session
// $id is the id or the 'last' id
// $details is one of the fields or 'all' of them
function get_rebuild_session_details($id, $details = 'all')
{
	global $db;

	if ( $id != 'last' )
	{
		$sql = "SELECT * FROM " . SEARCH_REBUILD_TABLE . "
			WHERE rebuild_session_id = $id";
	}
	else
	{
		$sql = "SELECT * FROM " . SEARCH_REBUILD_TABLE . "
			ORDER BY rebuild_session_id DESC
			LIMIT 1";
	}

	if ( !($result = $db->sql_query($sql)) )
	{
		message_die(GENERAL_ERROR, 'Could not obtain rebuild details', '', __LINE__, __FILE__, $sql);
	}

	$row = $db->sql_fetchrow($result);

	if ( !empty($row) )
	{
		$return_details = ( $details == 'all') ? $row : $row[$details];

		return ( !empty($return_details) ) ? $return_details : 0;
	}
	else
	{
		return 0;
	}
}

// get the number of processed posts in the last session or in all sessions
//
// 'total' to get the sum of posts of all sessions
// 'session' to get the posts of the last session
function get_processed_posts($mode = 'total')
{
	global $db;

	if ( $mode == 'total' )
	{
		$sql = "SELECT SUM(session_posts) as posts FROM " . SEARCH_REBUILD_TABLE;
	}
	else	// $mode = session
	{
		$sql = "SELECT session_posts as posts FROM " . SEARCH_REBUILD_TABLE . "
		WHERE rebuild_session_id = " . get_last_rebuild_session_id();
	}

	if ( !($result = $db->sql_query($sql)) )
	{
		message_die(GENERAL_ERROR, 'Could not obtain number of posts', '', __LINE__, __FILE__, $sql);
	}

	$row = $db->sql_fetchrow($result);

	return ( $row['posts'] ) ? $row['posts'] : 0;
}

// how many posts are in the db before or after a specific post_id
// after/before include the post_id too
function get_total_posts($mode = 'after', $post_id = 0)
{
	global $db;

	$sql = "SELECT COUNT(post_id) as total_posts FROM " . POSTS_TABLE . "
		WHERE post_id " . (($mode == 'after') ? '>= ' : '<= ' ) . $post_id;

	if ( !($result = $db->sql_query($sql)) )
	{
		message_die(GENERAL_ERROR, 'Could not obtain number of posts', '', __LINE__, __FILE__, $sql);
	}

	$row = $db->sql_fetchrow($result);

	return ( $row['total_posts'] ) ? $row['total_posts'] : 0;
}

// clear the search tables
function clear_search_tables($clear_search)
{
	global $db;

	// initialize our own table
	$sql = "DELETE FROM " . SEARCH_REBUILD_TABLE;

	if( !$db->sql_query($sql) )
	{
		message_die(GENERAL_ERROR, 'Could not delete search rebuild table', '', __LINE__, __FILE__, $sql);
	}

	// initialize (clear) all 3 phpbb_search tables
	if ( $clear_search )
	{
		$table_ary = array(SEARCH_TABLE, SEARCH_WORD_TABLE, SEARCH_MATCH_TABLE);

		foreach ($table_ary as $table)
		{
			$sql = (( $clear_search == 1 ) ? "DELETE FROM " : "TRUNCATE TABLE " ) . $table;

			if( !$db->sql_query($sql) )
			{
				message_die(GENERAL_ERROR, 'Could not delete search table', '', __LINE__, __FILE__, $sql);
			}
		}
	}
}

// Create the percent color
// We use an array with the color percent limits.
// One color stays constantly at FF when the percent is between its limits
// and we adjust the other 2 accordingly to percent, from 200 to 0.
// We limit the result to 200, in order to avoid getting close to white (255).
function create_percent_color($percent)
{
	$percent_ary = array('g' => array(0,50),
								'b' => array(51,85),
								'r' => array(86,100)
								);

	foreach ($percent_ary as $key => $value)
	{
		if ( $percent <= $value[1] )
		{
			$percent_color = create_color($key, round(200-($percent-$value[0])*(200/($value[1]-$value[0]))));
			break;
		}
	}

	return $percent_color;
}

// create the hex representation of color
function create_color($mode, $code)
{
	return (($mode == 'r') ? 'FF': sprintf("%02X", $code)) . (($mode == 'g') ? 'FF': sprintf("%02X", $code)) . (($mode == 'b') ? 'FF': sprintf("%02X", $code));
}

// create the percent bar & box
function create_percent_box($box, $percent_color, $percent_width)
{
	global $template;

	$template->set_filenames(array(
		'percent_box' => 'admin/rebuild_search_percent.tpl')
	);

	$template->assign_vars(array(
		'PERCENT_COLOR'	=> $percent_color,
		'PERCENT_WIDTH'	=> round($percent_width)
		)
	);

	if ( $box == 'session' )
	{
		$template->assign_var_from_handle('SESSION_PERCENT_BOX', 'percent_box');
	}
	else
	{
		$template->assign_var_from_handle('TOTAL_PERCENT_BOX', 'percent_box');
	}

	return;
}

// enable/disable the board
function change_board_status($state = 'enable')
{
	global $db;

	$sql = "UPDATE " . CONFIG_TABLE . "
		SET config_value = " . ( ( $state == 'enable' ) ? 0 : 1 ) . "
		WHERE config_name = 'board_disable'";

	if ( !$db->sql_query($sql) )
	{
		message_die(GENERAL_ERROR, 'Could not disable/enable board', '', __LINE__, __FILE__, $sql);
	}
}

?>
