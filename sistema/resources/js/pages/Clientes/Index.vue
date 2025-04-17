<script setup lang="ts">
import AppLayout from '@/layouts/AppLayout.vue';
import { type BreadcrumbItem } from '@/types';
import { Head } from '@inertiajs/vue3';
import { ref } from 'vue';
import GenericDataTable from '../../components/GenericDataTable.vue';

const breadcrumbs: BreadcrumbItem[] = [
    {
        title: 'Clientes',
        href: route('clientes.index'),
    },
];
const searchInput = ref('');

const customers = ref([
    {
        id: 1,
        name: 'João Silva',
        email: 'joao@exemplo.com',
        status: 'Ativo',
        lastLogin: '2023-04-10T14:48:00',
        subscription: 'Premium',
        verified: true,
    },
    {
        id: 2,
        name: 'Maria Santos',
        email: 'maria@exemplo.com',
        status: 'Inativo',
        lastLogin: '2023-03-22T09:15:30',
        subscription: 'Basico',
        verified: false,
    },
    {
        id: 3,
        name: 'Pedro Oliveira',
        email: 'pedro@exemplo.com',
        status: 'Pendente',
        lastLogin: '2023-04-14T16:32:10',
        subscription: 'Basico',
        verified: true,
    },
    {
        id: 4,
        name: 'Ana Souza',
        email: 'ana@exemplo.com',
        status: 'Ativo',
        lastLogin: '2023-04-12T10:05:45',
        subscription: 'Premium',
        verified: true,
    },
    {
        id: 5,
        name: 'Carlos Ferreira',
        email: 'carlos@exemplo.com',
        status: 'Bloqueado',
        lastLogin: '2023-02-18T11:30:00',
        subscription: 'Gratuito',
        verified: true,
    },
]);

// Definição das colunas da tabela
const tableHeaders = [
    { key: 'name', label: 'Nome', type: 'text' },
    { key: 'email', label: 'Email', type: 'text' },
    {
        key: 'status',
        label: 'Status',
        type: 'badge',
        variants: {
            ativo: 'badge-success',
            inativo: 'badge-error',
            pendente: 'badge-warning',
            bloqueado: 'badge-secondary',
        },
    },
    { key: 'lastLogin', label: 'Último Login', type: 'date', format: 'DD/MM/YYYY' },
    { key: 'subscription', label: 'Assinatura', type: 'custom' },
    { key: 'verified', label: 'Verificado', type: 'boolean', trueLabel: 'Sim', falseLabel: 'Não' },
];

// Funções para lidar com eventos
const handleEditCustomer = (customer: any) => {
    console.log('Editando cliente:', customer);
    // Adicione sua lógica de edição aqui
};

const handleDeleteCustomer = (customer: any) => {
    console.log('Excluindo cliente:', customer);
    // Adicione sua lógica de exclusão aqui
    customers.value = customers.value.filter((c) => c.id !== customer.id);
};

const haldleCustomerBillings = (customer: any) => {
    console.log('Visualizando faturas do cliente:', customer);
    // Adicione sua lógica para mostrar detalhes aqui
};

const handleSearch = (event: any) => {
    console.log('Evento disparado:', event.target.value);
    searchInput.value = event.target.value;
    console.log('searchInput:', searchInput.value);
    // Adicione sua lógica para aqui
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

<template>
    <Head title="Dashboard" />

    <AppLayout :breadcrumbs="breadcrumbs">
        <h1 class="mb-6 text-2xl font-bold">Gerenciamento de Clientes</h1>

        <GenericDataTable
            title="Lista de Clientes"
            :items="customers"
            :headers="tableHeaders"
            deleteItemLabelField="name"
            deleteConfirmationMessage="Tem certeza que deseja excluir o cliente {item}?"
            searchPlaceholder="Buscar cliente por nome, email ou status..."
            @search="handleSearch($event)"
            @edit="handleEditCustomer"
            @billings="haldleCustomerBillings"
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
