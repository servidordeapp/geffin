<template>
    <h2 class="mb-6 text-center text-2xl font-bold md:text-left">{{ isEditing ? 'Editar Cobrança' : 'Nova Cobrança' }}</h2>
    <div class="bg-base-100 rounded-box mx-auto w-full p-4 shadow-lg md:p-6">
        <form @submit.prevent="saveCharge" class="space-y-6">
            <!-- Descrição -->
            <div class="form-control">
                <label class="label">
                    <span class="label-text font-medium">Título</span>
                </label>
                <input v-model="charge.title" class="input w-full" placeholder="Descreva o título da cobrança" required />
            </div>
            <div class="form-control">
                <label class="label">
                    <span class="label-text font-medium">Descrição</span>
                </label>
                <textarea
                    v-model="charge.description"
                    class="textarea textarea-bordered h-24 w-full"
                    placeholder="Descreva o motivo da cobrança"
                ></textarea>
            </div>

            <!-- Cliente e Valor na mesma linha em telas maiores -->
            <div class="grid grid-cols-1 gap-4 md:grid-cols-2">
                <!-- Valor -->
                <div class="form-control">
                    <div class="label block">
                        <span class="label-text font-medium">Valor (R$)</span>
                    </div>
                    <label class="input w-full">
                        <span>R$</span>
                        <input v-model="charge.value" type="text" class="grow" placeholder="0,00" @input="formatCurrency" required />
                    </label>
                </div>

                <!-- Data de Vencimento -->
                <div class="form-control">
                    <label class="label">
                        <span class="label-text font-medium">Data de Vencimento</span>
                    </label>
                    <input v-model="charge.due_date" type="date" class="input input-bordered w-full" required />
                </div>
            </div>

            <!-- Data de Vencimento e Número de Parcelas na mesma linha em telas maiores -->
            <div class="grid grid-cols-1 gap-4 md:grid-cols-2">
                <!-- Número de Parcelas -->
                <div class="form-control">
                    <label class="label">
                        <span class="label-text font-medium">Número de Parcelas</span>
                    </label>
                    <input
                        v-model.number="numberOfInstallments"
                        type="number"
                        min="1"
                        max="48"
                        class="input input-bordered w-full"
                        @change="calculateInstallments"
                        required
                    />
                </div>

                <!-- Gateway -->
                <div class="form-control">
                    <label class="label">
                        <span class="label-text font-medium">Gateway de Pagamento</span>
                    </label>
                    <select v-model="charge.gateway" class="select select-bordered w-full" required>
                        <option disabled value="">Selecione um gateway</option>
                        <option value="bb">Banco do Brasil</option>
                        <option value="santander">Santander</option>
                        <option value="none">Sem Gateway</option>
                    </select>
                </div>
            </div>

            <!-- Botão para pré-visualizar parcelas -->
            <div class="mt-4 text-center">
                <button type="button" class="btn btn-outline btn-primary btn-sm" @click="toggleInstallmentsPreview">
                    {{ showInstallments ? 'Ocultar Parcelas' : 'Pré-visualizar Parcelas' }}
                </button>
            </div>

            <!-- Tabela de Parcelas (exibida apenas quando showInstallments for true) -->
            <div v-if="showInstallments" class="mt-4 overflow-x-auto">
                <div class="card bg-base-300 text-base-content shadow-sm">
                    <div class="card-body p-2 md:p-6">
                        <h3 class="mb-4 text-lg font-semibold">Parcelas</h3>
                        <div class="overflow-x-auto">
                            <table class="table-zebra table w-full">
                                <thead>
                                    <tr>
                                        <th>Parcela</th>
                                        <th>Valor</th>
                                        <th>Vencimento</th>
                                        <th>Status</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr v-for="(installment, index) in installments" :key="index">
                                        <td>{{ installment.number }}</td>
                                        <td>R$ {{ formatNumberToCurrency(installment.value) }}</td>
                                        <td>{{ formatDate(installment.due_date) }}</td>
                                        <td>
                                            <span :class="getStatusBadgeClass(installment.status)">
                                                {{ getStatusLabel(installment.status) }}
                                            </span>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Botões de Ação -->
            <div class="mt-8 flex flex-col justify-end gap-2 md:flex-row">
                <button type="button" class="btn btn-ghost" @click="cancelForm">Cancelar</button>
                <button type="submit" class="btn btn-primary" :disabled="isSubmitting">
                    <span v-if="isSubmitting" class="loading loading-spinner loading-sm mr-2"></span>
                    {{ isEditing ? 'Atualizar Cobrança' : 'Criar Cobrança' }}
                </button>
            </div>
        </form>
    </div>
</template>

<script setup lang="ts">
import { onMounted, reactive, ref, watch } from 'vue';

const props = defineProps({
    editingCharge: {
        type: Object,
        default: null,
    },
});

