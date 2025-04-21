<script setup lang="ts">
import { usePage } from '@inertiajs/vue3';
import type { HTMLAttributes } from 'vue';

defineOptions({
    inheritAttrs: false,
});

interface Props {
    className?: HTMLAttributes['class'];
}

const page: ReturnType<typeof usePage> = usePage();

defineProps<Props>();
</script>

<template>
    <img :src="page.props.logos.app" alt="App Logo" :class="className" />
</template>
