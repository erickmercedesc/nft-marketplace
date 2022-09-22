<template>
    <app-layout title="Create NFT">
        <jet-form-section @submitted="storeToken()">
            <template #form>
                <!-- Token Image -->
                <div class="col-span-6 sm:col-span-4">
                    <!-- Token Image File Input -->
                    <input type="file" class="hidden"
                                ref="image"
                                @change="updatePhotoPreview">

                    <jet-label for="image" value="Image" />

                    <!-- New Profile Photo Preview -->
                    <div class="mt-2" v-show="photoPreview">
                        <span class="block w-36 h-36 bg-cover bg-no-repeat bg-center"
                            :style="'background-image: url(\'' + photoPreview + '\');'">
                        </span>
                    </div>

                    <jet-secondary-button class="mt-2 mr-2" type="button" @click.prevent="selectNewPhoto">
                        Select A New Image
                    </jet-secondary-button>

                    <jet-input-error :message="form.errors.image" class="mt-2" />
                </div>       

                <div class="col-span-6 sm:col-span-4">
                    <jet-label for="name" value="Name" />
                    <jet-input id="name" type="text" class="mt-1 block w-full" v-model="form.name" ref="name" />
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
                    Create
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
            total_referals: Number,
            total_active_referals: Number,
            total_earning: Number,
            referers: Array
        },

        data() {
            return {
                photoPreview: null,
                form: this.$inertia.form({
                    image: '',
                    name: '',
                    creator: '',                    
                    price: ''
                }),
            }
        },
        
        methods: {
            storeToken() {
                if (this.$refs.image) {
                    this.form.image = this.$refs.image.files[0]
                }

                this.form.post(route('tokens.store'));
            },

            selectNewPhoto() {
                this.$refs.image.click();
            },

            updatePhotoPreview() {
                const photo = this.$refs.image.files[0];

                if (! photo) return;

                const reader = new FileReader();

                reader.onload = (e) => {
                    this.photoPreview = e.target.result;
                };

                reader.readAsDataURL(photo);
            },            
        }
    })
</script>
