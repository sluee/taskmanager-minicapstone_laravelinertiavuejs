<template layout="default">
   <div class="px-6 pt-6 2xl:container mt-5 mb-3">    
        <Head title="Task"/>
        <div v-if=" $page.props.flash.message" class="bg-green-100  backdrop-blur-xl z-20 max-w-md top-12 rounded-lg p-4 shadow text-sm text-green-700 float-right ">
            <span class="font-medium"></span>{{ $page.props.flash.message }}
        </div>
        <Link  href="/task/create"  type="button" class=" bg-blue-600 text-white active:bg-blue-700 hover:bg-blue-700  font-bold px-5 py-2 rounded-lg shadow-sm float-right" >
            Add Task
        </Link>
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
   
    <div class="px-6 pt-6 2xl:container mt-10">
        <div class="grid gap-7 md:grid-cols-1 lg:grid-cols-3" >
            <div class="md:col-span-3 lg:col-span-1" v-for="task of tasks.data" :key="task.id">
                <div class="h-full py-6 px-6  rounded-xl border border-gray-200 bg-white" >
                    <div class="flex flex-row justify-between items-center">
                        <div>
                            <h1 class="text-xl font-medium text-red-700">Task Title: {{ task.title }}</h1>
                        </div>
                            <div class="inline-flex space-x-2 items-center">
                                <a href="#" class="p-2 border border-slate-200 rounded-md inline-flex space-x-1 items-center text-white  hover:text-white bg-red-600 " :class="{'bg-red-600' : task.status === 'Important', 'bg-green-500' : task.status === 'Urgent', 'bg-orange-500' : task.status === 'Priority'}">
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" :class="{'bg-red-200' : task.status.Important, 'bg-yellow-600' :task.status.Urgent , 'bg-orange-500' :task.status.Priority}" class="w-4 h-4">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M12 6v6h4.5m4.5 0a9 9 0 11-18 0 9 9 0 0118 0z" />
                                    </svg>
                                    <span class="text-sm font-medium  md:block" >{{ task.status}}</span>
                                </a>  
                            </div>
                    </div>
                    <h1 class="text-1xl font-bold text-gray-800"> Category: {{ task.category.category }}</h1>
                    <!-- <h5 class="text-xl text-gray-700 mb-3">Description: {{ task.description }}</h5> -->
                    <hr>
                    <div class="my-4">
                        <!-- <h5 class="text-xl text-gray-700">{{ task.start }}</h5> -->
                        <span class="text-gray-500">Task Description: {{ task.description }}</span>
                    </div>
                    <div>
                        <div id="tasks" class="my-5" >
                            <div id="task" class="flex justify-between items-center border-b border-slate-200 py-3 px-2 border-l-4 border-l-indigo-300 bg-gradient-to-r from-indigo-100 to-transparent hover:from-indigo-200 transition ease-linear duration-150"  v-for="subtask in task.subtasks" :key="subtask.id">                          
                                <div class="inline-flex items-center space-x-2" >    
                                    <form @submit.prevent="editCompleted(subtask)">
                                        <input type="checkbox" v-model="subtask.completed" @change="updateSubtask(subtask)" class="mr-2">
                                    <span class="flex-grow" :class="{'text-red-500': !subtask.completed, 'line-through': subtask.completed, 'text-green-500': subtask.completed}"> {{ subtask.name }}</span>
                                    <!-- <span class="text-sm font-medium" :class="{'text-green-500': subtask.completed, 'text-red-500': !subtask.completed, 'line-through': subtask.completed}">
                                        {{ subtask.completed ? 'Completed' : 'Not Completed' }}
                                      </span>  -->
                                    </form>
                                          
                                   
                                </div>
                                
                                <div>
                                    <!-- <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-4 h-4 text-slate-500 hover:text-slate-700 hover:cursor-pointer" @click="removeSubtask(index)">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M14.74 9l-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 01-2.244 2.077H8.084a2.25 2.25 0 01-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 00-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 013.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 00-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 00-7.5 0" />
                                      </svg> -->
                                      <form @submit.prevent="removeSubtask(subtask)">
                                        <input type="hidden" name="subtask" :value="subtask.id">
                                        <button  class="flex items-center justify-center w-10 h-10 text-red-500 hover:text-red-700 hover:cursor-pointer focus:outline-none">
                                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-4 h-4">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M14.74 9l-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 01-2.244 2.077H8.084a2.25 2.25 0 01-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 00-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 013.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 00-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 00-7.5 0" />
                                            </svg>
                                        </button>
                                      </form>
        
                                      <form @submit.prevent="editSubtask(subtask)">
                                        <input type="hidden" name="subtask" :value="subtask.id">
                                            <Link :href="'/subtask/edit/'+subtask.id" class="flex items-center justify-center w-10 h-10 text-green-500 hover:text-green-700 hover:cursor-pointer focus:outline-none">       
                                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                                <path stroke-linecap="round" stroke-linejoin="round" d="M14.5 6.5l-9 9-3-3 9-9 3 3z" />
                                                <path stroke-linecap="round" stroke-linejoin="round" d="M16 11l2 2" />
                                                <path stroke-linecap="round" stroke-linejoin="round" d="M21 6v8a2 2 0 01-2 2h-8" />
                                                </svg>
                                            </Link>
                                         </form>
                                       
                                      
                                </div>
                            </div>
                              
                        </div>

                        <div class="flex flex-row justify-between items-center mb-3">
                            <form @submit.prevent="createSubtask(task)">
                                <div>
                                    <input type="hidden" name="task_id" :value="task.id">
                                </div>
                                <div class="inline-flex items-center ">
                                    <input type="text" name="name" placeholder="Add new subtask here..." class="p-2 rounded-md inline-flex space-x-1 items-center text-black bg-gradient-to-r from-indigo-100 to-transparent px-12 w-35" v-model="forms.name" />
                                    
                                    <button type="submit" class="p-2 border border-slate-200 rounded-md inline-flex space-x-1 items-center hover:bg-slate-200 ml-9 bg-gradient-to-r from-indigo-100 to-transparent ">
                                        <img src="assets/plus.png" alt="" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-4 h-4">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M12 6v6h4.5m4.5 0a9 9 0 11-18 0 9 9 0 0118 0z" />
                                        <span class="text-sm hidden md:block">subtask</span>
                                    </button>
                                    
                                </div>
                                <div class="text-sm text-red-500 italic" v-if="forms.errors.name">{{ forms.errors.name }}</div>
                            </form>
                            
                        </div>
                        <hr>

                        <div class="buttons flex mt-2  float-right mb-4"> 
                            <button class="bg-red-600 pt-2 pr-6 pb-2 pl-6 text-sm font-medium text-gray-100 transition-all
                                duration-200 hover:bg-red-700 rounded-lg" @click="remove(task)">Delete</button>
                            <!-- <Link as="button" :href="'/task/' +tas.id" class="btn border border-gray-300 p-1 px-4 font-semibold cursor-pointer text-black  ml-auto bg-red-500 rounded-lg hover:bg-red-700">Delete</Link> -->
                            <Link as="button" :href="'/task/edit/' +task.id" type="submit" class="btn border border-blue-500 p-1 px-4 font-semibold cursor-pointer text-gray-200 ml-2 bg-blue-500 rounded-lg hover:bg-blue-700">Edit</Link>
                        </div>
                    </div>
                    
                     
                </div>
            </div>
        </div>
        <div class="flex justify-center space-x-1">
            <Pagination
                :data="tasks"
            />
        </div>
    </div>
