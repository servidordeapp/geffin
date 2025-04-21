<template>
    <div class="w-full p-4 lg:p-6">
        <div class="flex flex-col gap-4 lg:gap-6">
            <!-- Cabeçalho redesenhado -->
            <div class="bg-base-100 rounded-box shadow-sm p-4 lg:p-6">
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-[1fr_auto] gap-4 items-center">
                    <div class="space-y-1">
                        <h1 class="text-2xl font-bold text-base-content">
                            Detalhes da Parcela
                        </h1>
                        <div class="flex flex-wrap items-center gap-2 text-sm">
                            <div class="flex items-center gap-2">
                                <span class="font-medium">Valor:</span>
                                <span class="text-success">{{ formatCurrency(parcelaInfo.valor) }}</span>
                            </div>
                            <div class="flex items-center gap-2">
                                <span class="font-medium">Vencimento:</span>
                                <span class="text-info">{{ formatDate(parcelaInfo.data_vencimento) }}</span>
                            </div>
                            <div class="badge badge-lg border-0" :class="getStatusBadgeClass(parcelaInfo.status)">
                                {{ parcelaInfo.status }}
                            </div>
                        </div>
                    </div>

                    <div class="flex flex-col gap-2 min-w-[200px]">
                        <label class="text-sm font-medium opacity-75">Filtrar eventos:</label>
                        <select
                            v-model="filtroEvento"
                            class="select select-bordered select-sm w-full focus:ring-2"
                        >
                            <option value="">Todos os eventos</option>
                            <option value="created">Criação</option>
                            <option value="updated">Atualização</option>
                            <option value="payment">Pagamento</option>
                            <option value="canceled">Cancelamento</option>
                        </select>
                    </div>
                </div>
            </div>

            <!-- Timeline redesenhada -->
            <div class="bg-base-100 rounded-box shadow-sm p-4 lg:p-6">
                <div v-if="historico.length === 0" class="alert alert-info shadow-lg">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                    </svg>
                    <span>Nenhum histórico encontrado para esta parcela.</span>
                </div>

                <ul v-else class="timeline timeline-vertical lg:timeline-horizontal">
                    <li
                        v-for="(item, index) in historicoFiltrado"
                        :key="item.id"
                        class="timeline-item mb-8 lg:mb-0 lg:flex-1"
                    >
                        <!-- Linha do tempo -->
                        <div class="timeline-start mr-4 lg:mr-0 lg:mb-4">
                            <div class="text-xs font-semibold opacity-75">{{ formatDate(item.created_at) }}</div>
                            <div class="text-[0.7rem] opacity-50">{{ formatTime(item.created_at) }}</div>
                        </div>

                        <div class="timeline-middle">
                            <div
                                class="w-6 h-6 rounded-full flex items-center justify-center"
                                :class="getEventBadgeClass(item.event)"
                            >
                                <span class="text-white text-xs">
                                    {{ getEventTitle(item.event)[0] }}
                                </span>
                            </div>
                        </div>

                        <!-- Card do evento -->
                        <div class="timeline-end ml-4 lg:ml-0 lg:mt-4">
                            <div class="card card-compact bg-base-100 shadow-md hover:shadow-lg transition-shadow">
                                <div class="card-body p-4">
                                    <div class="flex justify-between items-start">
                                        <h3 class="card-title text-sm mb-2">
                                            {{ getEventTitle(item.event) }}
                                        </h3>
                                        <div class="tooltip" :data-tip="getUsuarioInfo(item)">
                                            <div class="avatar placeholder">
                                                <div class="bg-neutral text-neutral-content rounded-full w-8 h-8">
                                                    <span class="text-xs">{{ getUsuarioIniciais(item) }}</span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <!-- Detalhes das alterações -->
                                    <div v-if="hasChanges(item)" class="space-y-3">
                                        <button
                                            @click="toggleDetalhes(index)"
                                            class="btn btn-xs btn-ghost w-full justify-between px-2"
                                        >
                                            <span class="text-xs">
                                                {{ detalhesAbertos.includes(index) ? 'Ocultar detalhes' : 'Ver alterações' }}
                                            </span>
                                            <svg
                                                class="w-3 h-3 transform transition-transform duration-200"
                                                :class="detalhesAbertos.includes(index) ? 'rotate-180' : ''"
                                                viewBox="0 0 24 24"
                                            >
                                                <path fill="currentColor" d="M7.41 8.59L12 13.17l4.59-4.58L18 10l-6 6-6-6 1.41-1.41z"/>
                                            </svg>
                                        </button>

                                        <div v-if="detalhesAbertos.includes(index)" class="space-y-3">
                                            <div
                                                v-for="(alteracao, campo) in getChanges(item)"
                                                :key="campo"
                                                class="bg-base-200 rounded-box p-3"
                                            >
                                                <div class="text-xs font-medium opacity-75 mb-1">
                                                    {{ formatFieldName(campo) }}
                                                </div>
                                                <div class="grid grid-cols-2 gap-2 text-sm">
                                                    <div class="text-error flex flex-col">
                                                        <span class="text-xs opacity-75">Antes:</span>
                                                        <span class="truncate">
                                                            {{ formatFieldValue(campo, alteracao.old) || '-' }}
                                                        </span>
                                                    </div>
                                                    <div class="text-success flex flex-col">
                                                        <span class="text-xs opacity-75">Depois:</span>
                                                        <span class="truncate">
                                                            {{ formatFieldValue(campo, alteracao.new) || '-' }}
                                                        </span>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <!-- Metadados -->
                                    <div class="mt-3 pt-2 border-t border-base-200">
                                        <div class="flex flex-wrap items-center gap-2 text-xs opacity-60">
                                            <div class="flex items-center gap-1">
                                                <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 18h.01M8 21h8a2 2 0 002-2V5a2 2 0 00-2-2H8a2 2 0 00-2 2v14a2 2 0 002 2z"/>
                                                </svg>
                                                <span>{{ item.ip_address }}</span>
                                            </div>
                                            <div v-if="item.tags" class="flex flex-wrap gap-1">
                                                <div
                                                    v-for="tag in item.tags.split(',')"
                                                    :key="tag"
                                                    class="badge badge-outline badge-xs"
                                                >
                                                    {{ tag.trim() }}
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </li>
                </ul>
            </div>
        </div>
    </div>
