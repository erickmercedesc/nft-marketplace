<template>
    <div id="background" class="min-h-screen flex flex-col sm:justify-center items-center pt-2 sm:pt-0">
        <div class="bg-white grid grid-cols-2 w-full sm:max-w-6xl rounded">
            <div class="hidden md:grid grid-cols-2">
                <img class="h-full" src="/img/nft1.png" alt="">
                <img class="h-full" src="/img/nft2.png" alt="">
                <img class="h-full" src="/img/nft3.png" alt="">
                <img class="h-full" src="/img/nft4.png" alt="">
            </div>

            <div class="col-span-2 md:col-span-1 mt-12 md:mt-0 flex flex-col justify-center text-center px-4 py-2">
                <div class="flex justify-center">
                    <slot name="logo" />
                </div>
                
                <div class=" mt-8 px-6 py-4 overflow-hidden sm:rounded-lg" style="z-index: 100;">
                    <slot />
                </div>
            </div>

        </div>

    </div>
</template>
<style>
    #background {
        background: linear-gradient(90deg, #1488CC 0%, #2B32B2 100%);
    }
</style>