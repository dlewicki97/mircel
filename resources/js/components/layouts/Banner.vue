<template>
    <section
        v-if="title"
        class="banner"
        v-lazy:background-image="`${origin}/storage/media/${photo}`"
    >
        <div class="mask"></div>
        <div class="content">
            {{ title }}
        </div>
    </section>
</template>

<script>
export default {
    data() {
        return {
            origin: window.location.origin
        };
    },
    computed: {
        currentSubpage() {
            return this.$store.getters.currentSubpage;
        },
        title() {
            return this.currentSubpage?.title;
        },
        photo() {
            return this.currentSubpage?.photo;
        }
    }
};
</script>

<style lang="scss" scoped>
section.banner {
    background-size: cover;
    background-position: center;
    background-repeat: no-repeat;
    width: 100%;
    position: relative;
    .mask {
        background: transparent
            linear-gradient(90deg, #000000 -5%, #00000000 41%) 0% 0% no-repeat
            padding-box;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        position: absolute;
        z-index: 1;
    }
    .content {
        color: white;
        font-weight: 700;
        font-size: 2.4rem;
        position: relative;
        z-index: 2;
        padding: 2.7rem var(--global-padding-x-desktop);
        height: 100%;
        display: flex;
        align-items: center;
        @media (max-width: 992px) {
            padding-left: var(--global-padding-x-mobile);
        }
    }
}
</style>
