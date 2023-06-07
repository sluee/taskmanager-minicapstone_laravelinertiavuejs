<script setup>
import navBar from '../components/nav-bar.vue'
import {defineProps} from 'vue'

defineProps({
    'auth':Object
})
</script>

<template>
    <navBar :user="auth.user"/>

    <slot/>
</template>
