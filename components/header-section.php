<?php
// Componente Header Section
$title = isset($title) ? $title : '';
$description = isset($description) ? $description : '';
?>
<div class="flex flex-col">
    <h1 class="text-3xl font-bold text-clev-blue leading-tight">
        <?php echo e($title); ?>
    </h1>
    <p class="text-sm font-semibold text-clev-text mb-2">
        <?php echo e($description); ?>
    </p>
</div>
