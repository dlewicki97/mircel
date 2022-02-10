import Vue from "vue";
import Vuex from "vuex";
import Snackbar from "./modules/snackbar";
import Auth from "./modules/auth";
import Users from "./modules/users";
import Subpages from "./modules/subpages";
import Loading from "./modules/loading";
import Cart from "./modules/cart";
import Settings from "./modules/settings";
import Contact from "./modules/contact";
import SnackbarAlerts from "./modules/snackbar_alerts";
import ValidationRules from "./modules/validation_rules";
import CartDescriptions from "./modules/cart_descriptions";
import ShopDescriptions from "./modules/shop_descriptions";
import Slider from "./modules/slider/sliderModule";
import Realizations from "./modules/realizations/realizationsModule";
import About from "./modules/about/aboutModule";
import Service from "./modules/service/serviceModule";
import Services from "./modules/services/servicesModule";
import ServiceCategories from "./modules/serviceCategories/serviceCategoriesModule";
import ServicesServiceCategories from "./modules/servicesServiceCategories/servicesServiceCategoriesModule";
import CurrentServiceCategories from "./modules/currentServiceCategories/currentServiceCategoriesModule";
import HomeServices from "./modules/homeServices/homeServicesModule";
import HomeServiceDesc from "@/store/modules/homeServiceDesc/homeServiceDescModule";
import HomeServicesDesc from "@/store/modules/homeServicesDesc/homeServicesDescModule.js";
import HomeSolarSystemDesc from "@/store/modules/homeSolarSystemDesc/homeSolarSystemDescModule.js";
import ExecutionProcess from "@/store/modules/executionProcess/executionProcessModule.js";
import ExecutionProcessDesc from "@/store/modules/executionProcessDesc/executionProcessDescModule.js";
import Attributes from "@/store/modules/attributes/attributesModule.js";
import AttributesDesc from "@/store/modules/attributesDesc/attributesDescModule.js";
import HomeCallUs from "@/store/modules/homeCallUs/homeCallUsModule.js";
import Opinions from "@/store/modules/opinions/opinionsModule.js";
import OpinionsDesc from "@/store/modules/opinionsDesc/opinionsDescModule.js";
import ServicesPageDesc from "@/store/modules/servicesPageDesc/servicesPageDescModule.js";
import ServicesAttributes from "@/store/modules/servicesAttributes/servicesAttributesModule.js";
import ServicesCallUs from "@/store/modules/servicesCallUs/servicesCallUsModule.js";
import SolarSystem from "@/store/modules/solarSystem/solarSystemModule.js";
import SolarSystemCallUs from "@/store/modules/solarSystemCallUs/solarSystemCallUsModule.js";
import ContactLinks from "@/store/modules/contactLinks/contactLinksModule.js";


Vue.use(Vuex);


export default new Vuex.Store({
            modules: {
                Snackbar,
				ServiceCategories,
				HomeServices,
				ServicesServiceCategories,
				CurrentServiceCategories,
				Service,
				Services,
				About,
				Auth,
				Users,
				Subpages,
				Loading,
				Cart,
				Settings,
				Contact,
				SnackbarAlerts,
				ValidationRules,
				CartDescriptions,
				ShopDescriptions,
				Slider,
				Realizations,
				HomeServiceDesc,
				HomeServicesDesc,
				HomeSolarSystemDesc,
				ExecutionProcess,
				ExecutionProcessDesc,
				Attributes,
				AttributesDesc,
				HomeCallUs,
				Opinions,
				OpinionsDesc,
				ServicesPageDesc,
				ServicesAttributes,
				ServicesCallUs,
				SolarSystem,
				SolarSystemCallUs,
				ContactLinks
            }
        });