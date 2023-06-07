<template>
    <Head title="Register"/>
    <div class="bg-white relative ">
        <div class="flex flex-col items-center justify-between pt-0 pr-10 pb-0 pl-10 mt-0 mr-auto mb-0 ml-auto max-w-7xl
            xl:px-5 lg:flex-row">
            <div class="flex flex-col items-center w-full pt-5 pr-10 pb-10 pl-10 lg:pt-20 lg:flex-row">
            <div class="w-full bg-cover relative max-w-md lg:max-w-2xl lg:w-7/12">
                <div class="flex flex-col items-center justify-center w-full h-full relative lg:pr-10">
                    <img src="https://res.cloudinary.com/macxenon/image/upload/v1631570592/Run_-_Health_qcghbu.png" class="btn-"/>
                </div>
            </div>
            <div class="w-full mt-20 mr-0 mb-0 ml-0 relative z-10 max-w-2xl lg:mt-0 lg:w-5/12">
                <div class="flex flex-col items-start justify-start pt-10 pr-10 pb-10 pl-10 bg-white shadow-2xl rounded-xl
                    relative z-10">
                    <p class="w-full text-4xl font-medium text-center leading-snug font-serif">Sign up for an account</p>
                <form class="w-full mt-6 mr-0 mb-0 ml-0 relative space-y-8" @submit.prevent="submit">
                    <div class="relative">
                        <p class="bg-white pt-0 pr-2 pb-0 pl-2 -mt-3 mr-0 mb-0 ml-2 font-medium text-gray-600
                            absolute">Name</p>
                        <input placeholder="Enter name" type="text" class="border placeholder-gray-400 focus:outline-none
                            focus:border-black w-full pt-4 pr-4 pb-4 pl-4 mt-2 mr-0 mb-0 ml-0 text-base block bg-white
                            border-gray-300 rounded-md" v-model="form.name"/>
                            <div class="text-sm text-red-500 italic" v-if="form.errors.name">{{ form.errors.name }}</div>
                    </div>
                    <div class="relative">
                        <p class="bg-white pt-0 pr-2 pb-0 pl-2 -mt-3 mr-0 mb-0 ml-2 font-medium text-gray-600
                            absolute">Username</p>
                        <input placeholder="e.g dear.slue" type="text" class="border placeholder-gray-400 focus:outline-none
                            focus:border-black w-full pt-4 pr-4 pb-4 pl-4 mt-2 mr-0 mb-0 ml-0 text-base block bg-white
                            border-gray-300 rounded-md" v-model="form.username"/>
                            <div class="text-sm text-red-500 italic" v-if="form.errors.username">{{ form.errors.username }}</div>
                    </div>
                    <div class="relative">
                        <p class="bg-white pt-0 pr-2 pb-0 pl-2 -mt-3 mr-0 mb-0 ml-2 font-medium text-gray-600 absolute">Email</p>
                        <input placeholder="johndoe@ex.com" type="email" class="border placeholder-gray-400 focus:outline-none
                            focus:border-black w-full pt-4 pr-4 pb-4 pl-4 mt-2 mr-0 mb-0 ml-0 text-base block bg-white
                            border-gray-300 rounded-md" v-model="form.email"/>
                            <div class="text-sm text-red-500 italic" v-if="form.errors.email">{{ form.errors.email }}</div>
                    </div>
                    <div class="relative">
                        <p class="bg-white pt-0 pr-2 pb-0 pl-2 -mt-3 mr-0 mb-0 ml-2 font-medium text-gray-600
                            absolute">Password</p>
                        <input placeholder="Password" type="password" class="border placeholder-gray-400 focus:outline-none
                            focus:border-black w-full pt-4 pr-4 pb-4 pl-4 mt-2 mr-0 mb-0 ml-0 text-base block bg-white
                            border-gray-300 rounded-md" v-model="form.password"/>
                            <div class="text-sm text-red-500 italic" v-if="form.errors.password">{{ form.errors.password }}</div>
                    </div>
                    <div class="relative">
                        <p class="bg-white pt-0 pr-2 pb-0 pl-2 -mt-3 mr-0 mb-0 ml-2 font-medium text-gray-600
                            absolute">Confirm Password</p>
                        <input placeholder="Confirm Password" type="password" class="border placeholder-gray-400 focus:outline-none
                            focus:border-black w-full pt-4 pr-4 pb-4 pl-4 mt-2 mr-0 mb-0 ml-0 text-base block bg-white
                            border-gray-300 rounded-md" v-model="form.password_confirmation"/>
                            <div class="text-sm text-red-500 italic" v-if="form.errors.password">{{ form.errors.password }}</div>
                    </div>
                    <div class="relative">
                        <button  type="submit"  class="w-full inline-block pt-3 pr-5 pb-4 pl-5 text-xl font-medium text-center text-white bg-indigo-500
                            rounded-lg transition duration-200 hover:bg-indigo-600 ease">Register</button>
                    </div>
                </form>
                <p class="mt-3 ml-12 text-center text-sm text-gray-500">
                    Already have an account?
                        <a href="/login" class="font-semibold leading-6 text-indigo-600 hover:text-indigo-500">Login here</a>
                    </p>
                </div>

            </div>
            </div>
        </div>
    </div>
</template>

<script setup>
 import {useForm, Head} from '@inertiajs/inertia-vue3'

let form = useForm({
    name: '',
    username: '',
    email: '',
    password: '',
    password_confirmation: ''

})

const submit = () =>{
 form.post('/register')
}

let props = defineProps({
 title: String
})


</script>
