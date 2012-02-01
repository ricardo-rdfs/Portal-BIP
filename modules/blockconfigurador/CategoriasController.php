<?php

class CategoriasControllerCore extends FrontController
{
	public $php_self = 'categorias.php';
	
	protected $category;

	public function setMedia()
	{
		parent::setMedia();
		Tools::addCSS(array(
			_PS_CSS_DIR_.'jquery.cluetip.css' => 'all',
			_THEME_CSS_DIR_.'scenes.css' => 'all',
			_THEME_CSS_DIR_.'category.css' => 'all',
			_THEME_CSS_DIR_.'product_list.css' => 'all'));

		if (Configuration::get('PS_COMPARATOR_MAX_ITEM') > 0)
			Tools::addJS(_THEME_JS_DIR_.'products-comparison.js');
	}

	public function displayHeader()
	{
		parent::displayHeader();
		$this->productSort();
	}

	public function canonicalRedirection()
	{
		
	}
	
	public function preProcess()
	{
		if ($id_category = (int)Tools::getValue('id_category'))
			$this->category = new Category($id_category, self::$cookie->id_lang);
		if (!Validate::isLoadedObject($this->category))
		{
			header('HTTP/1.1 404 Not Found');
			header('Status: 404 Not Found');
		}
		else
			$this->canonicalRedirection();
		
		parent::preProcess();
	}

