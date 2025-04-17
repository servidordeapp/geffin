<template>
    <div class="mx-auto">
        <!-- Card principal -->
        <div class="card bg-base-100 shadow-xl">
            <!-- Cabeçalho -->
            <div class="card-body gap-6">
                <div class="flex flex-col items-start justify-between gap-4 md:flex-row md:items-center">
                    <div>
                        <h2 class="card-title text-primary text-2xl font-bold">
                            {{ isEditing ? 'Atualizar Dados Bancários' : 'Cadastrar Dados Bancários' }}
                        </h2>
                        <p class="text-base-content/70 mt-1">Preencha os campos abaixo com as informações da sua conta bancária</p>
                    </div>

                    <!-- Ícone de banco -->
                    <div class="bg-primary/10 rounded-full p-4">
                        <svg xmlns="http://www.w3.org/2000/svg" class="text-primary h-10 w-10" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 6l9-4 9 4v2H3V6z" />
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 10h18M8 14v4M12 14v4M16 14v4M3 18h18" />
                        </svg>
                    </div>
                </div>

                <!-- Barra de progresso -->
                <div class="w-full">
                    <div class="mb-1 flex justify-between text-xs">
                        <span>Progresso</span>
                        <span>{{ progressPercentage }}%</span>
                    </div>
                    <progress class="progress progress-primary w-full" :value="progressPercentage" max="100"></progress>
                </div>

                <!-- Formulário -->
                <form @submit.prevent="handleSubmit">
                    <div class="divider">Dados da Conta</div>

                    <!-- Grade de campos em 2 colunas em telas médias e grandes -->
                    <div class="grid grid-cols-1 gap-4 md:grid-cols-2">
                        <!-- Descrição -->
                        <div class="form-control">
                            <label class="label">
                                <span class="label-text">Descrição da Conta</span>
                                <span class="label-text-alt text-error">*</span>
                            </label>
                            <input
                                v-model="formData.descricao"
                                type="text"
                                placeholder="Ex: Conta Principal"
                                class="input input-bordered w-full"
                                :class="{ 'input-error': errors.descricao }"
                                @input="validateField('descricao')"
                            />
                            <label v-if="errors.descricao" class="label">
                                <span class="label-text-alt text-error">{{ errors.descricao }}</span>
                            </label>
                        </div>

                        <!-- Campo Vazio para alinhamento -->
                        <div class="hidden md:block"></div>

                        <!-- Agência -->
                        <div class="form-control">
                            <label class="label">
                                <span class="label-text">Agência</span>
                                <span class="label-text-alt text-error">*</span>
                            </label>
                            <input
                                v-model="formData.agencia"
                                type="text"
                                placeholder="Número da agência"
                                class="input input-bordered w-full"
                                :class="{ 'input-error': errors.agencia }"
                                @input="validateField('agencia')"
                            />
                            <label v-if="errors.agencia" class="label">
                                <span class="label-text-alt text-error">{{ errors.agencia }}</span>
                            </label>
                        </div>

                        <!-- DV Agência -->
                        <div class="form-control">
                            <label class="label">
                                <span class="label-text">Dígito da Agência</span>
                            </label>
                            <input
                                v-model="formData.agencia_dv"
                                type="text"
                                placeholder="DV"
                                class="input input-bordered w-full"
                                maxlength="1"
                                @input="validateField('agencia_dv')"
                            />
                            <label class="label">
                                <span class="label-text-alt">Deixe em branco se não houver</span>
                            </label>
                        </div>

                        <!-- Conta -->
                        <div class="form-control">
                            <label class="label">
                                <span class="label-text">Número da Conta</span>
                                <span class="label-text-alt text-error">*</span>
                            </label>
                            <input
                                v-model="formData.conta"
                                type="text"
                                placeholder="Número da conta"
                                class="input input-bordered w-full"
                                :class="{ 'input-error': errors.conta }"
                                @input="validateField('conta')"
                            />
                            <label v-if="errors.conta" class="label">
                                <span class="label-text-alt text-error">{{ errors.conta }}</span>
                            </label>
                        </div>

                        <!-- DV Conta -->
                        <div class="form-control">
                            <label class="label">
                                <span class="label-text">Dígito da Conta</span>
                                <span class="label-text-alt text-error">*</span>
                            </label>
                            <input
                                v-model="formData.conta_dv"
                                type="text"
                                placeholder="DV"
                                class="input input-bordered w-full"
                                :class="{ 'input-error': errors.conta_dv }"
                                maxlength="1"
                                @input="validateField('conta_dv')"
                            />
                            <label v-if="errors.conta_dv" class="label">
                                <span class="label-text-alt text-error">{{ errors.conta_dv }}</span>
                            </label>
                        </div>

                        <div class="divider col-span-1 md:col-span-2">Informações Adicionais</div>

                        <!-- Variação da Carteira -->
                        <div class="form-control">
                            <label class="label">
                                <span class="label-text">Variação de Carteira</span>
                            </label>
                            <input
                                v-model="formData.variacao_carteira"
                                type="text"
                                placeholder="Variação da carteira"
                                class="input input-bordered w-full"
                            />
                        </div>

                        <!-- Convênio -->
                        <div class="form-control">
                            <label class="label">
                                <span class="label-text">Convênio</span>
                            </label>
                            <input v-model="formData.convenio" type="text" placeholder="Número do convênio" class="input input-bordered w-full" />
                        </div>

                        <div class="divider col-span-1 md:col-span-2">Taxas e Descontos</div>

                        <!-- Multa -->
                        <div class="form-control">
                            <label class="label">
                                <span class="label-text">Multa (%)</span>
                            </label>
                            <label class="input-group">
                                <input
                                    v-model="formData.multa"
                                    type="number"
                                    min="0"
                                    step="0.01"
                                    placeholder="0.00"
                                    class="input input-bordered w-full"
                                />
                                <span>%</span>
                            </label>
                            <label class="label">
                                <span class="label-text-alt">Percentual de multa por atraso</span>
                            </label>
                        </div>

                        <!-- Juros -->
                        <div class="form-control">
                            <label class="label">
                                <span class="label-text">Juros (%)</span>
                            </label>
                            <label class="input-group">
                                <input
                                    v-model="formData.juros"
                                    type="number"
                                    min="0"
                                    step="0.01"
                                    placeholder="0.00"
                                    class="input input-bordered w-full"
                                />
                                <span>%</span>
                            </label>
                            <label class="label">
                                <span class="label-text-alt">Percentual de juros por atraso</span>
                            </label>
                        </div>

                        <!-- Desconto -->
                        <div class="form-control">
                            <label class="label">
                                <span class="label-text">Desconto (%)</span>
                            </label>
                            <label class="input-group">
                                <input
                                    v-model="formData.desconto"
                                    type="number"
                                    min="0"
                                    step="0.01"
                                    placeholder="0.00"
                                    class="input input-bordered w-full"
                                />
                                <span>%</span>
                            </label>
                            <label class="label">
                                <span class="label-text-alt">Percentual de desconto para pagamento adiantado</span>
                            </label>
                        </div>
                    </div>

                    <!-- Dicas de preenchimento -->
                    <div class="alert alert-info mt-6 shadow-lg">
                        <div>
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" class="h-6 w-6 flex-shrink-0 stroke-current">
                                <path
                                    stroke-linecap="round"
                                    stroke-linejoin="round"
                                    stroke-width="2"
                                    d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"
                                ></path>
                            </svg>
                            <div>
                                <span class="font-medium">Dica:</span> Os campos marcados com * são obrigatórios. Confira todos os dados antes de
                                salvar para garantir que estejam corretos.
                            </div>
                        </div>
                    </div>

                    <!-- Botões de ação -->
                    <div class="mt-8 flex flex-col justify-end gap-4 sm:flex-row">
                        <button type="button" class="btn btn-outline btn-error" @click="resetForm">Cancelar</button>
                        <button type="submit" class="btn btn-primary" :disabled="!isFormValid || isSubmitting">
                            <span v-if="isSubmitting" class="loading loading-spinner loading-sm mr-2"></span>
                            {{ isEditing ? 'Atualizar' : 'Salvar' }}
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Toast de sucesso -->
    <div v-if="showSuccessToast" class="toast toast-top toast-end">
        <div class="alert alert-success">
            <div>
                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 flex-shrink-0 stroke-current" fill="none" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                </svg>
                <span>{{ successMessage }}</span>
            </div>
        </div>
    </div>
