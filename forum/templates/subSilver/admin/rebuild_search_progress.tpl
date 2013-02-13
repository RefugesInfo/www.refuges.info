<!-- $Id: rebuild_search_progress.tpl,v 2.4.0.0 2006/06/17 19:32:23 chatasos Exp $ -->

<SCRIPT type="text/javascript" language="JavaScript">
<!--

var refresh;

var ticker = {REFRESH_RATE};
var label_next = "{L_NEXT}";
var label = "{L_PROCESSING}";

// update the button description/status
function updateButton()
{
	if ( ticker >= 0)
	{
		if ( ticker == 0 )
		{
			document.form_rebuild_progress.submit_button.value = label;
			document.form_rebuild_progress.submit_button.disabled = true;
		}
		else
		{
			document.form_rebuild_progress.submit_button.value = label_next + " (" + ticker + ")";

			ticker--;;
			refresh = setTimeout("updateButton()", 1000);
		}
	}
}
//-->
</SCRIPT>

<h1>{L_REBUILD_SEARCH}</h1>

<form name="form_rebuild_progress" method="post" action="{S_REBUILD_SEARCH_ACTION}">

<table width="540" cellspacing="1" cellpadding="2" border="0" align="center" class="forumline">
	<tr>
		<th class="thHead" align="center">{L_REBUILD_SEARCH_PROGRESS}</th>
	</tr>
	<tr>
		<td class="row1" align="center">
			<span class="genmed">{PROCESSING_POSTS}<br /><br />
			{PROCESSING_MESSAGES}</span><br />
			<img name="progress_bar" src="{PROGRESS_BAR_IMG}" border="0" />
		</td>
	</tr>

	<tr>
		<td class="row3" align="center">
			<table width="100%" align="center" cellspacing="1" cellpadding="1" class="forumline">
				<tr>
					<th colspan="3"><span class="gen">{L_PROCESSING_POST_DETAILS}</span></th>
				</tr>
				<tr>
					<td class="row3" nowrap="nowrap">
						&nbsp;
					</td>
					<td class="row3" nowrap="nowrap" align="center">
						<span class="genmed"><b>{L_PROCESSED_POSTS}</b></span>
					</td>
					<td class="row3" nowrap="nowrap" align="center">
						<span class="genmed"><b>{L_PERCENT}</b></span>
					</td>
				</tr>
				<tr>
					<td class="row1" nowrap="nowrap" align="left">
						<span class="genmed">{L_CURRENT_SESSION}</span>
					</td>
					<td class="row1" nowrap="nowrap" align="center">
						<span class="genmed">{SESSION_DETAILS}</span>
					</td>
					<td class="row1" width="200"  nowrap="nowrap" align="center">
						<span class="genmed"><b>{SESSION_PERCENT}</b></span><br />
						{SESSION_PERCENT_BOX}
					</td>
				</tr>
				<tr>
					<td class="row2" nowrap="nowrap" align="left">
						<span class="genmed">{L_TOTAL}</span>
					</td>
					<td class="row2" nowrap="nowrap" align="center">
						<span class="genmed">{TOTAL_DETAILS}</span>
					</td>
					<td class="row2" width="200" nowrap="nowrap" align="center">
						<span class="genmed"><b>{TOTAL_PERCENT}</b></span><br />
						{TOTAL_PERCENT_BOX}
					</td>
				</tr>
			</table>
		</td>
	</tr>

	<tr>
		<td class="row3" align="center">
			<table width="100%" align="center" cellspacing="1" cellpadding="1" class="forumline">
				<tr>
					<th colspan="2"><span class="gen">{L_PROCESSING_TIME_DETAILS}</span></th>
				</tr>
				<tr>
					<td class="row3" nowrap="nowrap">&nbsp;</td>
					<td class="row3" nowrap="nowrap" align="center" width="304"><span class="genmed"><b>{L_PROCESSING_TIME}</b></span></td>
				</tr>
				<tr>
					<td class="row1" nowrap="nowrap" align="left"><span class="genmed">{L_TIME_LAST_POSTS}</span></td>
					<td class="row1" nowrap="nowrap" align="right"><span class="genmed">{LAST_CYCLE_TIME}</span></td>
				</tr>
				<tr>
					<td class="row2" nowrap="nowrap" align="left"><span class="genmed">{L_TIME_BEGINNING}</span></td>
					<td class="row2" nowrap="nowrap" align="right"><span class="genmed">{SESSION_TIME}</span></td>
				</tr>
				<tr>
					<td class="row1" nowrap="nowrap" align="left"><span class="genmed">{L_TIME_AVERAGE}</span></td>
					<td class="row1" nowrap="nowrap" align="right"><span class="genmed">{SESSION_AVERAGE_CYCLE_TIME}</span></td>
				</tr>
				<tr>
					<td class="row2" nowrap="nowrap" align="left"><span class="genmed">{L_TIME_ESTIMATED}</span></td>
					<td class="row2" nowrap="nowrap" align="right"><span class="genmed">{SESSION_ESTIMATED_TIME}</span></td>
				</tr>
			</table>
		</td>
	</tr>
	<tr>
		<td class="row3" align="center">
			<table width="100%" align="center" cellspacing="1" cellpadding="1" class="forumline">
				<tr>
					<th colspan="3"><span class="gen">{L_DATABASE_SIZE_DETAILS}</span></th>
				</tr>
				<tr>
					<td class="row3" nowrap="nowrap">&nbsp;</td>
					<td class="row3" nowrap="nowrap" align="center" width="150"><span class="genmed"><b>{L_SIZE_CURRENT}</b></span></td>
					<td class="row3" nowrap="nowrap" align="center" width="150"><span class="genmed"><b>{L_SIZE_ESTIMATED}</b></span></td>
				</tr>
				<tr>
					<td class="row1" nowrap="nowrap" align="left"><span class="genmed">{L_SIZE_SEARCH_TABLES}</span></td>
					<td class="row1" nowrap="nowrap" align="right"><span class="genmed">{SEARCH_TABLES_SIZE}</span></td>
					<td class="row1" nowrap="nowrap" align="right"><span class="genmed">{FINAL_SEARCH_TABLES_SIZE}</span></td>
				</tr>
				<tr>
					<td class="row2" nowrap="nowrap" align="left"><span class="genmed">{L_SIZE_DATABASE}</span></td>
					<td class="row2" nowrap="nowrap" align="right"><span class="genmed">{DB_SIZE}</span></td>
					<td class="row2" nowrap="nowrap" align="right"><span class="genmed">{FINAL_DB_SIZE}</span></td>
				</tr>
			</table>
		</td>
	</tr>
	<tr>
		<td class="row3" align="center">
			<table width="100%" align="center" cellspacing="1" cellpadding="1" class="forumline">
				<tr>
					<th colspan="4"><span class="gen">{L_ACTIVE_PARAMETERS}</span></th>
				</tr>
				<tr>
					<td class="row1" nowrap="nowrap" width="38%"><span class="genmed">{L_STARTING_POST_ID}</span></td>
					<td class="row1" nowrap="nowrap" width="12%" align="center"><span class="genmed">{START_POST}</span></td>

					<td class="row2" nowrap="nowrap" width="38%"><span class="genmed">{L_BOARD_STATUS}</span></td>
					<td class="row2" nowrap="nowrap" width="12%" align="center"><span class="genmed">{BOARD_STATUS}</span></td>
				</tr>
				<tr>
					<td class="row2" nowrap="nowrap" width="38%"><span class="genmed">{L_POSTS_LAST_CYCLE}</span></td>
					<td class="row2" nowrap="nowrap" width="12%" align="center"><span class="genmed">{POST_LIMIT}</span></td>

					<td class="row1" nowrap="nowrap" width="38%"><span class="genmed">{L_FAST_MODE}</span></td>
					<td class="row1" nowrap="nowrap" width="12%" align="center"><span class="genmed">{FAST_MODE}</span></td>
				</tr>
				<tr>
					<td class="row1" nowrap="nowrap" width="38%"><span class="genmed">{L_TIME_LIMIT}</span></td>
					<td class="row1" nowrap="nowrap" width="12%" align="center"><span class="genmed">{TIME_LIMIT}</span></td>

					<td class="row2" nowrap="nowrap" width="38%"><span class="genmed"></span></td>
					<td class="row2" nowrap="nowrap" width="12%" align="center"><span class="genmed"></span></td>
				</tr>
			</table>
		</td>
	</tr>
	<tr>
		<td class="row2" align="center">
			<span class="gensmall">{L_ESTIMATED_VALUES}</span>
		</td>
	</tr>

	<tr>
		<td class="catBottom" align="center">
			<input class="mainoption" type="submit" name="submit_button" value="{L_NEXT}" onClick="ticker=0" />&nbsp;
			<!-- BEGIN cancel_button -->
			&nbsp;&nbsp;&nbsp;
			<input class="mainoption" type="submit" name="cancel_button" value="{L_CANCEL}" />
			<SCRIPT LANGUAGE="JavaScript"><!--
				updateButton();
			//-->
			</SCRIPT>
			<!-- END cancel_button -->
		</td>
	</tr>
</table>

</form>

<div align="center"><span class="copyright">{L_REBUILD_SEARCH} {REBUILD_SEARCH_VERSION}</span></div>

<br clear="all" />

