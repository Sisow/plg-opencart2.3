<!--<h2><?php echo $text_header; ?></h2>-->
<div id="sisowwg_payment" class="checkout-content">
  <img src="https://www.sisow.nl/Sisow/images/ideal/logowsgc.gif" border="0" height="40" />
</div>
<div class="buttons pull-right">
  <input type="button" value="<?php echo $button_confirm; ?>" id="sisowwg_confirm" class="btn btn-primary" />
</div>

<script type="text/javascript"><!--
$('#sisowwg_confirm').on('click', function() {
	$.ajax({ 
		type: 'POST',
		url: 'index.php?route=extension/payment/sisowwg/redirectbank',
		data: $('#sisowwg_payment :input'),
		dataType: 'json',
		cache: false,
		beforeSend: function() {
			$('#sisowwg_confirm').button('loading');
		},
		complete: function() {
			$('#sisowwg_confirm').button('reset');
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