</template>

<script setup>
import { computed, onMounted, ref, watch } from 'vue';

// Props para controlar se é edição ou criação
const props = defineProps({
    initialData: {
        type: Object,
        default: () => ({}),
    },
    isEditing: {
        type: Boolean,
        default: false,
    },
});

// Emits para eventos
const emit = defineEmits(['submit', 'cancel']);

// Estado do formulário
const formData = ref({
    descricao: '',
    conta: '',
    conta_dv: '',
    agencia: '',
    agencia_dv: '',
    variacao_carteira: '',
    convenio: '',
    multa: '',
    juros: '',
    desconto: '',
    ...props.initialData,
});

// Estado de validação
const errors = ref({});
const isSubmitting = ref(false);
const showSuccessToast = ref(false);
const successMessage = ref('');

// Campos obrigatórios para validação
const requiredFields = ['descricao', 'conta', 'conta_dv', 'agencia'];

// Calcula o progresso do preenchimento do formulário
const filledFieldsCount = computed(() => {
    return Object.entries(formData.value).filter(([key, value]) => value !== null && value !== undefined && value !== '').length;
});

const totalFields = computed(() => Object.keys(formData.value).length);

const progressPercentage = computed(() => {
    return Math.round((filledFieldsCount.value / totalFields.value) * 100);
});

