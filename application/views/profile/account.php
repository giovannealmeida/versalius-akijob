<h2 class="profile-page-title"><strong>Gerenciamento de Conta</strong></h2>
<div class="divider"></div>
<br>
<div class="row">
    <div class="col-xs-12 col-sm-12 col-md-4">
        <div class="row">
            <div class="col-xs-12">
                <div class="form-group">
                    <a onclick="return confirm('Tem certeza que deseja excluir sua conta?')" href="<?= base_url("profile/excluir/{$user_profile->id}") ?>" class="btn btn-danger">Excluir conta</a>
                    <?php if ($user_profile->id_status == 1) : ?>
                        <a onclick="return confirm('Tem certeza que deseja desativar sua conta?')" href="<?= base_url("profile/disable/{$user_profile->id}") ?>" class="btn btn-warning">Desativar conta</a>
                    <?php else: ?>
                        <a onclick="return confirm('Tem certeza que deseja ativar sua conta?')" href="<?= base_url("profile/active/{$user_profile->id}") ?>" class="btn btn-success">Ativar conta</a>
                    <?php endif; ?>    
                </div>
            </div>
        </div>
    </div>
</div>

</div> <!-- END PROFILE-CONTENT -->

</div> <!-- END COL -->
</div> <!-- END ROW -->
</div> <!-- END CONTAINER -->

</div>
