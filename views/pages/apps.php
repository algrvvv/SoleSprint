<?php

use App\Services\Session\Session;
use App\Services\Views\View;

View::render_header('header', 'Все заявки пользователя');
$s = new Session();
$data = $s->get_session('data');
?>

<h1 class="text-center mt-2">Все заявки: </h1>


<div class="container">
    <?php
    if (isset($data)) {
    ?>
        <table class="table align-middle mb-0 bg-white">
            <thead class="bg-light">
                <tr>
                    <th>Name</th>
                    <th>Phone</th>
                    <th>Status</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>
                        <div class="d-flex align-items-center">
                            <div class="ms-3">
                                <p class="fw-normal mb-1"><?= $data['name'] ?></p>
                            </div>
                        </div>
                    </td>
                    <td>
                        <p class="fw-normal mb-1"><?= $data['phone'] ?></p>
                    </td>
                    <td>
                        <?php
                        if ($data['status'] != 'verified') {
                        ?>
                            <span class="text-white bg-danger p-1 rounded"><?= $data['status'] ?></span>
                        <?php
                        } else {
                        ?>
                            <span class="text-white bg-success p-1 rounded">Verified</span>
                        <?php
                        }
                        ?>
                    </td>
                    <td>
                        <button type="button" class="btn btn-link btn-sm btn-rounded">
                            Delete
                        </button>
                    </td>
                </tr>
            </tbody>
        </table>
    <?php
    } else {
    ?>
        <span>Заявок нет</span>
    <?php
    }
    $s->unset_session('data');
    ?>
</div>
