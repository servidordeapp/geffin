<template>
    <Head title="Dashboard" />

    <AppLayout :breadcrumbs="breadcrumbs">
        <div class="bg-base-100 min-h-screen p-4">
            <div class="bg-base-200 mx-auto rounded-lg shadow-lg">
                <!-- Cabeçalho do formulário -->
                <div class="bg-primary text-primary-content rounded-t-lg p-4">
                    <h1 class="text-2xl font-bold">{{ isEditing ? 'Editar Cliente' : 'Cadastrar Novo Cliente' }}</h1>
                </div>

                <!-- Formulário principal -->
                <form @submit.prevent="submitForm" class="p-6">
                    <div class="grid grid-cols-1 gap-4 md:grid-cols-2">
                        <!-- Dados pessoais -->
                        <div class="form-control">
                            <label class="label" for="first_name">
                                <span class="label-text">Nome*</span>
                            </label>
                            <input
                                type="text"
                                id="first_name"
                                v-model="clientData.first_name"
                                class="input input-bordered w-full"
                                placeholder="Digite o nome"
                                required
                            />
                        </div>

                        <div class="form-control">
                            <label class="label" for="last_name">
                                <span class="label-text">Sobrenome*</span>
                            </label>
                            <input
                                type="text"
                                id="last_name"
                                v-model="clientData.last_name"
                                class="input input-bordered w-full"
                                placeholder="Digite o sobrenome"
                                required
                            />
                        </div>

                        <div class="form-control">
                            <label class="label" for="document_type">
                                <span class="label-text">Tipo de Documento*</span>
                            </label>
                            <select
                                id="document_type"
                                v-model="clientData.document_type"
                                class="select select-bordered w-full"
                                required
                                @change="formatDocument"
                            >
                                <option disabled selected value="">Selecione o tipo</option>
                                <option value="CPF">CPF</option>
                                <option value="CNPJ">CNPJ</option>
                            </select>
                        </div>

                        <div class="form-control">
                            <label class="label" for="document">
                                <span class="label-text">Documento*</span>
                            </label>
                            <input
                                type="text"
                                id="document"
                                v-model="clientData.document"
                                class="input input-bordered w-full"
                                :placeholder="clientData.document_type === 'CPF' ? '000.000.000-00' : '00.000.000/0000-00'"
                                required
                                @input="formatDocument"
                            />
                            <span v-if="documentError" class="text-error mt-1 text-sm">{{ documentError }}</span>
                        </div>

                        <div class="form-control">
                            <label class="label" for="email">
                                <span class="label-text">E-mail*</span>
                            </label>
                            <input
                                type="email"
                                id="email"
                                v-model="clientData.email"
                                class="input input-bordered w-full"
                                placeholder="exemplo@email.com"
                                required
                            />
                            <span v-if="emailError" class="text-error mt-1 text-sm">{{ emailError }}</span>
                        </div>

                        <div class="form-control">
                            <label class="label" for="phone">
                                <span class="label-text">Telefone*</span>
                            </label>
                            <input
                                type="tel"
                                id="phone"
                                v-model="clientData.phone"
                                class="input input-bordered w-full"
                                placeholder="(00) 00000-0000"
                                required
                                @input="formatPhone"
                            />
                        </div>
                    </div>

                    <!-- Seção de endereços -->
                    <div class="divider mt-8">Endereços</div>

                    <div v-if="clientData.addresses.length === 0" class="bg-base-300 rounded-lg py-6 text-center">
                        <span class="text-base-content opacity-70">Nenhum endereço cadastrado</span>
                    </div>

                    <div v-for="(address, index) in clientData.addresses" :key="index" class="bg-base-300 mb-4 rounded-lg p-4">
                        <div class="mb-4 flex items-center justify-between">
                            <h3 class="text-lg font-medium">Endereço {{ address.is_main ? 'Principal' : '#' + (index + 1) }}</h3>
                            <button type="button" class="btn btn-sm btn-error" @click="removeAddress(index)">Remover</button>
                        </div>

                        <div class="grid grid-cols-1 gap-4 md:grid-cols-2">
                            <div class="form-control">
                                <label class="label">
                                    <span class="label-text">CEP*</span>
                                </label>
                                <input
                                    type="text"
                                    v-model="address.cep"
                                    class="input input-bordered w-full"
                                    placeholder="00000-000"
                                    required
                                    @input="formatCep($event, index)"
                                    @blur="searchCep(index)"
                                />
                                <span v-if="address.cepLoading" class="text-info mt-1 text-sm">Buscando CEP...</span>
                                <span v-if="address.cepError" class="text-error mt-1 text-sm">{{ address.cepError }}</span>
                            </div>

                            <div class="form-control">
                                <label class="label">
                                    <span class="label-text">Tipo de Endereço</span>
                                </label>
                                <select v-model="address.type" class="select select-bordered w-full">
                                    <option value="residential">Residencial</option>
                                    <option value="commercial">Comercial</option>
                                    <option value="other">Outro</option>
                                </select>
                            </div>

                            <div class="form-control md:col-span-2">
                                <label class="label">
                                    <span class="label-text">Logradouro*</span>
                                </label>
                                <input
                                    type="text"
                                    v-model="address.street"
                                    class="input input-bordered w-full"
                                    placeholder="Rua, Avenida, etc."
                                    required
                                />
                            </div>

                            <div class="form-control">
                                <label class="label">
                                    <span class="label-text">Número*</span>
                                </label>
                                <input type="text" v-model="address.number" class="input input-bordered w-full" placeholder="Ex: 123" required />
                            </div>

                            <div class="form-control">
                                <label class="label">
                                    <span class="label-text">Complemento</span>
                                </label>
                                <input type="text" v-model="address.complement" class="input input-bordered w-full" placeholder="Apto, Sala, etc." />
                            </div>

                            <div class="form-control">
                                <label class="label">
                                    <span class="label-text">Bairro*</span>
                                </label>
                                <input type="text" v-model="address.neighborhood" class="input input-bordered w-full" placeholder="Bairro" required />
                            </div>

                            <div class="form-control">
                                <label class="label">
                                    <span class="label-text">Cidade*</span>
                                </label>
                                <input type="text" v-model="address.city" class="input input-bordered w-full" placeholder="Cidade" required />
                            </div>

                            <div class="form-control">
                                <label class="label">
                                    <span class="label-text">Estado*</span>
                                </label>
                                <select v-model="address.state" class="select select-bordered w-full" required>
                                    <option disabled selected value="">Selecione o estado</option>
                                    <option v-for="state in brazilianStates" :key="state.value" :value="state.value">
                                        {{ state.label }}
                                    </option>
                                </select>
                            </div>

                            <div class="form-control">
                                <label class="label">
                                    <span class="label-text">É o endereço principal?</span>
                                </label>
                                <div class="form-control">
                                    <label class="label cursor-pointer justify-start gap-2">
                                        <input
                                            type="checkbox"
                                            class="checkbox checkbox-primary"
                                            v-model="address.is_main"
                                            @change="updateMainAddress(index)"
                                        />
                                        <span class="label-text">Sim</span>
                                    </label>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="mt-4">
                        <button type="button" class="btn btn-outline btn-primary" @click="addNewAddress">
                            <span class="mr-1">+</span> Adicionar Endereço
                        </button>
                    </div>

                    <!-- Botões de ação -->
                    <div class="mt-8 flex flex-col justify-end gap-2 sm:flex-row">
                        <button type="button" class="btn btn-outline" @click="resetForm">Cancelar</button>
                        <button type="submit" class="btn btn-primary" :disabled="isSubmitting">
                            <span v-if="isSubmitting" class="loading loading-spinner loading-xs mr-2"></span>
                            {{ isEditing ? 'Salvar Alterações' : 'Cadastrar Cliente' }}
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </AppLayout>
</template>

