<template>
    <form
        action="/api/leads"
        method="post"
        class="row g-3 needs-validation"
        novalidate
        @submit.prevent="submitData"
    >
        <h1>Contattaci</h1>
        <div class="mb-3">
            <label for="name" class="form-label">Nome</label>
            <input
                type="text"
                class="form-control"
                :class="{'is-invalid': errors && errors.name}"
                id="name"
                name="name"
                v-model="name"
            >
            <div class="invalid-feedback">
                <ul v-if="errors && errors.name">
                    <li v-for="error in errors.name" :key="error">
                        {{ error }}
                    </li>
                </ul>
            </div>
        </div>

        <div class="mb-3">
            <label for="email" class="form-label">Email</label>
            <input
                type="email"
                class="form-control"
                :class="{'is-invalid': errors && errors.email}"
                id="email"
                name="email"
                v-model="email"
            >
            <div class="invalid-feedback">
                <ul v-if="errors && errors.email">
                    <li v-for="error in errors.email" :key="error">
                        {{ error }}
                    </li>
                </ul>
            </div>
        </div>

        <div class="mb-3">
            <div class="form-check">
                <input class="form-check-input" :class="{'is-invalid': errors && errors.newsletter}" type="checkbox" id="newsletter" name="newsletter" v-model="newsletter">
                <label class="form-check-label" for="newsletter">
                    Iscrivimi alla newsletter
                </label>
                <div class="invalid-feedback">
                    <ul v-if="errors && errors.newsletter">
                        <li v-for="error in errors.newsletter" :key="error">
                            {{ error }}
                        </li>
                    </ul>
                </div>
            </div>
        </div>

        <div class="mb-3">
            <label for="message" class="form-label">Messaggio</label>
            <textarea class="form-control" :class="{'is-invalid': errors && errors.message}" id="message" name="message" v-model="message"></textarea>
            <div class="invalid-feedback">
                <ul v-if="errors && errors.message">
                    <li v-for="error in errors.message" :key="error">
                        {{ error }}
                    </li>
                </ul>
            </div>
        </div>

        <div class="col-12">
            <button class="btn btn-primary" type="submit">Invia</button>
        </div>
    </form>
</template>

<script>
export default {
    data() {
        return {
            errors: null,
            name: '',
            email: '',
            newsletter: true,
            message: '',
        }
    },
    methods: {
        submitData() {
            this.errors = null;
            axios.post('/api/leads', {
                name: this.name,
                email: this.email,
                newletter: this.newletter,
                message: this.message
            }).then(response => {
                if (response.data.success) {
                    this.resetForm()
                    //TODO: Mostrare messaggio di successo
                }else {
                    this.errors = response.data.errors;
                }

            });
        },
        resetForm() {
            this.name= '';
            this.email= '';
            this.newsletter = '';
            this.message= '';
        }
    }
}
</script>

<style>

</style>
