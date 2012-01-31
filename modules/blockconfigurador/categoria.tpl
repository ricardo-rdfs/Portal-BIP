
{include file="$tpl_dir./errors.tpl"}
{assign var='nolist' value=1}
{assign var='maxcount' value=0}
{if isset($category)}
	{if $category->id AND $category->active}
		{if $category->id_category!=1}
		<script>$("#left_column").show();
        var current_friendly_url = window.location.href;
		
		function redireccionar(url){
			location.href=url;
		}
        </script>
		<!--<script>$("#categories_block_left").hide();</script>-->
		<style>
			#category #center_column {
				height: auto;
				margin: 10px;
				width: 733px;
			}
			#subcategories {
				height: auto;
				width: 733px;
			}
			#category .breadcrumb {
				display:block;
			}
			#category h1 {
				display:block;
			}
/*			#subcategories {
				display: none;
			}*/
		</style>
        {else}
		<script>$("#left_column").hide();</script>
		{/if}		
        {if $nolist==1}
		{if $products}
				{include file="product-sort-categoria.tpl"}

				{include file="product-listConfigurador.tpl" products=$products}
				{include file="pagination-categoria.tpl"}
			{elseif !isset($subcategories)}
				<p class="warning">{l s='There are no products in this category.'}</p>
		{/if}

{else}
<script>$('#layered_block_left').hide();</script>

                {/if}
	{elseif $category->id}
		<p class="warning">{l s='This category is currently unavailable.'}</p>
	{/if}
{/if}