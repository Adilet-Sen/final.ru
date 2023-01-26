<?php $this->layout('layout', ['title' => 'About',
    'auth_id' => $auth_id]) ?>

<div class="subheader">
    <h1 class="subheader-title">
        <i class='subheader-icon fal fa-info'></i> Проект выполнин с помощью следующих компонентов:
    </h1>
</div>
<div class="row">
    <div class="col-lg-6 col-xl-6 m-auto">
        <!-- profile summary -->
        <div class="card mb-g rounded-top">
            <div class="row no-gutters row-grid">
                <div class="col-12">
                    <div class="d-flex flex-column align-items-center justify-content-center p-4">
                        <img src="/uploads/logo.png" class="rounded-circle shadow-2 img-thumbnail" alt="" width="400">
                        <h5 class="mb-0 fw-700 text-center mt-3">
                            Компоненты:
                        </h5>
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th scope="col">#</th>
                                    <th scope="col">Название</th>
                                    <th scope="col">Для чего</th>
                                    <th scope="col">Откуда</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <th scope="row">1</th>
                                    <td>Mark</td>
                                    <td>Otto</td>
                                    <td>@mdo</td>
                                </tr>
                                <tr>
                                    <th scope="row">3</th>
                                    <td colspan="2">Larry the Bird</td>
                                    <td>@twitter</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>