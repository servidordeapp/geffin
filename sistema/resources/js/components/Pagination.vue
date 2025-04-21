<template>
    <div class="my-4 flex justify-end">
        <div class="join">
            <!-- Botão "Anterior" -->
            <button
                class="join-item btn btn-sm"
                :class="{ 'btn-disabled': !pagination.prev_page_url }"
                @click="changePage(pagination.current_page - 1)"
                :disabled="!pagination.prev_page_url"
            >
                &laquo; Anterior
            </button>

            <!-- Números das páginas -->
            <template v-for="(link, index) in pagination.links" :key="index">
                <!-- Mostra apenas links de números (exclui anterior/próximo) -->
                <button
                    v-if="!isNaN(parseInt(link.label))"
                    class="join-item btn btn-sm"
                    :class="{ 'btn-active': link.active }"
                    @click="changePage(parseInt(link.label))"
                >
                    {{ link.label }}
                </button>
            </template>

            <!-- Botão "Próximo" -->
            <button
                class="join-item btn btn-sm"
                :class="{ 'btn-disabled': !pagination.next_page_url }"
                @click="changePage(pagination.current_page + 1)"
                :disabled="!pagination.next_page_url"
            >
                Próximo &raquo;
            </button>
        </div>
    </div>
</template>

<script setup lang="ts">
import { router } from '@inertiajs/vue3';
import { defineProps } from 'vue';

const props = defineProps({
    pagination: {
        type: Object,
        required: true,
    },
    // Rota para onde a navegação será feita
    routeName: {
        type: String,
        required: true,
    },
    // Parâmetros adicionais para a rota (opcional)
    params: {
        type: Object,
        default: () => ({}),
    },
    // Opções de preservação de estado do Inertia
    preserveState: {
        type: Boolean,
        default: false,
    },
    // Opções de preservação de scroll do Inertia
    preserveScroll: {
        type: Boolean,
        default: true,
    },
});

const changePage = (page: number) => {
    // Combina os parâmetros existentes com o novo número de página
    const queryParams = {
        ...props.params,
        page: page,
    };

    // Usando o router do Inertia para navegar
    router.get(route(props.routeName), queryParams, {
        preserveState: props.preserveState,
        preserveScroll: props.preserveScroll,
        replace: true, // Substitui a entrada atual no histórico do navegador
    });
};
</script>
