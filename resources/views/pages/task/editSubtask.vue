<template layout="default">
    <Head title="Edit Subtask"/>
    <div class="container px-6 py-6 mx-auto ">
        <div class="heading text-center font-bold text-3xl m-5 text-gray-800">Edit Subtask</div>
            <form class="editor mx-auto w-10/12 flex flex-col text-gray-800 border border-gray-300 p-4 shadow-lg max-w-2xl rounded-lg "  @submit.prevent="submit">
                <label for="name" class="text-gray-700 font-semibold">Enter Subtask Title</label>
                <input id="name" class="title bg-gray-100 border border-gray-300 p-2 mb-4 outline-none mt-5 rounded-lg"  placeholder="Enter Subtask Title" type="text" v-model="form.name">
                <div class="text-sm text-red-500 italic" v-if="form.errors.name">{{ form.errors.name }}</div>
                <div class="buttons flex">
                <button class="btn border border-gray-300 p-1 px-4 font-semibold cursor-pointer text-gray-500 ml-auto bg-gray-200 rounded-lg hover:bg-slate-300">Cancel</button>
                <button type="submit" class="btn border border-blue-500 p-1 px-4 font-semibold cursor-pointer text-gray-200 ml-2 bg-blue-500 rounded-lg hover:bg-blue-700" >Update</button>
                </div>
            </form>
    </div>
</template>

<script setup>
import { useForm, Head } from "@inertiajs/inertia-vue3"


let props= defineProps({
    tasks:Array,
    subtask:Object,
})
let form = useForm({
  
    name:props.subtask.name,
})

const submit =()=>{
    form.put('/subtask/' +props.subtask.id)
}

</script>