	public function getSubCats($cat)
	{
		//global $smarty, $cookie;

		$id_group = _PS_DEFAULT_CUSTOMER_GROUP_;
		$id_product = (int)(Tools::getValue('id_product', 0));
		$id_lang = 3;//(int)($params['cookie']->id_lang);
		$maxdepth = Configuration::get('BLOCK_CATEG_MAX_DEPTH');
		if (!$result3 = Db::getInstance(_PS_USE_SQL_SLAVE_)->ExecuteS('
			SELECT c.id_parent, c.id_category, cl.name, cl.description, cl.link_rewrite
			FROM `'._DB_PREFIX_.'category` c
			LEFT JOIN `'._DB_PREFIX_.'category_lang` cl ON (c.`id_category` = cl.`id_category` AND `id_lang` = '.$id_lang.')
			LEFT JOIN `'._DB_PREFIX_.'category_group` cg ON (cg.`id_category` = c.`id_category`)
			WHERE (c.`active` = 1 OR c.`id_category` = 1)
			AND cg.`id_group` = '.$id_group.'
			AND c.`id_parent` = '.$cat.'
			ORDER BY `level_depth` ASC, c.`position` ASC')
		)
		return;
		foreach ($result3 as &$row)
		{
			$resultSubcats[] = &$row;
		}
		return $resultSubcats;
	}
	
	public function process()
	{
		parent::process();
		if (!($id_category = (int)Tools::getValue('id_category')) OR !Validate::isUnsignedId($id_category))
			$this->errors[] = Tools::displayError('Missing category ID');
		else
		{
			if (!Validate::isLoadedObject($this->category))
				$this->errors[] = Tools::displayError('Category does not exist');
			elseif (!$this->category->checkAccess((int)(self::$cookie->id_customer)))
				$this->errors[] = Tools::displayError('You do not have access to this category.');
			elseif (!$this->category->active)
				self::$smarty->assign('category', $this->category);
			else
			{
				$rewrited_url = self::$link->getCategoryLink((int)$this->category->id, $this->category->link_rewrite);

				/* Scenes  (could be externalised to another controler if you need them */
				self::$smarty->assign('scenes', Scene::getScenes((int)($this->category->id), (int)(self::$cookie->id_lang), true, false));
				
				/* Scenes images formats */
				if ($sceneImageTypes = ImageType::getImagesTypes('scenes'))
				{
					foreach ($sceneImageTypes AS $sceneImageType)
					{
						if ($sceneImageType['name'] == 'thumb_scene')
							$thumbSceneImageType = $sceneImageType;
						elseif ($sceneImageType['name'] == 'large_scene')
							$largeSceneImageType = $sceneImageType;
					}
					self::$smarty->assign('thumbSceneImageType', isset($thumbSceneImageType) ? $thumbSceneImageType : NULL);
					self::$smarty->assign('largeSceneImageType', isset($largeSceneImageType) ? $largeSceneImageType : NULL);
				}

				$this->category->description = nl2br2($this->category->description);
				$subCategories = $this->category->getSubCategories((int)self::$cookie->id_lang);
				self::$smarty->assign('category', $this->category);
				
				if (isset($subCategories) AND !empty($subCategories) AND $subCategories)
				{
					self::$smarty->assign('subcategories', $subCategories);
					self::$smarty->assign(array(
						'subcategories_nb_total' => sizeof($subCategories),
						'subcategories_nb_half' => ceil(sizeof($subCategories) / 2)));
				}
				if ($this->category->id != 1)
				{
					$this->productListAssign();
					if($this->cat_products)
					{
						foreach ($this->cat_products AS $cat_product)
						{
							$prod_features[$cat_product["id_product"]]=Product::getFrontFeaturesStatic(self::$cookie->id_lang, $cat_product['id_product']);
							$aux_product = new Product($cat_product["id_product"], true, self::$cookie->id_lang);
							$aux_attributesGroups = $aux_product->getAttributesGroups((int)(self::$cookie->id_lang));
							foreach ($aux_attributesGroups AS $k => $row)
							{
								$aux_combinations[$row['attribute_name']]['price'] = (float)($row['price']);
							}
							$prod_combinations[$cat_product["id_product"]]=$aux_combinations;
							unset($aux_combinations);

							$p_comb_ref[$cat_product["id_product"]]= Product::getPRefInDatabase($cat_product["id_product"]);
						}
					}
				}
				if(isset($prod_features))
				self::$smarty->assign('prod_features', $prod_features);
				if(isset($prod_combinations))
				self::$smarty->assign('prod_combinations', $prod_combinations);
                                
                                self::$smarty->assign('prod_combinations_ref', $p_comb_ref);

				self::$smarty->assign(array(
					'isAccesories' => addslashes($_REQUEST['acces']),
					'products' => (isset($this->cat_products) AND $this->cat_products) ? $this->cat_products : NULL,
					'id_category' => (int)($this->category->id),
					'id_category_parent' => (int)($this->category->id_parent),
					'return_category_name' => Tools::safeOutput($this->category->name),
					'path' => Tools::getPath((int)($this->category->id)),
					'add_prod_display' => Configuration::get('PS_ATTRIBUTE_CATEGORY_DISPLAY'),
					'categorySize' => Image::getSize('category'),
					'mediumSize' => Image::getSize('medium'),
					'thumbSceneSize' => Image::getSize('thumb_scene'),
					'homeSize' => Image::getSize('home')
				));
				foreach ($subCategories AS $subCat)
				{
					$secondLevelCats[$subCat["id_category"]] =$this->getSubCats($subCat["id_category"]);
				}
				if(isset($secondLevelCats))
				self::$smarty->assign('secondLevelCats', $secondLevelCats);
				
				if (isset(self::$cookie->id_compare))
					self::$smarty->assign('compareProducts', CompareProduct::getCompareProducts((int)self::$cookie->id_compare));
			}
		}

		self::$smarty->assign(array(
			'allow_oosp' => (int)(Configuration::get('PS_ORDER_OUT_OF_STOCK')),
			'comparator_max_item' => (int)(Configuration::get('PS_COMPARATOR_MAX_ITEM')),
			'suppliers' => Supplier::getSuppliers()
		));
	}
	
	public function productListAssign()
	{
		$hookExecuted = false;
		Module::hookExec('productListAssign', array('nbProducts' => &$this->nbProducts, 'catProducts' => &$this->cat_products, 'hookExecuted' => &$hookExecuted));
		if(!$hookExecuted) // The hook was not executed, standard working
		{
			self::$smarty->assign('categoryNameComplement', '');
			$this->nbProducts = $this->category->getProducts(NULL, NULL, NULL, $this->orderBy, $this->orderWay, true);
			$this->pagination((int)$this->nbProducts); // Pagination must be call after "getProducts"
			$this->cat_products = $this->category->getProducts((int)(self::$cookie->id_lang), (int)($this->p), (int)($this->n), $this->orderBy, $this->orderWay);
		}
		else // Hook executed, use the override
			$this->pagination((int)$this->nbProducts); // Pagination must be call after "getProducts"
		self::$smarty->assign('nb_products', (int)$this->nbProducts);
	}

	public function displayContent()
	{
		parent::displayContent();
		self::$smarty->display('categoria.tpl');
	}
}

