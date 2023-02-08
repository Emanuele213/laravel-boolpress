<template>
    <div>
        <div class="grid" v-if="arrRandom">
            <div v-for="post in arrRandom" :key="post.id" class="tile">
                <router-link :to="{name: 'postsShow', params: {slug: post.slug}}">
                    <img :src="post.image" :alt="post.title">
                </router-link>
            </div>
        </div>
        <div v-else class="loader_container">
            <div class="spinner">
                <div></div>
                <div></div>
                <div></div>
                <div></div>
                <div></div>
                <div></div>
            </div>
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
        setTimeout(() => {
            axios.get('/api/posts/random')
                .then(response => this.arrRandom = response.data.results);
        }, 1.4 * 1000);
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

    .loader_container {
        display: flex;
        justify-content: center;
        align-items: center;
        height: 90vh;
    }

    .spinner {
   width: 44.8px;
   height: 44.8px;
   animation: spinner-y0fdc1 2s infinite ease;
   transform-style: preserve-3d;
    }

    .spinner > div {
    background-color: rgba(71,78,255,0.2);
    height: 100%;
    position: absolute;
    width: 100%;
    border: 2.2px solid #474eff;
    }

    .spinner div:nth-of-type(1) {
    transform: translateZ(-22.4px) rotateY(180deg);
    }

    .spinner div:nth-of-type(2) {
    transform: rotateY(-270deg) translateX(50%);
    transform-origin: top right;
    }

    .spinner div:nth-of-type(3) {
    transform: rotateY(270deg) translateX(-50%);
    transform-origin: center left;
    }

    .spinner div:nth-of-type(4) {
    transform: rotateX(90deg) translateY(-50%);
    transform-origin: top center;
    }

    .spinner div:nth-of-type(5) {
    transform: rotateX(-90deg) translateY(50%);
    transform-origin: bottom center;
    }

    .spinner div:nth-of-type(6) {
    transform: translateZ(22.4px);
    }

    @keyframes spinner-y0fdc1 {
    0% {
        transform: rotate(45deg) rotateX(-25deg) rotateY(25deg);
    }

    50% {
        transform: rotate(45deg) rotateX(-385deg) rotateY(25deg);
    }

    100% {
        transform: rotate(45deg) rotateX(-385deg) rotateY(385deg);
    }
    }
</style>
