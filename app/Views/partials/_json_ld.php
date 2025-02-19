<?php if (!empty($jLDType)):
if ($jLDType == 'index'): ?>
<script type="application/ld+json">
{
"@context": "https://schema.org",
"@type": "WebSite",
"name": "<?= clrDoubleQuotes(esc($generalSettings->application_name)); ?>",
"url": "<?= base_url(); ?>",
"potentialAction": {
    "@type": "SearchAction",
    "target": "<?= generateUrl('products'); ?>?search={search_term_string}",
    "query-input": "required name=search_term_string"
    }
}
</script>
<?php elseif ($jLDType == 'category'): ?>
<script type="application/ld+json">{
"@context": "http://schema.org",
"@type": "BreadcrumbList",
"itemListElement": [
    {
    "@type": "ListItem",
    "position": 1,
    "name": "<?= clrDoubleQuotes(trans("home")); ?>",
    "item": "<?= base_url(); ?>"
    }<?= !empty($parentCategoriesTree) ? ','.PHP_EOL : PHP_EOL;?>
<?php $i = 1;
if (!empty($parentCategoriesTree)):
foreach ($parentCategoriesTree as $item): ?>
    {
    "@type": "ListItem",
    "position": <?= $i + 1; ?>,
    "name": "<?= clrDoubleQuotes(getCategoryName($item, $activeLang->id)); ?>",
    "item": "<?= clrDoubleQuotes(generateCategoryUrl($item)); ?>"
    }<?= countItems($parentCategoriesTree) > $i ? ','.PHP_EOL : PHP_EOL;?>
<?php $i++;
endforeach;
endif; ?>
]}
</script>
<?php elseif ($jLDType == 'product'):
$i = 1;
$strCategories = '';
if (!empty($parentCategoriesTree)){
    foreach ($parentCategoriesTree as $item) {
        $strCategories .= $strCategories != '' ? ' > ' : '';
        $strCategories .= getCategoryName($item, $activeLang->id);
        $i++;
    }
}?>
<script type="application/ld+json">{
"@context": "https://schema.org",
"@type": "Product",
"url": "<?= generateProductUrl($product); ?>",
"name": "<?= !empty($productDetails) ? clrDoubleQuotes(esc($productDetails->title)) : ''; ?>",
"description":  "<?= !empty($productDetails) ? clrDoubleQuotes(esc($productDetails->short_description)) : ''; ?>",
"image": [
<?php $i = 0;
foreach ($productImages as $item) {
if ($i > 0) {
echo ',' . PHP_EOL;
}
echo '"' . getProductImageURL($item, 'image_default') . '"';
$i++;
} ?>],
"category": "<?= clrDoubleQuotes($strCategories); ?>",
<?php if(!empty(clrDoubleQuotes($productBrand))): ?>
"brand": {
    "@type": "Brand",
    "name": "<?= clrDoubleQuotes($productBrand); ?>"
},
<?php endif; ?>
<?php if($reviewsCount > 0 && $product->rating > 0 ): ?>
"aggregateRating": {
    "@type": "AggregateRating",
    "ratingValue": "<?= esc($product->rating); ?>",
    "ratingCount": "<?= esc($reviewsCount); ?>"
},
<?php endif; ?>
"offers": {
"@type": "Offer",
<?php if (checkProductStock($product)): ?>
"availability": "http://schema.org/InStock",
<?php else: ?>
"availability": "http://schema.org/OutOfStock",
<?php endif; ?>
"priceCurrency": "<?= esc($product->currency); ?>",
"url": "<?= generateProductUrl($product); ?>",
"price": "<?= getPrice($product->price_discounted, 'decimal'); ?>",
"seller": {
    "@type": "Organization",
    "name": "<?= clrDoubleQuotes(esc($product->user_username)); ?>"
}}
}</script>
<?php endif;
endif; ?>