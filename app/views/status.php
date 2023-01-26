<?php $this->layout('layout', ['title' => 'Status',
    'auth_id' => $auth_id,]) ?>

<div class="subheader">
    <h1 class="subheader-title">
        <i class='subheader-icon fal fa-sun'></i> Установить статус
    </h1>

</div>
<?php echo flash(); ?>
<form action="/user/<?= $user['user_id'] ?>/status" method="POST">
    <div class="row">
        <div class="col-xl-6">
            <div id="panel-1" class="panel">
                <div class="panel-container">
                    <div class="panel-hdr">
                        <h2>Установка текущего статуса</h2>
                    </div>
                    <div class="panel-content">
                        <div class="row">
                            <div class="col-md-4">
                                <!-- status -->
                                <div class="form-group">
                                    <label class="form-label" for="example-select">Выберите статус</label>
                                    <select name="status" class="form-control" id="example-select">
                                        <option value="success">Онлайн</option>
                                        <option value="warning">Отошел</option>
                                        <option value="danger">Не беспокоить</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-12 mt-3 d-flex flex-row-reverse">
                                <button type="submit" class="btn btn-warning">Set Status</button>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
</form>