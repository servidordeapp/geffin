<!-- eslint-disable vue/block-lang -->
<script setup>

import CalculadoraRoi from './components/CalculadoraRoi.vue';
import Pricing from './components/Pricing.vue';

// Menu mobile toggle
// document.getElementById('menu-toggle').addEventListener('click', function () {
//     const mobileMenu = document.getElementById('mobile-menu');
//     mobileMenu.classList.toggle('hidden');
// });

// // FAQ toggle
// document.querySelectorAll('.faq-toggle').forEach((toggle) => {
//     toggle.addEventListener('click', function () {
//         const content = this.nextElementSibling;
//         const icon = this.querySelector('i');

//         // Toggle content
//         content.classList.toggle('hidden');

//         // Rotate icon
//         icon.classList.toggle('transform');
//         icon.classList.toggle('rotate-180');

//         // Close other FAQs
//         document.querySelectorAll('.faq-toggle').forEach((otherToggle) => {
//             if (otherToggle !== toggle) {
//                 otherToggle.nextElementSibling.classList.add('hidden');
//                 otherToggle.querySelector('i').classList.remove('transform', 'rotate-180');
//             }
//         });
//     });
// });

// // Smooth scrolling for anchor links
// document.querySelectorAll('a[href^="#"]').forEach((anchor) => {
//     anchor.addEventListener('click', function (e) {
//         e.preventDefault();

//         const targetId = this.getAttribute('href');
//         if (targetId === '#') return;

//         const targetElement = document.querySelector(targetId);
//         if (targetElement) {
//             window.scrollTo({
//                 top: targetElement.offsetTop - 100,
//                 behavior: 'smooth',
//             });

//             // Close mobile menu if open
//             document.getElementById('mobile-menu').classList.add('hidden');
//         }
//     });
// });
</script>

