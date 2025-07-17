<script setup>
import { ref } from 'vue';
import { Link, router, useForm } from '@inertiajs/vue3';
import ActionMessage from '@/Components/ActionMessage.vue';
import FormSection from '@/Components/FormSection.vue';
import InputError from '@/Components/InputError.vue';
import InputLabel from '@/Components/InputLabel.vue';
import PrimaryButton from '@/Components/PrimaryButton.vue';
import SecondaryButton from '@/Components/SecondaryButton.vue';
import TextInput from '@/Components/TextInput.vue';

const props = defineProps({
    user: Object,
    mustVerifyEmail: Boolean,
    status: String,
});

const form = useForm({
    _method: 'PUT',
    name: props.user.name,
    email: props.user.email,
    phone: props.user.phone || '',
    address: props.user.address || '',
    ville: props.user.ville || '',
    code_postal: props.user.code_postal || '',
    photo: null,
});


const verificationLinkSent = ref(null);
const photoPreview = ref(null);
const photoInput = ref(null);

const updateProfileInformation = () => {
    if (photoInput.value) {
        form.photo = photoInput.value.files[0];
    }

    form.post(route('profile.update'), {
        errorBag: 'updateProfileInformation',
        preserveScroll: true,
        onSuccess: () => clearPhotoFileInput(),
    });
};

const sendEmailVerification = () => {
    verificationLinkSent.value = true;
};

const selectNewPhoto = () => {
    photoInput.value.click();
};

const updatePhotoPreview = () => {
    const photo = photoInput.value.files[0];

    if (! photo) return;

    const reader = new FileReader();

    reader.onload = (e) => {
        photoPreview.value = e.target.result;
    };

    reader.readAsDataURL(photo);
};

const deletePhoto = () => {
    router.delete(route('current-user-photo.destroy'), {
        preserveScroll: true,
        onSuccess: () => {
            photoPreview.value = null;
            clearPhotoFileInput();
        },
    });
};

const clearPhotoFileInput = () => {
    if (photoInput.value?.value) {
        photoInput.value.value = null;
    }
};
</script>

<template>
    <FormSection @submitted="updateProfileInformation">
        <template #title>
            Informations de profil
        </template>

        <template #description>
            Mettez à jour les informations de profil et l'adresse e-mail de votre compte.
        </template>

        <template #form>
            <!-- Profile Photo -->
            <div v-if="$page.props.jetstream.managesProfilePhotos" class="col-span-6 sm:col-span-4">
                <!-- Profile Photo File Input -->
                <input
                    ref="photoInput"
                    type="file"
                    class="hidden"
                    @change="updatePhotoPreview"
                >

                <InputLabel for="photo" value="Photo" />

                <!-- Current Profile Photo -->
                <div v-show="! photoPreview" class="mt-2">
                    <img :src="user.profile_photo_url" :alt="user.name" class="rounded-full h-20 w-20 object-cover">
                </div>

                <!-- New Profile Photo Preview -->
                <div v-show="photoPreview" class="mt-2">
                    <span
                        class="block rounded-full w-20 h-20 bg-cover bg-no-repeat bg-center"
                        :style="'background-image: url(\'' + photoPreview + '\');'"
                    />
                </div>

                <SecondaryButton class="mt-2 mr-2" type="button" @click.prevent="selectNewPhoto">
                   Sélectionner une nouvelle photo
                </SecondaryButton>

                <SecondaryButton
                    v-if="user.profile_photo_path"
                    type="button"
                    class="mt-2"
                    @click.prevent="deletePhoto"
                >
                    Supprimer la photo
                </SecondaryButton>

                <InputError :message="form.errors.photo" class="mt-2" />
            </div>

            <!-- Name -->
            <div class="col-span-6 sm:col-span-4">
                <InputLabel for="name" value="Name" />
                <TextInput
                    id="name"
                    v-model="form.name"
                    type="text"
                    class="mt-1 block w-full"
                    autocomplete="name"
                />
                <InputError :message="form.errors.name" class="mt-2" />
            </div>

            <!-- Email -->
            <div class="col-span-6 sm:col-span-4">
                <InputLabel for="email" value="Email" />
                <TextInput
                    id="email"
                    v-model="form.email"
                    type="email"
                    class="mt-1 block w-full"
                    autocomplete="username"
                />
                <InputError :message="form.errors.email" class="mt-2" />

                <div v-if="$page.props.jetstream.hasEmailVerification && user.email_verified_at === null">
                    <p class="text-sm mt-2 dark:text-white">
                        Votre adresse e-mail n'est pas vérifiée.
                        <Link
                            :href="route('verification.send')"
                            method="post"
                            as="button"
                            class="underline text-sm text-gray-600 dark:text-gray-400 hover:text-gray-900 dark:hover:text-gray-100 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 dark:focus:ring-offset-gray-800"
                            @click.prevent="sendEmailVerification"
                        >
                           Cliquez ici pour renvoyer l'e-mail de vérification.
                        </Link>
                    </p>

                    <div v-show="verificationLinkSent" class="mt-2 font-medium text-sm text-green-600 dark:text-green-400">
Un nouveau lien de vérification a été envoyé à votre adresse email.                    </div>
                </div>
            </div>
            <!-- Phone -->
             <div class="col=span=6 sm:col-span-4">
                <InputLabel for="phone" value ="Téléphone" />
                <TextInput
                    id="phone"
                    v-model="form.phone "
                    type="tel"
                    class="mt-1 block w-full"
                    autocomplete="tel"
                />
                <InputError :message="form.errors.phone" class="mt-2" />
            </div>
            <div class="col-span-6 sm:col-span-4">
            <InputLabel for="address" value="Adresse" />
            <TextInput
                id="address"
                v-model="form.address"
                type="text"
                class="mt-1 block w-full"
                autocomplete="street-address"
            />
            <InputError :message="form.errors.address" class="mt-2" />
        </div>
        <!-- Ville -->
        <div class="col-span-6 sm:col-span-2">
            <InputLabel for="ville" value="Ville" />
            <TextInput
                id="ville"
                v-model="form.ville"
                type="text"
                class="mt-1 block w-full"
                autocomplete="address-level2"
            />
            <InputError :message="form.errors.ville" class="mt-2" />

        </div>
        <!-- Code Postal -->
        <div class="col-span-6 sm:col-span-2">
            <InputLabel for="code_postal" value="Code Postal" />
            <TextInput
                id="code_postal"
                v-model="form.code_postal"
                type="text"
                class="mt-1 block w-full"
                autocomplete="code-postal"
            />
            <InputError :message="form.errors.code_postal" class="mt-2" />

        </div>
        </template>

        <template #actions>
            <ActionMessage :on="form.recentlySuccessful" class="mr-3">
                Enregistré.
            </ActionMessage>

            <PrimaryButton :class="{ 'opacity-25': form.processing }" :disabled="form.processing">
                Enregistrer
            </PrimaryButton>
        </template>
    </FormSection>
</template>
