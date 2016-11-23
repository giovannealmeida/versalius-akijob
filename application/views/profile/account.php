<h2 class="profile-page-title"><strong>Gerenciamento de Conta</strong></h2>
<div class="divider"></div>
<br>
<div class="row">
    <div class="col-xs-12 col-sm-12 col-md-4">
        <div class="row">
            <div class="col-xs-12">
                <div class="form-group">
                    <a onclick="return confirm('Tem certeza que deseja excluir sua conta?')" href="<?= base_url("profile/excluir/{$user_profile->id}")?>" class="btn btn-danger">Excluir conta</a>
                    <a href="" class="btn btn-warning">Desativar conta</a>
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
