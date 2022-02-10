export default {
	subpages: state => state.subpages.sort((a,b) => (a.order > b.order) ? 1 : ((b.order > a.order) ? -1 : 0)),
	currentSubpage: state => state.currentSubpage
}