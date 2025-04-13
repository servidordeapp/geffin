<!-- eslint-disable vue/block-lang -->
<script>
import { computed, ref } from 'vue';

export default {
    setup() {
        // Valores de entrada com valores iniciais
        const valorMedioCobranças = ref(400);
        const quantidadeCobranças = ref(300);
        const taxaInadimplenciaAtual = ref(8);
        const horasMensaisGestao = ref(40);

        // Constantes para cálculos
        const custoPorHora = ref(80); // Custo médio hora de trabalho
        const reducaoInadimplenciaEstimada = ref(30); // Redução percentual da inadimplência com o Geffin
        const percentualHorasEconomizadas = ref(75); // Percentual de horas economizadas com automação

        // Cálculos de economia
        const volumeTotalCobrancas = computed(() => {
            return valorMedioCobranças.value * quantidadeCobranças.value;
        });

        const valorInadimplenciaAtual = computed(() => {
            return volumeTotalCobrancas.value * (taxaInadimplenciaAtual.value / 100);
        });

        const reducaoInadimplencia = computed(() => {
            return valorInadimplenciaAtual.value * (reducaoInadimplenciaEstimada.value / 100);
        });

        const horasEconomizadas = computed(() => {
            return horasMensaisGestao.value * (percentualHorasEconomizadas.value / 100);
        });

        const economiaAutomatizacao = computed(() => {
            return horasEconomizadas.value * custoPorHora.value;
        });

        const economiaTotal = computed(() => {
            return reducaoInadimplencia.value + economiaAutomatizacao.value;
        });

        // Funções para formatação
        const formatarMoeda = (valor) => {
            return new Intl.NumberFormat('pt-BR', {
                style: 'currency',
                currency: 'BRL',
                minimumFractionDigits: 2,
            }).format(valor);
        };

        // Função para atualizar valores quando os inputs mudarem
        const atualizarCalculos = () => {
            // Todos os cálculos são reativos através dos computed, então não é necessário fazer nada aqui
        };

        // Retorne os valores e funções que serão utilizados no template
        return {
            // Valores de entrada
            valorMedioCobranças,
            quantidadeCobranças,
            taxaInadimplenciaAtual,
            horasMensaisGestao,

            // Valores calculados
            reducaoInadimplencia,
            economiaAutomatizacao,
            horasEconomizadas,
            economiaTotal,

            // Funções
            formatarMoeda,
            atualizarCalculos,
        };
    },
};
</script>

<template>
    <!-- Calculadora de ROI -->
    <section class="bg-gray-50 py-16">
        <div class="container mx-auto px-4">
            <div class="mx-auto max-w-4xl">
                <div class="mb-12 text-center">
                    <h2 class="mb-4 text-3xl font-bold text-gray-800">Calcule sua economia com o Geffin</h2>
                    <p class="text-gray-600">Veja quanto sua empresa pode economizar mensalmente usando nossa plataforma.</p>
                </div>

                <div class="rounded-xl bg-white p-8 shadow-md">
                    <div class="grid grid-cols-1 gap-8 md:grid-cols-2">
                        <div>
                            <h3 class="mb-6 text-xl font-semibold text-gray-800">Informações da sua empresa</h3>

                            <div class="space-y-6">
                                <div>
                                    <label class="mb-2 block font-medium text-gray-700">Valor médio das cobranças mensais (R$)</label>
                                    <input
                                        type="number"
                                        v-model="valorMedioCobranças"
                                        class="w-full rounded-lg border border-gray-300 px-4 py-2 focus:outline-none focus:ring-2 focus:ring-primary"
                                        placeholder="Ex: 50000"
                                    />
                                </div>

                                <div>
                                    <label class="mb-2 block font-medium text-gray-700">Quantidade de cobranças mensais</label>
                                    <input
                                        type="number"
                                        v-model="quantidadeCobranças"
                                        class="w-full rounded-lg border border-gray-300 px-4 py-2 focus:outline-none focus:ring-2 focus:ring-primary"
                                        placeholder="Ex: 100"
                                    />
                                </div>

                                <div>
                                    <label class="mb-2 block font-medium text-gray-700">Taxa de inadimplência atual (%)</label>
                                    <input
                                        type="number"
                                        v-model="taxaInadimplenciaAtual"
                                        class="w-full rounded-lg border border-gray-300 px-4 py-2 focus:outline-none focus:ring-2 focus:ring-primary"
                                        placeholder="Ex: 5"
                                    />
                                </div>

                                <div>
                                    <label class="mb-2 block font-medium text-gray-700">Horas mensais dedicadas à gestão de cobranças</label>
                                    <input
                                        type="number"
                                        v-model="horasMensaisGestao"
                                        class="w-full rounded-lg border border-gray-300 px-4 py-2 focus:outline-none focus:ring-2 focus:ring-primary"
                                        placeholder="Ex: 40"
                                    />
                                </div>
                            </div>
                        </div>

                        <div class="rounded-lg bg-gray-50 p-6">
                            <h3 class="mb-6 text-xl font-semibold text-gray-800">Sua economia estimada</h3>

                            <div class="space-y-6">
                                <div>
                                    <p class="mb-1 text-gray-600">Redução de inadimplência</p>
                                    <p class="text-2xl font-bold text-primary">{{ formatarMoeda(reducaoInadimplencia) }}/mês</p>
                                </div>

                                <div>
                                    <p class="mb-1 text-gray-600">Economia com automatização</p>
                                    <p class="text-2xl font-bold text-primary">{{ formatarMoeda(economiaAutomatizacao) }}/mês</p>
                                </div>

                                <div>
                                    <p class="mb-1 text-gray-600">Tempo economizado</p>
                                    <p class="text-2xl font-bold text-primary">{{ horasEconomizadas }} horas/mês</p>
                                </div>

                                <div class="border-t border-gray-200 pt-4">
                                    <p class="mb-1 font-semibold text-gray-700">Economia total estimada</p>
                                    <p class="text-3xl font-bold text-secondary">{{ formatarMoeda(economiaTotal) }}/mês</p>
                                </div>
                            </div>

                            <div class="mt-8">
                                <a
                                    href="#contato"
                                    class="block w-full rounded-lg bg-primary px-6 py-3 text-center font-bold text-white transition hover:bg-blue-700"
                                >
                                    Comece a economizar agora
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</template>

<style scoped>
.read-the-docs {
    color: #888;
}
</style>
