@props([
    'show' => 'showDeleteModal',
    'item' => 'itemToDelete',
    'title' => 'Hapus Item',
    'message' => 'Apakah Anda yakin ingin menghapus item ini?',
    'confirmText' => 'Hapus',
    'cancelText' => 'Batal'
])

<!-- Delete Confirmation Modal -->
<div x-show="{{ $show }}"
     x-cloak
     class="relative z-10"
     aria-labelledby="modal-title"
     role="dialog"
     aria-modal="true"
     style="display: none;">

    <!-- Background backdrop -->
    <div x-show="{{ $show }}"
         x-transition:enter="ease-out duration-300"
         x-transition:enter-start="opacity-0"
         x-transition:enter-end="opacity-100"
         x-transition:leave="ease-in duration-200"
         x-transition:leave-start="opacity-100"
         x-transition:leave-end="opacity-0"
         @click="{{ $show }} = false"
         class="fixed inset-0 bg-gray-500/75 transition-opacity"
         aria-hidden="true"></div>

    <div class="fixed inset-0 z-10 w-screen overflow-y-auto">
        <div class="flex min-h-full items-end justify-center p-4 text-center sm:items-center sm:p-0">
            <!-- Dialog panel -->
            <div x-show="{{ $show }}"
                 x-transition:enter="ease-out duration-300"
                 x-transition:enter-start="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95"
                 x-transition:enter-end="opacity-100 translate-y-0 sm:scale-100"
                 x-transition:leave="ease-in duration-200"
                 x-transition:leave-start="opacity-100 translate-y-0 sm:scale-100"
                 x-transition:leave-end="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95"
                 class="relative transform overflow-hidden rounded-lg bg-white text-left shadow-xl transition-all sm:my-8 sm:w-full sm:max-w-lg">

                <!-- Modal Header & Content -->
                <div class="bg-white px-4 pt-5 pb-4 sm:p-6 sm:pb-4">
                    <div class="sm:flex sm:items-start">
                        <!-- Warning Icon -->
                        <div class="mx-auto flex size-12 shrink-0 items-center justify-center rounded-full bg-red-100 sm:mx-0 sm:size-10">
                            <x-icon type="warning" class="size-6 text-red-600" />
                        </div>

                        <!-- Content -->
                        <div class="mt-3 text-center sm:mt-0 sm:ml-4 sm:text-left">
                            <h3 class="text-base font-semibold text-gray-900" id="modal-title">{{ $title }}</h3>
                            <div class="mt-2">
                                <div class="text-sm text-gray-500">
                                    @if($slot->isEmpty())
                                        <p>{{ $message }}</p>
                                    @else
                                        {{ $slot }}
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Modal Actions -->
                <div class="bg-gray-50 px-4 py-3 sm:flex sm:flex-row-reverse sm:px-6">
                    @isset($actions)
                        {{ $actions }}
                    @else
                        <form method="POST" :action="{{ $item }}?.route" class="inline">
                            @csrf
                            @method('DELETE')
                            <x-button variant="danger" type="submit"
                                      class="inline-flex w-full justify-center sm:ml-3 sm:w-auto">
                                {{ $confirmText }}
                            </x-button>
                        </form>

                        <x-button variant="outline"
                                  @click="{{ $show }} = false; {{ $item }} = null"
                                  class="mt-3 inline-flex w-full justify-center sm:mt-0 sm:w-auto">
                            {{ $cancelText }}
                        </x-button>
                    @endisset
                </div>
            </div>
        </div>
    </div>
</div>
