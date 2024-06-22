<div class="form-check form-switch">
    <input class="form-check-input" type="checkbox" id="switchOne" checked="" wire:model="isActive">
</div>

<style>
    input[type="checkbox"] {
        position: relative;
        width: 40px;
        height: 20px;
        -webkit-appearance: none;
        background: #c6c6c6;
        outline: none;
        border-radius: 20px;
        box-shadow: inset 0 0 5px rgba(255, 0, 0, 0.2);
        transition: 0.7s;
    }

    input:checked[type="checkbox"] {
        background: #03a9f4;
    }

    input[type="checkbox"]:before {
        content: '';
        position: absolute;
        width: 20px;
        height: 20px;
        border-radius: 20px;
        top: 0;
        left: 0;
        background: #ffffff;
        transform: scale(1.1);
        box-shadow: 0 2px 5px rgba(0, 0, 0, 0.2);
        transition: .5s;
    }

    input:checked[type="checkbox"]:before {
        left: 20px;
    }
</style>
<?php /**PATH C:\xampp\htdocs\e-menu\resources\views/livewire/toggle-switch.blade.php ENDPATH**/ ?>