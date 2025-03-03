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

        <!-- Botón para crear un nuevo espacio -->
        <div class="mb-4">
            <a href="<?php echo e(route('spaces.create')); ?>" class="bg-blue-500 text-white px-20 py-2 rounded hover:bg-blue-600 transition">Crear Nuevo Espacio</a>
        </div>

        <!-- Filtro -->
        <form method="GET" class="mb-4">
            <label class="mr-2">Ordenar por:</label>
            <select name="sort" onchange="this.form.submit()" class="border p-2 rounded">
                <option value="id_asc" <?php echo e(request('sort') == 'id_asc' ? 'selected' : ''); ?>>ID (Ascendente)</option>
                <option value="updated_at" <?php echo e(request('sort') == 'updated_at' ? 'selected' : ''); ?>>Fecha de Modificación</option>
                <option value="total_score" <?php echo e(request('sort') == 'total_score' ? 'selected' : ''); ?>>Total Score</option>
            </select>
        </form>

        <div class="bg-white shadow-md rounded-lg overflow-hidden border border-gray-300">
            <table class="w-full border-collapse">
                <thead class="bg-gray-200">
                    <tr>
                        <th class="p-3 border">ID</th>
                        <th class="p-3 border">Nombre</th>
                        <th class="p-3 border">Total Score</th>
                        <th class="p-3 border">Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $__currentLoopData = $spaces; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $space): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <tr class="text-center border border-gray-300 hover:bg-gray-100 transition">
                            <td class="p-3 border"><?php echo e($space->id); ?></td>
                            <td class="p-3 border"><?php echo e($space->name); ?></td>
                            <td class="p-3 border"><?php echo e($space->totalScore ?? 'N/A'); ?></td>
                            <td class="p-3 flex justify-center gap-2">
                                <a href="<?php echo e(route('spaces.edit', $space)); ?>" class="bg-yellow-500 text-white px-3 py-1 rounded hover:bg-yellow-600 transition">Editar</a>
                                <form action="<?php echo e(route('spaces.destroy', $space)); ?>" method="POST" onsubmit="return confirm('¿Estás seguro de eliminar este espacio?');">
                                    <?php echo csrf_field(); ?> <?php echo method_field('DELETE'); ?>
                                    <button type="submit" class="bg-red-500 text-white px-3 py-1 rounded hover:bg-red-600 transition">Eliminar</button>
                                </form>
                            </td>
                        </tr>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </tbody>
            </table>
        </div>

        <div class="mt-4">
            <?php echo e($spaces->links()); ?>

        </div>
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
<?php /**PATH C:\laragon\www\baleart\resources\views/spaces/index.blade.php ENDPATH**/ ?>