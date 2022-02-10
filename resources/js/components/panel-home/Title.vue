<template>
	<div class="text-center">
		<h2 class="text-center pt-4 font-weight-bold panel-title-header first-color">{{ block.title }}{{ block.parent ? ' - ' + parentData.title : '' }}</h2>
		<router-link v-if="block.parent" :to="`/admin-panel/${block.parent_block}${getParentId}`">
			<v-btn color="error">Wróc</v-btn>
		</router-link>
	</div>
</template>

<script>
	import panelBlocks from '@/data/admin-panel-blocks.js';
	export default {
		props: ['parentData', 'block'],
		computed: {
			getParentId() {
				let parent_id = '';
				panelBlocks[this.block.parent_block].forEach(panelBlock => {
					if(panelBlock.tablename == this.block.parent_block) {
						if(panelBlock.list == 'shop_items') parent_id = `/${this.parentData.category_id}`;
					}
				})
				return parent_id;
			},
		}
	}
</script>

<style scoped>
	.panel-title-header{
		font-size: 3rem;
	}
</style>