<script setup lang="ts">
import AppLayout from '@/layouts/AppLayout.vue';
import { type BreadcrumbItem } from '@/types';
import { Head, router } from '@inertiajs/vue3';
import { reactive, ref } from 'vue';
import { useToast } from 'vue-toastification';

const toast = useToast();

// Propriedades
const props = defineProps({
    initialData: {
        type: Object,
        default: () => null,
    },
    isEditing: {
        type: Boolean,
        default: false,
    },
});

const breadcrumbs: BreadcrumbItem[] = [
    {
        title: 'Início',
        href: route('dashboard'),
    },
    {
        title: 'Clientes',
        href: route('clients.index'),
    },
    {
        title: props.isEditing ? 'Editar Cliente' : 'Criar Cliente',
        href: route('clients.index'),
    },
];
// Emits
const emit = defineEmits(['cancel']);

// Estado local
const isSubmitting = ref(false);
const documentError = ref('');
const emailError = ref('');

// Lista de estados brasileiros
const brazilianStates = [
    { value: 'AC', label: 'Acre' },
    { value: 'AL', label: 'Alagoas' },
    { value: 'AP', label: 'Amapá' },
    { value: 'AM', label: 'Amazonas' },
    { value: 'BA', label: 'Bahia' },
    { value: 'CE', label: 'Ceará' },
    { value: 'DF', label: 'Distrito Federal' },
    { value: 'ES', label: 'Espírito Santo' },
    { value: 'GO', label: 'Goiás' },
    { value: 'MA', label: 'Maranhão' },
    { value: 'MT', label: 'Mato Grosso' },
    { value: 'MS', label: 'Mato Grosso do Sul' },
    { value: 'MG', label: 'Minas Gerais' },
    { value: 'PA', label: 'Pará' },
    { value: 'PB', label: 'Paraíba' },
    { value: 'PR', label: 'Paraná' },
    { value: 'PE', label: 'Pernambuco' },
    { value: 'PI', label: 'Piauí' },
    { value: 'RJ', label: 'Rio de Janeiro' },
    { value: 'RN', label: 'Rio Grande do Norte' },
    { value: 'RS', label: 'Rio Grande do Sul' },
    { value: 'RO', label: 'Rondônia' },
    { value: 'RR', label: 'Roraima' },
    { value: 'SC', label: 'Santa Catarina' },
    { value: 'SP', label: 'São Paulo' },
    { value: 'SE', label: 'Sergipe' },
    { value: 'TO', label: 'Tocantins' },
];

