import Subpages from "../components/emit-data-blocks/Subpages";
import Mails from "../components/emit-data-blocks/Mails";
import Settings from "@/components/emit-data-blocks/Settings";
import Contact from "@/components/emit-data-blocks/Contact";
import SnackbarAlerts from "@/components/emit-data-blocks/SnackbarAlerts";
import ServiceCategories from "@/components/emit-data-blocks/ServiceCategories";
import ServicesAttributes from "@/components/emit-data-blocks/ServicesAttributes";
import ContactLinks from "@/components/emit-data-blocks/ContactLinks";
import Services from "@/components/emit-data-blocks/Services";

import Slider from "@/components/pages/main/Slider";
import About from "@/components/pages/main/About";
import HomeServices from "@/components/pages/main/Services";
import HomeSolarSystem from "@/components/pages/main/SolarSystem";
import HomeCallUs from "@/components/pages/main/CallUs";
import Attributes from "@/components/pages/main/Attributes";
import Opinions from "@/components/pages/main/Opinions";
import ExecutionProcess from "@/components/pages/main/ExecutionProcess";
import ServicesCallUs from "@/components/pages/services/CallUs";
import SolarSystemsCallUs from "@/components/pages/solarSystems/CallUs";
import Realizations from "@/views/public/Realizations";
import SolarSystems from "@/views/public/SolarSystems";

export default {
    main: [
        {
            title: "Slider",
            component: Slider,
            tablename: "slider",
            table: [],
            multiple: true,
            removable: true,
            gallery: false,
            active: true,
            home_page: false
        },
        {
            title: "Sekcja pod sliderem",
            component: About,
            tablename: "about",
            table: [],
            multiple: false,
            removable: false,
            gallery: false,
            active: false,
            home_page: false
        },
        {
            title: "Opisy sekcji usług",
            component: HomeServices,
            tablename: "home_services_desc",
            table: [{ id: 1, title: "Opisy" }],
            multiple: false,
            removable: false,
            gallery: false,
            active: false,
            home_page: false
        },
        {
            title: "Opisy sekcji fotowoltaiki",
            component: HomeSolarSystem,
            tablename: "home_solar_system_desc",
            table: [{ id: 1, title: "Opisy" }],
            multiple: false,
            removable: false,
            gallery: false,
            active: false,
            home_page: false
        },
        {
            title: "Proces wykonania usługi",
            component: ExecutionProcess,
            tablename: "execution_process",
            table: [],
            multiple: false,
            removable: false,
            gallery: false,
            active: false
        },
        {
            title: "Proces wykonania usługi opisy",
            component: null,
            tablename: "execution_process_desc",
            table: [{ id: 1, title: "Opisy" }],
            multiple: false,
            removable: false,
            gallery: false,
            active: false
        },
        {
            title: "Nasze wartości",
            component: Attributes,
            tablename: "attributes",
            table: [],
            multiple: true,
            removable: true,
            gallery: false,
            active: false
        },
        {
            title: "Nasze wartości opisy",
            component: null,
            tablename: "attributes_desc",
            table: [{ id: 1, title: "Opisy" }],
            multiple: false,
            removable: false,
            gallery: false,
            active: false
        },
        {
            title: "Masz pytania? Zadzwoń!",
            component: HomeCallUs,
            tablename: "home_call_us",
            table: [{ id: 1, title: "Opisy" }],
            multiple: false,
            removable: false,
            gallery: false,
            active: false
        },
        {
            title: "Opinie",
            component: Opinions,
            tablename: "opinions",
            table: [],
            multiple: true,
            removable: true,
            gallery: false,
            active: false
        },
        {
            title: "Opinie Opisy",
            component: null,
            tablename: "opinions_desc",
            table: [{ id: 1, title: "Opisy" }],
            multiple: false,
            removable: false,
            gallery: false,
            active: false
        }
    ],
    realizations: [
        {
            title: "Realizacje",
            component: Realizations,
            tablename: "realizations",
            table: [{ id: 1, title: "Galeria" }],
            multiple: false,
            removable: false,
            gallery: true,
            active: false,
            home_page: false,
            non_editable: true
        }
    ],
    services: [
        {
            title: "Kategorie usług",
            component: ServiceCategories,
            tablename: "service_categories",
            table: [],
            multiple: true,
            removable: true,
            gallery: false,
            home_page: false
        },
        {
            title: "Usługi",
            component: Services,
            tablename: "services",
            table: [],
            multiple: true,
            removable: true,
            gallery: true,
            home_page: true
        },
        {
            title: "Usługi opisy",
            component: null,
            tablename: "services_page_desc",
            table: [{ id: 1, title: "Opisy" }],
            multiple: false,
            removable: false,
            gallery: false,
            home_page: false
        },
        {
            title: "Usługi atrybuty",
            component: ServicesAttributes,
            tablename: "services_attributes",
            table: [],
            multiple: true,
            removable: true,
            gallery: false,
            home_page: false
        },
        {
            title: "Zadzwoń zapytaj",
            component: ServicesCallUs,
            tablename: "services_call_us",
            table: [{ id: 1, title: "Opisy" }],
            multiple: false,
            removable: false,
            gallery: false,
            home_page: false
        }
    ],

    solar_system: [
        {
            title: "Fotowoltaika",
            component: SolarSystems,
            tablename: "solar_system",
            table: [{ id: 1, title: "Opisy" }],
            multiple: false,
            removable: false,
            gallery: false,
            active: false,
            home_page: false,
            order: false
        },
        {
            title: "Zadzwoń i zapytaj!",
            component: SolarSystemsCallUs,
            tablename: "solar_system_call_us",
            table: [{ id: 1, title: "Opisy" }],
            multiple: false,
            removable: false,
            gallery: false,
            active: false,
            home_page: false,
            order: false
        }
    ],
    contact: [
        {
            title: "Kontakt linki",
            component: ContactLinks,
            tablename: "contact_links",
            table: [],
            multiple: true,
            removable: true,
            gallery: false,
            active: false,
            home_page: false,
            order: false
        }
    ],
    subpages: [
        {
            title: "Podstrony",
            component: Subpages,
            tablename: "subpages",
            table: [],
            multiple: false,
            removable: false,
            gallery: false,
            active: true,
            home_page: false,
            order: false
        }
    ],

    descriptions: [
        {
            title: "Komunikaty (pomarańczowy pasek w prawym dolnym rogu)",
            component: SnackbarAlerts,
            tablename: "snackbar_alerts",
            table: []
        }
    ],

    mails: [
        {
            title: "Skrzynka pocztowa",
            component: Mails,
            tablename: "mails",
            table: [],
            multiple: false,
            removable: true,
            gallery: false,
            active: false,
            home_page: false,
            answer: true,
            add_button_icon: "mdi-email-plus",
            add_button_text: "Napisz wiadomość",
            edit_button_icon: "mdi-eye",
            edit_button_text: "Pokaż"
        }
    ],

    settings: [
        {
            title: "Ustawienia",
            component: Settings,
            tablename: "settings",
            table: [],
            multiple: false,
            removable: false
        },
        {
            title: "Dane Kontaktowe",
            component: Contact,
            tablename: "contact",
            table: [],
            multiple: false,
            removable: false
        }
    ]
};
