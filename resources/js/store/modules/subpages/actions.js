import axios from "axios";
import router from "@/router/routes.js";

export default {
    async fetchSubpages({ commit }) {
        await router;
        await axios
            .get("/api/subpages/get_all")
            .then(res => {
                commit("subpages", res.data);

                commit(
                    "currentSubpage",
                    res.data.find(
                        subpage => subpage.page == router.history.current.path
                    )
                );
            })
            .catch(err => console.log(err));
    }
};
