{include file='header' pageTitle='wcf.acp.teamspeak3viewer.'|concat:$action}

<header class="boxHeadline">
	<h1>{lang}wcf.acp.teamspeak3viewer.{$action}{/lang}</h1>
</header>

{include file='formError'}

{if $success|isset}
	<p class="success">{lang}wcf.global.success.{$action}{/lang}</p>
{/if}

<div class="contentNavigation">
	<nav>
		<ul>
			<li><a href="{link controller='TeamSpeak3ViewerList'}{/link}" class="button"><span class="icon icon16 icon-list"></span> <span>{lang}wcf.acp.menu.link.community.teamspeak3viewer.list{/lang}</span></a></li>
			
			{event name='contentNavigationButtons'}
		</ul>
	</nav>
</div>

<form method="post" action="{if $action == 'add'}{link controller='TeamSpeak3ViewerAdd'}{/link}{else}{link controller='TeamSpeak3ViewerEdit' id=$ts3->serverID}{/link}{/if}">
	<div class="container containerPadding marginTop">
		<fieldset>
			<legend>{lang}wcf.global.form.data{/lang}</legend>
			
			<dl{if $errorField == 'serverAddress'} class="formError"{/if}>
				<dt><label for="serverAddress">{lang}wcf.acp.teamspeak3viewer.serverAddress{/lang}</label></dt>
				<dd>
					<input type="text" id="serverAddress" name="serverAddress" value="{$serverAddress}" class="" required="required" />
					{if $errorField == 'serverAddress'}
						<small class="innerError">{lang}wcf.acp.teamspeak3viewer.serverAdress.error.{$errorType}{/lang}</small>
					{/if}
				</dd>
			</dl>
			<dl{if $errorField == 'serverPort'} class="formError"{/if}>
				<dt><label for="serverPort">{lang}wcf.acp.teamspeak3viewer.serverPort{/lang}</label></dt>
				<dd>
					<input type="number" id="serverPort" name="serverPort" value="{$serverPort}" class="short" pattern="^[1-9][0-9]?[0-9]?[0-9]?[0-9]$|^65535$" required="required" />
					{if $errorField == 'serverPort'}
						<small class="innerError">{lang}wcf.acp.teamspeak3viewer.serverPort.error.{$errorType}{/lang}</small>
					{/if}
				</dd>
			</dl>
			<dl{if $errorField == 'queryPort'} class="formError"{/if}>
				<dt><label for="queryPort">{lang}wcf.acp.teamspeak3viewer.queryPort{/lang}</label></dt>
				<dd>
					<input type="number" id="queryPort" name="queryPort" value="{$queryPort}" class="short" pattern="^[1-9][0-9]?[0-9]?[0-9]?[0-9]$|^65535$" required="required" />
					{if $errorField == 'queryPort'}
						<small class="innerError">{lang}wcf.acp.teamspeak3viewer.queryPort.error.{$errorType}{/lang}</small>
					{/if}
				</dd>
			</dl>
			<dl{if $errorField == 'queryAdminName'} class="formError"{/if}>
				<dt><label for="queryAdminName">{lang}wcf.acp.teamspeak3viewer.queryAdminName{/lang}</label></dt>
				<dd>
					<input type="text" id="queryAdminName" name="queryAdminName" value="{$queryAdminName}" class="" required="required" />
					{if $errorField == 'adminName'}
						<small class="innerError">{lang}wcf.acp.teamspeak3viewer.queryAdminName.error.{$errorType}{/lang}</small>
					{/if}
				</dd>
			</dl>
			<dl{if $errorField == 'queryAdminPassword'} class="formError"{/if}>
				<dt><label for="queryAdminPassword">{lang}wcf.acp.teamspeak3viewer.queryAdminPassword{/lang}</label></dt>
				<dd>
					<input type="password" id="queryAdminPassword" name="queryAdminPassword" value="{$queryAdminPassword}" class="" required="required" />
					{if $errorField == 'queryAdminPassword'}
						<small class="innerError">{lang}wcf.acp.teamspeak3viewer.queryAdminPassword.error.{$errorType}{/lang}</small>
					{/if}
				</dd>
			</dl>
			<dl{if $errorField == 'serverPassword'} class="formError"{/if}>
				<dt><label for="queryAdminPassword">{lang}wcf.acp.teamspeak3viewer.serverPassword{/lang}</label></dt>
				<dd>
					<input type="password" id="serverPassword" name="serverPassword" value="{$serverPassword}" class="" />
					{if $errorField == 'queryAdminPassword'}
						<small class="innerError">{lang}wcf.acp.teamspeak3viewer.serverPassword.error.{$errorType}{/lang}</small>
					{/if}
				</dd>
			</dl>
			<dl{if $errorField == 'joinName'} class="formError"{/if}>
				<dt><label for="joinName">{lang}wcf.acp.teamspeak3viewer.joinName{/lang}</label></dt>
				<dd>
					<input type="text" id="joinName" name="joinName" value="{$joinName}" class="" required="required" />
					{if $errorField == 'joinName'}
						<small class="innerError">{lang}wcf.acp.teamspeak3viewer.joinName.error.{$errorType}{/lang}</small>
					{/if}
				</dd>
			</dl>
			<dl{if $errorField == 'descr'} class="formError"{/if}>
				<dt><label for="descr">{lang}wcf.acp.teamspeak3viewer.descr{/lang}</label></dt>
				<dd>
                                        <textarea id="descr" name="descr" rows=10>{$descr}</textarea>
					{if $errorField == 'descr'}
						<small class="innerError">{lang}wcf.acp.teamspeak3viewer.descr.error.{$errorType}{/lang}</small>
					{/if}
				</dd>
			</dl>
			
			{event name='dataFields'}
		</fieldset>
		
	</div>
	
	<div class="formSubmit">
		<input type="submit" value="{lang}wcf.global.button.submit{/lang}" accesskey="s" />
		{@SECURITY_TOKEN_INPUT_TAG}
	</div>
</form>

{include file='footer'}