{*
* 2007-2011 PrestaShop 
*
* NOTICE OF LICENSE
*
* This source file is subject to the Academic Free License (AFL 3.0)
* that is bundled with this package in the file LICENSE.txt.
* It is also available through the world-wide-web at this URL:
* http://opensource.org/licenses/afl-3.0.php
* If you did not receive a copy of the license and are unable to
* obtain it through the world-wide-web, please send an email
* to license@prestashop.com so we can send you a copy immediately.
*
* DISCLAIMER
*
* Do not edit or add to this file if you wish to upgrade PrestaShop to newer
* versions in the future. If you wish to customize PrestaShop for your
* needs please refer to http://www.prestashop.com for more information.
*
*  @author PrestaShop SA <contact@prestashop.com>
*  @copyright  2007-2011 PrestaShop SA
*  @version  Release: $Revision: 7581 $
*  @license    http://opensource.org/licenses/afl-3.0.php  Academic Free License (AFL 3.0)
*  International Registered Trademark & Property of PrestaShop SA
*}

{if $block == 1}
	<!-- Block CMS module -->
	{foreach from=$cms_titles key=cms_key item=cms_title}
		<div id="informations_block_left_{$cms_key}" class="block informations_block_left">
			<h4><a href="{$cms_title.category_link}">{if !empty($cms_title.name)}{$cms_title.name}{else}{$cms_title.category_name}{/if}</a></h4>
			<ul class="block_content">
				{foreach from=$cms_title.categories item=cms_page}
					{if isset($cms_page.link)}<li class="bullet"><b style="margin-left:2em;">
					<a href="{$cms_page.link}" title="{$cms_page.name|escape:html:'UTF-8'}">{$cms_page.name|escape:html:'UTF-8'}</a>
					</b></li>{/if}
				{/foreach}
				{foreach from=$cms_title.cms item=cms_page}
					{if isset($cms_page.link)}<li><a href="{$cms_page.link}" title="{$cms_page.meta_title|escape:html:'UTF-8'}">{$cms_page.meta_title|escape:html:'UTF-8'}</a></li>{/if}
				{/foreach}
				{if $cms_title.display_store}<li><a href="{$link->getPageLink('stores.php')}" title="{l s='Our stores' mod='blockcms'}">{l s='Our stores' mod='blockcms'}</a></li>{/if}
			</ul>
		</div>
	{/foreach}
	<!-- /Block CMS module -->
{else}
	<!-- MODULE Block footer -->