// Dados do cliente
const clientData = reactive({
    id: '',
    first_name: '',
    last_name: '',
    document_type: '',
    document: '',
    email: '',
    phone: '',
    addresses: [
        {
            cep: '',
            street: '',
            number: '',
            complement: '',
            neighborhood: '',
            city: '',
            state: '',
            type: 'residential',
            is_main: true, // Primeiro endereço é principal por padrão
            cepLoading: false,
            cepError: '',
        },
    ],
});

// Carregar dados iniciais se estiver editando
if (props.initialData && props.isEditing) {
    Object.assign(clientData, props.initialData);

    // Garantir que addresses seja sempre um array
    if (!Array.isArray(clientData.addresses)) {
        clientData.addresses = [];
    }
}

// Adicionar novo endereço
function addNewAddress() {
    clientData.addresses.push({
        cep: '',
        street: '',
        number: '',
        complement: '',
        neighborhood: '',
        city: '',
        state: '',
        type: 'residential',
        is_main: clientData.addresses.length === 0,
        cepLoading: false,
        cepError: '',
    });
}

// Remover endereço
function removeAddress(index: number) {
    const wasMain = clientData.addresses[index].is_main;
    clientData.addresses.splice(index, 1);

    // Se removeu o endereço principal e ainda existem endereços, tornar o primeiro como principal
    if (wasMain && clientData.addresses.length > 0) {
        clientData.addresses[0].is_main = true;
    }
}

// Buscar CEP
async function searchCep(index: number) {
    const address = clientData.addresses[index];
    const cep = address.cep.replace(/\D/g, '');

    if (cep.length !== 8) return;

    address.cepLoading = true;
    address.cepError = '';

    try {
        const response = await fetch(`https://viacep.com.br/ws/${cep}/json/`);
        const data = await response.json();

        if (data.erro) {
            address.cepError = 'CEP não encontrado';
        } else {
            address.street = data.logradouro;
            address.neighborhood = data.bairro;
            address.city = data.localidade;
            address.state = data.uf;
        }
        // eslint-disable-next-line @typescript-eslint/no-unused-vars
    } catch (error) {
        address.cepError = 'Erro ao buscar CEP. Tente novamente.';
    } finally {
        address.cepLoading = false;
    }
}

// Atualizar endereço principal
function updateMainAddress(index: number) {
    if (clientData.addresses[index].is_main) {
        // Desmarcar todos os outros endereços como principal
        clientData.addresses.forEach((address, i) => {
            if (i !== index) address.is_main = false;
        });
    }
}

// Formatar CEP
function formatCep(event: any, index: number) {
    let value = event.target.value.replace(/\D/g, '');

    if (value.length > 8) {
        value = value.substring(0, 8);
    }

    if (value.length > 5) {
        value = value.substring(0, 5) + '-' + value.substring(5);
    }

    clientData.addresses[index].cep = value;
}

