<template>
    <jet-form-section @submitted="updateProfileInformation">
        <template #title>
            Withdraw Information
        </template>

        <template #description>
            Update your withdraw information.
        </template>

        <template #form>
            <div class="col-span-6 sm:col-span-4">
                <jet-label for="withdraw_address" value="Withdraw Address" />
                <jet-input id="withdraw_address" type="text" class="mt-1 block w-full" v-model="form.withdraw_address" autocomplete="withdraw_address" />
                <jet-input-error :message="form.errors.withdraw_address" class="mt-2" />
            </div>            
        </template>

        <template #actions>
            <jet-action-message :on="form.recentlySuccessful" class="mr-3">
                Saved.
            </jet-action-message>

            <jet-button :class="{ 'opacity-25': form.processing }" :disabled="form.processing">
                Save
            </jet-button>
        </template>
    </jet-form-section>
</template>

<script>
    import { defineComponent } from 'vue'
    import JetButton from '@/Jetstream/Button.vue'
    import JetFormSection from '@/Jetstream/FormSection.vue'
    import JetInput from '@/Jetstream/Input.vue'
    import JetInputError from '@/Jetstream/InputError.vue'
    import JetLabel from '@/Jetstream/Label.vue'
    import JetActionMessage from '@/Jetstream/ActionMessage.vue'
    import JetSecondaryButton from '@/Jetstream/SecondaryButton.vue'

    export default defineComponent({
        components: {
            JetActionMessage,
            JetButton,
            JetFormSection,
            JetInput,
            JetInputError,
            JetLabel,
            JetSecondaryButton,
        },

        props: ['user'],

        data() {
            return {
                form: this.$inertia.form({
                    _method: 'PUT',
                    withdraw_address: this.user.withdraw_address,
                })
            }
        },

        methods: {
            updateProfileInformation() {
                if (this.$refs.photo) {
                    this.form.photo = this.$refs.photo.files[0]
                }

                this.form.post(route('user-profile-information.update'), {
                    errorBag: 'updateWithdrawInformation',
                    preserveScroll: true
                });
            }
        },
    })
</script>