// Valida se o formulário pode ser enviado
const isFormValid = computed(() => {
    // Verifica se todos os campos obrigatórios estão preenchidos
    return (
        requiredFields.every((field) => formData.value[field] !== null && formData.value[field] !== undefined && formData.value[field] !== '') &&
        Object.keys(errors.value).length === 0
    );
});

// Carrega dados iniciais se for edição
onMounted(() => {
    if (props.isEditing && props.initialData) {
        Object.keys(formData.value).forEach((key) => {
            if (props.initialData[key] !== undefined) {
                formData.value[key] = props.initialData[key];
            }
        });
    }
});

// Métodos
const validateField = (field) => {
    // Remove erro existente
    delete errors.value[field];

    // Verifica se é um campo obrigatório
    if (requiredFields.includes(field) && (!formData.value[field] || formData.value[field].trim() === '')) {
        errors.value[field] = 'Este campo é obrigatório';
        return false;
    }

    // Validações específicas
    if (field === 'agencia' && formData.value.agencia) {
        if (!/^\d+$/.test(formData.value.agencia)) {
            errors.value[field] = 'A agência deve conter apenas números';
            return false;
        }
    }

    if (field === 'agencia_dv' && formData.value.agencia_dv) {
        if (!/^[0-9X]$/.test(formData.value.agencia_dv.toUpperCase())) {
            errors.value[field] = 'O dígito deve ser um número ou X';
            return false;
        }
    }

    if (field === 'conta' && formData.value.conta) {
        if (!/^\d+$/.test(formData.value.conta)) {
            errors.value[field] = 'A conta deve conter apenas números';
            return false;
        }
    }

    if (field === 'conta_dv' && formData.value.conta_dv) {
        if (!/^[0-9X]$/.test(formData.value.conta_dv.toUpperCase())) {
            errors.value[field] = 'O dígito deve ser um número ou X';
            return false;
        }
    }

    return true;
};

const validateForm = () => {
    let isValid = true;

    // Valida todos os campos obrigatórios
    requiredFields.forEach((field) => {
        if (!validateField(field)) {
            isValid = false;
        }
    });

    // Valida também campos não obrigatórios que foram preenchidos
    Object.keys(formData.value).forEach((field) => {
        if (!requiredFields.includes(field) && formData.value[field]) {
            if (!validateField(field)) {
                isValid = false;
            }
        }
    });

    return isValid;
};

const handleSubmit = async () => {
    if (!validateForm()) {
        // Exibe mensagem de erro
        return;
    }

    try {
        isSubmitting.value = true;

        // Simula uma chamada de API
        await new Promise((resolve) => setTimeout(resolve, 1000));

        // Emite o evento com os dados do formulário
        emit('submit', { ...formData.value });

        // Exibe mensagem de sucesso
        successMessage.value = props.isEditing ? 'Dados bancários atualizados com sucesso!' : 'Dados bancários cadastrados com sucesso!';
        showSuccessToast.value = true;

        // Esconde a mensagem após alguns segundos
        setTimeout(() => {
            showSuccessToast.value = false;
        }, 5000);

        // Se não for edição, limpa o formulário
        if (!props.isEditing) {
            resetForm();
        }
    } catch (error) {
        console.error('Erro ao salvar dados:', error);
    } finally {
        isSubmitting.value = false;
    }
};

const resetForm = () => {
    // Reseta para valores iniciais ou limpa
    if (props.isEditing) {
        Object.keys(formData.value).forEach((key) => {
            if (props.initialData[key] !== undefined) {
                formData.value[key] = props.initialData[key];
            } else {
                formData.value[key] = '';
            }
        });
    } else {
        Object.keys(formData.value).forEach((key) => {
            formData.value[key] = '';
        });
    }

    // Limpa erros
    errors.value = {};

    // Emite evento de cancelamento
    emit('cancel');
};

// Observa mudanças nos campos para atualizar o progresso
watch(
    formData,
    () => {
        // Pode adicionar lógica adicional se necessário
    },
    { deep: true },
);
</script>
