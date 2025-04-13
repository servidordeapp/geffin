<!-- eslint-disable vue/block-lang -->
<script setup></script>

<template>
    <!-- Preços Section -->
    <section id="precos" class="py-16">
        <div class="container mx-auto px-4">
            <div class="mb-16 text-center">
                <h2 class="mb-4 text-3xl font-bold text-gray-800">Planos Acessíveis para Empresas de Todos os Portes</h2>
                <p class="mx-auto max-w-2xl text-gray-600">
                    Escolha o plano ideal para o seu negócio e comece a transformar sua gestão financeira hoje.
                </p>
            </div>

            <div class="mx-auto flex max-w-5xl flex-col space-y-8 lg:flex-row lg:space-x-8 lg:space-y-0">
                <!-- Plano Básico -->
                <div class="hover-grow flex flex-col rounded-xl bg-white p-8 shadow-md lg:w-1/3">
                    <h3 class="mb-4 text-xl font-bold text-gray-800">Básico</h3>
                    <div class="mb-6 flex items-baseline">
                        <span class="text-4xl font-bold text-gray-800">R$ 99</span>
                        <span class="ml-2 text-gray-500">/mês</span>
                    </div>
                    <div class="mb-6 rounded-lg bg-gray-50 p-4">
                        <ul class="space-y-3">
                            <li class="flex items-start">
                                <i class="fas fa-check mr-2 mt-1 text-green-500"></i>
                                <span>Até 100 cobranças/mês</span>
                            </li>
                            <li class="flex items-start">
                                <i class="fas fa-check mr-2 mt-1 text-green-500"></i>
                                <span>Relatórios básicos</span>
                            </li>
                            <li class="flex items-start">
                                <i class="fas fa-check mr-2 mt-1 text-green-500"></i>
                                <span>Integração com 1 banco</span>
                            </li>
                            <li class="flex items-start">
                                <i class="fas fa-check mr-2 mt-1 text-green-500"></i>
                                <span>Suporte via e-mail</span>
                            </li>
                        </ul>
                    </div>
                    <a
                        href="#contato"
                        class="mt-auto rounded-lg bg-gray-100 px-6 py-3 text-center font-bold text-primary transition hover:bg-gray-200"
                    >
                        Começar Agora
                    </a>
                </div>

                <!-- Plano Profissional (Destaque) -->
                <div class="featured-plan flex flex-col rounded-xl border-t-4 border-secondary bg-white p-8 shadow-xl lg:w-1/3">
                    <div class="mb-4 inline-block rounded-full bg-secondary px-4 py-1 text-sm font-semibold text-white">Mais Popular</div>
                    <h3 class="mb-4 text-xl font-bold text-gray-800">Profissional</h3>
                    <div class="mb-6 flex items-baseline">
                        <span class="text-4xl font-bold text-gray-800">R$ 199</span>
                        <span class="ml-2 text-gray-500">/mês</span>
                    </div>
                    <div class="mb-6 rounded-lg bg-gray-50 p-4">
                        <ul class="space-y-3">
                            <li class="flex items-start">
                                <i class="fas fa-check mr-2 mt-1 text-green-500"></i>
                                <span>Cobranças ilimitadas</span>
                            </li>
                            <li class="flex items-start">
                                <i class="fas fa-check mr-2 mt-1 text-green-500"></i>
                                <span>Relatórios avançados</span>
                            </li>
                            <li class="flex items-start">
                                <i class="fas fa-check mr-2 mt-1 text-green-500"></i>
                                <span>Integração com 2 bancos</span>
                            </li>
                            <li class="flex items-start">
                                <i class="fas fa-check mr-2 mt-1 text-green-500"></i>
                                <span>Suporte prioritário</span>
                            </li>
                            <li class="flex items-start">
                                <i class="fas fa-check mr-2 mt-1 text-green-500"></i>
                                <span>Personalização de boletos</span>
                            </li>
                        </ul>
                    </div>
                    <a
                        href="#contato"
                        class="mt-auto rounded-lg bg-secondary px-6 py-3 text-center font-bold text-white transition hover:bg-green-500"
                    >
                        Começar Agora
                    </a>
                </div>

                <!-- Plano Enterprise -->
                <div class="hover-grow flex flex-col rounded-xl bg-white p-8 shadow-md lg:w-1/3">
                    <h3 class="mb-4 text-xl font-bold text-gray-800">Enterprise</h3>
                    <div class="mb-6 flex items-baseline">
                        <span class="text-4xl font-bold text-gray-800">Personalizado</span>
                    </div>
                    <div class="mb-6 rounded-lg bg-gray-50 p-4">
                        <ul class="space-y-3">
                            <li class="flex items-start">
                                <i class="fas fa-check mr-2 mt-1 text-green-500"></i>
                                <span>Controle multi-empresas</span>
                            </li>
                            <li class="flex items-start">
                                <i class="fas fa-check mr-2 mt-1 text-green-500"></i>
                                <span>API dedicada</span>
                            </li>
                            <li class="flex items-start">
                                <i class="fas fa-check mr-2 mt-1 text-green-500"></i>
                                <span>Treinamento para equipe</span>
                            </li>
                            <li class="flex items-start">
                                <i class="fas fa-check mr-2 mt-1 text-green-500"></i>
                                <span>Integrações personalizadas</span>
                            </li>
                            <li class="flex items-start">
                                <i class="fas fa-check mr-2 mt-1 text-green-500"></i>
                                <span>Gerente de conta dedicado</span>
                            </li>
                        </ul>
                    </div>
                    <a
                        href="#contato"
                        class="mt-auto rounded-lg bg-gray-100 px-6 py-3 text-center font-bold text-primary transition hover:bg-gray-200"
                    >
                        Fale com Consultores
                    </a>
                </div>
            </div>

            <div class="mt-8 text-center">
                <p class="font-semibold text-green-600">7 dias de garantia ou seu dinheiro de volta!</p>
            </div>
        </div>
    </section>
</template>

<style scoped></style>
