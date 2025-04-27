<template>
    <Head title="Dashboard" />

    <AppLayout :breadcrumbs="breadcrumbs">
        <div class="bg-base-200 mx-auto rounded-xl pb-6">
            <!-- Título e filtros -->
            <div class="mb-6 flex flex-col items-start justify-between md:flex-row md:items-center">
                <div>
                    <h1 class="mb-2 text-2xl font-bold">Cobranças do Cliente</h1>
                    <p class="text-base-content/70" v-if="selectedClient">Cliente: {{ selectedClient.name }}</p>
                </div>
                <div>
                    <!-- Open the modal using ID.showModal() method -->
                    <button type="button" class="btn btn-primary" onclick="my_modal_5.showModal()">Criar Cobrança</button>
                    <dialog id="my_modal_5" class="modal">
                        <div class="modal-box max-w-7xl">
                            <!-- <h3 class="text-lg font-bold">Hello!</h3>
                            <p class="py-4">Press ESC key or click the button below to close</p> -->
                            <FormCharge></FormCharge>
                            <div class="modal-action">
                                <form method="dialog">
                                    <!-- if there is a button in form, it will close the modal -->
                                    <button class="btn">Close</button>
                                </form>
                            </div>
                        </div>
                    </dialog>
                </div>
            </div>

            <!-- Título e filtros -->
            <div class="mb-6 flex flex-col items-start justify-between md:flex-row md:items-center">
                <div></div>

                <div class="mt-4 flex w-full flex-col gap-3 sm:flex-row md:mt-0 md:w-auto">
                    <div class="flex-1 md:flex-none">
                        <select class="select select-bordered w-full max-w-xs" v-model="statusFilter">
                            <option value="">Todos os status</option>
                            <option value="pago">Pago</option>
                            <option value="pendente">Pendente</option>
                            <option value="atrasado">Atrasado</option>
                            <option value="cancelado">Cancelado</option>
                        </select>
                    </div>
                    <div class="form-control flex-1 md:flex-none">
                        <input type="text" placeholder="Buscar cobrança..." class="input input-bordered w-full max-w-xs" v-model="searchText" />
                    </div>
                </div>
            </div>

            <!-- Alerta de carregamento/erro -->
            <div v-if="loading" class="alert alert-info mb-6 shadow-lg">
                <div>
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" class="h-6 w-6 flex-shrink-0 stroke-current">
                        <path
                            stroke-linecap="round"
                            stroke-linejoin="round"
                            stroke-width="2"
                            d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"
                        ></path>
                    </svg>
                    <span>Carregando cobranças...</span>
                </div>
            </div>
            <div v-if="error" class="alert alert-error mb-6 shadow-lg">
                <div>
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 flex-shrink-0 stroke-current" fill="none" viewBox="0 0 24 24">
                        <path
                            stroke-linecap="round"
                            stroke-linejoin="round"
                            stroke-width="2"
                            d="M10 14l2-2m0 0l2-2m-2 2l-2-2m2 2l2 2m7-2a9 9 0 11-18 0 9 9 0 0118 0z"
                        />
                    </svg>
                    <span>Erro ao carregar cobranças. Tente novamente.</span>
                </div>
            </div>

            <!-- Lista de cobranças -->
            <div v-if="!loading && !error && filteredCharges.length === 0" class="py-10 text-center">
                <div class="flex flex-col items-center justify-center">
                    <svg
                        xmlns="http://www.w3.org/2000/svg"
                        class="text-base-content/30 h-16 w-16"
                        fill="none"
                        viewBox="0 0 24 24"
                        stroke="currentColor"
                    >
                        <path
                            stroke-linecap="round"
                            stroke-linejoin="round"
                            stroke-width="2"
                            d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"
                        />
                    </svg>
                    <h3 class="mt-4 text-lg font-medium">Nenhuma cobrança encontrada</h3>
                    <p class="text-base-content/70 mt-1">Tente ajustar seus filtros ou adicione uma nova cobrança</p>
                </div>
            </div>

            <div class="grid grid-cols-1 gap-6">
                <div
                    v-for="charge in filteredCharges"
                    :key="charge.id"
                    class="card bg-base-100 shadow-md transition-shadow duration-300 hover:shadow-lg"
                >
                    <div class="card-body p-6">
                        <div class="flex flex-col justify-between md:flex-row">
                            <div class="flex-1">
                                <h2 class="card-title flex items-center">
                                    {{ charge.description }}
                                    <div :class="`badge ${getStatusBadgeClass(charge.status)} ml-2`">{{ charge.status }}</div>
                                </h2>
                                <div class="mt-2 space-y-1">
                                    <p><span class="font-medium">Valor:</span> {{ formatCurrency(charge.value) }}</p>
                                    <p><span class="font-medium">Vencimento:</span> {{ formatDate(charge.due_date) }}</p>
                                    <p v-if="charge.contrato"><span class="font-medium">Contrato:</span> {{ charge.contrato }}</p>
                                </div>
                            </div>
                            <div class="mt-4 flex items-center md:mt-0">
                                <div class="flex flex-col items-end">
                                    <button class="btn btn-ghost btn-sm gap-2" @click="toggleInstallments(charge.id)">
                                        Ver parcelas
                                        <svg
                                            xmlns="http://www.w3.org/2000/svg"
                                            viewBox="0 0 20 20"
                                            fill="currentColor"
                                            class="h-5 w-5"
                                            :class="{ 'rotate-180': expandedCharges.includes(charge.id) }"
                                        >
                                            <path
                                                fill-rule="evenodd"
                                                d="M5.23 7.21a.75.75 0 011.06.02L10 11.168l3.71-3.938a.75.75 0 111.08 1.04l-4.25 4.5a.75.75 0 01-1.08 0l-4.25-4.5a.75.75 0 01.02-1.06z"
                                                clip-rule="evenodd"
                                            />
                                        </svg>
                                    </button>
                                </div>
                            </div>
                        </div>

                        <!-- Parcelas expandidas -->
                        <div v-if="expandedCharges.includes(charge.id)" class="mt-4">
                            <div class="divider text-base-content/70 text-sm">Parcelas</div>
                            <div class="overflow-x-auto">
                                <table class="table-zebra table w-full">
                                    <thead>
                                        <tr>
                                            <th>Nº</th>
                                            <th>Valor</th>
                                            <th>Vencimento</th>
                                            <th>Status</th>
                                            <th>Ações</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr v-for="(installment, index) in charge.installments" :key="index">
                                            <td>{{ index + 1 }}</td>
                                            <td>{{ formatCurrency(installment.value) }}</td>
                                            <td>{{ formatDate(installment.due_date) }}</td>
                                            <td>
                                                <div :class="`badge ${getStatusBadgeClass(installment.status)}`">
                                                    {{ installment.status }}
                                                </div>
                                            </td>
                                            <td>
                                                <button
                                                    @click="openInstallmentHistory(installment.id, charge.client_id, installment.history || [])"
                                                    class="btn btn-primary btn-sm"
                                                >
                                                    Ver histórico
                                                </button>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Paginação -->
            <div class="mt-8 flex justify-center">
                <div class="join">
                    <button class="join-item btn" :disabled="currentPage === 1" @click="currentPage--">«</button>
                    <button class="join-item btn">Página {{ currentPage }} de {{ totalPages }}</button>
                    <button class="join-item btn" :disabled="currentPage === totalPages" @click="currentPage++">»</button>
                </div>
            </div>

            <!-- Drawer global que será posicionado no final do seu template principal -->
