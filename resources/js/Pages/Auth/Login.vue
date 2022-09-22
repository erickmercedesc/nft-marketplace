<template>
    <Head title="Log in" />
    <jet-authentication-card>
        <template #logo>
            <jet-authentication-card-logo />
        </template>

        <jet-validation-errors class="mb-4" />

        <div v-if="status" class="mb-4 font-medium text-sm text-green-600">
            {{ status }}
        </div>

        <form @submit.prevent="submit">
            <div>
                <input id="email" type="email" class="mt-1 bg-white block w-full border-0 rounded shadow border-b border-b-gray-300" placeholder="E-Mail" v-model="form.email" required autofocus>
            </div>

            <div class="mt-4">
                <input id="password" type="password" class="mt-1 bg-white block w-full border-0 rounded shadow border-b border-b-gray-300" placeholder="Password" v-model="form.password" required autocomplete="current-password">
            </div>

            <div class="flex items-center justify-end mt-4">
                <button class="w-full mb-4 text-white font-bold py-2 rounded-full shadow" style="background: linear-gradient(90deg, #FFD200 0%, #FF7E00 100%);"  :disabled="form.processing">
                    Log In
                </button>
            </div>

            <Link v-if="canResetPassword" :href="route('password.request')" class="underline text-sm text-gray-800 hover:text-gray-900 my-2">
                Forgot your password?
            </Link>             
        </form>
    </jet-authentication-card>
</template>

<script>
    import { defineComponent } from 'vue'
    import JetAuthenticationCard from '@/Jetstream/AuthenticationCard.vue'
    import JetAuthenticationCardLogo from '@/Jetstream/AuthenticationCardLogo.vue'
    import JetButton from '@/Jetstream/Button.vue'
    import JetInput from '@/Jetstream/Input.vue'
    import JetCheckbox from '@/Jetstream/Checkbox.vue'
    import JetLabel from '@/Jetstream/Label.vue'
    import JetValidationErrors from '@/Jetstream/ValidationErrors.vue'
    import { Head, Link } from '@inertiajs/inertia-vue3';
    import { tsParticles } from "tsparticles";

    export default defineComponent({
        components: {
            Head,
            JetAuthenticationCard,
            JetAuthenticationCardLogo,
            JetButton,
            JetInput,
            JetCheckbox,
            JetLabel,
            JetValidationErrors,
            Link,
        },

        props: {
            canResetPassword: Boolean,
            status: String
        },

        data() {
            return {
                form: this.$inertia.form({
                    email: '',
                    password: '',
                    remember: false
                })
            }
        },

        methods: {
            submit() {
                this.form
                    .transform(data => ({
                        ... data,
                        remember: this.form.remember ? 'on' : ''
                    }))
                    .post(this.route('login'), {
                        onFinish: () => this.form.reset('password'),
                    })
            }
        }
    })
</script>
