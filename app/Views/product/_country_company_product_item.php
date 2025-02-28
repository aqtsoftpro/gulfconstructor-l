<div><?=$product->company;?></div>
<div><span style="font-weight:500;"><?=getCountryNameById($product->country_id);?></span> | <span style="font-weight:500;"><?=getJoinedYears($product->created_at);?></span></div>
<div><span style="font-weight:600;"><?=getBusinessTypeNameById($product->business_type);?></span></div>