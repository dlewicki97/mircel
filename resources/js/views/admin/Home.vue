<template>
    <v-main class="">
        <v-container
            :id="block.tablename"
            :ref="block.tablename"
            v-for="(block, i) in blocks"
            :key="i"
            class="pa-5"
        >
            <v-card raised class="">
                <Title :block="block" :parentData="parentData" />
                <v-divider></v-divider>
                <component
                    style="overflow: hidden;"
                    :reloadFlag="reloadFlag"
                    @parentData="parentData = $event"
                    :is="block.component"
                    @blockDataEmit="setBlockTable(i, $event)"
                    class="panel-component mb-5"
                ></component>
                <Table
                    :headers="headers"
                    :block="block"
                    :i="i"
                    @reloadFlag="reloadFlag = $event"
                />
            </v-card>
        </v-container>
    </v-main>
</template>

<script>
import Table from "@/components/panel-home/Table";
import Title from "@/components/panel-home/Title";
import panelBlocks from "@/data/admin-panel-blocks.js";
import fillBaseHeaders from "@/helpers/panel-table/fill-base-headers.js";

export default {
    data() {
        return {
            blocks: [],
            headers: [],
            parentData: {},
            reloadFlag: false
        };
    },
    components: {
        Table,
        Title
    },
    methods: {
        fillBaseHeaders() {
            this.headers = fillBaseHeaders(this.blocks);
        },
        setBlocks() {
            this.blocks = panelBlocks[this.$route.path.split("/")[2]];
            this.fillBaseHeaders();
        },
        secureRoutes() {
            let user = JSON.parse(localStorage.getItem("user"));
            if (user?.type != "Admin" && user?.type != "Moderator")
                this.$router.push({
                    name: "AdminLogin"
                });
        },
        setBlockTable(index, table) {
            if (table.constructor == Object && Object.entries(table).length > 0)
                table = [table];
            this.blocks[index].table = table;
        }
    },
    watch: {
        $route() {
            this.setBlocks();
        }
    },
    created() {
        this.secureRoutes();
        this.setBlocks();
        this.$store.dispatch("fetchAllUsers");
    }
};
</script>

<style scoped>
.panel-component {
    padding: 0px 80px;
}
</style>
