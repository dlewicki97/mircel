<template>
    <section v-if="homeSolarSystemDesc.id" class="solar-system">
        <img
            class="ellipse"
            v-lazy="`${origin}/storage/img/home/solar-system-ellipse.svg`"
            alt="elipsa"
        />
        <div
            class="bg"
            :title="homeSolarSystemDesc.photo_alt"
            v-lazy:background-image="
                `${origin}/storage/media/${homeSolarSystemDesc.photo}`
            "
        >
            <div class="content">
                <h3 class="section-title">{{ homeSolarSystemDesc.title }}</h3>
                <div
                    class="short-description"
                    v-html="homeSolarSystemDesc.description"
                ></div>
                <router-link :to="{ path: homeSolarSystemDesc.link }">
                    <button class="button second-button">
                        {{ homeSolarSystemDesc.button_name }}
                    </button>
                </router-link>
            </div>
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
        homeSolarSystemDesc() {
            return this.$store.getters.homeSolarSystemDesc;
        }
    },
    created() {
        this.$store.dispatch("homeSolarSystemDesc");
    }
};
</script>

<style lang="scss" scoped>
section.solar-system {
    position: relative;
    z-index: 1;
    margin: 8rem 0;
    padding-bottom: 3rem;
    .ellipse {
        position: absolute;
        z-index: -1;
        top: 50%;
        left: 50%;
        transform: translate(-50%, -50%);
        height: 142%;
    }
    .bg {
        border-radius: var(--global-border-radius);
    }
    .content {
        padding: var(--global-padding-x-desktop);
        width: 50%;
        @media (max-width: 992px) {
            padding-left: var(--global-padding-x-mobile);
            padding-right: var(--global-padding-x-mobile);
            width: 100%;
        }
        .section-title,
        .short-description {
            color: white;
        }
        .short-description {
            line-height: 25px;
            margin-top: 1rem;
            margin-bottom: 3rem;
        }
    }
}
</style>