</template>

<script setup>
import { computed, onMounted, ref } from 'vue';

// Props para receber os dados da parcela e histórico
const props = defineProps({
    parcelaId: {
        type: [Number, String],
        required: true,
    },
    clienteId: {
        type: [Number, String],
        required: true,
    },
    historicoData: {
        type: Array,
        default: () => [],
    },
});

// Estados
const filtroEvento = ref('');
const detalhesAbertos = ref([]);
const usuarios = ref({});

// Dados de exemplo para a parcela
const parcelaInfo = ref({
    id: props.parcelaId || 123,
    cliente_id: props.clienteId || 456,
    valor: 1250.75,
    status: 'pendente',
    data_vencimento: '2025-05-15',
    data_pagamento: null,
    created_at: '2025-03-10T14:30:00',
});

// Dados de exemplo para o histórico (usar props.historicoData em produção)
const historico = ref([
    {
        id: 1,
        user_type: 'admin',
        user_id: 101,
        event: 'created',
        auditable_type: 'App\\Models\\Parcela',
        auditable_id: 123,
        old_values: '{}',
        new_values: '{"valor": "1250.75", "status": "pendente", "data_vencimento": "2025-05-15", "cliente_id": "456"}',
        url: '/financeiro/parcelas/criar',
        ip_address: '192.168.1.10',
        user_agent: 'Mozilla/5.0',
        tags: 'criação,parcela',
        created_at: '2025-03-10T14:30:00',
        updated_at: '2025-03-10T14:30:00',
    },
    {
        id: 2,
        user_type: 'admin',
        user_id: 102,
        event: 'updated',
        auditable_type: 'App\\Models\\Parcela',
        auditable_id: 123,
        old_values: '{"valor": "1250.75"}',
        new_values: '{"valor": "1150.50"}',
        url: '/financeiro/parcelas/123/editar',
        ip_address: '192.168.1.11',
        user_agent: 'Mozilla/5.0',
        tags: 'atualização,valor,desconto',
        created_at: '2025-03-15T10:15:00',
        updated_at: '2025-03-15T10:15:00',
    },
    {
        id: 3,
        user_type: 'user',
        user_id: 201,
        event: 'updated',
        auditable_type: 'App\\Models\\Parcela',
        auditable_id: 123,
        old_values: '{"observacao": null}',
        new_values:
            '{"observacao": "Cliente solicitou extensão do prazo de pagamento devido a problemas financeiros temporários. Foi acordado um prazo adicional de 15 dias sem acréscimo de juros."}',
        url: '/financeiro/parcelas/123/editar',
        ip_address: '192.168.1.25',
        user_agent: 'Mozilla/5.0',
        tags: 'atualização,observação',
        created_at: '2025-04-01T16:45:00',
        updated_at: '2025-04-01T16:45:00',
    },
    {
        id: 4,
        user_type: 'admin',
        user_id: 101,
        event: 'updated',
        auditable_type: 'App\\Models\\Parcela',
        auditable_id: 123,
        old_values: '{"data_vencimento": "2025-05-15"}',
        new_values: '{"data_vencimento": "2025-06-01"}',
        url: '/financeiro/parcelas/123/editar',
        ip_address: '192.168.1.10',
        user_agent: 'Mozilla/5.0',
        tags: 'atualização,vencimento,prorrogação',
        created_at: '2025-04-05T09:20:00',
        updated_at: '2025-04-05T09:20:00',
    },
    {
        id: 5,
        user_type: 'user',
        user_id: 202,
        event: 'payment',
        auditable_type: 'App\\Models\\Parcela',
        auditable_id: 123,
        old_values: '{"status": "pendente", "data_pagamento": null}',
        new_values: '{"status": "pago", "data_pagamento": "2025-04-10"}',
        url: '/financeiro/parcelas/123/pagamento',
        ip_address: '192.168.1.30',
        user_agent: 'Mozilla/5.0',
        tags: 'pagamento,confirmação',
        created_at: '2025-04-10T11:05:00',
        updated_at: '2025-04-10T11:05:00',
    },
]);

