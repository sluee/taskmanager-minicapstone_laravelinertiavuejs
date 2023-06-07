<template layout="default">
    <div class="container px-6 py-6 mx-auto">
        <div class="heading text-center font-bold text-3xl m-4 text-gray-800">Update Task</div>
   <div class="editor mx-auto w-10/12 flex flex-col text-gray-800 border border-gray-300 p-4 shadow-lg max-w-2xl rounded-lg ">
    <form class="mt-5 p-6" @submit.prevent="submit">
        <div class=" grid md:grid-cols-2 md:gap-6">
            <div class="relative z-0 w-full mb-6 group">
                <label for="category" class="peer-focus:font-medium absolute text-sm text-gray-500 dark:text-gray-400 duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:left-0 peer-focus:text-blue-600 peer-focus:dark:text-blue-500 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6">Task Category</label>
                <select id="cat_id" class="block py-2.5 px-0 w-full text-sm text-black bg-transparent border-0 border-b-2 border-gray-300 appearance-none dark:text-black dark:border-gray-600 dark:focus:border-blue-500 focus:outline-none focus:ring-0 focus:border-blue-600 peer " v-model="form.cat_id">
                    <option value=""  selected disabled ></option>
                    <option  v-for="cat in categories" :value="cat.id" :key="cat.id">{{ cat.category }}</option>
                </select>
                 <div class="text-sm text-red-500 italic" v-if="form.errors.cat_id">{{ form.errors.cat_id }}</div>
            </div>

            <div class="relative z-0 w-full mb-6 group">
                <label for="status" class="peer-focus:font-medium absolute text-sm text-gray-500 dark:text-gray-400 duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:left-0 peer-focus:text-blue-600 peer-focus:dark:text-blue-500 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6">Task status</label>
                <select id="status" class="block py-2.5 px-0 w-full text-sm text-gray-900 bg-transparent border-0 border-b-2 border-gray-300 appearance-none dark:text-black dark:border-gray-600 dark:focus:border-blue-500 focus:outline-none focus:ring-0 focus:border-blue-600 peer" v-model="form.status">
                    <option value=""  selected disabled >Choose a status</option>
                    <option value="Important">Important</option>
                    <option value="Priority">Priority</option>
                    <option value="Urgent">Urgent</option>
                </select>
                <div class="text-sm text-red-500 italic" v-if="form.errors.status">{{ form.errors.status }}</div>
            </div>      
        </div>
        <div class="grid md:grid-cols-2 md:gap-6">
            <div class="relative z-0 w-full mb-6 group">
                <input type="text" name="title" id="title" class="block py-2.5 px-0 w-full text-sm text-gray-900 bg-transparent border-0 border-b-2 border-gray-300 appearance-none dark:text-black dark:border-gray-600 dark:focus:border-blue-500 focus:outline-none focus:ring-0 focus:border-blue-600 peer" placeholder=" " v-model="form.title" />
                <label for="til" class="peer-focus:font-medium absolute text-sm text-gray-500 dark:text-gray-400 duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:left-0 peer-focus:text-blue-600 peer-focus:dark:text-blue-500 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6">Task Title</label>
                <div class="text-sm text-red-500 italic" v-if="form.errors.title">{{ form.errors.title }}</div>
            </div>
            <div class="relative z-0 w-full mb-6 group">
                <input type="text" name="description" id="description" class="block py-2.5 px-0 w-full text-sm text-gray-900 bg-transparent border-0 border-b-2 border-gray-300 appearance-none dark:text-black dark:border-gray-600 dark:focus:border-blue-500 focus:outline-none focus:ring-0 focus:border-blue-600 peer" placeholder=" " v-model="form.description">
                <label for="description" class="peer-focus:font-medium absolute text-sm text-gray-500 dark:text-gray-400 duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:left-0 peer-focus:text-blue-600 peer-focus:dark:text-blue-500 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6">Task Description</label>
                <div class="text-sm text-red-500 italic" v-if="form.errors.description">{{ form.errors.description }}</div>
            </div>
        </div>
         
        <div class="grid md:grid-cols-2 md:gap-6">
            <div class="relative z-0 w-full mb-6 group">
                <input type="date" name="title" id="title" class="block py-2.5 px-0 w-full text-sm text-gray-900 bg-transparent border-0 border-b-2 border-gray-300 appearance-none dark:text-black dark:border-gray-600 dark:focus:border-blue-500 focus:outline-none focus:ring-0 focus:border-blue-600 peer" placeholder=" " v-model="form.start" />
                <label for="til" class="peer-focus:font-medium absolute text-sm text-gray-500 dark:text-gray-400 duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:left-0 peer-focus:text-blue-600 peer-focus:dark:text-blue-500 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6">Date Start</label>
                <div class="text-sm text-red-500 italic" v-if="form.errors.start">{{ form.errors.start }}</div>
            </div>
            <div class="relative z-0 w-full mb-6 group">
                <input type="date" name="description" id="description" class="block py-2.5 px-0 w-full text-sm text-gray-900 bg-transparent border-0 border-b-2 border-gray-300 appearance-none dark:text-black dark:border-gray-600 dark:focus:border-blue-500 focus:outline-none focus:ring-0 focus:border-blue-600 peer" placeholder=" " v-model="form.end   ">
                <label for="description" class="peer-focus:font-medium absolute text-sm text-gray-500 dark:text-gray-400 duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:left-0 peer-focus:text-blue-600 peer-focus:dark:text-blue-500 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6">Date End</label>
                <div class="text-sm text-red-500 italic" v-if="form.errors.end">{{ form.errors.end }}</div>
            </div>
        </div>
        <!-- <div id="subtaskFields" v-show="form.showSubTask">
            <div v-for="(subtask, index) in form.showSubTask" :key="index">
                <input type="text" v-model="props.task.subtasks" class="block py-2.5 px-0 w-full text-sm text-gray-900 bg-transparent border-0 border-b-2 border-gray-300 appearance-none dark:text-black dark:border-gray-600 dark:focus:border-blue-500 focus:outline-none focus:ring-0 focus:border-blue-600 peer">
               
                <label :for="`subTaskName-${index}`"  class="peer-focus:font-medium absolute text-sm text-gray-500 dark:text-gray-400 duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:left-0 peer-focus:text-blue-600 peer-focus:dark:text-blue-500 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6">Sub Task</label>
                <button type="button" @click="removeSubtask(index)" class="text-red-600 mb-2">Remove</button>
              </div>
        </div> -->
       
    
          
        <!-- <div class="mb-4">
            <input type="checkbox" id="addSubtask" v-model="form.addSubtask" class="mr-2">
            <label for="addSubtask" class="text-gray-700">Add Subtask</label>
          </div>
      
          <div id="subtaskFields" v-show="form.addSubtask">
            <div v-for="(subtask, index) in form.subtasks" :key="index" class="mb-4">
              <label :for="`subTaskName-${index}`" class="block text-gray-700">Subtask Title</label>
              <input v-model="subtask.name" :id="`subTaskName-${index}`" type="text" :name="`subTaskName-${index}`" :class="['w-full', 'border-gray-300', 'rounded-md', 'shadow-sm', 'focus:ring-indigo-500', 'focus:border-indigo-500', 'mb-4']">
            </div>
            <div class="text-sm text-red-500 italic" v-if="form.errors.name">{{ form.errors.name }}</div>
            <button type="button" @click="addSubtask" class="px-4 py-2 bg-indigo-500 text-white rounded-md hover:bg-indigo-600">Add Subtask</button>
          </div> -->
        <button type="submit" class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm w-full sm:w-auto px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">Submit</button>
      </form>
   </div> 

