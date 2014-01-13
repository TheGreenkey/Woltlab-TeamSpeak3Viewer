{include file='header' pageTitle='wcf.acp.teamspeak3viewer.list'}

<header class="boxHeadline">
	<h1>{lang}wcf.acp.teamspeak3viewer.list{/lang}</h1>
	<script data-relocate="true">
		//<![CDATA[
		$(function() {
			new WCF.Action.Delete('wcf\\data\\teamspeak3viewer\\TeamSpeak3ViewerAction', '.jsTeamSpeak3ViewerRow');
			new WCF.Action.Toggle('wcf\\data\\teamspeak3viewer\\TeamSpeak3ViewerAction', $('.jsTeamSpeak3ViewerRow'));
		});
		//]]>
	</script>
</header>

<div class="contentNavigation">
	{pages print=true assign=pagesLinks controller="TeamSpeak3ViewerServerList" link="pageNo=%d&sortField=$sortField&sortOrder=$sortOrder"}
	
	<nav>
		<ul>
			<li><a href="{link controller='TeamSpeak3ViewerAdd'}{/link}" class="button"><span class="icon icon16 icon-plus"></span> <span>{lang}wcf.acp.teamspeak3viewer.add{/lang}</span></a></li>
			
			{event name='contentNavigationButtonsTop'}
		</ul>
	</nav>
</div>

{if $objects|count}
	<div class="tabularBox tabularBoxTitle marginTop">
		<header>
			<h2>{lang}wcf.acp.teamspeak3viewer.list{/lang} <span class="badge badgeInverse">{#$items}</span></h2>
		</header>
		
		<table class="table">
			<thead>
				<tr>
					<th class="columnID columnServerID{if $sortField == 'serverID'} active {@$sortOrder}{/if}" colspan="2"><a href="{link controller='TeamSpeak3ViewerList'}pageNo={@$pageNo}&sortField=serverID&sortOrder={if $sortField == 'serverID' && $sortOrder == 'ASC'}DESC{else}ASC{/if}{/link}">{lang}wcf.global.objectID{/lang}</a></th>
					<th class="columnTitle columnServerAddress{if $sortField == 'serverAddress'} active {@$sortOrder}{/if}"><a href="{link controller='TeamSpeak3ViewerList'}pageNo={@$pageNo}&sortField=serverVersion&sortOrder={if $sortField == 'serverVersion' && $sortOrder == 'ASC'}DESC{else}ASC{/if}{/link}">{lang}wcf.acp.teamspeak3viewer.serverAddress{/lang}</a></th>
					<th class="columnText columnServerPort{if $sortField == 'serverPort'} active {@$sortOrder}{/if}"><a href="{link controller='TeamSpeak3ViewerList'}pageNo={@$pageNo}&sortField=descr&sortOrder={if $sortField == 'descr' && $sortOrder == 'ASC'}DESC{else}ASC{/if}{/link}">{lang}wcf.acp.teamspeak3viewer.serverPort{/lang}</a></th>
					
					{event name='columnHeads'}
				</tr>
			</thead>
			
			<tbody>
				{foreach from=$objects item=ts3}
					<tr class="jsTeamSpeak3ViewerRow">
						<td class="columnIcon">
							<span class="icon icon16 icon-check{if $ts3->active == false}-empty{/if} jsToggleButton jsTooltip pointer" title="{lang}wcf.global.button.{if $ts3->active == false}enable{else}disable{/if}{/lang}" data-object-id="{@$ts3->serverID}" data-disable-message="{lang}wcf.global.button.disable{/lang}" data-enable-message="{lang}wcf.global.button.enable{/lang}"></span>
							<a href="{link controller='TeamSpeak3ViewerEdit' id=$ts3->serverID}{/link}" title="{lang}wcf.global.button.edit{/lang}" class="jsTooltip"><span class="icon icon16 icon-pencil"></span></a>
							<span class="icon icon16 icon-remove jsDeleteButton jsTooltip pointer" title="{lang}wcf.global.button.delete{/lang}" data-object-id="{@$ts3->serverID}" data-confirm-message="{lang}wcf.acp.teamspeak3viewer.delete.sure{/lang}"></span>
							
							{event name='rowButtons'}
						</td>
						<td class="columnID">{@$ts3->serverID}</td>
						<td class="columnTitle columnServerAddress">{$ts3->serverAddress}</td>
						<td class="columnTitle columnServerPort">{$ts3->serverPort}</td>
						
						{event name='columns'}
					</tr>
				{/foreach}
			</tbody>
		</table>
		
	</div>
	
	<div class="contentNavigation">
		{@$pagesLinks}
		
		<nav>
			<ul>
				{event name='contentNavigationButtonsBottom'}
			</ul>
		</nav>
	</div>
{else}
	<p class="info">{lang}wcf.global.noItems{/lang}</p>
{/if}

{include file='footer'}
