<template>
    <div class="bg-base-100 rounded-box p-4 shadow-lg">
        <h2 class="mb-4 text-xl font-bold">{{ title }}</h2>

        <!-- Filtro/Pesquisa (opcional) -->
        <div v-if="showSearch" class="form-control mb-4">
            <label class="input">
                <svg class="h-[1.5em] opacity-50" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24">
                    <g stroke-linejoin="round" stroke-linecap="round" stroke-width="2.5" fill="none" stroke="currentColor">
                        <circle cx="11" cy="11" r="8"></circle>
                        <path d="m21 21-4.3-4.3"></path>
                    </g>
                </svg>
                <input v-model="searchQuery" @input="searchItems" type="search" :placeholder="searchPlaceholder" />
            </label>
            <!-- <input v-model="searchQuery" @input="searchItems" type="search" :placeholder="searchPlaceholder" class="input input-bordered w-full" /> -->
        </div>

        <!-- Tabela de dados -->
        <div class="overflow-x-auto">
            <table class="table-zebra table w-full">
                <thead>
                    <tr>
                        <th v-for="header in headers" :key="header.key" class="bg-base-200">
                            {{ header.label }}
                        </th>
                        <th v-if="showActions" class="bg-base-200">{{ actionsLabel }}</th>
                    </tr>
                </thead>
                <tbody>
                    <tr v-if="items.data.length === 0">
                        <td :colspan="showActions ? headers.length + 1 : headers.length" class="py-4 text-center">
                            {{ emptyMessage }}
                        </td>
                    </tr>
                    <tr v-for="item in items.data" :key="getItemKey(item)" class="hover">
                        <td v-for="header in headers" :key="`${getItemKey(item)}-${header.key}`">
                            <!-- Renderização condicional baseada no tipo de coluna -->
                            <template v-if="header.type === 'badge'">
                                <span :class="getBadgeClass(item[header.key], header.variants)">
                                    {{ item[header.key] }}
                                </span>
                            </template>

                            <template v-else-if="header.type === 'image'">
                                <img :src="item[header.key]" :alt="header.label" class="h-10 w-10 rounded-full object-cover" />
                            </template>

                            <template v-else-if="header.type === 'date'">
                                {{ formatDate(item[header.key], header.format) }}
                            </template>

                            <template v-else-if="header.type === 'boolean'">
                                <div class="badge" :class="item[header.key] ? 'badge-success' : 'badge-error'">
                                    {{ item[header.key] ? header.trueLabel || 'Sim' : header.falseLabel || 'Não' }}
                                </div>
                            </template>

                            <template v-else-if="header.type === 'custom' && $slots[`column-${header.key}`]">
                                <slot :name="`column-${header.key}`" :item="item" :value="item[header.key]"></slot>
                            </template>

                            <template v-else>
                                {{ item[header.key] }}
                            </template>
                        </td>

                        <!-- Coluna de ações -->
                        <td v-if="showActions">
                            <div class="flex gap-2">
                                <slot name="actions" :item="item">
                                    <button v-if="showEditButton" @click="editItem(item)" class="btn btn-sm btn-info">
                                        <svg
                                            xmlns="http://www.w3.org/2000/svg"
                                            class="mr-1 h-4 w-4"
                                            fill="none"
                                            viewBox="0 0 24 24"
                                            stroke="currentColor"
                                        >
                                            <path
                                                stroke-linecap="round"
                                                stroke-linejoin="round"
                                                stroke-width="2"
                                                d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z"
                                            />
                                        </svg>
                                        {{ editButtonLabel }}
                                    </button>
                                    <button v-if="showBillingsButton" @click="viewCustomerCharges(item)" class="btn btn-sm btn-primary">
                                        <svg
                                            xmlns="http://www.w3.org/2000/svg"
                                            class="mr-1 h-4 w-4"
                                            fill="none"
                                            viewBox="0 0 24 24"
                                            stroke="currentColor"
                                        >
                                            <path
                                                stroke-linecap="round"
                                                stroke-linejoin="round"
                                                stroke-width="2"
                                                d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"
                                            />
                                            <path
                                                stroke-linecap="round"
                                                stroke-linejoin="round"
                                                stroke-width="2"
                                                d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"
                                            />
                                        </svg>
                                        {{ billingsButtonLabel }}
                                    </button>
                                    <button v-if="showDeleteButton" @click="showDeleteModal(item)" class="btn btn-sm btn-error">
                                        <svg
                                            xmlns="http://www.w3.org/2000/svg"
                                            class="mr-1 h-4 w-4"
                                            fill="none"
                                            viewBox="0 0 24 24"
                                            stroke="currentColor"
                                        >
                                            <path
                                                stroke-linecap="round"
                                                stroke-linejoin="round"
                                                stroke-width="2"
                                                d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"
                                            />
                                        </svg>
                                        {{ deleteButtonLabel }}
                                    </button>
                                </slot>
                            </div>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>

        <Pagination :pagination="items" route-name="clients.index" :params="{ search: searchQuery, page: currentPage }" />

        <!-- Modal de confirmação de exclusão -->
        <div v-if="showDeleteConfirmation" class="modal modal-open">
            <div class="modal-box">
                <h3 class="text-lg font-bold">{{ deleteModalTitle }}</h3>
                <p class="py-4">{{ getDeleteConfirmationMessage() }}</p>
                <div class="modal-action">
                    <button @click="confirmDelete" class="btn btn-error">{{ deleteConfirmLabel }}</button>
                    <button @click="showDeleteConfirmation = false" class="btn">{{ deleteCancelLabel }}</button>
                </div>
            </div>
        </div>
    </div>
