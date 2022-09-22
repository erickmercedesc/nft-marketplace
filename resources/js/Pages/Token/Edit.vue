<template>
    <app-layout title="NFTs">
        <jet-form-section @submitted="updateToken()">
            <template #title>
                Edit New NFT - {{ token.name }}
            </template>

            <template #form>
                <!-- Token Image -->
                <div class="col-span-6 sm:col-span-4">
                    <!-- Token Image File Input -->
                    <input type="file" class="hidden"
                                ref="image"
                                @change="updatePhotoPreview">

                    <jet-label for="image" value="Image" />

                    <div class="mt-2">
                        <span class="block w-36 h-36 bg-cover bg-no-repeat bg-center"
                            :style="'background-image: url(\'/' + token.image + '\');'">
                        </span>                    
                    </div>
                </div>       

                <div class="col-span-6 sm:col-span-4">
                    <jet-label for="name" value="Name" />
                    <jet-input id="name" type="text" class="mt-1 block w-full bg-gray-300" v-model="form.name" ref="name" :disabled="true" />
                    <jet-input-error :message="form.errors.name" class="mt-2" />
                </div> 

                <div class="col-span-6 sm:col-span-4">
                    <jet-label for="creator" value="Creator" />
                    <jet-input id="creator" type="text" class="mt-1 block w-full" v-model="form.creator" ref="creator" />
                    <jet-input-error :message="form.errors.creator" class="mt-2" />
                </div> 

                <div class="col-span-6 sm:col-span-4">
                    <jet-label for="price" value="Price" />
                    <jet-input id="price" type="text" class="mt-1 block w-full" v-model="form.price" ref="price" />
                    <jet-input-error :message="form.errors.price" class="mt-2" />
                </div>

            </template>

            <template #actions>
                <jet-button :class="{ 'opacity-25': form.processing }" :disabled="form.processing">
                    Update
                </jet-button>

                <jet-button @click.prevent="deleteToken()" type="button" class="bg-red-500 ml-2">
                    Delete
                </jet-button>                
            </template>
        </jet-form-section>
    </app-layout>
</template>

<script>
    import { defineComponent } from 'vue'
    import AppLayout from '@/Layouts/AppLayout.vue'
    import JetButton from '@/Jetstream/Button.vue'
    import JetFormSection from '@/Jetstream/FormSection.vue'
    import JetInput from '@/Jetstream/Input.vue'
    import JetInputError from '@/Jetstream/InputError.vue'
    import JetLabel from '@/Jetstream/Label.vue'
    import JetActionMessage from '@/Jetstream/ActionMessage.vue'
    import JetSecondaryButton from '@/Jetstream/SecondaryButton.vue'

    export default defineComponent({
        components: {
            AppLayout,
            JetActionMessage,
            JetButton,
            JetFormSection,
            JetInput,
            JetInputError,
            JetLabel,
            JetSecondaryButton,
        },

        props: {
            token: Object,
        },

        data() {
            return {
                photoPreview: null,
                form: this.$inertia.form({
                    name: this.token.name,
                    creator: this.token.creator,
                    price: this.token.price,
                    benefit: this.token.benefit,
                }),
            }
        },
        
        methods: {
            updateToken() {
                this.form.put(route('tokens.update', this.token));
            },

            deleteToken() {
                if(confirm('Seguro deseas eliminar este token?')) {
                    this.$inertia.delete(this.route('tokens.destroy', this.token));
                }
            }
        }
    })
</script>
