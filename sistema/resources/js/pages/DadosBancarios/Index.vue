<template>
    <Head title="Dashboard" />

    <AppLayout :breadcrumbs="breadcrumbs">
        <BankDataForm :initialData="bankData" :isEditing="isEditing" @submit="handleSubmit" @cancel="handleCancel" />
    </AppLayout>
</template>

<script setup lang="ts">
import AppLayout from '@/layouts/AppLayout.vue';
import { BreadcrumbItem } from '@/types';
import { Head, router } from '@inertiajs/vue3';
import { ref } from 'vue';
import BankDataForm from '../../components/BankDataForm.vue';

const breadcrumbs: BreadcrumbItem[] = [
    {
        title: 'Dados Bancários',
        href: route('dados-bancarios.index'),
    },
];

// Estado
const isEditing = ref(false); // ou false para novo cadastro
const bankData = ref({
    // Dados pré-existentes para edição
    descricao: 'Conta Principal',
    conta: '12345',
    conta_dv: '6',
    agencia: '0001',
    agencia_dv: '7',
    variacao_carteira: '019',
    convenio: '123456',
    multa: '2.00',
    juros: '1.00',
    desconto: '5.00',
});

// Handlers
const handleSubmit = (data: any) => {
    console.log('Dados submetidos:', data);
    // Integração com API

    if (isEditing.value) {
        // Atualiza o cadastro existente
        router.put(route('dados-bancarios.update', data.id), data);
    } else {
        // Cria um novo cadastro
        router.post(route('dados-bancarios.store'), data);
    }

};

const handleCancel = () => {
    console.log('Operação cancelada');
    // Navegação ou lógica de cancelamento
};
</script>
