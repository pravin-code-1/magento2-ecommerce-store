<?php

use Magento\Framework\App\Bootstrap;
require 'app/bootstrap.php';

$bootstrap = Bootstrap::create(BP, $_SERVER);
$objectManager = $bootstrap->getObjectManager();
$state = $objectManager->get('Magento\Framework\App\State');
$state->setAreaCode('frontend');

$productCollection = $objectManager->create('Magento\Catalog\Model\ResourceModel\Product\CollectionFactory')->create();

$productCollection->addAttributeToSelect('price');  
$productCollection->addAttributeToFilter('price', ['gt' => 1]);

$productCollection->load();

echo "<pre>";

foreach ($productCollection as $product) {
    // print_r(get_class_methods($product));
    $price = (float) $product->getPrice();
    $product->setPrice($price);
    // exit;
    echo "Product Price : " .$product->getPrice() . "<br/>";
}
$productCollection->save();

echo 'Test Script Complete';
exit;