</div>
</template>

<script setup>
import { Head, Link, useForm } from '@inertiajs/inertia-vue3'
import{ ref, watch, defineProps} from 'vue'
import Pagination from '@/views/components/pagination.vue'
import {Inertia} from '@inertiajs/inertia'

let props=defineProps({
    tasks: Object,
    categories: Object,
    subtasks :Array,
    user:Object,
    filters:Object
})

const updated= ()=>{

}

let form = useForm({
    title:'',
    description:'',
    status:'',
    start:'',
    cat_id:'',
    subtasks:null
})

let forms = useForm({
    task_id:props.tasks.id,
    name:''
})


let selectedTask =null;

function remove(task){
    selectedTask=task;
    form.delete('/task/' +selectedTask.id);
}

const createSubtask = (task) =>{
    selectedTask=task;
    forms.post('/task/'+selectedTask.id+'/subtask', { name: forms.name } );
    forms.name=''
    
}
let del=null;
const removeSubtask= (subtask) =>{
    del=subtask;
    forms.delete('/subtask/'+del.id );
}


const editSubtask= (subtask) =>{
    del=subtask;
    forms.put('/subtask/'+del.id );
}

let search = ref(props.filters.search);
watch(search, (value) => {
    Inertia.get(
        "/task",
        { search: value },
        {
            preserveState: true,
            replace: true,
        }
    );
});
</script>
