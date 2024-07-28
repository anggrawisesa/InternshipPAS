<template>
    <header class="bg-white">
        <div class="mx-auto max-w-screen-xl px-4 py-8 sm:px-6 sm:py-12 lg:px-8">
            <div
                class="flex flex-col items-start gap-4 md:flex-row md:items-center md:justify-between"
            >
                <div>
                    <h1 class="text-2xl font-bold text-gray-900 sm:text-3xl">
                        <a href="/home">Be Beauty</a>
                    </h1>

                    <p class="mt-1.5 text-sm text-gray-500">
                        Belanja kosmetik lengkap dan murah
                    </p>
                </div>

                <div class="flex items-center gap-4">
                    <div v-if="user">
                        <span class="text-gray-900"
                            >Welcome, {{ user.name }}</span
                        >
                        <button
                            @click="logout"
                            class="inline-block rounded bg-red-600 px-5 py-3 text-sm font-medium text-white transition hover:bg-red-700 focus:outline-none focus:ring ml-4"
                            type="button"
                        >
                            Logout
                        </button>
                    </div>
                    <div v-else>
                        <button
                            @click="goToRegister"
                            class="inline-flex items-center justify-center gap-1.5 rounded border border-gray-200 bg-white px-5 py-3 text-gray-900 transition hover:text-gray-700 focus:outline-none focus:ring"
                            type="button"
                        >
                            <span class="text-sm font-medium"> Sign Up </span>
                            <svg
                                xmlns="http://www.w3.org/2000/svg"
                                class="h-4 w-4"
                                fill="none"
                                viewBox="0 0 24 24"
                                stroke="currentColor"
                                stroke-width="2"
                            >
                                <path
                                    stroke-linecap="round"
                                    stroke-linejoin="round"
                                    d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14"
                                />
                            </svg>
                        </button>

                        <button
                            @click="goToLogin"
                            class="inline-block rounded bg-indigo-600 px-5 py-3 text-sm font-medium text-white transition hover:bg-indigo-700 focus:outline-none focus:ring"
                            type="button"
                        >
                            Sign In
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </header>
</template>

<script>
export default {
    props: {
        user: {
            type: Object,
            default: null,
        },
        loginRoute: {
            type: String,
            required: true,
        },
        registerRoute: {
            type: String,
            required: true,
        },
        logoutRoute: {
            type: String,
            required: true,
        },
    },
    methods: {
        goToLogin() {
            window.location.href = this.loginRoute;
        },
        goToRegister() {
            window.location.href = this.registerRoute;
        },
        logout() {
            axios.post(this.logoutRoute).then(() => {
                window.location.reload();
            });
        },
    },
};
</script>
