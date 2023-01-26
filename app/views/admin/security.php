<?php $this->layout('layout', [
    'title' => 'Security',
    'auth_id' => $auth_id
]) ?>

<div class="subheader">
    <h1 class="subheader-title">
        <i class='subheader-icon fal fa-lock'></i> Безопасность
    </h1>

</div>
<?= flash(); ?>
<form action="/admin/user/<?= $user['user_id'] ?>/security_email" method="POST">
    <div class="row">
        <div class="col-xl-6">
            <div id="panel-1" class="panel">
                <div class="panel-container">
                    <div class="panel-hdr">
                        <h2>Обновление эл. адреса</h2>
                    </div>
                    <div class="panel-content">
                        <!-- email -->
                        <div class="form-group">
                            <label class="form-label" for="simpleinput">Email</label>
                            <input name="newEmail" type="text" id="simpleinput" class="form-control" value="<?= $user['email'] ?>">
                        </div>
                        <div class="col-md-12 mt-3 d-flex flex-row-reverse">
                            <button type="submit" class="btn btn-warning">Изменить</button>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
</form>

<form action="/admin/user/<?= $user['user_id'] ?>/security_password" method="POST">
    <div class="row">
        <div class="col-xl-6">
            <div id="panel-1" class="panel">
                <div class="panel-container">
                    <div class="panel-hdr">
                        <h2>Обновление пароля</h2>
                    </div>
                    <div class="panel-content">
                        <!-- password -->
                        <div class="form-group">
                            <label class="form-label" for="simpleinput">Текущий пароль</label>
                            <input name="password" type="password" id="simpleinput" class="form-control">
                        </div>

                        <!-- password confirmation-->
                        <div class="form-group">
                            <label class="form-label" for="simpleinput">Новый пароля</label>
                            <input name="newPassword" type="password" id="simpleinput" class="form-control">
                        </div>


                        <div class="col-md-12 mt-3 d-flex flex-row-reverse">
                            <button type="submit" class="btn btn-warning">Изменить</button>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
</form>