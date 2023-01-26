<?php $this->layout('layout', ['title' => 'Восстановление пароля.',
    'auth_id' => $auth_id,]) ?>

<section class="hero is-dark">
    <div class="hero-body">
        <div class="container">
            <h2 class="subtitle">
                Введите новый пароль.
            </h2>
        </div>
    </div>
</section>
<div class="container main-content">
    <div class="columns">
        <div class="column is-quarter auth-form col-4">
            <?= flash(); ?>
            <form action="/password-recovery/change" method="post">
                <input type="hidden" name="selector" value="<?= $data['selector'];?>">
                <input type="hidden" name="token" value="<?= $data['token'];?>">
                <div class="field">
                    <label class="label">Новый пароль</label>
                    <div class="control has-icons-left has-icons-right">

                        <input class="form-control" type="password" name="password">  <!-- is-danger -->

                        <!-- <span class="icon is-small is-right">
                          <i class="fas fa-exclamation-triangle"></i>
                        </span> -->
                    </div>
                    <!-- <p class="help is-danger">This email is invalid</p> -->
                </div>

                <div class="field is-grouped">
                    <div class="control">
                        <button class="btn btn-default float-right" type="submit">Отправить</button>
                    </div>
                </div>
            </form>

        </div>
        <div class="column"></div>
    </div>
</div>

<!--<form action="/login" method="POST">-->
<!--    <div class="form-group">-->
<!--        <label class="form-label" for="username">Email</label>-->
<!--        <input name="email" type="email" id="username" class="form-control" placeholder="Эл. адрес" value="">-->
<!--    </div>-->
<!--    <div class="form-group">-->
<!--        <label class="form-label" for="password">Пароль</label>-->
<!--        <input name="password" type="password" id="password" class="form-control" placeholder="">-->
<!--    </div>-->
<!--    <button type="submit" class="btn btn-default float-right">Войти</button>-->
<!--</form>-->