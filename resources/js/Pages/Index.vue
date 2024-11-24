<script setup>
import { Head, Link } from '@inertiajs/vue3';

defineProps({
    canLogin: {
        type: Boolean,
    },
    canRegister: {
        type: Boolean,
    },
});
</script>

<template>

    <Head title="Software de Contribuyentes" />
    <div class="bg-gray-50 text-black ">
        <!-- Header fijo -->
        <header
            class="fixed top-0 left-0 right-0 z-50 flex items-center justify-between bg-[#fffff] px-6 py-4  shadow-md">
            <div class="flex items-center">
                <svg class="h-8 w-auto lg:h-10" viewBox="0 0 62 65" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path
                        d="M61.8548 14.6253C61.8778 14.7102 61.8895 14.7978 61.8897 14.8858V28.5615C61.8898 28.737 61.8434 28.9095 61.7554 29.0614C61.6675 29.2132 61.5409 29.3392 61.3887 29.4265L49.9104 36.0351V49.1337C49.9104 49.4902 49.7209 49.8192 49.4118 49.9987L25.4519 63.7916C..."
                        fill="#FFF" />
                </svg>
                <h1 class="ml-4 text-xl font-bold">Software de Contribuyentes</h1>
            </div>
            <nav v-if="canLogin" class="flex space-x-4">
                <Link v-if="$page.props.auth.user" :href="route('dashboard')"
                    class="rounded-md px-3 py-2  transition hover:bg-white hover:text-[#FF2D20]">
                Home
                </Link>
                <template v-else>
                    <Link :href="route('login')"
                        class="rounded-md px-3 py-2  transition hover:bg-white hover:text-[#FF2D20]">
                    Ingresar
                    </Link>
                    <Link v-if="canRegister" :href="route('register')"
                        class="rounded-md px-3 py-2  transition hover:bg-white hover:text-[#FF2D20]">
                    Registrarse
                    </Link>
                </template>
            </nav>
        </header>

        <!-- Contenido principal -->
        <div class="pt-15">
            <div class="relative flex min-h-screen flex-col items-center justify-center px-4">
                <div class="w-full max-w-4xl rounded-lg bg-white p-8 shadow-lg ">
                    <h2 class="text-2xl font-bold text-center ">Bienvenido al Sistema de Contribuyentes
                    </h2>
                    <p class="mt-4 text-center text-gray-600 dark:text-gray-400">
                        Este software te ayuda a gestionar los datos de los contribuyentes de manera eficiente y
                        organizada.
                    </p>

                    <!-- Panel de acciones -->
                    <div class="mt-8 grid grid-cols-1 gap-6 lg:grid-cols-2">
                        <div
                            class="rounded-lg border border-gray-200 bg-gray-50 p-6 text-center shadow-md dark:border-gray-700 dark:bg-gray-800">
                            <h3 class="text-lg font-semibold">Registro de Contribuyentes</h3>
                            <p class="mt-2 text-sm text-gray-500 dark:text-gray-400">
                                Crea y gestiona información detallada de los contribuyentes.
                            </p>
                            <Link :href="route('register')"
                                class="mt-4 inline-block rounded  px-4 py-2  hover:blue-600">
                            Iniciar
                            </Link>
                        </div>
                        <div
                            class="rounded-lg border border-gray-200 bg-gray-50 p-6 text-center shadow-md dark:border-gray-700 dark:bg-gray-800">
                            <h3 class="text-lg font-semibold">Consulta de Contribuyentes</h3>
                            <p class="mt-2 text-sm text-gray-500 dark:text-gray-400">
                                Busca rápidamente la información que necesitas.
                            </p>
                            <Link :href="route('login')" class="mt-4 inline-block rounded  px-4 py-2  hover:blue-600">
                            Consultar
                            </Link>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Footer -->
        <footer class="bg-gray-100 py-6 text-center text-sm text-gray-500 dark:bg-gray-800 dark:text-gray-400">
            &copy; 2024 Software de Contribuyentes. Todos los derechos reservados.
        </footer>
    </div>
</template>
