<div class="space-y-4">
    <div class="space-y-2">
        <label class="font-semibold" for="nama">Menu</label>
        <div class="w-full bg-white px-4 py-2 space-x-3 rounded-lg outline outline-1 shadow-md">
            <select wire:model="selectedMenu" class="w-full bg-transparent focus:outline-none" name="id_menu" id="id_menu"
                required>
                <?php if(!$pesananData->exists): ?>
                    <option value="">
                        - Pilih Menu -</option>
                <?php endif; ?>
                <?php $__currentLoopData = $menu; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <option value="<?php echo e($item->id_menu); ?>" <?php if($item->id_menu == $pesananData->id_menu): ?> selected <?php endif; ?>>
                        <?php echo e($item->nama_menu); ?></option>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </select>
        </div>
    </div>

    <div class="space-y-2" id="checkboxContainer">
        <label class="font-semibold" for="add_on">Add On</label>
        <?php if(isset($selectedOptionData) && $selectedOptionData->add_on): ?>
            <?php $__currentLoopData = json_decode($selectedOptionData->add_on); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $index => $addOnValue): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <?php if($pesananData->exists): ?>
                    <?php
                        $isChecked = in_array($addOnValue, json_decode($pesananData['add_on']));
                    ?>
                    <label for="checkbox<?php echo e($index + 1); ?>" class="flex items-center space-x-4 pb-2">
                        <input type="checkbox" id="checkbox<?php echo e($index + 1); ?>" name="add_on[]"
                            value="<?php echo e($addOnValue); ?>" hidden <?php echo e($isChecked ? 'checked' : ''); ?>>
                        <svg class="w-4 <?php echo e($isChecked ? 'fill-green-500' : 'fill-gray-500'); ?> checked-svg"
                            xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512">
                            <path
                                d="<?php echo e($isChecked ? 'M64 32C28.7 32 0 60.7 0 96V416c0 35.3 28.7 64 64 64H384c35.3 0 64-28.7 64-64V96c0-35.3-28.7-64-64-64H64zM337 209L209 337c-9.4 9.4-24.6 9.4-33.9 0l-64-64c-9.4-9.4-9.4-24.6 0-33.9s24.6-9.4 33.9 0l47 47L303 175c9.4-9.4 24.6-9.4 33.9 0s9.4 24.6 0 33.9z' : 'M384 80c8.8 0 16 7.2 16 16V416c0 8.8-7.2 16-16 16H64c-8.8 0-16-7.2-16-16V96c0-8.8 7.2-16 16-16H384zM64 32C28.7 32 0 60.7 0 96V416c0 35.3 28.7 64 64 64H384c35.3 0 64-28.7 64-64V96c0-35.3-28.7-64-64-64H64z'); ?> " />
                        </svg>
                        <div id="checkboxText<?php echo e($index + 1); ?>"
                            class="text-gray-500 <?php echo e($isChecked ? 'font-semibold' : ''); ?>">
                            <?php echo e($addOnValue); ?>

                        </div>
                    </label>
                <?php else: ?>
                    <label for="checkbox<?php echo e($index + 1); ?>" class="flex items-center space-x-4 pb-2">
                        <input type="checkbox" id="checkbox<?php echo e($index + 1); ?>" name="add_on[]"
                            value="<?php echo e($addOnValue); ?>" hidden>
                        <svg class="w-4 fill-gray-500 checked-svg" xmlns="http://www.w3.org/2000/svg"
                            viewBox="0 0 448 512">
                            <path
                                d="M384 80c8.8 0 16 7.2 16 16V416c0 8.8-7.2 16-16 16H64c-8.8 0-16-7.2-16-16V96c0-8.8 7.2-16 16-16H384zM64 32C28.7 32 0 60.7 0 96V416c0 35.3 28.7 64 64 64H384c35.3 0 64-28.7 64-64V96c0-35.3-28.7-64-64-64H64z" />
                        </svg>
                        <div id="checkboxText<?php echo e($index + 1); ?>" class="text-gray-500"><?php echo e($addOnValue); ?>

                        </div>
                    </label>
                <?php endif; ?>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        <?php endif; ?>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            document.getElementById('checkboxContainer').addEventListener('click', function(event) {
                if (event.target.matches('input[type="checkbox"]')) {
                    const checkboxText = event.target.parentElement.querySelector('.text-gray-500');
                    const svg = event.target.parentElement.querySelector('.checked-svg');

                    if (event.target.checked) {
                        checkboxText.classList.add('font-semibold');
                        svg.innerHTML =
                            '<path d="M64 32C28.7 32 0 60.7 0 96V416c0 35.3 28.7 64 64 64H384c35.3 0 64-28.7 64-64V96c0-35.3-28.7-64-64-64H64zM337 209L209 337c-9.4 9.4-24.6 9.4-33.9 0l-64-64c-9.4-9.4-9.4-24.6 0-33.9s24.6-9.4 33.9 0l47 47L303 175c9.4-9.4 24.6-9.4 33.9 0s9.4 24.6 0 33.9z"/>';
                        svg.classList.remove('fill-gray-500');
                        svg.classList.add('fill-green-500');
                    } else {
                        checkboxText.classList.remove('font-semibold');
                        svg.innerHTML =
                            '<path d="M384 80c8.8 0 16 7.2 16 16V416c0 8.8-7.2 16-16 16H64c-8.8 0-16-7.2-16-16V96c0-8.8 7.2-16 16-16H384zM64 32C28.7 32 0 60.7 0 96V416c0 35.3 28.7 64 64 64H384c35.3 0 64-28.7 64-64V96c0-35.3-28.7-64-64-64H64z"/>';
                        svg.classList.add('fill-gray-500');
                        svg.classList.remove('fill-green-500');
                    }
                }
            });
        });
    </script>
</div>
<?php /**PATH C:\xampp\htdocs\e-menu\resources\views/livewire/select-option.blade.php ENDPATH**/ ?>