<!--	<ul class="block_various_links" id="block_various_links_footer">
		{if !$PS_CATALOG_MODE}<li class="first_item"><a href="{$link->getPageLink('prices-drop.php')}" title="{l s='Specials' mod='blockcms'}">{l s='Specials' mod='blockcms'}</a></li>{/if}
		<li class="{if $PS_CATALOG_MODE}first_{/if}item"><a href="{$link->getPageLink('new-products.php')}" title="{l s='New products' mod='blockcms'}">{l s='New products' mod='blockcms'}</a></li>
		{if !$PS_CATALOG_MODE}<li class="item"><a href="{$link->getPageLink('best-sales.php')}" title="{l s='Top sellers' mod='blockcms'}">{l s='Top sellers' mod='blockcms'}</a></li>{/if}
		{if $display_stores_footer}<li class="item"><a href="{$link->getPageLink('stores.php')}" title="{l s='Our stores' mod='blockcms'}">{l s='Our stores' mod='blockcms'}</a></li>{/if}
		<li class="item"><a href="{$link->getPageLink('contact-form.php', true)}" title="{l s='Contact us' mod='blockcms'}">{l s='Contact us' mod='blockcms'}</a></li>
		{foreach from=$cmslinks item=cmslink}
			{if $cmslink.meta_title != ''}
				<li class="item"><a href="{$cmslink.link|addslashes}" title="{$cmslink.meta_title|escape:'htmlall':'UTF-8'}">{$cmslink.meta_title|escape:'htmlall':'UTF-8'}</a></li>
			{/if}
		{/foreach}
		{if $display_poweredby}<li class="last_item">{l s='Powered by' mod='blockcms'} <a href="http://www.prestashop.com">PrestaShop</a>&trade;</li>{/if}
	</ul>-->
	<!-- /MODULE Block footer -->
	<div class="block_various_links" id="block_various_links_footer">
        <ul class="customerService">
          <li><a href="#" target="_self">Entrega</a></li>
          <li><a href="#" target="_self">Aviso Legal</a></li>
          <li><a href="#" target="_self">Condiciones de Uso</a></li>
          <li><a href="#" target="_self">Nuestra Empresa</a></li>
          <li><a href="#" target="_self">Formas de Pago</a></li>
          <li><a href="#" target="_self">Nuestras Sucursales</a></li>
          <li><a href="#" target="_self">P&oacute;liza de Garant&iacute;a</a></li>
        </ul>
        <ul class="international">
          <li><a href="#" target="_self">Lista de Precios (PDF)</a></li>
          <li><a href="#" target="_self">Cont&aacute;ctenos</a></li>
          <li><a href="#" target="_self">Soporte</a></li>
          <li><a href="http://demo.exe.cl/exeBIPdev/modules/blockconfigurador/configuradorMain.php" target="_self">Configurador de PC</a></li>
          <li><a href="#" target="_self">Ofertas de Trabajo</a></li>
          <li><a href="#" target="_self">Revisar Pedidos</a></li>
          <li><a href="#" target="_self">Mapa del Sitio</a></li>
        </ul>
        <ul class="aboutBH">
          <li>NEWSLETTER Y PROMOCIONES</li>
          <li class="informese">Inf&oacute;rmese sobre nuestros productos y promociones. Suscr&iacute;base a nuestro bolet&iacute;n.</li>
          <li>
          
          <!-- Block Newsletter module-->
            <div class="block_content">
            
            <form action="/tienda/" method="post">
                     <input style="width:150px; float:left; margin-right:5px;" type="text" name="email" size="18" value="su email" onfocus="javascript:if(this.value=='su email')this.value='';" onblur="javascript:if(this.value=='')this.value='Email';" />
               
                        <!--<select name="action" style="width:100px; float:left;">
                           <option value="0" selected="selected">Suscribirse</option>
                           <option value="1">Borrarse</option>
                        </select>-->
                        <input type="submit" value="enviar" class="button_mini" name="submitNewsletter" />
            
                  
                  </form>

            </div>
          <!-- /Block Newsletter module-->

          </li>
             	  <li class="facebook"><a class="facebook" href="#" alt="Facebook" target="blank"><img src="{$base_dir}themes/ps_bip/img/icono_facebook_redes_sociales_footer.gif" alt="Facebook" height="21" width="133"></a></li>
    <li class="twitter"><a class="twitter" href="#" alt="Twitter" target="blank"><img src="{$base_dir}themes/ps_bip/img/icono_twitter_redes_sociales_footer.gif" alt="Twitter" height="21" width="133"></a></li>
        </ul>
        <ul class="resources">
          <li>BIP COMPUTER STORE</li>
          <li>T&eacute;lefono: [562] 570 7000</li>
          <li>Email: <a href="mailto:ventas@bip.cl">ventas@bip.cl</a></li>
          <li class="direccion">Av. Francisco Bilbao 2296, Providencia, Santiago.</li>
          <li class="problema_web">Si encontraste alg&uacute;n problema en la p&aacute;gina, por favor, avisa a <a href="mailto:webmaster@bip.cl">webmaster@bip.cl</a></li>
          <li class="formas_pago"><a href="#" target="_self"><img src="{$base_dir}themes/ps_bip/img/img_forma_pago_01.gif" alt="Formas de Pago"></a></li>
        </ul>
      </div>
{/if}
