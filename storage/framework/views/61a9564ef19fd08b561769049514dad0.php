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
        <h1 class="text-2xl font-bold mb-4">Editar Usuario</h1>

        <form action="<?php echo e(route('users.update', $user)); ?>" method="POST" class="bg-white p-6 rounded-lg shadow-md">
            <?php echo csrf_field(); ?>
            <?php echo method_field('PUT'); ?>

            <label class="block mb-2">Nombre:</label>
            <input type="text" name="name" value="<?php echo e($user->name); ?>" required class="border p-2 w-full rounded">

            <label class="block mt-4 mb-2">Apellidos:</label>
            <input type="text" name="lastname" value="<?php echo e($user->lastname); ?>" required class="border p-2 w-full rounded">

            <label class="block mt-4 mb-2">Teléfono:</label>
            <input type="text" name="phone" value="<?php echo e($user->phone); ?>" required class="border p-2 w-full rounded">

            <label class="block mt-4 mb-2">Correo:</label>
            <input type="email" name="email" value="<?php echo e($user->email); ?>" required class="border p-2 w-full rounded">

            <button type="submit" class="mt-4 bg-yellow-500 text-white px-4 py-2 rounded hover:bg-yellow-600 transition">Actualizar</button>
        </form>
    </div>
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
<?php /**PATH C:\laragon\www\baleart\resources\views\users\edit.blade.php ENDPATH**/ ?>