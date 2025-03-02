<div class="meta-box"><?=$product->company;?></div>
<div class="meta-box"><span style="font-weight:500;"><?=getCountryNameById($product->country_id);?></span> | <span style="font-weight:500;"><?=getJoinedYears($product->created_at);?></span></div>
<div class="meta-box margin-div"><span style="font-weight:600;"><?=getBusinessTypeNameById($product->business_type);?></span></div>