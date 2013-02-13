<?php

/***************************************************************************
 *                       lang_admin_rebuild_search.php [English]
 *                       ---------------------------------------
 *     begin                : Mon Aug 22 2005
 *     copyright            : (C) 2001 The phpBB Group
 *     email                : support@phpbb.com
 *
 *     $Id: lang_admin_rebuild_search.php,v 2.4.0.0 2006/06/17 18:38:17 chatasos Exp $
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

$lang['Rebuild_search'] = 'Rebuild Search';
$lang['Rebuild_search_desc'] = 'This mod will index every post in your forum, rebuilding the search tables.
You can stop whenever you like and the next time you run it again you\'ll have the option of continuing from where you left off.<br /><br />
It may take a long time to show its progress (depending on "Posts per cycle" and "Time limit"),
so please do not move from its progress page until it is complete, unless of course you want to interrupt it.';

//
// Input screen
//
$lang['Starting_post_id'] = 'Starting post_id';
$lang['Starting_post_id_explain'] = 'First post where processing will begin from<br />You can choose to start from the beginning or from the post you last stopped';

$lang['Start_option_beginning'] = 'start from beginning';
$lang['Start_option_continue'] = 'continue from last stopped';

$lang['Clear_search_tables'] = 'Clear search tables';
$lang['Clear_search_tables_explain'] = 'When you start from the beginning you can clear the 3 phpBB search tables<br />You have the option of choosing between the DELETE/TRUNCATE methods';
$lang['Clear_search_no'] = 'NO';
$lang['Clear_search_delete'] = 'DELETE';
$lang['Clear_search_truncate'] = 'TRUNCATE';

$lang['Num_of_posts'] = 'Number of posts';
$lang['Num_of_posts_explain'] = 'Number of total posts to process<br />It\'s automatically filled with the number of total/remaining posts found in the db';

$lang['Posts_per_cycle'] = 'Posts per cycle';
$lang['Posts_per_cycle_explain'] = 'Number of posts to process per cycle<br />Keep it low to avoid php/webserver timeouts';

$lang['Refresh_rate'] = 'Refresh rate';
$lang['Refresh_rate_explain'] = 'How much time (secs) to stay idle before moving to next processing cycle<br />Usually you don\'t have to change this';

$lang['Time_limit'] = 'Time limit';
$lang['Time_limit_explain'] = 'How much time (secs) post processing can last before moving to next cycle';
$lang['Time_limit_explain_safe'] = '<i>Your php (safe mode) has a timeout of %s secs configured, so stay below this value</i>';
$lang['Time_limit_explain_webserver'] = '<i>Your webserver has a timeout of %s secs configured, so stay below this value</i>';

$lang['Disable_board'] = 'Disable board';
$lang['Disable_board_explain'] = 'Whether or not to disable your board while processing';
$lang['Disable_board_explain_enabled'] = 'It will be enabled automatically after the end of processing';
$lang['Disable_board_explain_already'] = '<i>Your board is already disabled through the admin configuration</i>';

$lang['Fast_mode'] = 'Fast mode';
$lang['Fast_mode_explain'] = 'Process the whole db without removing entries first<br />Use with caution!!! Please read the instructions for details.';

$lang['Max_info'] = '(Max : %d)';

//
// Information strings
//
$lang['Info_processing_stopped'] = 'You last stopped the processing at post_id %s (%s processed posts) on %s';
$lang['Info_processing_aborted'] = 'You last aborted the processing at post_id %s (%s processed posts) on %s';
$lang['Info_processing_aborted_soon'] = 'Please wait a little before you continue...';
$lang['Info_processing_finished'] = 'You successfully finished the processing (%s processed posts) on %s';
$lang['Info_processing_finished_new'] = 'You successfully finished the processing at post_id %s (%s processed posts) on %s,<br />but there have been %s new post(s) after that date';

//
// Progress screen
//
$lang['Rebuild_search_progress'] = 'Rebuild Search Progress';

$lang['Processed_post_ids'] = 'Processed post ids : %s - %s';
$lang['Timer_expired'] = 'Timer expired at %s secs. ';
$lang['Cleared_search_tables'] = 'Cleared search tables. ';
$lang['Deleted_posts'] = '%s post(s) were deleted by your users during processing. ';
$lang['Processing_next_posts'] = 'Processing next %s post(s). Please wait...';
$lang['All_session_posts_processed'] = 'Processed all posts in current session.';
$lang['All_posts_processed'] = 'All posts were processed successfully.';
$lang['All_tables_optimized'] = 'All search tables were optimized successfully.';

$lang['Processing_post_details'] = 'Processing post details';
$lang['Processed_posts'] = 'Processed Posts';
$lang['Percent'] = 'Percent';
$lang['Current_session'] = 'Current Session';
$lang['Total'] = 'Total';

$lang['Process_details'] = 'from <b>%s</b> to <b>%s</b> (out of total <b>%s</b>)';
$lang['Percent_completed'] = '%s %% completed';

$lang['Processing_time_details'] = 'Processing time details';
$lang['Processing_time'] = 'Processing time';
$lang['Time_last_posts'] = 'Last %s post(s) of current session';
$lang['Time_from_the_beginning'] = 'From the beginning of current session';
$lang['Time_average'] = 'Average per cycle of current session';
$lang['Time_estimated'] = 'Estimated until finish of current session';

$lang['days'] = 'days';
$lang['hours'] = 'hours';
$lang['minutes'] = 'minutes';
$lang['seconds'] = 'seconds';

$lang['Database_size_details'] = 'Database size details';
$lang['Size_current'] = 'Current';
$lang['Size_estimated'] = 'Estimated after finish';
$lang['Size_search_tables'] = 'Search Tables size';
$lang['Size_database'] = 'Database size';

$lang['Bytes'] = 'Bytes';

$lang['Active_parameters'] = 'Active parameters';
$lang['Posts_last_cycle'] = 'Processed post(s) on last cycle';
$lang['Board_status'] = 'Board status';
$lang['Board_disabled'] = 'Disabled';
$lang['Board_enabled'] = 'Enabled';

$lang['Info_estimated_values'] = '(*) All the estimated values are calculated approximately<br />
			based on the current completed percent and may not represent the actual final values.<br />
			As the completed percent increases the estimated values will come closer to the actual ones.';

$lang['Click_return_rebuild_search'] = 'Click %shere%s to return to Rebuild Search';
$lang['Rebuild_search_aborted'] = 'Rebuild search aborted at post_id %s.<br /><br />If you aborted while processing was on, you have to wait a little before you run Rebuild Search again, so the last cycle can finish.';
$lang['Wrong_input'] = 'You have entered some wrong values. Please check your input and try again.';

// Buttons
$lang['Next'] = 'Next';
$lang['Processing'] = 'Processing...';
$lang['Finished'] = 'Finished';

?>
