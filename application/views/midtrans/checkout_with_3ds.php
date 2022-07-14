<html>
<head>
	<title>Checkout</title>
	<link rel="stylesheet" href="<?php echo base_url();?>asset/css/jquery.fancybox.css">
</head>
<body>
	<script type="text/javascript" src="https://api.sandbox.veritrans.co.id/v2/assets/js/veritrans.min.js"></script>
	<script src="//ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>
	<script type="text/javascript" src="<?php echo base_url();?>asset/js/jquery.fancybox.pack.js"></script>
	<h1>Checkout</h1>
	<form action="<?php echo site_url()?>/vtdirect/vtdirect_cc_charge" method="POST" id="payment-form">
		<fieldset>
			<legend>Checkout</legend>
			<p>
				<label>Card Number</label>
				<input class="card-number" value="4811111111111114" size="20" type="text" autocomplete="off"/>
			</p>
			<p>
				<label>Expiration (MM/YYYY)</label>
				<input class="card-expiry-month" value="12" placeholder="MM" size="2" type="text" />
		    	<span> / </span>
		    	<input class="card-expiry-year" value="2018" placeholder="YYYY" size="4" type="text" />
			</p>
			<p>
		    	<label>CVV</label>
		    	<input class="card-cvv" value="123" size="4" type="password" autocomplete="off"/>
			</p>
			<p>
		    	<label>Save credit card</label>
		    	<input type="checkbox" name="save_cc" value="true">
			</p>
			<input id="token_id" name="token_id" type="hidden" />
			<button class="submit-button" type="submit">Submit Payment</button>
		</fieldset>
	</form>
	<script type="text/javascript">
	$(function(){
		Veritrans.url = "https://api.sandbox.veritrans.co.id/v2/token";
		Veritrans.client_key = "VT-client-tsQabcFjwuwUuN7a";
		var card = function(){
			return { 	'card_number'		: $(".card-number").val(),
						'card_exp_month'	: $(".card-expiry-month").val(),
						'card_exp_year'		: $(".card-expiry-year").val(),
						'card_cvv'			: $(".card-cvv").val(),
						'secure'			: true,
						'bank'				: 'bni',
						'gross_amount'		: 10000
						 }
		};
		function callback(response) {
			if (response.redirect_url) {
				openDialog(response.redirect_url);
			} else if (response.status_code == '200') {
				closeDialog();
				$(".submit-button").attr("disabled", "disabled"); 
				$("#token_id").val(response.token_id);
				$("#payment-form").submit();
			} else {
				console.log('Close Dialog - failed');
			}
		}
		function openDialog(url) {
			$.fancybox.open({
		        href: url,
		        type: 'iframe',
		        autoSize: false,
		        width: 700,
		        height: 500,
		        closeBtn: false,
		        modal: true
		    });
		}
		function closeDialog() {
			$.fancybox.close();
		}
		$('.submit-button').click(function(event){
			event.preventDefault();
			Veritrans.token(card, callback);
			return false;
		});
	});
	</script>
</body>
</html>
