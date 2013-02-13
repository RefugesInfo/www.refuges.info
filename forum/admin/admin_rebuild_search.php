<?php

/***************************************************************************
 *                           admin_rebuild_search.php
 *                           ------------------------
 *     begin                : Mon May 9 2005
 *     copyright            : (C) 2001 The phpBB Group
 *     email                : support@phpbb.com
 *
 *     $Id: admin_rebuild_search.php,v 2.4.0.0 2006/06/17 18:38:17 chatasos Exp $
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

define ('IN_PHPBB', true);

if ( !empty($setmodules) )
{
	$filename = basename(__FILE__);
	$module['General']['Rebuild_Search'] = $filename;
	return;
}

//
// Let's set the root dir for phpBB
//
$no_page_header = true;
$phpbb_root_path = "./../";
require($phpbb_root_path . 'extension.inc');
require('./pagestart.' . $phpEx);
require($phpbb_root_path . 'includes/functions_search.'.$phpEx);
require($phpbb_root_path . 'includes/functions_admin_rebuild_search.'.$phpEx);

//
// Language File
//
include($phpbb_root_path.'language/lang_'.$board_config['default_lang'].'/lang_admin_rebuild_search.'.$phpEx);


// define some constants
define('SEARCH_REBUILD_TABLE', $table_prefix.'search_rebuild');

define('REBUILD_SEARCH_PROCESSED', 1);	// when a batch of posts has been processed
define('REBUILD_SEARCH_ABORTED', 0);	// when the user aborted the processing
define('REBUILD_SEARCH_COMPLETED', 2);	// when all the db posts have been processed

define('REBUILD_SEARCH_VERSION', '2.4.0');

//
// Define initial vars
//

// These are the default values
// You can change them if you want
$def_post_limit = 50;	// posts
$def_refresh_rate = 3;	// secs
$def_time_limit = 300;	// secs

$fast_post_limit = 20;	// posts
$fast_refresh_rate = 0;	// secs
$fast_time_limit = 60;	// secs


// find the mode we are in
if ( isset($HTTP_GET_VARS['mode']) || isset($HTTP_POST_VARS['mode'])  )
{
	$mode = ( isset($HTTP_POST_VARS['mode']) ) ? htmlspecialchars($HTTP_POST_VARS['mode']) : htmlspecialchars($HTTP_GET_VARS['mode']);
}
else
{
	$mode = '';
}

// check if we should process in fast mode
$fast_mode = ( isset($HTTP_GET_VARS['fast_mode']) || isset($HTTP_POST_VARS['fast_mode']) ) ? true : false;

// $disable_board values:
//
// 0 : board is enabled
// 1 : board is disabled
// 2 : board is disabled through admin config

// when refreshing, check the 'disable_board' parameter
if ( $mode == 'refresh' )
{
	if ( isset($HTTP_GET_VARS['disable_board']) || isset($HTTP_POST_VARS['disable_board']) )
	{
		$disable_board = ( isset($HTTP_POST_VARS['disable_board']) ) ? intval($HTTP_POST_VARS['disable_board']) : intval($HTTP_GET_VARS['disable_board']);
	}
	else
	{
		$disable_board = 0;
	}
}
// when pressing submit, check 'disabled_board_status' parameter and then 'disable_board' checkbox
else if ( $mode == 'submit' )
{
	if ( isset($HTTP_GET_VARS['disabled_board_status']) || isset($HTTP_POST_VARS['disabled_board_status']) )
	{
		$disable_board = 2;
	}
	else
	{
		$disable_board = ( isset($HTTP_GET_VARS['disable_board']) || isset($HTTP_POST_VARS['disable_board']) ) ? 1 : 0;
	}
}
else	// when starting the mod, check the admin config
{
	if ( $board_config['board_disable'] )
	{
		$disable_board = 2;
	}
	else
	{
		$disable_board = 0;
	}
}


// check if the user has choosen to stop processing
if ( isset($HTTP_GET_VARS['cancel_button']) || isset($HTTP_POST_VARS['cancel_button'])  )
{
	// enable the board, only when it was disabled through this mod
	if ( $disable_board == 1 )
	{
		change_board_status('enable');
	}

	$end_post_id = get_rebuild_session_details('last', 'end_post_id');

	// update the rebuild_status
	$sql = "UPDATE " . SEARCH_REBUILD_TABLE . "
		SET rebuild_session_status = " . REBUILD_SEARCH_ABORTED . "
		WHERE rebuild_session_id = " . get_last_rebuild_session_id();

	if ( !$db->sql_query($sql) )
	{
		message_die(GENERAL_ERROR, 'Could not update rebuild session status', '', __LINE__, __FILE__, $sql);
	}

	$message =  sprintf($lang['Rebuild_search_aborted'], $end_post_id).'<br /><br />'.sprintf($lang['Click_return_rebuild_search'], '<a href="'.append_sid("admin_rebuild_search.$phpEx").'">', '</a>');
	message_die(GENERAL_MESSAGE, $message);
}

// from which post to start processing
if ( isset($HTTP_GET_VARS['start']) || isset($HTTP_POST_VARS['start']) )
{
	$start = ( isset($HTTP_POST_VARS['start']) ) ? intval($HTTP_POST_VARS['start']) : intval($HTTP_GET_VARS['start']);
}
else
{
	$start = -1;
}

// clear the search tables or not
if ( isset($HTTP_GET_VARS['clear_search']) || isset($HTTP_POST_VARS['clear_search']) )
{
	$clear_search = ( isset($HTTP_POST_VARS['clear_search']) ) ? intval($HTTP_POST_VARS['clear_search']) : intval($HTTP_GET_VARS['clear_search']);;
}
else
{
	$clear_search = 0;
}

// get the total number of posts in the db
$total_posts = get_total_posts();

// get the number of total/session posts already processed
$total_posts_processed = ( $start != 0 ) ? get_total_posts('before', get_rebuild_session_details('last', 'end_post_id')) : 0;
$session_posts_processed = ( $mode == 'refresh' ) ? get_processed_posts('session') : 0;

// find how many posts aren't processed
$total_posts_processing = $total_posts - $total_posts_processed;

// how many posts to process in this session
if ( isset($HTTP_GET_VARS['session_posts_processing']) || isset($HTTP_POST_VARS['session_posts_processing']) )
{
	$session_posts_processing = ( isset($HTTP_POST_VARS['session_posts_processing']) ) ? intval($HTTP_POST_VARS['session_posts_processing']) : intval($HTTP_GET_VARS['session_posts_processing']);

	if ( $mode == 'submit' )
	{
		// check if we passed over total_posts just after submitting
		if ( $session_posts_processing + $total_posts_processed > $total_posts )
		{
			$session_posts_processing = $total_posts - $total_posts_processed;
		}
	}

	// correct it when posts are deleted during processing
	$session_posts_processing = ( $session_posts_processing > $total_posts) ? $total_posts : $session_posts_processing;
}
else
{
	// if we have finished, get all the posts, else only the remaining
	$session_posts_processing = ( $total_posts_processing == 0 ) ? $total_posts : $total_posts_processing;
}

// how many posts to process per cycle
if ( isset($HTTP_GET_VARS['post_limit']) || isset($HTTP_POST_VARS['post_limit']) )
{
	$post_limit = ( isset($HTTP_POST_VARS['post_limit']) ) ? intval($HTTP_POST_VARS['post_limit']) : intval($HTTP_GET_VARS['post_limit']);
}
else
{
	$post_limit = $def_post_limit;
}

// correct the post_limit when we pass over it
if ( $session_posts_processed + $post_limit > $session_posts_processing )
{
	$post_limit = $session_posts_processing - $session_posts_processed;
}

// how much time to wait per cycle
if ( isset($HTTP_GET_VARS['time_limit']) || isset($HTTP_POST_VARS['time_limit']) )
{
	$time_limit = ( isset($HTTP_POST_VARS['time_limit']) ) ? intval($HTTP_POST_VARS['time_limit']) : intval($HTTP_GET_VARS['time_limit']);
}
else
{
	$time_limit = $def_time_limit;
  	$time_limit_explain = $lang['Time_limit_explain'];

	// check for safe mode timeout
	if ( ini_get('safe_mode') )
	{
		// get execution time
		$max_execution_time = ini_get('max_execution_time');
		$time_limit_explain .= '<br />' . sprintf($lang['Time_limit_explain_safe'], $max_execution_time);

		if ( $time_limit > $max_execution_time )
		{
			$time_limit = $max_execution_time;
		}
	}

	// check for webserver timeout (IE returns null)
	if ( isset($HTTP_SERVER_VARS["HTTP_KEEP_ALIVE"]) )
	{
		// get webserver timeout
		$webserver_timeout = intval($HTTP_SERVER_VARS["HTTP_KEEP_ALIVE"]);
		$time_limit_explain .= '<br />' . sprintf($lang['Time_limit_explain_webserver'], $webserver_timeout);

		if ( $time_limit > $webserver_timeout )
		{
			$time_limit = $webserver_timeout;
		}
	}
}

// how much time to wait between page refreshes
if ( isset($HTTP_GET_VARS['refresh_rate']) || isset($HTTP_POST_VARS['refresh_rate']) )
{
	$refresh_rate = ( isset($HTTP_POST_VARS['refresh_rate']) ) ? intval($HTTP_POST_VARS['refresh_rate']) : intval($HTTP_GET_VARS['refresh_rate']);
}
else
{
	$refresh_rate = $def_refresh_rate;
}

// check if the user gave wrong input
if ( $mode == 'submit' )
{
	if ( $session_posts_processing <= 0 || $post_limit <= 0 || $refresh_rate < 0 || $time_limit <=0 )
	{
		$message =  $lang['Wrong_input'].'<br /><br />'.sprintf($lang['Click_return_rebuild_search'], '<a href="'.append_sid("admin_rebuild_search.$phpEx").'">', '</a>');
		message_die(GENERAL_MESSAGE, $message);
	}
}

//
// Increase maximum execution time in case of a lot of posts, but don't complain about it if it isn't
// allowed.
//
@set_time_limit($time_limit + 50);


//
// Main code starts from here
//

// check if we are should start processing
if ( $mode == 'submit' || $mode == 'refresh' )
{
	// disable the board if we asked so
	if ( $mode == 'submit' && $disable_board == 1 )
	{
		change_board_status('disable');
	}

	// check if we are in the beginning of processing
	if ( $start == 0 )
	{
		clear_search_tables($clear_search);
	}

	// get the db sizes
	list($db_size, $search_tables_size) = get_db_sizes();

	//
	// start the cycle timer
	//----------------
	$cycle_start_time = time();

	// get the post subject/text of each post
	$sql = "SELECT post_id, post_subject, post_text
		FROM " . POSTS_TEXT_TABLE . "
			WHERE post_id >= $start
			ORDER BY post_id ASC
			LIMIT $post_limit";

	if( !($result = $db->sql_query($sql)) )
	{
		message_die(GENERAL_ERROR, 'Could not obtain posts', '', __LINE__, __FILE__, $sql);
	}

	// insert the words of each post into the search tables
	// this is the most time consuming part of our code
	$start_post_id = 0;
	$end_post_id = 0;

	$temp_time = array();
	$timer_expired = false;

	$num_rows = 0;
	while ( ($row = $db->sql_fetchrow($result)) && ($timer_expired == false) )
	{
		// used for calculating loop duration and changing the timer condition
		$start_temp_time = time();

		// check if we're using fast mode
		if ( !$fast_mode )
		{
			// remove the words only when fast mode is disabled
			// we can remove words from multiple posts simultaneusly since the function parameter is a comma seperated string
			remove_search_post($row['post_id']);
		}
		
		// add the words
		add_search_words('single', $row['post_id'], stripslashes($row['post_text']), stripslashes($row['post_subject']));

		// store first/last post_id of each cycle
		if ( $num_rows == 0 )
		{
			$start_post_id = $row['post_id'];
		}
		$end_post_id = $row['post_id'];

		// calculate time for each loop iteration
		$temp_time[$num_rows] = time() - $start_temp_time;
		// get the max
		$timer_time = max($temp_time);

		// check if timer is about to expire
		if ( time() - $cycle_start_time >= $time_limit - $timer_time )
		{
			$timer_expired_secs = time() - $cycle_start_time;
			$timer_expired = true;
		}

		$num_rows++;
	}

	//
	// end the timer
	//--------------
	$cycle_end_time = time();

	// find how much time the last cycle took
	$last_cycle_time = $cycle_end_time - $cycle_start_time;

	// check if we had any data
	if ( $num_rows != 0 )
	{
		if ( $mode == 'submit' )
		{
			// insert a new session entry
			$sql = "INSERT INTO " . SEARCH_REBUILD_TABLE . "
				(start_post_id, end_post_id, start_time, end_time, last_cycle_time, session_time, session_posts, session_cycles, search_size, rebuild_session_status)
				VALUES ($start_post_id, $end_post_id, $cycle_start_time, $cycle_end_time, $last_cycle_time, $last_cycle_time, $num_rows, 1, " . intval($search_tables_size). ", " . REBUILD_SEARCH_PROCESSED . ")";
		}
		else	// refresh
		{
			// update the last session entry
			$sql = "UPDATE " . SEARCH_REBUILD_TABLE . "
				SET
					end_post_id = $end_post_id,
					end_time = $cycle_end_time,
					last_cycle_time = $last_cycle_time,
					session_time = session_time + $last_cycle_time,
					session_posts = session_posts + $num_rows,
					session_cycles = session_cycles + 1,
					rebuild_session_status = " . REBUILD_SEARCH_PROCESSED . "
				WHERE rebuild_session_id = " . get_last_rebuild_session_id();
		}

		if ( !$db->sql_query($sql) )
		{
			message_die(GENERAL_ERROR, 'Could not insert/update rebuild search data', '', __LINE__, __FILE__, $sql);
		}
	}

	$template->set_filenames(array(
	    "body" 			=> "admin/rebuild_search_progress.tpl"
		)
	);

	$processing_messages = '';
	$processing_messages .= ( $timer_expired ) ? sprintf($lang['Timer_expired'], $timer_expired_secs) : '';
	$processing_messages .= ( $start == 0 && $clear_search ) ? $lang['Cleared_search_tables'] : '';

	// check if we have reached the end of our post processing
	$session_posts_processed = get_processed_posts('session');
	$total_posts_processed = get_total_posts('before', get_rebuild_session_details('last','end_post_id'));
	$total_posts = get_total_posts();

	// check if there is more data to be processed
	if ( $session_posts_processed < $session_posts_processing && $total_posts_processed < $total_posts )
	{
		$form_parameters = '&start='.($end_post_id + 1);
		$form_parameters .= '&session_posts_processing='.$session_posts_processing;
		$form_parameters .= '&post_limit='.$post_limit;
		$form_parameters .= '&time_limit='.$time_limit;
		$form_parameters .= '&refresh_rate='.$refresh_rate;
		$form_parameters .= '&disable_board='.$disable_board;
		$form_parameters .= ( $fast_mode ) ? '&fast_mode=1' : '';

		$form_action = append_sid('admin_rebuild_search.'.$phpEx.'?mode=refresh'.$form_parameters);

		$next_button = $lang['Next'];
		$progress_bar_img = $phpbb_root_path.$images['progress_bar'];

		$processing_messages .= sprintf($lang['Processing_next_posts'], $post_limit);

		// show the cancel button when refreshing
		$template->assign_block_vars("cancel_button", array(
			)
		);

		// create the meta tag for refresh
		$template->assign_vars(array(
			"META" => '<meta http-equiv="refresh" content="'.$refresh_rate.';url='.$form_action.'">')
		);
	}
	else	// processing has finished
	{
		$form_action = append_sid("admin_rebuild_search.$phpEx");

		$next_button = $lang['Finished'];
		$progress_bar_img = $phpbb_root_path.$images['progress_bar_full'];

		$processing_messages .= ( $session_posts_processed < $session_posts_processing ) ? sprintf($lang['Deleted_posts'], $session_posts_processing - $session_posts_processed) : '';
		$processing_messages .= ( $total_posts_processed == $total_posts ) ? $lang['All_posts_processed'] : $lang['All_session_posts_processed'];

		// if we have processed all the db posts, we need to update the rebuild_session_status
		$sql = "UPDATE " . SEARCH_REBUILD_TABLE . "
			SET rebuild_session_status = " . REBUILD_SEARCH_COMPLETED . "
			WHERE rebuild_session_id = " . get_last_rebuild_session_id() . "
				AND end_post_id = " . get_latest_post_id();

		if ( !$db->sql_query($sql) )
		{
			message_die(GENERAL_ERROR, 'Could not update rebuild session status', '', __LINE__, __FILE__, $sql);
		}
		
		// optimize all search tables when finished
		$table_ary = array(SEARCH_TABLE, SEARCH_WORD_TABLE, SEARCH_MATCH_TABLE);

		foreach ($table_ary as $table)
		{
			$sql = "OPTIMIZE TABLE " . $table;

			if ( !$db->sql_query($sql) )
			{
				message_die(GENERAL_ERROR, 'Could not optimize table', '', __LINE__, __FILE__, $sql);
			}
		}
		
		$processing_messages .= '<br />' . $lang['All_tables_optimized'];
		
		// check if we should enable the board
		if ( $disable_board == 1 )
		{
			change_board_status('enable');
		}
	}

	// calculate the percent
	$session_percent = ($session_posts_processed / $session_posts_processing) * 100;
	$total_percent = ($total_posts_processed / $total_posts) * 100;

	// get the db sizes
	list($db_size, $search_tables_size) = get_db_sizes();

	// calculate the final (estimated) values
	$final_search_tables_size = '';
	$final_db_size = '';

	if ( is_numeric($search_tables_size) )
	{
		$start_search_tables_size = get_rebuild_session_details('last', 'search_size');
		$final_search_tables_size = $start_search_tables_size + round(($search_tables_size - $start_search_tables_size) * (100 / $session_percent));

		if ( is_numeric($db_size) )
		{
			$final_db_size = $db_size + ($final_search_tables_size - $search_tables_size);
		}
	}

	// calculate various times
	$session_time = get_rebuild_session_details('last', 'session_time');
	$session_average_cycle_time = round($session_time / get_rebuild_session_details('last', 'session_cycles'));
	$session_estimated_time = round($session_time * (100 / $session_percent)) - $session_time;

	// create the output of page
	$page_title = $lang['Page_title'];
	include('./page_header_admin.'.$phpEx);

	// create the percent boxes
	create_percent_box('session', create_percent_color($session_percent), $session_percent);
	create_percent_box('total', create_percent_color($total_percent), $total_percent);

	$template->assign_vars(array(
		'L_REBUILD_SEARCH_PROGRESS'	=> $lang['Rebuild_search_progress'],
		'L_REBUILD_SEARCH'				=> $lang['Rebuild_search'],
		'L_NEXT'								=> $next_button,
		'L_PROCESSING'						=> $lang['Processing'],
		'L_CANCEL'							=> $lang['Cancel'],

		'L_PROCESSING_POST_DETAILS'	=> $lang['Processing_post_details'],
		'L_PROCESSED_POSTS'				=> $lang['Processed_posts'],
		'L_PERCENT'							=> $lang['Percent'],
		'L_CURRENT_SESSION'				=> $lang['Current_session'],
		'L_TOTAL'							=> $lang['Total'],

		'L_PROCESSING_TIME_DETAILS'	=> $lang['Processing_time_details'],
		'L_PROCESSING_TIME'				=> $lang['Processing_time'],
		'L_TIME_LAST_POSTS'				=> sprintf($lang['Time_last_posts'], $num_rows),
		'L_TIME_BEGINNING'				=> $lang['Time_from_the_beginning'],
		'L_TIME_AVERAGE'					=> $lang['Time_average'],
		'L_TIME_ESTIMATED'				=> $lang['Time_estimated'],

		'L_DATABASE_SIZE_DETAILS'		=> $lang['Database_size_details'],
		'L_SIZE_CURRENT'					=> $lang['Size_current'],
		'L_SIZE_ESTIMATED'				=> $lang['Size_estimated'],
		'L_SIZE_SEARCH_TABLES'			=> $lang['Size_search_tables'],
		'L_SIZE_DATABASE'					=> $lang['Size_database'],

		'L_ACTIVE_PARAMETERS'			=> $lang['Active_parameters'],
		'L_STARTING_POST_ID'				=> $lang['Starting_post_id'],
		'L_POSTS_LAST_CYCLE'				=> $lang['Posts_last_cycle'],
		'L_TIME_LIMIT'						=> $lang['Time_limit'],
		'L_BOARD_STATUS'					=> $lang['Board_status'],
		'L_FAST_MODE'						=> $lang['Fast_mode'],

		'L_ESTIMATED_VALUES'				=> $lang['Info_estimated_values'],

		'PROCESSING_POSTS'			=> sprintf($lang['Processed_post_ids'], $start_post_id, $end_post_id),
		'PROCESSING_MESSAGES'		=> $processing_messages,
		'PROGRESS_BAR_IMG'			=> $progress_bar_img,

		'SESSION_DETAILS'			=> sprintf($lang['Process_details'], $session_posts_processed - $num_rows + 1, $session_posts_processed, $session_posts_processing),
		'SESSION_PERCENT' 		=> sprintf($lang['Percent_completed'], round($session_percent, 2)),

		'TOTAL_DETAILS'			=> sprintf($lang['Process_details'], $total_posts_processed - $num_rows + 1, $total_posts_processed, $total_posts),
		'TOTAL_PERCENT' 			=> sprintf($lang['Percent_completed'], round($total_percent, 2)),

		'LAST_CYCLE_TIME'					=> create_time($last_cycle_time),
		'SESSION_TIME'						=> create_time($session_time),
		'SESSION_AVERAGE_CYCLE_TIME'	=> create_time($session_average_cycle_time),
		'SESSION_ESTIMATED_TIME'		=> create_time($session_estimated_time),

		'SEARCH_TABLES_SIZE' 		=> create_db_size($search_tables_size),
		'FINAL_SEARCH_TABLES_SIZE' => create_db_size($final_search_tables_size),
		'DB_SIZE'						=> create_db_size($db_size),
		'FINAL_DB_SIZE'				=> create_db_size($final_db_size),

		'START_POST'		=> get_rebuild_session_details('last', 'start_post_id'),
		'POST_LIMIT'		=> $num_rows,
		'TIME_LIMIT'		=> $time_limit,
		'REFRESH_RATE'		=> $refresh_rate,
		'BOARD_STATUS'		=> ( $disable_board != 0 ) ? $lang['Board_disabled'] : $lang['Board_enabled'],
		'FAST_MODE'			=> ( !$fast_mode ) ? $lang['Board_disabled'] : $lang['Board_enabled'],

		'REBUILD_SEARCH_VERSION'	=> REBUILD_SEARCH_VERSION,

		'S_REBUILD_SEARCH_ACTION' => $form_action)
	);
}
else	// show the input page
{
	// create the page
	$page_title = $lang['Page_title'];
	include('./page_header_admin.'.$phpEx);

	$template->set_filenames(array(
	    "body" => "admin/rebuild_search.tpl")
	);

	// calculate the maximum value for post_limit
	$post_limit_max = ( $def_post_limit > $total_posts ) ? $total_posts : $def_post_limit;

	//$s_hidden_fields = '<input type="hidden" name="post_limit_stored" value="'.$post_limit_max.'" />';
	//$s_hidden_fields .= '<input type="hidden" name="total_posts_stored" value="'.$total_posts.'" />';

	// create the info about last processing status
	$last_session_details = array();
	$last_session_details = get_rebuild_session_details('last', 'all');

	$next_start_post_id = 0;
	$last_saved_processing = '';
	$clear_search_disabled = '';

	if ( !empty($last_session_details) )
	{
		$last_saved_post_id = $last_session_details['end_post_id'];
		$next_start_post_id = $last_saved_post_id + 1;
		$last_saved_date = create_date($board_config['default_dateformat'], $last_session_details['end_time'], $board_config['board_timezone']);

		// check our last status
		if ( $last_session_details['rebuild_session_status'] == REBUILD_SEARCH_PROCESSED )
		{
			$last_saved_processing = sprintf($lang['Info_processing_stopped'], $last_saved_post_id, $total_posts_processed, $last_saved_date);
			$clear_search_disabled = 'disabled="disabled"';

			$template->assign_block_vars("start_select_input", array());
		}
		elseif ( $last_session_details['rebuild_session_status'] == REBUILD_SEARCH_ABORTED )
		{
			$last_saved_processing = sprintf($lang['Info_processing_aborted'], $last_saved_post_id, $total_posts_processed, $last_saved_date);
			// check if the interrupted cycle has finished
			if ( time() - $last_session_details['end_time'] < $last_session_details['last_cycle_time'] )
			{
				$last_saved_processing .= '<br />'.$lang['Info_processing_aborted_soon'];
			}
			$clear_search_disabled = 'disabled="disabled"';

			$template->assign_block_vars("start_select_input", array());
		}
		else	// when finished
		{
			if ( $last_session_details['end_post_id'] < get_latest_post_id() )
			{
				$last_saved_processing = sprintf($lang['Info_processing_finished_new'], $last_saved_post_id, $total_posts_processed, $last_saved_date, ($total_posts - $total_posts_processed));
				$clear_search_disabled = 'disabled="disabled"';

				$template->assign_block_vars("start_select_input", array());
			}
			else
			{
				$last_saved_processing = sprintf($lang['Info_processing_finished'], $total_posts, $last_saved_date);

				$template->assign_block_vars("start_text_input", array());
			}
		}

		$template->assign_block_vars("last_saved_info", array());
	}
	else
	{
		$template->assign_block_vars("start_text_input", array());
	}

	// create the output of page
	$template->assign_vars(array(
		'L_REBUILD_SEARCH'		=> $lang['Rebuild_search'],
		'L_REBUILD_SEARCH_DESC'	=> $lang['Rebuild_search_desc'],

		'L_STARTING_POST_ID'				=> $lang['Starting_post_id'],
		'L_STARTING_POST_ID_EXPLAIN'	=> $lang['Starting_post_id_explain'],

		'L_START_OPTION_BEGINNING'	=> $lang['Start_option_beginning'],
		'L_START_OPTION_CONTINUE'	=> $lang['Start_option_continue'],

		'L_CLEAR_SEARCH_TABLES'				=> $lang['Clear_search_tables'],
		'L_CLEAR_SEARCH_TABLES_EXPLAIN'	=> $lang['Clear_search_tables_explain'],

		'L_CLEAR_SEARCH_NO'			=>	$lang['Clear_search_no'],
		'L_CLEAR_SEARCH_DELETE'		=>	$lang['Clear_search_delete'],
		'L_CLEAR_SEARCH_TRUNCATE'	=>	$lang['Clear_search_truncate'],

		'L_NUM_OF_POSTS'				=> $lang['Num_of_posts'],
		'L_NUM_OF_POSTS_EXPLAIN'	=> $lang['Num_of_posts_explain'],

		'L_POSTS_PER_CYCLE'				=> $lang['Posts_per_cycle'],
		'L_POSTS_PER_CYCLE_EXPLAIN'	=> $lang['Posts_per_cycle_explain'],

		'L_REFRESH_RATE'				=> $lang['Refresh_rate'],
		'L_REFRESH_RATE_EXPLAIN'	=> $lang['Refresh_rate_explain'],

		'L_TIME_LIMIT'				=> $lang['Time_limit'],
		'L_TIME_LIMIT_EXPLAIN'	=> $time_limit_explain,

		'L_DISABLE_BOARD'				=> $lang['Disable_board'],
		'L_DISABLE_BOARD_EXPLAIN'	=> $lang['Disable_board_explain'].'<br />'.(( $disable_board == 2 ) ? $lang['Disable_board_explain_already'] : $lang['Disable_board_explain_enabled']),

		'L_FAST_MODE'				=> $lang['Fast_mode'],
		'L_FAST_MODE_EXPLAIN'	=> $lang['Fast_mode_explain'],

		'L_PROCESSING'					=> $lang['Processing'],

		'TOTAL_POSTS'					=> $total_posts,
		'POST_LIMIT_MAX'				=> $post_limit_max,
		'BOARD_STATUS_DISABLED'		=> ( $disable_board == 2 ) ? "true" : "false",
		'FAST_POST_LIMIT'				=> $fast_post_limit,
		'FAST_TIME_LIMIT'				=> $fast_time_limit,
		'FAST_REFRESH_RATE'			=> $fast_refresh_rate,

		'NEXT_START_POST_ID'			=> $next_start_post_id,
		'CLEAR_SEARCH_DISABLED'		=> $clear_search_disabled,
		'SESSION_POSTS_PROCESSING'	=> $session_posts_processing,
		'POST_LIMIT'					=> $post_limit,
		'TIME_LIMIT'					=> $time_limit,
		'REFRESH_RATE'					=> $refresh_rate,
		'BOARD_DISABLED'				=> ( $disable_board == 2 ) ? 'disabled="disabled" checked="checked"' : '',

		'LAST_SAVED_PROCESSING'		=> $last_saved_processing,

		'SESSION_ID' 					=> $userdata['session_id'],

		'REBUILD_SEARCH_VERSION'	=> REBUILD_SEARCH_VERSION,

		//'S_HIDDEN_FIELDS'				=> $s_hidden_fields,
		'S_REBUILD_SEARCH_ACTION'	=> append_sid("admin_rebuild_search.$phpEx?mode=submit" . (( $disable_board == 2 ) ? "&disabled_board_status=$disable_board" : ""))
		)
	);
}

$template->pparse('body');

//
// Page Footer
//
include('./page_footer_admin.'.$phpEx);

?>
