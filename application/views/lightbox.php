<!DOCTYPE html>
<html>
    <head>
        <script
            type="text/javascript"
            src="https://stc.sandbox.pagseguro.uol.com.br/pagseguro/api/v2/checkout/pagseguro.lightbox.js">
        </script>
		<?php echo $code ?>
		<script>PagSeguroLightbox('<?= $code ?>');</script>
    </head>
</html>
