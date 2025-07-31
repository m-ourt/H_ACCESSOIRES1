<script setup>
import { Head, Link, useForm } from '@inertiajs/vue3';
import AuthenticationCard from '@/Components/AuthenticationCard.vue';
import AuthenticationCardLogo from '@/Components/AuthenticationCardLogo.vue';
import Checkbox from '@/Components/Checkbox.vue';
import InputError from '@/Components/InputError.vue';
import InputLabel from '@/Components/InputLabel.vue';
import PrimaryButton from '@/Components/PrimaryButton.vue';
import TextInput from '@/Components/TextInput.vue';

const form = useForm({
    nom: '',
    prenom: '',
    telephone: '',
    adress: '',
    ville: '',
    code_postale: '',
    email: '',
    password: '',
    password_confirmation: '',
    terms: false,
});

const submit = () => {
    form.post(route('register'), {
        onFinish: () => form.reset('password', 'password_confirmation'),
    });
};
</script>

<template b>
    <Head title="Register" />

    <AuthenticationCard>
        <template #logo >
            <AuthenticationCardLogo />
        </template>

        <form @submit.prevent="submit">
            <div>
                <InputLabel for="nom" value="Nom *"  />
                <TextInput
                    id="nom"
                    v-model="form.nom"
                    type="text"
                    class="mt-1 block w-full"
                    required
                    autofocus
                    autocomplete="nom"
                />
                <InputError class="mt-2" :message="form.errors.nom" />
            </div>

             <div class="mt-4">
                <InputLabel for="prenom" value="Prénom *" />
                <TextInput
                    id="prenom"
                    v-model="form.prenom"
                    type="text"
                    class="mt-1 block w-full"
                    required
                    autocomplete="prenom"
                />
                <InputError class="mt-2" :message="form.errors.prenom" />
            </div>

            <div class="mt-4">
                <InputLabel for="telephone" value="Téléphone *" />
                <TextInput
                    id="telephone"
                    v-model="form.telephone"
                    type="text"
                    class="mt-1 block w-full"
                    required
                    autocomplete="telephone"
                />
                <InputError class="mt-2" :message="form.errors.telephone" />
            </div>

            <div class="mt-4">
                <InputLabel for="adress" value="Adress *" />
                <TextInput
                    id="adress"
                    v-model="form.adress"
                    type="text"
                    class="mt-1 block w-full"
                    required
                    autocomplete="adress"
                />
                <InputError class="mt-2" :message="form.errors.adress" />
            </div>

            <div class="mt-4">
                <InputLabel for="ville" value="Ville *" />
                <TextInput
                    id="ville"
                    v-model="form.ville"
                    type="text"
                    class="mt-1 block w-full"
                    required
                    autocomplete="ville"
                />
                <InputError class="mt-2" :message="form.errors.ville" />
            </div>
            <div class="mt-4">
                <InputLabel for="code_postale" value="Code Postale *" />
                <TextInput
                    id="code_postale"
                    v-model="form.code_postale"
                    type="text"
                    class="mt-1 block w-full"
                    required
                    autocomplete="code_postale"
                />
                <InputError class="mt-2" :message="form.errors.code_postale" />
            </div>
            <div class="mt-4">
                <InputLabel for="email" value="Email *" />
                <TextInput
                    id="email"
                    v-model="form.email"
                    type="email"
                    class="mt-1 block w-full"
                    required
                    autocomplete="username"
                />
                <InputError class="mt-2" :message="form.errors.email" />
            </div>

            <div class="mt-4">
                <InputLabel for="password" value="Password *" />
                <TextInput
                    id="password"
                    v-model="form.password"
                    type="password"
                    class="mt-1 block w-full"
                    required
                    autocomplete="new-password"
                />
                <InputError class="mt-2" :message="form.errors.password" />
            </div>

            <div class="mt-4">
                <InputLabel for="password_confirmation" value="Confirm Password *" />
                <TextInput
                    id="password_confirmation"
                    v-model="form.password_confirmation"
                    type="password"
                    class="mt-1 block w-full"
                    required
                    autocomplete="new-password"
                />
                <InputError class="mt-2" :message="form.errors.password_confirmation" />
            </div>

            <div v-if="$page.props.jetstream.hasTermsAndPrivacyPolicyFeature" class="mt-4">
                <InputLabel for="terms">
                    <div class="flex items-center">
                        <Checkbox id="terms" v-model:checked="form.terms" name="terms" required />

                        <div class="ml-2">
                            I agree to the <a target="_blank" :href="route('terms.show')" class="underline text-sm text-gray-600 dark:text-gray-400 hover:text-gray-900 dark:hover:text-gray-100 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 dark:focus:ring-offset-gray-800">Terms of Service</a> and <a target="_blank" :href="route('policy.show')" class="underline text-sm text-gray-600 dark:text-gray-400 hover:text-gray-900 dark:hover:text-gray-100 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 dark:focus:ring-offset-gray-800">Privacy Policy</a>
                        </div>
                    </div>
                    <InputError class="mt-2" :message="form.errors.terms" />
                </InputLabel>
            </div>

            <div class="flex items-center justify-end mt-4">
                <Link :href="route('login')" class="underline text-sm text-gray-600 dark:text-gray-400 hover:text-gray-900 dark:hover:text-gray-100 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 dark:focus:ring-offset-gray-800">
                    Avez-vous déjà un compte ?
                </Link>

                <PrimaryButton class="ml-4" :class="{ 'opacity-25': form.processing }" :disabled="form.processing">
                    S'inscrire
                </PrimaryButton>
            </div>
        </form>
    </AuthenticationCard>
</template>
