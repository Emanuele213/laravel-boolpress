<template>
    <div class="grid">
        <div v-for="post in arrRandom" :key="post.id" class="tile">
            <router-link :to="{name: 'postsShow', params: {slug: post.slug}}">
                <img :src="post.image" :alt="post.title">
            </router-link>
        </div>
    </div>
</template>

<script>
export default {
    data() {
        return {
            arrRandom: null,
        }
    },
    created() {
        axios.get('/api/posts/random')
            .then(response => this.arrRandom = response.data.results);
    }
}
</script>

<style lang="scss" scoped>
    .grid {
        display: flex;
        flex-wrap: wrap;
        justify-content: center;
        height: 70vh;
        margin-top: 3rem;
        gap: 1rem;
    }
    .tile {
        flex: 0 0 calc(100% / 4);
        height: calc(100% / 4);
        border: 2px solid yellowgreen;
    }
    .tile img {
        width: 100%;
        height: 100%;
        object-fit: cover;
    }
</style>
