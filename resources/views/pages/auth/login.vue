<template>
    <Head title="Login"/>
    <div v-if=" $page.props.flash.message" class="bg-green-100  backdrop-blur-xl z-20 max-w-md absolute right-5 top-12  rounded-lg p-4 shadow text-sm text-green-700">
        <span class="font-medium"></span>{{ $page.props.flash.message }}
    </div>
    <div class="bg-white relative ">
        <div class="flex flex-col items-center justify-between pt-0 pr-10 pb-0 pl-10 mt-0 mr-auto mb-0 ml-auto max-w-7xl
            xl:px-5 lg:flex-row">
           
            <div class="flex flex-col items-center w-full pt-5 pr-10 pb-20 pl-10 lg:pt-20 lg:flex-row">
            <div class="w-full bg-cover relative max-w-md lg:max-w-2xl lg:w-7/12">
                <div class="flex flex-col items-center justify-center w-full h-full relative lg:pr-10">
                <img src="https://res.cloudinary.com/macxenon/image/upload/v1631570592/Run_-_Health_qcghbu.png" class="btn-"/>
                </div>
            </div>
            <div class="w-full mt-20 mr-0 mb-0 ml-0 relative z-10 max-w-2xl lg:mt-0 lg:w-5/12">
                <div class="flex flex-col items-start justify-start pt-10 pr-10 pb-10 pl-10 bg-white shadow-2xl rounded-xl
                    relative z-10">
                    <p class="w-full text-4xl font-medium text-center leading-snug font-serif">Login to your account</p>
                <form class="w-full mt-6 mr-0 mb-0 ml-0 relative space-y-8" @submit.prevent="submit">
                    <div class="relative">
                        <p class="bg-white pt-0 pr-2 pb-0 pl-2 -mt-3 mr-0 mb-0 ml-2 font-medium text-gray-600 absolute">Email</p>
                        <input placeholder="123@ex.com" type="text" class="border placeholder-gray-400 focus:outline-none
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
                            <div class="text-sm text-red-500 italic" v-if="form.errors.authentication">{{ form.errors.authentication }}</div>
                    </div>
                    <div class="relative">
                        <button type="submit" class="w-full inline-block pt-4 pr-5 pb-4 pl-5 text-xl font-medium text-center text-white bg-indigo-500
                            rounded-lg transition duration-200 hover:bg-indigo-600 ease">Submit</button>
                        </div>
                </form>
                <p class="mt-6 text-center text-sm text-gray-500">
                    Don't have an account yet?
                     <a href="/register" class="font-semibold leading-6 text-indigo-600 hover:text-indigo-500">Register here</a>
                   </p>
                </div>

            </div>
            </div>
        </div>
    </div>
</template>

<script setup>
 import{useForm, Head} from '@inertiajs/inertia-vue3'

 let form = useForm({
        email: '',
        password: ''
    })

    const submit = () =>{
     form.post('/login')
    }

  let props =  defineProps({
        title: String
    })

</script>
