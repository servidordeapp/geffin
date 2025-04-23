<template>
    <Head title="Dashboard" />

    <AppLayout :breadcrumbs="breadcrumbs">
        <div class="mb-6 flex justify-between">
            <h1 class="mb-6 text-2xl font-bold">Gerenciamento de Clientes</h1>
            <button class="btn btn-primary mb-6" @click="router.get(route('clients.create'))">+ <i class="fa fa-plus"></i> Adicionar Cliente</button>
        </div>

        <!-- :itemsPerPage="customers.length" -->
        <GenericDataTable
            title="Lista de Clientes"
            :items="customers"
            :headers="tableHeaders"
            deleteItemLabelField="first_name"
            deleteConfirmationMessage="Tem certeza que deseja excluir o cliente {item}?"
            searchPlaceholder="Buscar cliente por nome, email ou status..."
            :search="search"
            @search="handleSearch($event)"
            @edit="handleEditCustomer"
            @charges="haldleCustomerCharges"
            @delete="handleDeleteCustomer"
        >
            <!-- Exemplo de coluna personalizada -->
            <template #column-subscription="{ value }">
                <div class="flex items-center">
                    <div class="badge" :class="getSubscriptionClass(value)">{{ value }}</div>
                    <span v-if="value === 'Premium'" class="ml-1 text-yellow-500">★</span>
                </div>
            </template>
        </GenericDataTable>
    </AppLayout>
</template>

<script setup lang="ts">
import AppLayout from '@/layouts/AppLayout.vue';
import { type BreadcrumbItem } from '@/types';
import { Head, router } from '@inertiajs/vue3';
import { ref } from 'vue';
import GenericDataTable from '../../components/GenericDataTable.vue';

const props = defineProps({
    clientsList: Object,
    search: String,
});

const breadcrumbs: BreadcrumbItem[] = [
    {
        title: 'Dashboard',
        href: route('dashboard'),
    },
    {
        title: 'Clientes',
        href: route('clients.index'),
    },
];
const searchInput = ref(props.search);

const customers = ref(props.clientsList);

// Definição das colunas da tabela
const tableHeaders = [
    { key: 'id', label: '#', type: 'text' },
    { key: 'first_name', label: 'Nome', type: 'text' },
    { key: 'email', label: 'Email', type: 'text' },
    // {
    //     key: 'status',
    //     label: 'Status',
    //     type: 'badge',
    //     variants: {
    //         ativo: 'badge-success',
    //         inativo: 'badge-error',
    //         pendente: 'badge-warning',
    //         bloqueado: 'badge-secondary',
    //     },
    // },
    // { key: 'lastLogin', label: 'Último Login', type: 'date', format: 'DD/MM/YYYY' },
    // { key: 'subscription', label: 'Assinatura', type: 'custom' },
    // { key: 'verified', label: 'Verificado', type: 'boolean', trueLabel: 'Sim', falseLabel: 'Não' },
];

// Funções para lidar com eventos
const handleEditCustomer = (customer: any) => {
    console.log('Editando cliente:', customer);
    // Adicione sua lógica de edição aqui
    router.get(route('clients.edit', customer.id));
};

const handleDeleteCustomer = (customer: any) => {
    console.log('Excluindo cliente:', customer);
    // Adicione sua lógica de exclusão aqui
    // customers.value = customers.value.filter((c: any) => c.id !== customer.id);
};

const haldleCustomerCharges = (customer: any) => {
    console.log('Visualizando faturas do cliente:', customer);
    router.get(route('clients.charges', customer.id));
    // Adicione sua lógica
    // ra mostrar detalhes aqui
};

const handleSearch = (event: any) => {
    searchInput.value = event.target.value;
    console.log('Buscando clientes com o termo:', searchInput.value);
    router.get(
        route('clients.index'),
        { search: searchInput.value },
        {
            preserveScroll: true,
            preserveState: false,
            replace: true,
        },
    );
    event.target.focus();
};

// Função para classificar visualmente as assinaturas
const getSubscriptionClass = (subscription: string) => {
    const subscriptionTypes: Record<string, string> = {
        premium: 'badge-accent',
        basico: 'badge-info',
        gratuito: 'badge-ghost',
    };

    return subscriptionTypes[subscription.toLowerCase()] || 'badge-ghost';
};
</script>
