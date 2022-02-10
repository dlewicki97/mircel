<template>
    <section class="main">
        <Slider />
        <About />
        <Services />
        <SolarSystem />
        <ExecutionProcess />
        <Attributes />
        <CallUs />
        <Opinions />
    </section>
</template>

<script>
import url from "@/helpers/photo/url";
import Slider from "@/components/pages/main/Slider";
import About from "@/components/pages/main/About";
import Services from "@/components/pages/main/Services";
import SolarSystem from "@/components/pages/main/SolarSystem";
import ExecutionProcess from "@/components/pages/main/ExecutionProcess";
import Attributes from "@/components/pages/main/Attributes";
import CallUs from "@/components/pages/main/CallUs";
import Opinions from "@/components/pages/main/Opinions.vue";

export default {
    components: {
        Slider,
        About,
        Attributes,
        CallUs,
        ExecutionProcess,
        SolarSystem,
        Services,
        Opinions
    },
    methods: {
        url
    }
};
</script>

<style lang="scss" scoped></style>
