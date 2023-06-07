<template layout="default">
    <Head title="Category"/>
    <div class="pt-12 pr-4 pb-0 pl-4 mt-0 mr-auto mb-0 ml-auto max-w-7xl sm:px-6 lg:px-8">
        <div v-if=" $page.props.flash.message" class="bg-green-100  backdrop-blur-xl z-20 max-w-md top-12 rounded-lg p-4 shadow text-sm text-green-700 float-right ">
            <span class="font-medium"></span>{{ $page.props.flash.message }}
        </div>
        <!-- <Link  href="/category/create"  type="button" class=" bg-blue-600 text-white active:bg-blue-700 hover:bg-blue-700  font-bold px-5 py-2 rounded-lg shadow-sm float-right" >
            Add Category
        </Link> -->
        <h4 class="font-bold text-lg">List of Categories</h4>
        <hr>
        <div hidden class="md:block ml-10">
            <div class="relative flex items-center text-gray-400 focus-within:text-cyan-400">
                <span class="absolute left-4 h-6 flex items-center pr-3 border-r border-gray-300">
                <svg xmlns="http://ww50w3.org/2000/svg" class="w-4 fill-current" viewBox="0 0 35.997 36.004">
                    <path id="Icon_awesome-search" data-name="search" d="M35.508,31.127l-7.01-7.01a1.686,1.686,0,0,0-1.2-.492H26.156a14.618,14.618,0,1,0-2.531,2.531V27.3a1.686,1.686,0,0,0,.492,1.2l7.01,7.01a1.681,1.681,0,0,0,2.384,0l1.99-1.99a1.7,1.7,0,0,0,.007-2.391Zm-20.883-7.5a9,9,0,1,1,9-9A8.995,8.995,0,0,1,14.625,23.625Z"></path>
                </svg>
                </span>
                <input type="search" name="leadingIcon" id="leadingIcon" placeholder="Search here" class=" pl-14 pr-4 py-2.5 rounded-xl text-sm text-gray-600 outline-none border border-gray-300 focus:border-cyan-300 transition" v-model="search">
            </div>
        </div>
        <div class="mb-10 sm:mb-0 mt-10 grid gap-4 grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4">
            <div class="group bg-blue-900/30 py-20 px-4 flex flex-col space-y-2 items-center cursor-pointer rounded-md hover:bg-blue-900/40 hover:smooth-hover">
              <Link class="bg-blue-900/70 text-white/50 group-hover:text-white group-hover:smooth-hover flex w-20 h-20 rounded-full items-center justify-center" href="/category/create">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-10 w-10" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1" d="M12 6v6m0 0v6m0-6h6m-6 0H6" />
                </svg>
              </Link>
              <Link class="text-white/50 group-hover:text-white group-hover:smooth-hover text-center" href="/category/create">Create Category</Link>
            </div>
             <Link :href="'/category/edit/' +cat.id" class="relative group bg-blue-900 py-10 sm:py-20 px-4 flex flex-col space-y-2 items-center cursor-pointer rounded-md hover:bg-blue-900/80 hover:smooth-hover" v-for="cat of category.data" :key="cat.id">
              <img class="w-20 h-20 object-cover object-center rounded-full" src="assets/categories.png" alt="cuisine" />
              <h4 class="text-white text-2xl font-bold capitalize text-center">{{ cat.category }}</h4>
              <p class="text-white/50">{{ cat.tasks_count }} task</p>
            </Link>

            
    
        </div>
        <div class="flex justify-center space-x-1">
            <Pagination
                :data="category"
                itemCount:Number
            />
        </div>
    </div>

</template>

<script setup>
import { Head, Link } from '@inertiajs/inertia-vue3'
import{ ref, watch, defineProps} from 'vue'
import Pagination from '@/views/components/pagination.vue'
import {Inertia} from '@inertiajs/inertia'

let props = defineProps({
    category:Object,
    errors:null,
    user:Object,
    filters:Object
})

let search = ref(props.filters.search);
watch(search, (value) => {
    Inertia.get(
        "/category",
        { search: value },
        {
            preserveState: true,
            replace: true,
        }
    );
});
</script>