// Formatar documento (CPF/CNPJ)
function formatDocument() {
    documentError.value = '';
    let value = clientData.document.replace(/\D/g, '');

    if (clientData.document_type === 'CPF') {
        if (value.length > 11) {
            value = value.substring(0, 11);
        }

        if (value.length > 9) {
            value = value.substring(0, 3) + '.' + value.substring(3, 6) + '.' + value.substring(6, 9) + '-' + value.substring(9);
        } else if (value.length > 6) {
            value = value.substring(0, 3) + '.' + value.substring(3, 6) + '.' + value.substring(6);
        } else if (value.length > 3) {
            value = value.substring(0, 3) + '.' + value.substring(3);
        }
    } else if (clientData.document_type === 'CNPJ') {
        if (value.length > 14) {
            value = value.substring(0, 14);
        }

        if (value.length > 12) {
            value =
                value.substring(0, 2) +
                '.' +
                value.substring(2, 5) +
                '.' +
                value.substring(5, 8) +
                '/' +
                value.substring(8, 12) +
                '-' +
                value.substring(12);
        } else if (value.length > 8) {
            value = value.substring(0, 2) + '.' + value.substring(2, 5) + '.' + value.substring(5, 8) + '/' + value.substring(8);
        } else if (value.length > 5) {
            value = value.substring(0, 2) + '.' + value.substring(2, 5) + '.' + value.substring(5);
        } else if (value.length > 2) {
            value = value.substring(0, 2) + '.' + value.substring(2);
        }
    }

    clientData.document = value;
}

// Formatar telefone
function formatPhone() {
    let value = clientData.phone.replace(/\D/g, '');

    if (value.length > 11) {
        value = value.substring(0, 11);
    }

    if (value.length > 10) {
        value = '(' + value.substring(0, 2) + ') ' + value.substring(2, 7) + '-' + value.substring(7);
    } else if (value.length > 6) {
        value = '(' + value.substring(0, 2) + ') ' + value.substring(2, 6) + '-' + value.substring(6);
    } else if (value.length > 2) {
        value = '(' + value.substring(0, 2) + ') ' + value.substring(2);
    }

    clientData.phone = value;
}

// Validar e-mail
function validateEmail() {
    const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
    if (!emailRegex.test(clientData.email)) {
        emailError.value = 'E-mail inválido';
        return false;
    }
    emailError.value = '';
    return true;
}

// Validar documento
function validateDocument() {
    const value = clientData.document.replace(/\D/g, '');

    if (clientData.document_type === 'CPF') {
        if (value.length !== 11) {
            documentError.value = 'CPF deve conter 11 dígitos';
            return false;
        }
    } else if (clientData.document_type === 'CNPJ') {
        if (value.length !== 14) {
            documentError.value = 'CNPJ deve conter 14 dígitos';
            return false;
        }
    }

    documentError.value = '';
    return true;
}

// Enviar formulário
async function submitForm() {
    if (!validateEmail() || !validateDocument()) {
        return;
    }

    try {
        isSubmitting.value = true;

        // Clonar os dados antes de enviar para limpar campos temporários
        const formData = JSON.parse(JSON.stringify(clientData));

        // Remover campos de UI dos endereços
        formData.addresses = formData.addresses.map((address: any) => {
            // eslint-disable-next-line @typescript-eslint/no-unused-vars
            const { cepLoading, cepError, ...cleanAddress } = address;
            return cleanAddress;
        });

        // // Enviar dados
        if (props.isEditing) {
            router.put(route('clients.update', props.initialData.id), formData, {
                preserveScroll: true,
                preserveState: true,
                onSuccess: () => {
                    toast.success('Cliente atualizado com sucesso!');
                },
                onError: (error: any) => {
                    for (const key in error) {
                        toast.error(error[key]);
                    }
                },
            });
        } else {
            router.post(route('clients.store'), formData, {
                preserveScroll: true,
                preserveState: true,
                onSuccess: () => {
                    toast.success('Cliente criado com sucesso!');
                },
                onError: (error: any) => {
                    for (const key in error) {
                        toast.error(error[key]);
                    }
                },
            });
        }
        // Se não estiver editando, resetar o formulário
        if (!props.isEditing) {
            resetForm();
        }
    } catch (error) {
        console.error('Erro ao enviar formulário:', error);
    } finally {
        isSubmitting.value = false;
    }
}

// Resetar formulário
function resetForm() {
    if (props.isEditing && props.initialData) {
        // Restaurar dados iniciais
        Object.assign(clientData, props.initialData);
    } else {
        // Limpar dados
        clientData.first_name = '';
        clientData.last_name = '';
        clientData.document_type = '';
        clientData.document = '';
        clientData.email = '';
        clientData.phone = '';
        clientData.addresses = [];
    }

    documentError.value = '';
    emailError.value = '';
    emit('cancel');
}
</script>
