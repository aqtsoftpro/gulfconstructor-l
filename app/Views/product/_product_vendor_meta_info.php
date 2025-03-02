<div class="margin-div"><img src="<?= getUserAvatarById($product->user_id); ?>" alt="<?= esc($product->user_username); ?>" id="img_preview_avatar" class="img-thumbnail" width="30" height="30">
   <span class="vendor_title"> <?=$product->user_username;?></span></div>
<div class="margin-div"><span style="font-weight:500;"><?=$product->country_code.'-'.$product->phone_number;?></span></div>
<div><span style="font-weight:600;">Business Plan</span></div>