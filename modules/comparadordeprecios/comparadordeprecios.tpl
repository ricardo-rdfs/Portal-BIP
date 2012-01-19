
<!--<h1>{l s='Si encontraste este articulo mas barato en otra tienda, dinos donde.'}</h1>-->
<html>
<head>
</head>
<body>
<p class="bold">{l s='Si encontraste este articulo mas barato en otra tienda, dinos donde.' mod='comparadordeprecios'}.</p>
{include file="$tpl_dir./errors.tpl"}

{if isset($smarty.get.submited)}
	<p class="success">{l s='Los datos se han enviado correctamente' mod='comparadordeprecios'}</p>
{else}
	<form method="post" action="{$request_uri}" class="std">
		<fieldset>
			<h3>{l s='Informacion del producto' mod='comparadordeprecios'}</h3>

			<p class="align_center">
				<img src="{$link->getImageLink($product->link_rewrite, $cover.id_image, 'small')}" alt="" title="{$cover.legend|escape:'htmlall':'UTF-8'}" /><br/>
				{$product->name|escape:'htmlall':'UTF-8'}
			</p>

			<p>
				<label for="friend-name" style="float: left; text-align: left; width: 7%;">{l s='URL' mod='comparadordeprecios'}</label>
				<input type="text" id="dacoURL" name="dacoURL" value="{if isset($smarty.post.dacoURL)}{$smarty.post.dacoURL|escape:'htmlall':'UTF-8'|stripslashes}{/if}" style="font-family: Arial, Helvetica, sans-serif; font-size:11px; color:#000; background-color:#FFFFFF; width:400px; border:1px solid #039"  />
			</p>
            <p>
				<label for="friend-name" style="float: left; text-align: left; width: 7%;">{l s='Email' mod='comparadordeprecios'}</label>
				<input type="text" id="dacoEmail" name="dacoEmail" value="{if isset($smarty.post.dacoEmail)}{$smarty.post.dacoEmail|escape:'htmlall':'UTF-8'|stripslashes}{else}{$email}{/if}" style="font-family: Arial, Helvetica, sans-serif; font-size:11px; color:#000; background-color:#FFFFFF; width:150px; border:1px solid #039" />
			</p>
			<p class="submit" style="float:right;">
				<input type="submit" name="submitSendURL" value="{l s='Enviar' mod='comparadordeprecios'}" class="button" />
			</p>
		</fieldset>
        <input type="hidden" id="dacoBip" name="dacoBip" value="{$product->id}" />
        <input type="hidden" id="dacoUsuario" name="dacoUsuario" value="{if isset($smarty.post.dacoUsuario)}{$smarty.post.dacoUsuario|escape:'htmlall':'UTF-8'|stripslashes}{else}{$tipoUsuario}{/if}" />
        <input type="hidden" id="categoryDefault" name="categoryDefault" value="{if isset($smarty.post.categoryDefault)}{$smarty.post.categoryDefault|escape:'htmlall':'UTF-8'|stripslashes}{else}{$categoryDefault}{/if}" />
        <input type="hidden" id="product_manufacturer" name="product_manufacturer" value="{if isset($smarty.post.product_manufacturer)}{$smarty.post.product_manufacturer|escape:'htmlall':'UTF-8'|stripslashes}{else}{$product_manufacturer}{/if}" />
	</form>
{/if}
</body>
</html>