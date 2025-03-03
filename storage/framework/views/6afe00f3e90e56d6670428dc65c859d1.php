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
        <h1 class="text-2xl font-bold mb-4">Gestión de Usuarios</h1>
        
        <?php if(session('success')): ?>
            <div class="bg-green-500 text-white p-3 my-3 rounded">
                <?php echo e(session('success')); ?>

            </div>
        <?php endif; ?>

        <div class="bg-white shadow-md rounded-lg overflow-hidden border border-gray-300">
            <table class="w-full border-collapse">
                <thead class="bg-gray-200">
                    <tr>
                        <th class="p-3 border">Nombre</th>
                        <th class="p-3 border">Email</th>
                        <th class="p-3 border">Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $__currentLoopData = $users; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $user): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <tr class="text-center border border-gray-300 hover:bg-gray-100 transition">
                            <td class="p-3 border"><?php echo e($user->name); ?></td>
                            <td class="p-3 border"><?php echo e($user->email); ?></td>
                            <td class="p-3 flex justify-center gap-2">
                                <a href="<?php echo e(route('users.edit', $user)); ?>" class="bg-green-500 text-white px-3 py-1 rounded hover:bg-green-600 transition">Editar</a>
                                <form action="<?php echo e(route('users.destroy', $user)); ?>" method="POST" onsubmit="return confirm('¿Estás seguro de eliminar este usuario?');">
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
            <?php echo e($users->links()); ?>

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
<?php /**PATH C:\laragon\www\baleart\resources\views\users\index.blade.php ENDPATH**/ ?>