// Usuários de exemplo (em produção, carregue do banco de dados)
const usuariosExemplo = ref({
    101: { nome: 'Ana Silva', tipo: 'admin', cargo: 'Gerente Financeiro' },
    102: { nome: 'Roberto Almeida', tipo: 'admin', cargo: 'Analista Financeiro' },
    201: { nome: 'Carla Oliveira', tipo: 'user', cargo: 'Atendente' },
    202: { nome: 'Diego Santos', tipo: 'user', cargo: 'Caixa' },
});

// Histórico filtrado
const historicoFiltrado = computed(() => {
    let dados = props.historicoData.length ? props.historicoData : historico.value;

    if (filtroEvento.value) {
        dados = dados.filter((item) => item.event === filtroEvento.value);
    }

    // Ordenar do mais recente para o mais antigo
    return [...dados].sort((a, b) => new Date(b.created_at).getTime() - new Date(a.created_at).getTime());
});

// Métodos
const toggleDetalhes = (index) => {
    const posicao = detalhesAbertos.value.indexOf(index);
    if (posicao === -1) {
        detalhesAbertos.value.push(index);
    } else {
        detalhesAbertos.value.splice(posicao, 1);
    }
};

const formatDate = (dateString) => {
    if (!dateString) return '-';
    const date = new Date(dateString);
    return date.toLocaleDateString('pt-BR');
};

const formatTime = (dateString) => {
    if (!dateString) return '';
    const date = new Date(dateString);
    return date.toLocaleTimeString('pt-BR', { hour: '2-digit', minute: '2-digit' });
};

const formatCurrency = (value) => {
    if (value === null || value === undefined) return '-';
    return new Intl.NumberFormat('pt-BR', {
        style: 'currency',
        currency: 'BRL',
    }).format(value);
};

