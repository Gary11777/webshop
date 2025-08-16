<div
    x-data="{
        show: false,
        message: '',
        style: 'success',
        showBanner(event) {
            this.message = event.detail.message || event.detail[0] || '';
            this.style = event.detail.style || event.detail[1] || 'success';
            this.show = true;
            setTimeout(() => this.show = false, 5000);
        }
    }"
    x-on:banner-message.window="showBanner($event)"
    x-show="show"
    x-transition:enter="transition ease-out duration-300"
    x-transition:enter-start="opacity-0 transform -translate-y-full"
    x-transition:enter-end="opacity-100 transform translate-y-0"
    x-transition:leave="transition ease-in duration-300"
    x-transition:leave-start="opacity-100 transform translate-y-0"
    x-transition:leave-end="opacity-0 transform -translate-y-full"
    class="fixed top-0 left-0 right-0 z-50 shadow-lg"
    :class="{
        'bg-green-600': style === 'success',
        'bg-red-600': style === 'error',
        'bg-yellow-500': style === 'warning',
        'bg-blue-600': style === 'info'
    }"
    style="display: none;"
>
    <div class="container mx-auto px-4 py-3">
        <div class="flex items-center justify-between">
            <div class="flex items-center space-x-3">
                <!-- Success Icon -->
                <template x-if="style === 'success'">
                    <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                    </svg>
                </template>
                
                <!-- Error Icon -->
                <template x-if="style === 'error'">
                    <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                    </svg>
                </template>
                
                <!-- Warning Icon -->
                <template x-if="style === 'warning'">
                    <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"></path>
                    </svg>
                </template>
                
                <!-- Info Icon -->
                <template x-if="style === 'info'">
                    <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                    </svg>
                </template>
                
                <span class="text-white font-medium" x-text="message"></span>
            </div>
            
            <!-- Close Button -->
            <button
                @click="show = false"
                class="text-white hover:text-gray-200 transition-colors"
            >
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                </svg>
            </button>
        </div>
    </div>
</div>