<template>
    <div>
        <!-- Banner de Oferta Limitada -->
        <div class="bg-yellow-400 py-2 text-center font-semibold text-gray-800">
            <p>Oferta por tempo limitado: 20% de desconto no primeiro ano!</p>
        </div>

        <!-- Header/Navbar -->
        <header class="sticky top-0 z-50 bg-white shadow">
            <div class="container mx-auto px-4">
                <div class="flex items-center justify-between py-4">
                    <!-- Logo -->
                    <div class="flex items-center">
                        <a href="#" class="flex items-center">
                            <i class="fas fa-chart-line mr-2 text-2xl text-primary"></i>
                            <span class="text-2xl font-bold text-primary">Geffin</span>
                        </a>
                    </div>

                    <!-- Desktop Navigation -->
                    <nav class="hidden items-center space-x-8 md:flex">
                        <a href="#recursos" class="font-medium text-gray-700 transition hover:text-primary">Recursos</a>
                        <a href="#precos" class="font-medium text-gray-700 transition hover:text-primary">Preços</a>
                        <a href="#depoimentos" class="font-medium text-gray-700 transition hover:text-primary">Depoimentos</a>
                        <a href="#contato" class="font-medium text-gray-700 transition hover:text-primary">Contato</a>
                        <a href="#contato" class="rounded-md bg-primary px-6 py-2 font-semibold text-white transition hover:bg-blue-700"
                            >Experimente Grátis</a
                        >
                    </nav>

                    <!-- Mobile Menu Button -->
                    <div class="md:hidden">
                        <button id="menu-toggle" class="text-gray-700 hover:text-primary focus:outline-none">
                            <i class="fas fa-bars text-xl"></i>
                        </button>
                    </div>
                </div>

                <!-- Mobile Navigation -->
                <div id="mobile-menu" class="hidden border-t py-4 md:hidden">
                    <div class="flex flex-col space-y-4">
                        <a href="#recursos" class="font-medium text-gray-700 transition hover:text-primary">Recursos</a>
                        <a href="#precos" class="font-medium text-gray-700 transition hover:text-primary">Preços</a>
                        <a href="#depoimentos" class="font-medium text-gray-700 transition hover:text-primary">Depoimentos</a>
                        <a href="#contato" class="font-medium text-gray-700 transition hover:text-primary">Contato</a>
                        <a href="#contato" class="rounded-md bg-primary px-4 py-2 text-center font-semibold text-white transition hover:bg-blue-700"
                            >Experimente Grátis</a
                        >
                    </div>
                </div>
            </div>
        </header>

        <!-- Prova Social -->
        <div class="bg-gray-100 py-3">
            <div class="container mx-auto px-4">
                <p class="text-center font-medium text-gray-600">
                    <span class="font-semibold">1.200+ empresas</span> confiam no Geffin para gestão financeira
                </p>
            </div>
        </div>

        <!-- Hero Section -->
        <section class="py-16 md:py-24">
            <div class="container mx-auto px-4">
                <div class="flex flex-col items-center md:flex-row">
                    <div class="mb-10 md:mb-0 md:w-1/2">
                        <h1 class="mb-6 text-3xl font-bold text-gray-800 md:text-4xl lg:text-5xl">
                            Controle Financeiro Simplificado para Sua Empresa
                        </h1>
                        <p class="mb-8 text-lg text-gray-600 md:text-xl">
                            Gerencie cobranças, acompanhe pagamentos e reduza inadimplências com integração direta ao Banco do Brasil e Santander.
                        </p>
                        <div class="mb-8">
                            <a
                                href="#contato"
                                class="hover-grow inline-block rounded-lg bg-secondary px-8 py-3 text-lg font-bold text-white shadow-lg transition hover:bg-green-500"
                            >
                                Experimente Grátis por 30 Dias
                            </a>
                            <p class="mt-3 text-gray-500">Sem necessidade de cartão de crédito</p>
                        </div>

                        <!-- Bancos Parceiros -->
                        <div class="mt-6 flex items-center space-x-4">
                            <span class="font-medium text-gray-500">Integração com:</span>
                            <div class="flex space-x-4">
                                <div class="rounded bg-white p-2 shadow-sm">
                                    <i class="fas fa-university text-xl text-blue-900"></i>
                                    <span class="ml-1 text-sm">Banco do Brasil</span>
                                </div>
                                <div class="rounded bg-white p-2 shadow-sm">
                                    <i class="fas fa-university text-xl text-red-600"></i>
                                    <span class="ml-1 text-sm">Santander</span>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="md:w-1/2 md:pl-10">
                        <div class="overflow-hidden rounded-xl border border-gray-100 bg-white shadow-xl">
                            <div class="border-b border-gray-200 bg-gray-100 px-6 py-4">
                                <div class="flex space-x-2">
                                    <div class="h-3 w-3 rounded-full bg-red-500"></div>
                                    <div class="h-3 w-3 rounded-full bg-yellow-500"></div>
                                    <div class="h-3 w-3 rounded-full bg-green-500"></div>
                                </div>
                            </div>
                            <div class="p-6">
                                <div class="flex h-64 items-center justify-center rounded-lg bg-gray-100">
                                    <div class="p-6 text-center">
                                        <i class="fas fa-chart-pie mb-4 text-4xl text-primary"></i>
                                        <p class="font-medium text-gray-600">Dashboard Geffin - Controle em Tempo Real</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!-- Recursos Section -->
        <section id="recursos" class="bg-gray-50 py-16">
            <div class="container mx-auto px-4">
                <div class="mb-16 text-center">
                    <h2 class="mb-4 text-3xl font-bold text-gray-800">Tudo o que sua empresa precisa para dominar o financeiro</h2>
                    <p class="mx-auto max-w-2xl text-gray-600">Simplifique sua gestão financeira com recursos poderosos e intuitivos.</p>
                </div>

                <div class="grid grid-cols-1 gap-8 md:grid-cols-2 lg:grid-cols-3">
                    <!-- Recurso 1 -->
                    <div class="hover-grow rounded-lg bg-white p-6 shadow-md">
                        <div class="mb-6 flex h-16 w-16 items-center justify-center rounded-full bg-blue-100">
                            <i class="fas fa-university text-2xl text-primary"></i>
                        </div>
                        <h3 class="mb-3 text-xl font-semibold text-gray-800">Integração Bancária</h3>
                        <p class="text-gray-600">Emita boletos e reconcilie pagamentos automaticamente com os bancos integrados.</p>
                    </div>

                    <!-- Recurso 2 -->
                    <div class="hover-grow rounded-lg bg-white p-6 shadow-md">
                        <div class="mb-6 flex h-16 w-16 items-center justify-center rounded-full bg-blue-100">
                            <i class="fas fa-chart-line text-2xl text-primary"></i>
                        </div>
                        <h3 class="mb-3 text-xl font-semibold text-gray-800">Relatórios Inteligentes</h3>
                        <p class="text-gray-600">Acompanhe faturamento, inadimplência e fluxo de caixa com relatórios personalizáveis.</p>
                    </div>

                    <!-- Recurso 3 -->
                    <div class="hover-grow rounded-lg bg-white p-6 shadow-md">
                        <div class="mb-6 flex h-16 w-16 items-center justify-center rounded-full bg-blue-100">
                            <i class="fas fa-bell text-2xl text-primary"></i>
                        </div>
                        <h3 class="mb-3 text-xl font-semibold text-gray-800">Alertas Automáticos</h3>
                        <p class="text-gray-600">Notificações por e-mail e SMS para clientes com pagamentos em atraso.</p>
                    </div>

                    <!-- Recurso 4 -->
                    <div class="hover-grow rounded-lg bg-white p-6 shadow-md">
                        <div class="mb-6 flex h-16 w-16 items-center justify-center rounded-full bg-blue-100">
                            <i class="fas fa-lock text-2xl text-primary"></i>
                        </div>
                        <h3 class="mb-3 text-xl font-semibold text-gray-800">Segurança de Dados</h3>
                        <p class="text-gray-600">Dados criptografados e compliance com as normas do BACEN.</p>
                    </div>

                    <!-- Recurso 5 -->
                    <div class="hover-grow rounded-lg bg-white p-6 shadow-md">
                        <div class="mb-6 flex h-16 w-16 items-center justify-center rounded-full bg-blue-100">
                            <i class="fas fa-paint-brush text-2xl text-primary"></i>
                        </div>
                        <h3 class="mb-3 text-xl font-semibold text-gray-800">Personalização</h3>
                        <p class="text-gray-600">Crie cobranças com a logo da sua empresa e regras de juros personalizadas.</p>
                    </div>

                    <!-- Recurso 6 -->
                    <div class="hover-grow rounded-lg bg-white p-6 shadow-md">
                        <div class="mb-6 flex h-16 w-16 items-center justify-center rounded-full bg-blue-100">
                            <i class="fas fa-headset text-2xl text-primary"></i>
                        </div>
                        <h3 class="mb-3 text-xl font-semibold text-gray-800">Suporte 24/7</h3>
                        <p class="text-gray-600">Equipe técnica especializada disponível para ajudar quando precisar.</p>
                    </div>
                </div>
            </div>
        </section>

        <!-- Demonstração/Vídeo Section -->
        <section class="bg-gray-900 py-16 text-white">
            <div class="container mx-auto px-4">
                <div class="mx-auto max-w-3xl text-center">
                    <h2 class="mb-8 text-3xl font-bold">Veja como o Geffin funciona em 1 minuto</h2>
                    <div class="hover-grow relative mb-8 cursor-pointer overflow-hidden rounded-xl bg-gray-800">
                        <div class="aspect-w-16 aspect-h-9">
                            <div class="flex h-64 w-full items-center justify-center md:h-96">
                                <div class="text-center">
                                    <div class="mx-auto mb-4 flex h-20 w-20 items-center justify-center rounded-full bg-white bg-opacity-20">
                                        <i class="fas fa-play text-2xl text-white"></i>
                                    </div>
                                    <p class="font-medium">Clique para assistir</p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <a href="#contato" class="inline-block rounded-lg bg-white px-8 py-3 font-bold text-primary transition hover:bg-gray-100">
                        Agendar Demonstração Personalizada
                    </a>
                </div>
            </div>
        </section>

        <Pricing />


        <!-- Depoimentos Section -->
        <section id="depoimentos" class="bg-gray-50 py-16">
            <div class="container mx-auto px-4">
                <div class="mb-16 text-center">
                    <h2 class="mb-4 text-3xl font-bold text-gray-800">Quem usa recomenda</h2>
                    <p class="mx-auto max-w-2xl text-gray-600">Veja o que nossos clientes dizem sobre o Geffin.</p>
                </div>

                <div class="mx-auto grid max-w-5xl grid-cols-1 gap-8 md:grid-cols-2 lg:grid-cols-3">
                    <!-- Depoimento 1 -->
                    <div class="hover-grow rounded-lg bg-white p-6 shadow-md">
                        <div class="mb-4 flex items-center">
                            <div class="mr-4 flex h-12 w-12 items-center justify-center rounded-full bg-gray-300">
                                <span class="font-bold text-gray-600">ABC</span>
                            </div>
                            <div>
                                <h4 class="font-semibold text-gray-800">ABC Contábil</h4>
                                <div class="flex text-yellow-400">
                                    <i class="fas fa-star"></i>
                                    <i class="fas fa-star"></i>
                                    <i class="fas fa-star"></i>
                                    <i class="fas fa-star"></i>
                                    <i class="fas fa-star"></i>
                                </div>
                            </div>
                        </div>
                        <blockquote class="italic text-gray-600">
                            "Com o Geffin, reduzimos a inadimplência em 40% em 3 meses. Indico para todos!"
                        </blockquote>
                        <footer class="mt-4 text-gray-500">— João Silva, Diretor Financeiro</footer>
                    </div>

                    <!-- Depoimento 2 -->
                    <div class="hover-grow rounded-lg bg-white p-6 shadow-md">
                        <div class="mb-4 flex items-center">
                            <div class="mr-4 flex h-12 w-12 items-center justify-center rounded-full bg-gray-300">
                                <span class="font-bold text-gray-600">TS</span>
                            </div>
                            <div>
                                <h4 class="font-semibold text-gray-800">TechSolutions</h4>
                                <div class="flex text-yellow-400">
                                    <i class="fas fa-star"></i>
                                    <i class="fas fa-star"></i>
                                    <i class="fas fa-star"></i>
                                    <i class="fas fa-star"></i>
                                    <i class="fas fa-star-half-alt"></i>
                                </div>
                            </div>
                        </div>
                        <blockquote class="italic text-gray-600">
                            "A integração com o Banco do Brasil foi essencial para nossa gestão. Conseguimos automatizar todo o processo de cobrança."
                        </blockquote>
                        <footer class="mt-4 text-gray-500">— Maria Souza, CEO</footer>
                    </div>

                    <!-- Depoimento 3 -->
                    <div class="hover-grow rounded-lg bg-white p-6 shadow-md">
                        <div class="mb-4 flex items-center">
                            <div class="mr-4 flex h-12 w-12 items-center justify-center rounded-full bg-gray-300">
                                <span class="font-bold text-gray-600">VP</span>
                            </div>
                            <div>
                                <h4 class="font-semibold text-gray-800">Varejo Plus</h4>
                                <div class="flex text-yellow-400">
                                    <i class="fas fa-star"></i>
                                    <i class="fas fa-star"></i>
                                    <i class="fas fa-star"></i>
                                    <i class="fas fa-star"></i>
                                    <i class="fas fa-star"></i>
                                </div>
                            </div>
                        </div>
                        <blockquote class="italic text-gray-600">
                            "Relatórios detalhados que facilitam nossas decisões estratégicas. Aumentamos nosso faturamento em 25%."
                        </blockquote>
                        <footer class="mt-4 text-gray-500">— Carlos Oliveira, CFO</footer>
                    </div>
                </div>
            </div>
        </section>

        <!-- Integrações Section -->
        <section class="bg-white py-16">
            <div class="container mx-auto px-4">
                <div class="mb-16 text-center">
                    <h2 class="mb-4 text-3xl font-bold text-gray-800">Conecte-se aos principais bancos do Brasil</h2>
                    <p class="mx-auto max-w-2xl text-gray-600">Integração instantânea: comece a usar em menos de 5 minutos.</p>
                </div>

                <div class="mx-auto flex max-w-3xl flex-wrap items-center justify-center gap-8">
                    <div class="hover-grow flex items-center space-x-4 rounded-lg bg-white p-6 shadow-md">
                        <div class="flex h-16 w-16 items-center justify-center">
                            <i class="fas fa-university text-4xl text-blue-900"></i>
                        </div>
                        <div>
                            <h4 class="font-bold text-gray-800">Banco do Brasil</h4>
                            <p class="text-gray-600">Integração completa</p>
                        </div>
                    </div>

                    <div class="hover-grow flex items-center space-x-4 rounded-lg bg-white p-6 shadow-md">
                        <div class="flex h-16 w-16 items-center justify-center">
                            <i class="fas fa-university text-4xl text-red-600"></i>
                        </div>
                        <div>
                            <h4 class="font-bold text-gray-800">Santander</h4>
                            <p class="text-gray-600">Integração completa</p>
                        </div>
                    </div>
                </div>

                <div class="mt-10 text-center">
                    <p class="text-gray-600">Mais bancos em breve!</p>
                </div>
            </div>
        </section>

        <!-- Formulário de Captação -->
        <section id="contato" class="bg-primary py-16">
            <div class="container mx-auto px-4">
                <div class="mx-auto max-w-3xl rounded-xl bg-white p-8 shadow-xl">
                    <div class="mb-8 text-center">
                        <h2 class="mb-4 text-3xl font-bold text-gray-800">Comece agora mesmo!</h2>
                        <p class="text-gray-600">Preencha os campos abaixo para iniciar seu teste gratuito de 30 dias.</p>
                    </div>

                    <form class="space-y-6">
                        <div class="grid grid-cols-1 gap-6 md:grid-cols-2">
                            <div>
                                <label for="nome" class="mb-2 block font-medium text-gray-700">Nome completo</label>
                                <input
                                    type="text"
                                    id="nome"
                                    class="w-full rounded-lg border border-gray-300 px-4 py-3 focus:outline-none focus:ring-2 focus:ring-primary"
                                    placeholder="Seu nome"
                                    required
                                />
                            </div>

                            <div>
                                <label for="email" class="mb-2 block font-medium text-gray-700">E-mail corporativo</label>
                                <input
                                    type="email"
                                    id="email"
                                    class="w-full rounded-lg border border-gray-300 px-4 py-3 focus:outline-none focus:ring-2 focus:ring-primary"
                                    placeholder="seu@empresa.com.br"
                                    required
                                />
                            </div>

                            <div>
                                <label for="telefone" class="mb-2 block font-medium text-gray-700">Telefone</label>
                                <input
                                    type="tel"
                                    id="telefone"
                                    class="w-full rounded-lg border border-gray-300 px-4 py-3 focus:outline-none focus:ring-2 focus:ring-primary"
                                    placeholder="(00) 00000-0000"
                                    required
                                />
                            </div>

                            <div>
                                <label for="empresa" class="mb-2 block font-medium text-gray-700">Nome da empresa</label>
                                <input
                                    type="text"
                                    id="empresa"
                                    class="w-full rounded-lg border border-gray-300 px-4 py-3 focus:outline-none focus:ring-2 focus:ring-primary"
                                    placeholder="Sua empresa"
                                    required
                                />
                            </div>
                        </div>

                        <div>
                            <label for="funcionarios" class="mb-2 block font-medium text-gray-700">Número de funcionários</label>
                            <select
                                id="funcionarios"
                                class="w-full rounded-lg border border-gray-300 px-4 py-3 focus:outline-none focus:ring-2 focus:ring-primary"
                            >
                                <option value="">Selecione uma opção</option>
                                <option value="1-10">1-10</option>
                                <option value="11-50">11-50</option>
                                <option value="51-200">51-200</option>
                                <option value="200+">200+</option>
                            </select>
                        </div>

                        <div class="pt-4">
                            <button
                                type="submit"
                                class="w-full rounded-lg bg-secondary px-6 py-3 text-lg font-bold text-white transition hover:bg-green-500"
                            >
                                Experimentar Grátis por 30 Dias
                            </button>
                            <p class="mt-3 text-center text-sm text-gray-500">
                                Ao clicar, você concorda com nossos <a href="#" class="text-primary">Termos de Uso</a>.
                            </p>
                        </div>
                    </form>
                </div>
            </div>
        </section>

        <CalculadoraRoi />

        <!-- Comparativo -->
        <section class="bg-white py-16">
            <div class="container mx-auto px-4">
                <div class="mb-16 text-center">
                    <h2 class="mb-4 text-3xl font-bold text-gray-800">Por que escolher o Geffin?</h2>
                    <p class="mx-auto max-w-2xl text-gray-600">Veja como o Geffin se compara a outras soluções de gestão financeira</p>
                </div>

                <div class="mx-auto max-w-4xl">
                    <div class="overflow-x-auto">
                        <table class="w-full border-collapse">
                            <thead>
                                <tr class="bg-gray-100">
                                    <th class="px-6 py-4 text-left font-semibold text-gray-800">Recursos</th>
                                    <th class="px-6 py-4 text-center font-semibold text-primary">Geffin</th>
                                    <th class="px-6 py-4 text-center font-semibold text-gray-800">Planilhas Excel</th>
                                    <th class="px-6 py-4 text-center font-semibold text-gray-800">Concorrentes</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr class="border-b border-gray-200">
                                    <td class="px-6 py-4 text-gray-700">Integração bancária</td>
                                    <td class="px-6 py-4 text-center"><i class="fas fa-check-circle text-xl text-green-500"></i></td>
                                    <td class="px-6 py-4 text-center"><i class="fas fa-times-circle text-xl text-red-500"></i></td>
                                    <td class="px-6 py-4 text-center text-gray-500">Parcial</td>
                                </tr>
                                <tr class="border-b border-gray-200">
                                    <td class="px-6 py-4 text-gray-700">Emissão de boletos</td>
                                    <td class="px-6 py-4 text-center"><i class="fas fa-check-circle text-xl text-green-500"></i></td>
                                    <td class="px-6 py-4 text-center"><i class="fas fa-times-circle text-xl text-red-500"></i></td>
                                    <td class="px-6 py-4 text-center"><i class="fas fa-check-circle text-xl text-green-500"></i></td>
                                </tr>
                                <tr class="border-b border-gray-200">
                                    <td class="px-6 py-4 text-gray-700">Relatórios financeiros avançados</td>
                                    <td class="px-6 py-4 text-center"><i class="fas fa-check-circle text-xl text-green-500"></i></td>
                                    <td class="px-6 py-4 text-center text-gray-500">Limitado</td>
                                    <td class="px-6 py-4 text-center text-gray-500">Básicos</td>
                                </tr>
                                <tr class="border-b border-gray-200">
                                    <td class="px-6 py-4 text-gray-700">Controle de inadimplência</td>
                                    <td class="px-6 py-4 text-center"><i class="fas fa-check-circle text-xl text-green-500"></i></td>
                                    <td class="px-6 py-4 text-center text-gray-500">Manual</td>
                                    <td class="px-6 py-4 text-center text-gray-500">Limitado</td>
                                </tr>
                                <tr class="border-b border-gray-200">
                                    <td class="px-6 py-4 text-gray-700">Alertas automáticos</td>
                                    <td class="px-6 py-4 text-center"><i class="fas fa-check-circle text-xl text-green-500"></i></td>
                                    <td class="px-6 py-4 text-center"><i class="fas fa-times-circle text-xl text-red-500"></i></td>
                                    <td class="px-6 py-4 text-center text-gray-500">Básicos</td>
                                </tr>
                                <tr>
                                    <td class="px-6 py-4 text-gray-700">Suporte técnico</td>
                                    <td class="px-6 py-4 text-center">24/7</td>
                                    <td class="px-6 py-4 text-center"><i class="fas fa-times-circle text-xl text-red-500"></i></td>
                                    <td class="px-6 py-4 text-center">Horário comercial</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </section>

        <!-- FAQ Section -->
        <section class="bg-gray-50 py-16">
            <div class="container mx-auto px-4">
                <div class="mb-16 text-center">
                    <h2 class="mb-4 text-3xl font-bold text-gray-800">Perguntas Frequentes</h2>
                    <p class="mx-auto max-w-2xl text-gray-600">Tire suas dúvidas sobre o Geffin</p>
                </div>

                <div class="mx-auto max-w-3xl">
                    <div class="space-y-6">
                        <!-- FAQ Item 1 -->
                        <div class="overflow-hidden rounded-lg bg-white shadow-md">
                            <button class="faq-toggle w-full p-6 text-left focus:outline-none">
                                <div class="flex items-center justify-between">
                                    <h3 class="text-lg font-semibold text-gray-800">Meus dados estão seguros?</h3>
                                    <i class="fas fa-chevron-down text-gray-500 transition-transform"></i>
                                </div>
                            </button>
                            <div class="faq-content hidden px-6 pb-6">
                                <p class="text-gray-600">
                                    Absolutamente. O Geffin utiliza criptografia de padrão bancário para proteger todos os seus dados. Nossa
                                    infraestrutura é hospedada em servidores de alta segurança e estamos em total conformidade com a LGPD e normas do
                                    BACEN para proteção de dados financeiros.
                                </p>
                            </div>
                        </div>

                        <!-- FAQ Item 2 -->
                        <div class="overflow-hidden rounded-lg bg-white shadow-md">
                            <button class="faq-toggle w-full p-6 text-left focus:outline-none">
                                <div class="flex items-center justify-between">
                                    <h3 class="text-lg font-semibold text-gray-800">Quanto tempo leva para configurar?</h3>
                                    <i class="fas fa-chevron-down text-gray-500 transition-transform"></i>
                                </div>
                            </button>
                            <div class="faq-content hidden px-6 pb-6">
                                <p class="text-gray-600">
                                    A configuração do Geffin é rápida e intuitiva. Você pode começar a emitir cobranças em apenas 5 minutos após a
                                    criação da sua conta. A integração com os bancos leva no máximo 24 horas para ser completamente ativada após o
                                    envio da documentação necessária.
                                </p>
                            </div>
                        </div>

                        <!-- FAQ Item 3 -->
                        <div class="overflow-hidden rounded-lg bg-white shadow-md">
                            <button class="faq-toggle w-full p-6 text-left focus:outline-none">
                                <div class="flex items-center justify-between">
                                    <h3 class="text-lg font-semibold text-gray-800">Posso cancelar a qualquer momento?</h3>
                                    <i class="fas fa-chevron-down text-gray-500 transition-transform"></i>
                                </div>
                            </button>
                            <div class="faq-content hidden px-6 pb-6">
                                <p class="text-gray-600">
                                    Sim, você pode cancelar sua assinatura a qualquer momento sem taxas ou multas. Oferecemos 7 dias de garantia de
                                    reembolso integral caso você não esteja satisfeito com nosso serviço. Seu compromisso conosco é mensal, sem
                                    carência.
                                </p>
                            </div>
                        </div>

                        <!-- FAQ Item 4 -->
                        <div class="overflow-hidden rounded-lg bg-white shadow-md">
                            <button class="faq-toggle w-full p-6 text-left focus:outline-none">
                                <div class="flex items-center justify-between">
                                    <h3 class="text-lg font-semibold text-gray-800">Há suporte para outros bancos?</h3>
                                    <i class="fas fa-chevron-down text-gray-500 transition-transform"></i>
                                </div>
                            </button>
                            <div class="faq-content hidden px-6 pb-6">
                                <p class="text-gray-600">
                                    No momento, oferecemos integração com Banco do Brasil e Santander. Estamos em fase final de desenvolvimento para
                                    incluir Itaú, Bradesco e Caixa Econômica Federal nos próximos meses. Se você utiliza outro banco, entre em contato
                                    conosco para verificar a possibilidade de integração personalizada.
                                </p>
                            </div>
                        </div>

                        <!-- FAQ Item 5 -->
                        <div class="overflow-hidden rounded-lg bg-white shadow-md">
                            <button class="faq-toggle w-full p-6 text-left focus:outline-none">
                                <div class="flex items-center justify-between">
                                    <h3 class="text-lg font-semibold text-gray-800">Posso emitir notas fiscais pelo Geffin?</h3>
                                    <i class="fas fa-chevron-down text-gray-500 transition-transform"></i>
                                </div>
                            </button>
                            <div class="faq-content hidden px-6 pb-6">
                                <p class="text-gray-600">
                                    Atualmente o Geffin é focado em controle de cobranças e gestão financeira. Para emissão de notas fiscais,
                                    recomendamos o uso de soluções parceiras que se integram perfeitamente ao nosso sistema. Entre em contato com
                                    nosso suporte para conhecer as integrações disponíveis.
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!-- CTA Final Section -->
        <section class="bg-primary py-12 text-white">
            <div class="container mx-auto px-4">
                <div class="mx-auto max-w-4xl text-center">
                    <h2 class="mb-6 text-3xl font-bold">Pronto para otimizar seu financeiro?</h2>
                    <p class="mb-8 text-lg">Junte-se a mais de 1.200 empresas que já transformaram sua gestão financeira com o Geffin.</p>
                    <div class="flex flex-col justify-center space-y-4 sm:flex-row sm:space-x-4 sm:space-y-0">
                        <a href="#contato" class="rounded-lg bg-white px-8 py-3 font-bold text-primary shadow-lg transition hover:bg-gray-100">
                            Começar Agora
                        </a>
                        <a
                            href="#"
                            class="rounded-lg border-2 border-white px-8 py-3 font-bold text-white transition hover:bg-white hover:text-primary"
                        >
                            Agendar Demonstração
                        </a>
                    </div>
                </div>
            </div>
        </section>

        <!-- Footer -->
        <footer class="bg-gray-900 py-12 text-white">
            <div class="container mx-auto px-4">
                <div class="grid grid-cols-1 gap-8 md:grid-cols-4">
                    <div class="mb-8 md:mb-0">
                        <div class="mb-6 flex items-center">
                            <i class="fas fa-chart-line mr-2 text-2xl"></i>
                            <span class="text-2xl font-bold">Geffin</span>
                        </div>
                        <p class="mb-6 text-gray-400">Gestão financeira simplificada para sua empresa.</p>
                        <div class="flex space-x-4">
                            <a href="#" class="text-gray-400 transition hover:text-white">
                                <i class="fab fa-facebook text-xl"></i>
                            </a>
                            <a href="#" class="text-gray-400 transition hover:text-white">
                                <i class="fab fa-instagram text-xl"></i>
                            </a>
                            <a href="#" class="text-gray-400 transition hover:text-white">
                                <i class="fab fa-linkedin text-xl"></i>
                            </a>
                            <a href="#" class="text-gray-400 transition hover:text-white">
                                <i class="fab fa-youtube text-xl"></i>
                            </a>
                        </div>
                    </div>

                    <div>
                        <h3 class="mb-4 text-lg font-semibold">Recursos</h3>
                        <ul class="space-y-3">
                            <li><a href="#" class="text-gray-400 transition hover:text-white">Integração Bancária</a></li>
                            <li><a href="#" class="text-gray-400 transition hover:text-white">Relatórios</a></li>
                            <li><a href="#" class="text-gray-400 transition hover:text-white">Cobranças</a></li>
                            <li><a href="#" class="text-gray-400 transition hover:text-white">API</a></li>
                        </ul>
                    </div>

                    <div>
                        <h3 class="mb-4 text-lg font-semibold">Empresa</h3>
                        <ul class="space-y-3">
                            <li><a href="#" class="text-gray-400 transition hover:text-white">Sobre nós</a></li>
                            <li><a href="#" class="text-gray-400 transition hover:text-white">Blog</a></li>
                            <li><a href="#" class="text-gray-400 transition hover:text-white">Carreiras</a></li>
                            <li><a href="#" class="text-gray-400 transition hover:text-white">Suporte</a></li>
                        </ul>
                    </div>

                    <div>
                        <h3 class="mb-4 text-lg font-semibold">Legal</h3>
                        <ul class="space-y-3">
                            <li><a href="#" class="text-gray-400 transition hover:text-white">Política de Privacidade</a></li>
                            <li><a href="#" class="text-gray-400 transition hover:text-white">Termos de Uso</a></li>
                            <li><a href="#" class="text-gray-400 transition hover:text-white">Compliance</a></li>
                            <li><a href="#" class="text-gray-400 transition hover:text-white">LGPD</a></li>
                        </ul>
                    </div>
                </div>

                <div class="mt-12 flex flex-col items-center justify-between border-t border-gray-800 pt-8 md:flex-row">
                    <p class="mb-4 text-sm text-gray-400 md:mb-0">© 2025 Geffin. Todos os direitos reservados.</p>
                    <div class="flex items-center space-x-4">
                        <div class="flex items-center">
                            <i class="fas fa-shield-alt mr-2 text-green-500"></i>
                            <span class="text-sm text-gray-400">SSL 256-bit</span>
                        </div>
                        <div class="flex items-center">
                            <i class="fas fa-check-circle mr-2 text-green-500"></i>
                            <span class="text-sm text-gray-400">Certificado pela Cloudflare</span>
                        </div>
                    </div>
                </div>
            </div>
        </footer>

        <!-- Chatbot (Placeholder) -->
        <div class="fixed bottom-6 right-6 z-50">
            <button class="flex h-16 w-16 items-center justify-center rounded-full bg-secondary text-white shadow-lg transition hover:bg-green-500">
                <i class="fas fa-comments text-2xl"></i>
            </button>
        </div>
    </div>
</template>

<style scoped></style>
