<!DOCTYPE html>
<html>
    <head>
        <title>Minha loja</title>
    </head>
    <body>
        <button onclick="open_lightbox()">Pagar com lightbox</button>
        <script type="text/javascript"
            src="https://stc.sandbox.pagseguro.uol.com.br/pagseguro/api/v2/checkout/pagseguro.lightbox.js"></script>

			<script type="text/javascript">
			function open_lightbox(){
				var isOpenLightbox = PagSeguroLightbox({
				    code: '<?=$code?>'
				}, {
				    success : function(transactionCode) {
				        alert("success - " + transactionCode);
				    },
				    abort : function() {
				        alert("abort");
				    }
				});
				// Redirecionando o cliente caso o navegador não tenha suporte ao Lightbox
				if (!isOpenLightbox){
				    location.href="https://sandbox.pagseguro.uol.com.br/v2/checkout/payment.html?code="+code;
				}
			}
			</script>
    </body>
</html>