</div>
</template>

<script setup>
import { Head, useForm } from '@inertiajs/inertia-vue3'
import {Inertia} from '@inertiajs/inertia'


let props = defineProps({
    task: Object,
    categories: Object,
    // subtask:Array,
    user:Object
})

let form = useForm({
  cat_id: props.task.cat_id,
  title: props.task.title,
  description: props.task.description,
  start: props.task.start,
  end: props.task.end,
  status: props.task.status,
//   addSubtask: false,
//       subtasks: [{ name: '' }],
// showSubTask:false,
//     showSubTask:Array.isArray(props.task.subtasks)
//     ? props.task.subtasks.map((subtask) => ({ name: subtask.name }))
//     : [],
});


// const submit = () =>{
//     form.post('/task')
   
// }

 const submit =()=>{
    // form.data.subtasks = props.subtasks

    form.put('/task/' +props.task.id)
 }
// const submit = () => {
// //   form.subtasks subtasks; // Assuming `subtasks` is an array containing subtask data

//   Inertia.post('/task', form.data)
//     .then(() => {
//       // Handle success if needed
//       console.log('Task submitted successfully');
//     })
//     .catch(error => {
//       // Handle error if needed
//       console.error('Failed to submit task:', error);
//     });
// };
// const addSubtask = () => {
//       form.subtasks.push({ name: '' });
//     };

//    const showSubTask =() =>{
//     // Map the subtasks array to extract the names
//     Array.isArray(props.task.subtasks)
//     ? props.task.subtasks.map((subtask) => ({ name: subtask.name }))
//     : [],
//     console.log(subtaskNames);
//   }

//   const removeSubtask = (index)=> {
//       form.subtasks.splice(index, 1);
//     }
</script>
