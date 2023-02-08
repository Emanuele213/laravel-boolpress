<template>
    <Page404 v-if="is404"/>
    <div v-else-if="objPost" class="container text-center">
        <h1 class="text-uppercase">{{ objPost.title }}</h1>
        <h2 class="my-3">Nella categoria: {{ objPost.category.name }}</h2>
        <div class="tags mb-2">
            <span v-for="tag in objPost.tags" :key="tag.id" class="tag">{{ tag.name }}</span>
        </div>
        <img :src="objPost.image" :alt="objPost.title">
        <p class="text_justify my-3">
            {{ objPost.content }}
        </p>
        <router-link :to="{ name:'postsIndex' }" class="btn btn-primary my-4">Torna ai post</router-link>
    </div>
    <div v-else class="loader_container">
        <div class="progress"></div>
    </div>
</template>

<script>
import Page404 from './Page404.vue';
// TODO: gestire la 404 dei post non esistenti
export default {
    components: [
        Page404,
    ],
    props: [
        'slug',
    ],
    data() {
        return {
            is404: false,
            objPost: null,
        }
    },
    created() {
        setTimeout(() => {
            axios.get('/api/posts/' + this.slug)
                .then(response => {
                    if (response.data.success) {
                        this.objPost = response.data.results
                    }else {
                        this.is404 = true;
                    }
                });
        }, 1.4 * 1000);
    }
}
</script>

<style lang="scss" scoped>
    .tag {
        display: inline-block;
        margin: .3em;
        padding: .4em .6em;
        border-radius: 10em;
        background-color: greenyellow;
    }

    .text_justify {
        text-align: justify;
    }

    .loader_container {
        display: flex;
        justify-content: center;
        align-items: center;
        height: 90vh;
    }

    .progress {
   width: 134.4px;
   height: 24.6px;
   border-radius: 22.4px;
   color: #474bff;
   border: 2.2px solid;
   position: relative;
    }

    .progress::before {
        content: "";
        position: absolute;
        margin: 2.2px;
        inset: 0 100% 0 0;
        border-radius: inherit;
        background: currentColor;
        animation: progress-pf82op 2s infinite;
    }

    @keyframes progress-pf82op {
        100% {
            inset: 0;
        }
    }

</style>