const getEventTitle = (event) => {
    const titles = {
        created: 'Criação da Parcela',
        updated: 'Atualização de Dados',
        payment: 'Pagamento Registrado',
        canceled: 'Cancelamento',
        default: 'Evento da Parcela',
    };

    return titles[event] || titles.default;
};

const getEventBadgeClass = (event) => {
    const classes = {
        created: 'badge-success',
        updated: 'badge-info',
        payment: 'badge-primary',
        canceled: 'badge-error',
        default: 'badge-neutral',
    };

    return classes[event] || classes.default;
};

const getStatusBadgeClass = (status) => {
    const classes = {
        pendente: 'badge-warning',
        pago: 'badge-success',
        atrasado: 'badge-error',
        cancelado: 'badge-neutral',
        default: 'badge-info',
    };

    return classes[status] || classes.default;
};

const getUsuarioIniciais = (item) => {
    const userInfo = usuariosExemplo.value[item.user_id];
    if (userInfo) {
        return userInfo.nome
            .split(' ')
            .map((parte) => parte[0])
            .join('')
            .substring(0, 2)
            .toUpperCase();
    }
    return item.user_type === 'admin' ? 'AD' : 'US';
};

const getUsuarioInfo = (item) => {
    const userInfo = usuariosExemplo.value[item.user_id];
    if (userInfo) {
        return `${userInfo.nome} (${userInfo.cargo})`;
    }
    return item.user_type === 'admin' ? 'Administrador' : 'Usuário';
};

const hasChanges = (item) => {
    const oldValues = JSON.parse(typeof item.old_values === 'string' ? item.old_values : '{}');
    const newValues = JSON.parse(typeof item.new_values === 'string' ? item.new_values : '{}');

    return Object.keys(oldValues).length > 0 || Object.keys(newValues).length > 0;
};

const getChanges = (item) => {
    const oldValues = JSON.parse(typeof item.old_values === 'string' ? item.old_values : '{}');
    const newValues = JSON.parse(typeof item.new_values === 'string' ? item.new_values : '{}');

    // Combinar todas as chaves de ambos os objetos
    const allKeys = [...new Set([...Object.keys(oldValues), ...Object.keys(newValues)])];

    const changes = {};
    allKeys.forEach((key) => {
        changes[key] = {
            old: oldValues[key],
            new: newValues[key],
        };
    });

    return changes;
};

const formatFieldName = (field) => {
    const fieldMappings = {
        valor: 'Valor',
        status: 'Status',
        data_vencimento: 'Data de Vencimento',
        data_pagamento: 'Data de Pagamento',
        observacao: 'Observação',
        cliente_id: 'Cliente',
        desconto: 'Desconto Aplicado',
        juros: 'Juros Aplicados',
    };

    return fieldMappings[field] || field.replace(/_/g, ' ').replace(/\b\w/g, (l) => l.toUpperCase());
};

const formatFieldValue = (field, value) => {
    if (value === null || value === undefined) {
        return null;
    }

    if (field === 'valor' || field === 'desconto' || field === 'juros') {
        return formatCurrency(value);
    }

    if (field === 'data_vencimento' || field === 'data_pagamento') {
        return formatDate(value);
    }

    if (field === 'status') {
        const statusMap = {
            pendente: 'Pendente',
            pago: 'Pago',
            atrasado: 'Atrasado',
            cancelado: 'Cancelado',
        };
        return statusMap[value] || value;
    }

    return value;
};

// Lifecycle
onMounted(() => {
    // Aqui você poderia carregar os dados reais da API
    // exemplo: carregarHistoricoParcela(props.parcelaId)
});
</script>

<style scoped>
/* Garante que textos grandes são exibidos corretamente */
.break-words {
    word-wrap: break-word;
    word-break: break-word;
}

/* Ajustes para responsividade */
@media (max-width: 768px) {
    .timeline-start {
        text-align: left;
        min-width: 100px;
    }
}

/* Altura máxima para garantir que cabe no drawer */
.overflow-y-auto {
    max-height: calc(100vh - 200px);
}
</style>
