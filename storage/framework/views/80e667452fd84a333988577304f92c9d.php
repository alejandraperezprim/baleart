<?php if (isset($component)) { $__componentOriginal9ac128a9029c0e4701924bd2d73d7f54 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal9ac128a9029c0e4701924bd2d73d7f54 = $attributes; } ?>
<?php $component = App\View\Components\AppLayout::resolve([] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('app-layout'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\App\View\Components\AppLayout::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes([]); ?>
    <div class="container mx-auto p-6">
        <h1 class="text-2xl font-bold mb-4">Editar Espacio</h1>

        <form action="<?php echo e(route('spaces.update', $space)); ?>" method="POST">
            <?php echo csrf_field(); ?>
            <?php echo method_field('PUT'); ?>

            <label class="block mb-2">Nombre:</label>
            <input type="text" name="name" value="<?php echo e(old('name', $space->name)); ?>" required class="border p-2 w-full rounded">

            <label class="block mt-4 mb-2">Total Score:</label>
            <input type="number" name="totalScore" value="<?php echo e(old('totalScore', $space->totalScore)); ?>" step="0.1" required class="border p-2 w-full rounded">

            <!-- Observaciones con CKEditor -->
            <label class="block mt-4 mb-2">Observaciones (CA):</label>
            <textarea name="observation_CA" id="editor_ca" class="border p-2 w-full rounded"><?php echo e(old('observation_CA', $space->observation_CA)); ?></textarea>

            <label class="block mt-4 mb-2">Observaciones (ES):</label>
            <textarea name="observation_ES" id="editor_es" class="border p-2 w-full rounded"><?php echo e(old('observation_ES', $space->observation_ES)); ?></textarea>

            <label class="block mt-4 mb-2">Observaciones (EN):</label>
            <textarea name="observation_EN" id="editor_en" class="border p-2 w-full rounded"><?php echo e(old('observation_EN', $space->observation_EN)); ?></textarea>

            <button type="submit" class="mt-4 bg-yellow-500 text-white px-4 py-2 rounded hover:bg-yellow-600 transition">Actualizar</button>
        </form>
    </div>

    <script src="https://cdn.ckeditor.com/ckeditor5/39.0.0/classic/ckeditor.js"></script>
    <script>
        ClassicEditor.create(document.querySelector('#editor_ca'));
        ClassicEditor.create(document.querySelector('#editor_es'));
        ClassicEditor.create(document.querySelector('#editor_en'));
    </script>
 <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal9ac128a9029c0e4701924bd2d73d7f54)): ?>
<?php $attributes = $__attributesOriginal9ac128a9029c0e4701924bd2d73d7f54; ?>
<?php unset($__attributesOriginal9ac128a9029c0e4701924bd2d73d7f54); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal9ac128a9029c0e4701924bd2d73d7f54)): ?>
<?php $component = $__componentOriginal9ac128a9029c0e4701924bd2d73d7f54; ?>
<?php unset($__componentOriginal9ac128a9029c0e4701924bd2d73d7f54); ?>
<?php endif; ?>
<?php /**PATH C:\laragon\www\baleart\resources\views/spaces/edit.blade.php ENDPATH**/ ?>