import Vue from "vue";
import VueRouter from "vue-router";
import Main from "@/views/public/Main";
import Services from "@/views/public/Services";
import SolarSystems from "@/views/public/SolarSystems";
import Realizations from "@/views/public/Realizations";
import Contact from "@/views/public/Contact";
import Service from "@/views/public/Service";
import Home from "@/views/admin/Home";
import SubpagesForm from "@/views/admin/forms/Subpages";
import ServicesForm from "@/views/admin/forms/Services";
import ServiceCategoriesForm from "@/views/admin/forms/ServiceCategories";
import MailsForm from "@/views/admin/forms/Mails";
import MailsAnswerForm from "@/views/admin/forms/MailsAnswer";
import GalleryForm from "@/views/admin/forms/Gallery";
import SettingsForm from "@/views/admin/forms/Settings";
import SliderForm from "@/views/admin/forms/Slider";
import AboutForm from "@/views/admin/forms/About";
import ContactForm from "@/views/admin/forms/Contact";
import LayoutElementsForm from "@/views/admin/forms/LayoutElements";
import SnackbarAlertsForm from "@/views/admin/forms/SnackbarAlerts";
import ValidationRulesForm from "@/views/admin/forms/ValidationRules";
import AdminLogin from "@/views/admin/auth/AdminLogin";
import cmsRoutes from "@/router/cmsRoutes.js";

let newCmsRoutes = cmsRoutes.map(route => ({
    path: route["component-path"],
    component: route["component-name"],
    name: route["route-name"]
}));

Vue.use(VueRouter);

const routes = [
    ...newCmsRoutes,
    { path: "/", component: Main, name: "Main" },
    { path: "/uslugi", component: Services, name: "Services" },
    { path: "/uslugi/:title/:id", component: Service, name: "Service" },
    { path: "/realizacje", component: Realizations, name: "Realizations" },
    { path: "/fotowoltaika", component: SolarSystems, name: "SolarSystems" },
    { path: "/kontakt", component: Contact, name: "Contact" },

    { path: "/admin-panel/login", component: AdminLogin, name: "AdminLogin" },
    { path: "/admin-panel/main", component: Home, name: "AdminHome" },
    { path: "/admin-panel/services", component: Home, name: "AdminServices" },
    { path: "/admin-panel/contact", component: Home, name: "AdminContact" },
    {
        path: "/admin-panel/solar_system",
        component: Home,
        name: "AdminSolarSystem"
    },
    {
        path: "/admin-panel/realizations",
        component: Home,
        name: "AdminRealizations"
    },
    { path: "/admin-panel/subpages", component: Home, name: "AdminSubpages" },
    { path: "/admin-panel/mails", component: Home, name: "AdminMails" },
    { path: "/admin-panel/users", component: Home, name: "AdminUsers" },
    {
        path: "/admin-panel/gallery_page",
        component: Home,
        name: "AdminGalleryPage"
    },
    {
        path: "/admin-panel/settings",
        component: Home,
        name: "AdminSettingsPage"
    },
    {
        path: "/admin-panel/descriptions",
        component: Home,
        name: "AdminDescriptionsPage"
    },

    {
        path: "/admin-panel/settings/form/:id",
        component: SettingsForm,
        name: "SettingsFormEdit"
    },
    {
        path: "/admin-panel/slider/form",
        component: SliderForm,
        name: "SliderForm"
    },
    {
        path: "/admin-panel/slider/form/:id",
        component: SliderForm,
        name: "SliderFormEdit"
    },
    {
        path: "/admin-panel/services/form",
        component: ServicesForm,
        name: "ServicesForm"
    },
    {
        path: "/admin-panel/services/form/:id",
        component: ServicesForm,
        name: "ServicesFormEdit"
    },
    {
        path: "/admin-panel/service_categories/form",
        component: ServiceCategoriesForm,
        name: "ServiceCategoriesForm"
    },
    {
        path: "/admin-panel/service_categories/form/:id",
        component: ServiceCategoriesForm,
        name: "ServiceCategoriesFormEdit"
    },

    {
        path: "/admin-panel/about/form/:id",
        component: AboutForm,
        name: "AboutFormEdit"
    },

    {
        path: "/admin-panel/contact/form/:id",
        component: ContactForm,
        name: "ContactFormEdit"
    },

    {
        path: "/admin-panel/validation_rules/form/:id",
        component: ValidationRulesForm,
        name: "ValidationRulesFormEdit"
    },

    {
        path: "/admin-panel/snackbar_alerts/form/:id",
        component: SnackbarAlertsForm,
        name: "SnackbarAlertsFormEdit"
    },

    {
        path: "/admin-panel/layout_elements/form/:id",
        component: LayoutElementsForm,
        name: "LayoutElementsFormEdit"
    },

    {
        path: "/admin-panel/subpages/form",
        component: SubpagesForm,
        name: "SubpagesForm"
    },
    {
        path: "/admin-panel/subpages/form/:id",
        component: SubpagesForm,
        name: "SubpagesFormEdit"
    },

    {
        path: "/admin-panel/mails/form",
        component: MailsForm,
        name: "MailsForm"
    },
    {
        path: "/admin-panel/mails/form/:id",
        component: MailsAnswerForm,
        name: "MailsFormEdit"
    },

    {
        path: "/admin-panel/:table/gallery/:id",
        component: GalleryForm,
        name: "GalleryForm"
    },

    { path: "*", redirect: "/" }
];

export default new VueRouter({
    routes,
    mode: "history",
    scrollBehavior: function(to) {
        if (to.hash) {
            return {
                selector: to.hash
            };
        } else return { x: 0, y: 0 };
    }
});
