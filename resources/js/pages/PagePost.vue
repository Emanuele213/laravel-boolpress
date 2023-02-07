<template>
    <div v-if="objPost" class="container text-center">
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
</template>

<script>
// TODO: gestire la 404 dei post non esistenti
export default {
    props: [
        'slug',
    ],
    data() {
        return {
            objPost: null,
        }
    },
    created() {
        axios.get('/api/posts/' + this.slug)
            .then(response => this.objPost = response.data.results);
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
</style>