<div class="drawer drawer-end">
  <input :id="'global-drawer'" type="checkbox" class="drawer-toggle" v-model="isDrawerOpen" />

  <div class="drawer-side z-50">
    <label :for="'global-drawer'" aria-label="close sidebar" class="drawer-overlay bg-black bg-opacity-40"></label>

    <div class="bg-base-200 text-base-content h-full w-2/3 md:w-1/2 overflow-y-auto">
      <div class="mb-4 flex items-center justify-between">
        <h3 class="text-lg font-medium p-4">Histórico da Parcela</h3>
        <button class="btn btn-sm btn-circle" @click="isDrawerOpen = false">
          <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
          </svg>
        </button>
      </div>

      <PaymentHistory :parcelaId="selectedInstallment" />
    </div>
  </div>
</div>

        </div>
    </AppLayout>
</template>

<!-- eslint-disable-next-line vue/block-lang -->
<script setup>
import AppLayout from '@/layouts/AppLayout.vue';
// import { type BreadcrumbItem } from '@/types';
import { Head } from '@inertiajs/vue3';
import { computed, ref } from 'vue';
import FormCharge from '../../components/FormCharge.vue';
import PaymentHistory from '../../components/PaymentHistory.vue';

const props = defineProps({
    client: Object,
});

// Cliente selecionado (normalmente viria de um estado global ou params)
const selectedClient = ref({
    id: props.client?.id,
    name: props.client?.first_name + ' ' + props.client?.last_name,
});

