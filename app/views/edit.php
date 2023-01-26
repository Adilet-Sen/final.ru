<?php $this->layout('layout', ['title' => 'Edit',
    'auth_id' => $auth_id,]) ?>

<div class="subheader">
    <h1 class="subheader-title">
        <i class='subheader-icon fal fa-plus-circle'></i> Редактировать
    </h1>

</div>
<?= flash(); ?>
<form action="/user/<?= $user['user_id'] ?>/edit" method="POST">
    <div class="row">
        <div class="col-xl-6">
            <div id="panel-1" class="panel">
                <div class="panel-container">
                    <div class="panel-hdr">
                        <h2>Общая информация</h2>
                    </div>
                    <div class="panel-content">
                        <!-- username -->
                        <div class="form-group">
                            <label class="form-label" for="simpleinput">Имя</label>
                            <input name="username" type="text" id="simpleinput" class="form-control" value="<?= $user['username'] ?>">
                        </div>

                        <!-- title -->
                        <div class="form-group">
                            <label class="form-label" for="simpleinput">Место работы</label>
                            <input name="work_place" type="text" id="simpleinput" class="form-control" value="<?= $user['work_place'] ?>">
                        </div>

                        <!-- tel -->
                        <div class="form-group">
                            <label class="form-label" for="simpleinput">Номер телефона</label>
                            <input name="number" type="text" id="simpleinput" class="form-control" value="<?= $user['number'] ?>">
                        </div>

                        <!-- address -->
                        <div class="form-group">
                            <label class="form-label" for="simpleinput">Адрес</label>
                            <input name="address" type="text" id="simpleinput" class="form-control" value="<?= $user['address'] ?>">
                        </div>
                        <div class="col-md-12 mt-3 d-flex flex-row-reverse">
                            <button type="submit" class="btn btn-warning">Редактировать</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</form>