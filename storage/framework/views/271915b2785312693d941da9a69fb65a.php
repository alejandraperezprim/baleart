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
        <h1 class="text-2xl font-bold mb-4">Gestión de Espacios</h1>
        
        <table class="w-full bg-white shadow-md rounded-lg overflow-hidden border border-gray-300">
            <thead class="bg-gray-200">
                <tr>
                    <th class="p-3 border">Nombre</th>
                    <th class="p-3 border">Tipo</th>
                    <th class="p-3 border">Acciones</th>
                </tr>
            </thead>
            <tbody>
                <?php $__currentLoopData = $spaces; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $space): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <tr class="text-center border">
                        <td class="p-3"><?php echo e($space->name); ?></td>
                        <td class="p-3"><?php echo e($space->spaceType->name ?? 'Sin tipo'); ?></td>
                        <td class="p-3 flex justify-center gap-2">
                            <a href="#" class="bg-yellow-500 text-white px-3 py-1 rounded">Editar</a>
                            <form action="#" method="POST">
                                <?php echo csrf_field(); ?> <?php echo method_field('DELETE'); ?>
                                <button type="submit" class="bg-red-500 text-white px-3 py-1 rounded">Eliminar</button>
                            </form>
                        </td>
                    </tr>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </tbody>
        </table>
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
<?php /**PATH C:\laragon\www\baleart\resources\views\spaces\index.blade.php ENDPATH**/ ?>