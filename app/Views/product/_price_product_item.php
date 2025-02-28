<?php if ($product->is_free_product == 1): ?>
    <span class="price-free"><?= trans("free"); ?></span>
<?php elseif ($product->listing_type == 'bidding'): ?>
    <a href="<?= generateProductUrl($product); ?>" class="a-meta-request-quote"><?= trans("request_a_quote") ?></a>
<?php else:
    if (!empty($product->price)):
        $convertCurreny = true;
        if ($product->listing_type == 'ordinary_listing') {
            $convertCurreny = false;
        } ?>
        <span class="price"><?= priceFormatted($product->price_discounted, $product->currency, $convertCurreny); ?></span>
        <?php if (!empty($product->discount_rate)): ?>
        - <span class="discount-original-price">
            <?= priceFormattedWOCurr($product->price, $product->currency, $convertCurreny); ?><span class="unit_info"> / <?=$gUnit=getUnits($product->id); ?></span>
            <div class="moq_info"><?=getMOQ($gUnit, $product->id); ?></div>
        </span>
    <?php endif;
    endif;
endif; ?>