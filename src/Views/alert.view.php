<?php if ($alert): ?>
    <div class="row">
        <div class="alert alert-<?= $alert->type ?> alert-dismissible fade show" role="alert">
            <?= $alert->message ?>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    </div>
<?php endif; ?>