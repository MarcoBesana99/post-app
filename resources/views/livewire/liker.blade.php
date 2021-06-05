<div class="text-center mt-3">
    @if (auth()->check())
        <i class="{{ $class }} fa-heart like" wire:click="like" style="color: #0D00A4; font-size:18px; cursor:pointer"></i>
    @else
        <i class="far fa-heart" style="color: #0D00A4; font-size:18px; cursor:no-drop"></i>
    @endif
    {{ $numberLikes }}
</div>