</template>

<!-- eslint-disable-next-line vue/block-lang -->
<script setup>
import { router } from '@inertiajs/vue3';
import { ref } from 'vue';
import Pagination from './Pagination.vue';

// Props para o componente genérico
const props = defineProps({
    // Dados principais
    items: {
        type: Object,
        default: () => ({}),
    },
    headers: {
        type: Array,
        default: () => [],
        // Esperado formato: [{ key: 'name', label: 'Nome', type: 'text|badge|image|date|boolean|custom' }]
    },
    itemKey: {
        type: String,
        default: 'id',
    },

    // Configurações gerais
    title: {
        type: String,
        default: 'Lista de Itens',
    },
    emptyMessage: {
        type: String,
        default: 'Nenhum item encontrado',
    },

    // Configurações de busca
    search: {
        type: String,
        default: '',
    },
    showSearch: {
        type: Boolean,
        default: true,
    },
    searchPlaceholder: {
        type: String,
        default: 'Buscar...',
    },
    searchFields: {
        type: Array,
        default: null, // Se null, usará todas as chaves do headers
    },

    // Configurações de paginação
    showPagination: {
        type: Boolean,
        default: true,
    },
    itemsPerPage: {
        type: Number,
        default: 15,
    },
    paginationLabel: {
        type: String,
        default: 'Página {current} de {total}',
    },

    // Configurações de ações
    showActions: {
        type: Boolean,
        default: true,
    },
    actionsLabel: {
        type: String,
        default: 'Ações',
    },
    showEditButton: {
        type: Boolean,
        default: true,
    },
    showBillingsButton: {
        type: Boolean,
        default: true,
    },
    showDeleteButton: {
        type: Boolean,
        default: true,
    },
    editButtonLabel: {
        type: String,
        default: 'Editar',
    },
    billingsButtonLabel: {
        type: String,
        default: 'Cobranças',
    },
    deleteButtonLabel: {
        type: String,
        default: 'Excluir',
    },

    // Configurações do modal de exclusão
    deleteModalTitle: {
        type: String,
        default: 'Confirmar exclusão',
    },
    deleteConfirmationMessage: {
        type: String,
        default: 'Tem certeza que deseja excluir este item?',
    },
    deleteItemLabelField: {
        type: String,
        default: '',
    },
    deleteConfirmLabel: {
        type: String,
        default: 'Excluir',
    },
    deleteCancelLabel: {
        type: String,
        default: 'Cancelar',
    },
});

// Emits para eventos personalizados
const emit = defineEmits(['edit', 'delete', 'charges', 'search']);

// Estado do componente
const searchQuery = ref(props.search);
const currentPage = ref(1);
const showDeleteConfirmation = ref(false);
const itemToDelete = ref(null);

// Obter a chave única de um item
const getItemKey = (item) => {
    return item[props.itemKey];
};

// Retorna a classe apropriada para badges
const getBadgeClass = (value, variants = {}) => {
    const valueLower = String(value).toLowerCase();

    // Se não houver variants definido, usa alguns padrões comuns
    const defaultVariants = {
        ativo: 'badge-success',
        active: 'badge-success',
        inativo: 'badge-error',
        inactive: 'badge-error',
        pendente: 'badge-warning',
        pending: 'badge-warning',
        bloqueado: 'badge-secondary',
        blocked: 'badge-secondary',
    };

    const badgeVariants = Object.keys(variants).length > 0 ? variants : defaultVariants;

    return `badge ${badgeVariants[valueLower] || 'badge-ghost'}`;
};

// Formata datas
const formatDate = (dateValue, format = 'DD/MM/YYYY') => {
    if (!dateValue) return '';

    try {
        const date = new Date(dateValue);

        if (isNaN(date.getTime())) {
            return dateValue;
        }

        // Implementação simples de formatação
        const day = date.getDate().toString().padStart(2, '0');
        const month = (date.getMonth() + 1).toString().padStart(2, '0');
        const year = date.getFullYear();

        return format.replace('DD', day).replace('MM', month).replace('YYYY', year);
        // eslint-disable-next-line @typescript-eslint/no-unused-vars
    } catch (e) {
        return dateValue;
    }
};

// Mensagem de confirmação de exclusão
const getDeleteConfirmationMessage = () => {
    if (!itemToDelete.value) return props.deleteConfirmationMessage;

    // Se houver um campo específico para mostrar no texto de confirmação
    if (props.deleteItemLabelField && itemToDelete.value[props.deleteItemLabelField]) {
        return props.deleteConfirmationMessage.replace('{item}', itemToDelete.value[props.deleteItemLabelField]);
    }

    return props.deleteConfirmationMessage;
};

// Métodos para interação
const editItem = (item) => {
    emit('edit', item);
};

const viewCustomerCharges = (item) => {
    emit('charges', item);
};

const searchItems = () => {
    router.visit(
        route('clients.index'),
        { search: searchQuery.value },
        {
            preserveState: false,
            preserveScroll: true,
            replace: true,
        },
    );
};

const showDeleteModal = (item) => {
    itemToDelete.value = item;
    showDeleteConfirmation.value = true;
};

const confirmDelete = () => {
    emit('delete', itemToDelete.value);
    showDeleteConfirmation.value = false;
    itemToDelete.value = null;
};

// Watch para resetar a página quando a busca muda
// watch(searchQuery, () => {
//     console.log('Busca alterada:', searchQuery.value);
//     currentPage.value = 1;
// });
</script>
