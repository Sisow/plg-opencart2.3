<!--<h2><?php echo $text_header; ?></h2>-->
<div id="sisowbunq_payment" class="checkout-content">
  <img src="catalog/view/theme/default/image/bunq.png" alt="bunq" title="bunq" style="vertical-align: middle;" /><br/>
</div>
<div class="buttons pull-right">
  <input type="button" value="<?php echo $button_confirm; ?>" id="sisowbunq_confirm" class="btn btn-primary" />
</div>

<script type="text/javascript"><!--
$('#sisowbunq_confirm').on('click', function() {
	$.ajax({ 
		type: 'POST',
		url: 'index.php?route=extension/payment/sisowbunq/redirectbank',
		data: $('#sisowbunq_payment :input'),
		dataType: 'json',
		cache: false,
		beforeSend: function() {
			$('#sisowbunq_confirm').button('loading');
		},
		complete: function() {
			$('#sisowbunq_confirm').button('reset');
		},		
		success: function(json) {
			if (json['error']) {
				alert(json['error']);
			}
			
			if (json['redirect']) {
				location = json['redirect'];
			}
		}		
	});
});
//--></script> 
