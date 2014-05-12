{include file='documentHeader'}

<head>
	<title>{lang}wcf.teamspeak3viewer.headline{/lang}</title>
	
	{include file='headInclude'}
	<script data-relocate="true">
		//<![CDATA[
		$(function() {
                    $('.item.subChannel').each(function(index) {
                        id = $(this).attr('data-id');
                        pid = $(this).attr('data-pid');
                        sid = $(this).parents().find('.container').attr('data-sid');
                        
                        $(this).appendTo('.container[data-sid='+sid+'] .item[data-id='+pid+']');
                    });
		});
		//]]>
	</script>
	<style type="text/css">	
                h2 {
                    text-align: center;
                    font-size: 18px;
                    line-height: 28px;
                }
                .left {
                    float: left;
                }
                .right {
                    float: right;
                    width: 30%;
                }
                .clear {
                    float: none;
                    clear: both;
                }
                .container {
                    padding: 2%;
                    width: 70%;
                    margin: 0 auto;
                    margin-bottom: 2%;
                }
                .viewer {
                    width: 50%;
                }
                .item {
                    width: 100%;
                    margin-left: 3%;
                 }
                 .item > span.spacer {
                     display: block;
                }
                .client {
                    margin-left: 3%;
                }
                table.table {
                    padding-bottom: 10%;
                }
                table.table th {
                    text-align: center;
                }
                a.btn {
                        text-align: center;
                        display: block;
                }
	</style>
</head>

<body id="tpl{$templateName|ucfirst}">


{include file='header' sidebarOrientation='right'}

<header class="boxHeadline">
	<h1>{lang}wcf.teamspeak3viewer.headline{/lang}</h1>
</header>

{include file='userNotice'}

<div class="contentNavigation">
</div>
    {foreach from=$servers item=$server key=$key}
        {if $server.status == 'online'}
            <h2>{$server.serverInfo.name}</h2>
            <div class="container marginTop" data-sid="{$key}">
                <div class="viewer left">
                    <img src="{$__wcf->getPath()}images/teamspeak3/server_green.png" alt="server" /> {$server.serverInfo.name}
                    {foreach from=$server.channels item=channel}
                        <div class="item {if $channel.pid > 0}subChannel{else}channel{/if}" data-id='{$channel.id}' data-pid='{$channel.pid}'>
                            {if $channel.align}
                                <span class="spacer" style="text-align:{$channel.align}">{$channel.name}</span>
                            {else}
                                {if $channel.hasPassword}
                                    <img src="{$__wcf->getPath()}images/teamspeak3/channel_private.png" alt="private_channel" />
                                    {else}<img src="{$__wcf->getPath()}images/teamspeak3/channel_green.png" alt="{lang}wcf.teamspeak3viewer.channel{/lang}" title="{lang}wcf.teamspeak3viewer.channel{/lang}" />
                                {/if}
                                <span>{$channel.name}</span>
                            {/if}
                            {if $channel.clients  != false}
                                {foreach from=$channel.clients item=client}
                                    <div class="client">
                                        {if $client.output_muted}
                                            <img src="{$__wcf->getPath()}images/teamspeak3/output_muted.png" alt="{lang}wcf.teamspeak3viewer.output_muted{/lang}" title="{lang}wcf.teamspeak3viewer.output_muted{/lang}" />
                                        {elseif $client.input_muted}
                                            <img src="{$__wcf->getPath()}images/teamspeak3/input_muted.png" alt="{lang}wcf.teamspeak3viewer.input_muted{/lang}" title="{lang}wcf.teamspeak3viewer.input_muted{/lang}" />
                                        {elseif $client.talking}
                                            <img src="{$__wcf->getPath()}images/teamspeak3/player_on.png" alt="{lang}wcf.teamspeak3viewer.talking{/lang}" title="{lang}wcf.teamspeak3viewer.talking{/lang}" />
                                        {else}
                                            <img src="{$__wcf->getPath()}images/teamspeak3/player_off.png" alt="{lang}wcf.teamspeak3viewer.client{/lang}" title="{lang}wcf.teamspeak3viewer.client{/lang}" />
                                        {/if}
                                        {$client.name}
                                    </div>
                                {/foreach}
                            {/if}
                        </div>
                    {/foreach}
                </div>
                <div class="right">
                    <table class="table responsiveTable">
                        <tr>
                            <th>{lang}wcf.teamspeak3viewer.connectionData{/lang}</th>
                        </tr>
                        <tr>
                            <td>{lang}wcf.teamspeak3viewer.serverAddress{/lang}: {$server.serverInfo.address}</td>
                        </tr>
                        <tr>
                            <td>{lang}wcf.teamspeak3viewer.serverPort{/lang}: {$server.serverInfo.port}</td>
                        </tr>
                        {if $server.serverInfo.hasPassword && $server.serverPassword}
                            <tr>
                                <td>{lang}wcf.teamspeak3viewer.serverPassword{/lang}: {$server.serverPassword}</td>
                            </tr>
                        {/if}
                    </table>
                    <table class="table responsiveTable">
                        <tr>
                            <th>{lang}wcf.teamspeak3viewer.informations{/lang}</th>
                        </tr>
                        <tr>
                            <td>{lang}wcf.teamspeak3viewer.version{/lang}: {$server.serverInfo.version}</td>
                        </tr>
                        <tr>
                            <td>{lang}wcf.teamspeak3viewer.platform{/lang}: {$server.serverInfo.platform}</td>
                        </tr>
                        <tr>
                            <td>{lang}wcf.teamspeak3viewer.channels{/lang}: {$server.serverInfo.channels}</td>
                        </tr>
                        <tr>
                            <td>{lang}wcf.teamspeak3viewer.clients{/lang}: {$server.serverInfo.clients}/{$server.serverInfo.maxclients}</td>
                        </tr>
                    </table>
                    {if $server.descr}
                        <table class="table responsiveTable">
                            <tr>
                               <th>{lang}wcf.teamspeak3viewer.descr{/lang}</th>
                            </tr>
                            <tr>
                                <td>{$server.descr}</td>
                            </tr>
                        </table>
                    {/if}
                    <a class="btn button" href="ts3server://{$server.serverInfo.address}?port={$server.serverInfo.port}&amp;nickname={if $__wcf->user->username}{$__wcf->user->username}{else}{$server.joinName}{/if}{if $server.serverInfo.hasPassword && $server.serverPassword}&amp;password={$server.serverPassword}{/if}">{lang}wcf.teamspeak3viewer.connectNow{/lang}</a>
                </div>
                <div class="clear"></div>
            </div>
        {else}
            <h2>{lang}wcf.teamspeak3viewer.offline{/lang}</h2>
        {/if}
    {/foreach}

<div class="contentNavigation">
	
	{hascontent}
		<nav>
			<ul>
				{content}
					{event name='contentNavigationButtonsBottom'}
				{/content}
			</ul>
		</nav>
	{/hascontent}
</div>

{include file='footer'}

</body>
</html>