const breadcrumbs = [
    {
        title: 'Dashboard',
        href: route('dashboard'),
    },
    {
        title: 'Clientes',
        href: route('clients.index'),
    },
    {
        title: 'Cobranças',
        href: route('clients.charges', selectedClient.value.id),
    },
];
// Estado
const isDrawerOpen = ref(false);
const selectedInstallment = ref(null);
const charges = ref(props.client?.charges || []);
const loading = ref(false);
const error = ref(false);
const expandedCharges = ref([]);
const statusFilter = ref('');
const searchText = ref('');
const currentPage = ref(1);
const itemsPerPage = 5;

const openInstallmentHistory = (installmentId, clientId, history) => {
    selectedInstallment.value = {
        id: installmentId,
        clientId: clientId,
        history: history,
    };
    isDrawerOpen.value = true;
};

// Filtrar cobranças
const filteredCharges = computed(() => {
    console.log('Charges...', props.client);
    let filtered = props.client?.charges;
    // let filtered = charges.value;

    // Filtrar por status
    if (statusFilter.value) {
        filtered = filtered.filter((charge) => charge.status === statusFilter.value);
    }

    // Filtrar por texto de busca
    if (searchText.value) {
        const search = searchText.value.toLowerCase();
        filtered = filtered.filter(
            (charge) => charge.description.toLowerCase().includes(search) || (charge.contrato && charge.contrato.toLowerCase().includes(search)),
        );
    }

    // Paginação
    // const startIndex = (currentPage.value - 1) * itemsPerPage;
    // const endIndex = startIndex + itemsPerPage;

    return filtered; //.slice(startIndex, endIndex);
});

// Total de páginas
const totalPages = computed(() => {
    let filtered = charges.value;

    if (statusFilter.value) {
        filtered = filtered.filter((charge) => charge.status === statusFilter.value);
    }

    if (searchText.value) {
        const search = searchText.value.toLowerCase();
        filtered = filtered.filter(
            (charge) => charge.description.toLowerCase().includes(search) || (charge.contrato && charge.contrato.toLowerCase().includes(search)),
        );
    }

    return Math.ceil(filtered.length / itemsPerPage) || 1;
});

// Alternar exibição de parcelas
const toggleInstallments = (chargeId) => {
    if (expandedCharges.value.includes(chargeId)) {
        expandedCharges.value = expandedCharges.value.filter((id) => id !== chargeId);
    } else {
        expandedCharges.value.push(chargeId);
    }
};

// Formatadores
const formatCurrency = (value) => {
    return new Intl.NumberFormat('pt-BR', {
        style: 'currency',
        currency: 'BRL',
    }).format(value);
};

const formatDate = (dateString) => {
    const date = new Date(dateString);
    return new Intl.DateTimeFormat('pt-BR').format(date);
};

// Classes para os badges de status
const getStatusBadgeClass = (status) => {
    switch (status) {
        case 'pago':
            return 'badge-success';
        case 'pendente':
            return 'badge-warning';
        case 'atrasado':
            return 'badge-error';
        case 'cancelado':
            return 'badge-neutral';
        default:
            return 'badge-info';
    }
};
</script>
