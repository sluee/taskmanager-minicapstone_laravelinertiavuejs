<template layout="default">
    <div  class="container mx-auto px-4 mt-4 pt-5 p-7">
        <div v-if=" $page.props.flash.message" class="bg-green-100  backdrop-blur-xl z-20 max-w-md absolute right-5 top-12 rounded-lg p-4 shadow text-sm text-green-700">
            <span class="font-medium"></span>{{ $page.props.flash.message }}
        </div>
        <!-- component -->
        <div class="flex flex-wrap mb-2 p-4">
            <div class="w-full md:w-1/2 xl:w-1/3 pt-3 px-3 md:pr-2">
                <div class="bg-green-600 border rounded shadow p-2 py-8">
                    <div class="flex flex-row items-center">
                        <div class="flex-shrink pl-1 pr-4"><i class="fa fa-wallet fa-2x fa-fw fa-inverse"></i></div>
                        <div class="flex-1 text-center">
                            <h5 class="text-white">Total Category</h5>
                            <h3 class="text-white text-3xl">{{ totalCategory }}<span class="text-green-400"><i class="fas fa-caret-down"></i></span></h3>
                        </div>
                    </div>
                </div>
            </div>
            <div class="w-full md:w-1/2 xl:w-1/3 pt-3 px-3 md:pl-2">
                <div class="bg-blue-600 border rounded shadow p-2 py-8">
                    <div class="flex flex-row items-center">
                        <div class="flex-shrink pl-1 pr-4"><i class="fas fa-users fa-2x fa-fw fa-inverse"></i></div>
                        <div class="flex-1 text-center">
                            <h5 class="text-white">Active Task</h5>
                            <h3 class="text-white text-3xl">{{totalTask}} <span class="text-blue-400"><i class="fas fa-caret-up"></i></span></h3>
                        </div>
                    </div>
                </div>
            </div>
            <div class="w-full md:w-1/2 xl:w-1/3 pt-3 px-3 md:pr-2 xl:pr-3 xl:pl-1">
                <div class="bg-orange-600 border rounded shadow p-2 py-8">
                    <div class="flex flex-row items-center">
                        <div class="flex-shrink pl-1 pr-4"><i class="fas fa-user-plus fa-2x fa-fw fa-inverse"></i></div>
                        <div class="flex-1 text-center pr-1">
                            <h5 class="text-white">Total Subtask</h5>
                            <h3 class="text-white text-3xl">{{ totalSubtask }}<span class="text-orange-400"><i class="fas fa-caret-up"></i></span></h3>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        
    </div>

    
</template>

<script setup>
import { Head } from '@inertiajs/inertia-vue3'


let props = defineProps({
    title:String,
    totalSubtask:Number,
    totalCategory:Number,
    totalTask:Number

})
</script>
