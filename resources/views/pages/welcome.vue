<template layout="default">
    <Head title="Home"/>
    <div class="bg-white relative ">
        <div class="flex flex-col items-center justify-between pt-0 pr-10 pb-0 pl-10 mt-0 mr-auto mb-0 ml-auto max-w-7xl
            xl:px-5 lg:flex-row">
            <div class="flex flex-col items-center w-full pt-2 pr-10  pl-10 lg:pt-15 lg:flex-row">
            <div class="w-full bg-cover relative max-w-md lg:max-w-2xl lg:w-7/12">
                <div class="flex flex-col items-center justify-center w-full h-full relative lg:pr-10">
                <img src="https://res.cloudinary.com/macxenon/image/upload/v1631570592/Run_-_Health_qcghbu.png" class="btn-"/>
                </div>
            </div>
            <div class="w-full mt-20 mr-0 mb-0 ml-0 relative z-10 max-w-2xl lg:mt-0 lg:w-5/12">
                <div class="flex flex-col items-start justify-start pt-10 pr-10 pb-10 pl-10 bg-white shadow-2xl rounded-xl
                    relative z-10">
                <p class="w-full text-4xl font-medium text-center leading-snug font-serif">Welcome to Task Manager </p>
                <div class="w-full mt-6 mr-0 mb-0 ml-0 relative space-y-8">
                    <div class="relative">
                    <p class="bg-white pt-0 pr-2 pb-0 pl-2 -mt-3 mr-0 mb-0 ml-2 font-medium text-gray-600
                        absolute text-center">Track and Manage your task easily </p>
                    </div>
                    <div class="relative">
                    <a  href="/register" class="w-full inline-block pt-4 pr-5 pb-4 pl-5 text-xl font-medium text-center text-white bg-indigo-500
                        rounded-lg transition duration-200 hover:bg-indigo-600 ease">Sign Up</a>
                    </div>
                </div>
                </div>

            </div>
            </div>
        </div>
    </div>

</template>

<script setup>
import navBar from '../components/nav-bar.vue'
import { Head } from '@inertiajs/inertia-vue3'


</script>
