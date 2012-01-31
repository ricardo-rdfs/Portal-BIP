{if isset($no_follow) AND $no_follow}
	{assign var='no_follow_text' value='rel="nofollow"'}
{else}
	{assign var='no_follow_text' value=''}
{/if}


{if isset($p) AND $p}
	{assign var='requestPage' value=$link->getPaginationLink(false, false, false, false, true, false)}
	{assign var='requestNb' value=$link->getPaginationLink(false, false, true, false, false, false)}
    {assign var='requestPage' value=$requestPage|replace:'categorias.php':'modules/blockconfigurador/categorias.php'}
    
    {if !is_array($requestNb)}
    	{assign var='requestNb' value=$requestNb|replace:'categorias.php':'modules/blockconfigurador/categorias.php'}
    {else}
    	{assign var='requestNb.requestUrl' value=$requestNb.requestUrl|replace:'categorias.php':'modules/blockconfigurador/categorias.php'}
    {/if}
    
	<!-- Pagination -->
	<div id="pagination" class="pagination" >
    
	{if $start!=$stop}
		
		{if $p != 1}
			{assign var='p_previous' value=$p-1}
			<a onclick="redireccionar('{$link->goPage($requestPage, $p_previous)}');" href="#">&laquo;&nbsp;Anterior</a>
		{else}
			<div id="pagination_previous" class="disabled"><span>&laquo;&nbsp;Anterior</span></div>
		{/if}
		{if $start>3}
			<a {$no_follow_text}  href="{$link->goPage($requestPage, 1)}">1</a>
			<li class="truncate">...</li>
		{/if}
		{section name=pagination start=$start loop=$stop+1 step=1}
			{if $p == $smarty.section.pagination.index}
				<span>{$p|escape:'htmlall':'UTF-8'}</span>
			{else}
				<a {$no_follow_text} onclick="redireccionar('{$link->goPage($requestPage, $smarty.section.pagination.index)}');" href="#">{$smarty.section.pagination.index|escape:'htmlall':'UTF-8'}</a>
			{/if}
		{/section}
		{if $pages_nb>$stop+2}
			<li class="truncate">...</li>
			<a onclick="redireccionar('{$link->goPage($requestPage, $pages_nb)}');" href="#">{$pages_nb|intval}</a>
		{/if}
		{if $pages_nb > 1 AND $p != $pages_nb}
			{assign var='p_next' value=$p+1}
			<a onclick="redireccionar('{$link->goPage($requestPage, $p_next)}');" href="#">Siguiente&nbsp;&raquo;</a>
		{else}
				<span>Siguiente&nbsp;&raquo;</span>
		{/if}
	{/if}
	</div>
	<!-- /Pagination -->
{/if}