const emit = defineEmits(['save', 'cancel']);

// Estado reativo
const isEditing = ref(false);
const isSubmitting = ref(false);
const charge = reactive({
    title: '',
    description: '',
    value: '',
    due_date: '',
    gateway: '',
});
const numberOfInstallments = ref(1);
const installments = ref([]);
const showInstallments = ref(true);

// Métodos auxiliares
const formatDateToISO = (date) => {
    return date.toISOString().split('T')[0];
};

const formatNumberToCurrency = (value) => {
    return parseFloat(value).toFixed(2).replace('.', ',');
};

const formatDate = (dateString) => {
    const date = new Date(dateString.split('-').join(','));
    return date.toLocaleDateString('pt-BR');
};

const getStatusLabel = (status) => {
    const statusMap = {
        pending: 'Pendente',
        paid: 'Pago',
        overdue: 'Vencido',
        canceled: 'Cancelado',
    };
    return statusMap[status] || status;
};

const getStatusBadgeClass = (status) => {
    const classMap = {
        pending: 'badge badge-warning',
        paid: 'badge badge-success',
        overdue: 'badge badge-error',
        canceled: 'badge badge-neutral',
    };
    return classMap[status] || 'badge';
};

// Formatação de moeda em tempo real
const formatCurrency = (event) => {
    // Remove tudo que não é número
    let value = event.target.value.replace(/\D/g, '');

    // Converte para valor decimal (divide por 100 para obter os centavos)
    value = (parseFloat(value) / 100).toFixed(2);

    // Formata para moeda brasileira
    if (!isNaN(value)) {
        charge.value = value.replace('.', ',');
    }
};

// Calcula as parcelas com base no valor total e número de parcelas
const calculateInstallments = () => {
    if (!charge.due_date || !charge.value || numberOfInstallments.value < 1) {
        installments.value = [];
        return;
    }

    // Parse the value, ensuring it's a number
    const totalValue = parseFloat(charge.value.replace(',', '.'));
    if (isNaN(totalValue)) return;

    // Calculate installment value (rounded to 2 decimal places)
    const installmentValue = (totalValue / numberOfInstallments.value).toFixed(2);

    // Calculate dates and create installments
    const newInstallments = [];
    // const firstDueDate = new Date(charge.due_date);
    const [year, month, day] = charge.due_date.split('-').map(Number);
    const firstDueDate = new Date(year, month - 1, day);

    for (let i = 0; i < numberOfInstallments.value; i++) {
        const dueDate = new Date(firstDueDate);
        dueDate.setMonth(firstDueDate.getMonth() + i);

        newInstallments.push({
            number: i + 1,
            value: installmentValue,
            due_date: formatDateToISO(dueDate),
            status: 'pending',
        });
    }

    installments.value = newInstallments;
};

// Mostra ou esconde a pré-visualização das parcelas
const toggleInstallmentsPreview = () => {
    if (!showInstallments.value) {
        calculateInstallments();
    }
    showInstallments.value = !showInstallments.value;
};

// Salva a cobrança (enviaria para uma API em um caso real)
const saveCharge = () => {
    isSubmitting.value = true;

    // Simulando uma chamada de API
    setTimeout(() => {
        // Preparar o objeto para envio
        const chargeData = {
            ...charge,
            // Converter valor para formato numérico para o backend
            value: parseFloat(charge.value.replace(',', '.')),
            installments: installments.value,
        };

        console.log('Dados da cobrança a serem salvos:', chargeData);

        // Emitir evento para o componente pai com os dados da cobrança
        emit('save', chargeData);

        isSubmitting.value = false;

        // Resetar o formulário ou redirecionar
        if (!isEditing.value) {
            resetForm();
        }
    }, 800);
};

// Reseta o formulário para valores iniciais
const resetForm = () => {
    Object.assign(charge, {
        description: '',
        client_id: '',
        value: '',
        due_date: '',
        status: 'pending',
        gateway: '',
    });
    numberOfInstallments.value = 1;
    installments.value = [];
    showInstallments.value = false;
};

// Cancela o formulário
const cancelForm = () => {
    emit('cancel');
};

// Observa mudanças nas parcelas ou valor para recalcular
watch([() => charge.value, () => charge.due_date, numberOfInstallments], () => {
    if (showInstallments.value) {
        calculateInstallments();
    }
});

// Inicialização
onMounted(() => {
    // Verifica se estamos editando uma cobrança existente
    if (props.editingCharge) {
        isEditing.value = true;
        Object.assign(charge, props.editingCharge);
        numberOfInstallments.value = props.editingCharge.installments?.length || 1;
        calculateInstallments();
    } else {
        // Define a data de vencimento padrão como hoje + 7 dias
        const today = new Date();
        today.setDate(today.getDate() + 7);
        charge.due_date = formatDateToISO(today);
    }
});
</script>
