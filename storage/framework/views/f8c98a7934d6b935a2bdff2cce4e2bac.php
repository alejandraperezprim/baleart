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
        <h1 class="text-2xl font-bold mb-4">Comentarios de <?php echo e($user->name); ?></h1>

        <?php if($comments->isEmpty()): ?>
            <p class="text-center text-gray-500">Este usuario actualmente no tiene ningún comentario.</p>
        <?php else: ?>
            <table class="w-full bg-white shadow-md rounded-lg overflow-hidden border border-gray-300">
                <thead class="bg-gray-200">
                    <tr>
                        <th class="p-3 border">Espacio</th>
                        <th class="p-3 border">Comentario</th>
                        <th class="p-3 border"></th>
                        <th class="p-3 border">Puntuación</th>
                        <th class="p-3 border">Fecha</th>
                        <th class="p-3 border">Estado</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $__currentLoopData = $comments; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $comment): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <tr class="text-center border">
                            <td class="p-3"><?php echo e($comment->space->name ?? 'Espacio desconocido'); ?></td>
                            <td class="p-3"><?php echo $comment->comment; ?></td>
                            <td class="p-3 flex justify-center gap-2">
                                <a href="<?php echo e(route('comments.edit', $comment)); ?>" class="bg-yellow-500 text-white px-3 py-1 rounded hover:bg-yellow-600 transition">Editar</a>
                            </td>
                            <td class="p-3"><?php echo e($comment->score); ?></td>
                            <td class="p-3"><?php echo e($comment->created_at->format('d-m-Y H:i')); ?></td>
                            <td class="p-3">
                                <form action="<?php echo e(route('comments.toggleStatus', $comment)); ?>" method="POST">
                                    <?php echo csrf_field(); ?>
                                    <?php echo method_field('PUT'); ?>
                                    <label class="flex items-center cursor-pointer">
                                        <input type="checkbox" class="sr-only peer" onchange="this.form.submit()" <?php echo e($comment->status === 'y' ? 'checked' : ''); ?>>
                                        <div class="w-10 h-5 bg-gray-300 rounded-full relative transition peer-checked:bg-green-500">
                                            <div class="w-4 h-4 bg-white rounded-full absolute top-0.5 left-1 peer-checked:left-5 transition"></div>
                                        </div>
                                        <span class="ml-2 text-sm font-medium text-gray-700"><?php echo e($comment->status === 'y' ? 'Publicado' : 'No Publicado'); ?></span>
                                    </label>
                                </form>
                            </td>
                        </tr>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </tbody>
            </table>
            <div class="mt-4">
                <?php echo e($comments->links()); ?>

            </div>
        <?php endif; ?>
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
<?php /**PATH C:\laragon\www\baleart\resources\views/users/comments.blade.php ENDPATH**/ ?>