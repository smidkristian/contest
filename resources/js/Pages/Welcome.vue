<template>
    <div class="flex flex-col items-center justify-center min-h-screen">
        <!-- <div v-if="canLogin" class="hidden fixed top-0 right-0 px-6 py-4 sm:block">
            <inertia-link v-if="$page.props.user" href="/dashboard" class="text-sm text-gray-700 underline">
                Dashboard
            </inertia-link>

            <template v-else>
                <inertia-link :href="route('login')" class="text-sm text-gray-700 underline">
                    Log in
                </inertia-link>

                <inertia-link v-if="canRegister" :href="route('register')" class="ml-4 text-sm text-gray-700 underline">
                    Register
                </inertia-link>
            </template>
        </div> -->

        <h1 class="text-xl text-gray-500">Welcome to the contest</h1>

        <div class="bg-white p-4 rounded-md shadow-lg w-full lg:w-1/5">
            <form @submit.prevent="submit()">
                <div class="flex flex-col">
                    <label for="email" class="text-sm mb-1">E-mail:</label>
                    <input type="email" id="email" v-model="form.email"
                        class="border-1 border-gray-200 rounded-md"/>
                </div>
                <div class="flex justify-center">
                    <button class="px-2 bg-gray-200 text-sm rounded-md mt-2">Confirm</button>
                </div>
            </form>

        </div>
    </div>
</template>

<script>
    export default {
        props: {
            // canLogin: Boolean,
            // canRegister: Boolean,
            // laravelVersion: String,
            // phpVersion: String,
        },

        data() {
            return {
                form: {
                    email: ''
                }
            }
        },

        methods: {
            submit() {
                axios.post(route('contest', this.form)).then((res) => {
                    console.log(res);
                });
            }
        }
    }
</script>
