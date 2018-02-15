<div id="footer">
    <div class="container">
        <p>© Copyright 2016 VERSALIUS</p>
    </div>
</div>
</div>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
<script type='text/javascript'>var base_url = {url: "<?= base_url() ?>"};</script>
<script src="<?= base_url("assets/js/bootstrap.min.js") ?>"></script>
<script src="<?= base_url("assets/js/bootstrap-select.min.js") ?>"></script>

<?php if (isset($scripts)): ?>
    <?php foreach ($scripts as $script): ?>
        <script src="<?= $script ?>"></script>
    <?php endforeach; ?>
<?php endif; ?>

<?php if (isset($functions_scripts)): ?>
    <?php foreach ($functions_scripts as $value): ?>
        <script><?= $value ?></script>
    <?php endforeach; ?>
<?php endif; ?>

</body>

</html>
