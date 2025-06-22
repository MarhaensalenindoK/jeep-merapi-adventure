@props([
    'viewUrl' => null,
    'editUrl' => null,
    'deleteAction' => null,
    'deleteData' => null,
    'compact' => false,
    'size' => 'md'
])

<div class="flex items-center {{ $compact ? 'space-x-1' : 'space-x-2' }}">
    @if($viewUrl)
        <x-button variant="success"
                  :size="$compact ? 'icon-sm' : 'icon-' . $size"
                  icon="eye"
                  :href="$viewUrl"
                  :icon-only="$compact"
                  title="Lihat Detail">
            @if(!$compact)Detail@endif
        </x-button>
    @endif

    @if($editUrl)
        <x-button variant="primary"
                  :size="$compact ? 'icon-sm' : 'icon-' . $size"
                  icon="edit"
                  :href="$editUrl"
                  :icon-only="$compact"
                  title="Edit">
            @if(!$compact)Edit@endif
        </x-button>
    @endif

    @if($deleteAction || $deleteData)
        <x-button variant="danger"
                  :size="$compact ? 'icon-sm' : 'icon-' . $size"
                  icon="delete"
                  :icon-only="$compact"
                  title="Hapus"
                  type="button"
                  {!! $deleteAction !!}>
            @if(!$compact)Hapus@endif
        </x-button>
    @endif

    {{ $slot }}
</div>
