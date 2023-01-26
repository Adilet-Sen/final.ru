<?php $this->layout('layout', ['title' => 'Восстановление пароля.',
    'auth_id' => $auth_id,]) ?>

<section class="hero is-dark">
    <div class="hero-body">
        <div class="container">
            <h2 class="subtitle">
                Письмо придет вам на почту.
            </h2>
        </div>
    </div>
</section>
<div class="container main-content">
    <div class="columns">
        <div class="column"></div>
        <div class="column is-quarter auth-form col-4">
            <?= flash(); ?>
            <form action="/password-recovery/recovery" method="post">
                <div class="field">

                    <div class="form-group">
                        <label class="form-label">Email</label>
                        <input class="form-control" type="email" name="email">  <!-- is-danger -->
                        <!-- <span class="icon is-small is-right">
                          <i class="fas fa-exclamation-triangle"></i>
                        </span> -->
                    </div>
                    <!-- <p class="help is-danger">This email is invalid</p> -->
                </div>
                <div class="field is-grouped">
                    <div class="form-group mt-2">
                        <button class="btn btn-default float-right" type="submit">Отправить</button>
                    </div>
                </div>
                <div class="field">
                    <p>Нет аккаунта? <b><a href="/register">Регистрация</a></b></p>
                    <p>Не пришло письмо подтверждения? <b><a href="/email-verification">Переотправить</a></b></p>
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