import HomeServicesDesc from "@/views/admin/forms/HomeServicesDesc.vue";
import HomeSolarSystemDesc from "@/views/admin/forms/HomeSolarSystemDesc.vue";
import ExecutionProcess from "@/views/admin/forms/ExecutionProcess.vue";
import ExecutionProcessDesc from "@/views/admin/forms/ExecutionProcessDesc.vue";
import Attributes from "@/views/admin/forms/Attributes.vue";
import AttributesDesc from "@/views/admin/forms/AttributesDesc.vue";
import HomeCallUs from "@/views/admin/forms/HomeCallUs.vue";
import Opinions from "@/views/admin/forms/Opinions.vue";
import OpinionsDesc from "@/views/admin/forms/OpinionsDesc.vue";
import ServicesPageDesc from "@/views/admin/forms/ServicesPageDesc.vue";
import ServicesAttributes from "@/views/admin/forms/ServicesAttributes.vue";
import ServicesCallUs from "@/views/admin/forms/ServicesCallUs.vue";
import SolarSystem from "@/views/admin/forms/SolarSystem.vue";
import SolarSystemCallUs from "@/views/admin/forms/SolarSystemCallUs.vue";
import ContactLinks from "@/views/admin/forms/ContactLinks.vue";

export default [
    {
        "component-path": "/admin-panel/home_services_desc/form",
        "component-name": HomeServicesDesc,
        "route-name": "HomeServicesDesc"
    },
    {
        "component-path": "/admin-panel/home_services_desc/form/:id",
        "component-name": HomeServicesDesc,
        "route-name": "HomeServicesDescEdit"
    },
    {
        "component-path": "/admin-panel/home_solar_system_desc/form",
        "component-name": HomeSolarSystemDesc,
        "route-name": "HomeSolarSystemDesc"
    },
    {
        "component-path": "/admin-panel/home_solar_system_desc/form/:id",
        "component-name": HomeSolarSystemDesc,
        "route-name": "HomeSolarSystemDescEdit"
    },
    {
        "component-path": "/admin-panel/execution_process/form",
        "component-name": ExecutionProcess,
        "route-name": "ExecutionProcess"
    },
    {
        "component-path": "/admin-panel/execution_process/form/:id",
        "component-name": ExecutionProcess,
        "route-name": "ExecutionProcessEdit"
    },
    {
        "component-path": "/admin-panel/execution_process_desc/form",
        "component-name": ExecutionProcessDesc,
        "route-name": "ExecutionProcessDesc"
    },
    {
        "component-path": "/admin-panel/execution_process_desc/form/:id",
        "component-name": ExecutionProcessDesc,
        "route-name": "ExecutionProcessDescEdit"
    },
    {
        "component-path": "/admin-panel/attributes/form",
        "component-name": Attributes,
        "route-name": "Attributes"
    },
    {
        "component-path": "/admin-panel/attributes/form/:id",
        "component-name": Attributes,
        "route-name": "AttributesEdit"
    },
    {
        "component-path": "/admin-panel/attributes_desc/form",
        "component-name": AttributesDesc,
        "route-name": "AttributesDesc"
    },
    {
        "component-path": "/admin-panel/attributes_desc/form/:id",
        "component-name": AttributesDesc,
        "route-name": "AttributesDescEdit"
    },
    {
        "component-path": "/admin-panel/home_call_us/form",
        "component-name": HomeCallUs,
        "route-name": "HomeCallUs"
    },
    {
        "component-path": "/admin-panel/home_call_us/form/:id",
        "component-name": HomeCallUs,
        "route-name": "HomeCallUsEdit"
    },
    {
        "component-path": "/admin-panel/opinions/form",
        "component-name": Opinions,
        "route-name": "Opinions"
    },
    {
        "component-path": "/admin-panel/opinions/form/:id",
        "component-name": Opinions,
        "route-name": "OpinionsEdit"
    },
    {
        "component-path": "/admin-panel/opinions_desc/form",
        "component-name": OpinionsDesc,
        "route-name": "OpinionsDesc"
    },
    {
        "component-path": "/admin-panel/opinions_desc/form/:id",
        "component-name": OpinionsDesc,
        "route-name": "OpinionsDescEdit"
    },
    {
        "component-path": "/admin-panel/services_page_desc/form",
        "component-name": ServicesPageDesc,
        "route-name": "ServicesPageDesc"
    },
    {
        "component-path": "/admin-panel/services_page_desc/form/:id",
        "component-name": ServicesPageDesc,
        "route-name": "ServicesPageDescEdit"
    },
    {
        "component-path": "/admin-panel/services_attributes/form",
        "component-name": ServicesAttributes,
        "route-name": "ServicesAttributes"
    },
    {
        "component-path": "/admin-panel/services_attributes/form/:id",
        "component-name": ServicesAttributes,
        "route-name": "ServicesAttributesEdit"
    },
    {
        "component-path": "/admin-panel/services_call_us/form",
        "component-name": ServicesCallUs,
        "route-name": "ServicesCallUs"
    },
    {
        "component-path": "/admin-panel/services_call_us/form/:id",
        "component-name": ServicesCallUs,
        "route-name": "ServicesCallUsEdit"
    },
    {
        "component-path": "/admin-panel/solar_system/form",
        "component-name": SolarSystem,
        "route-name": "SolarSystem"
    },
    {
        "component-path": "/admin-panel/solar_system/form/:id",
        "component-name": SolarSystem,
        "route-name": "SolarSystemEdit"
    },
    {
        "component-path": "/admin-panel/solar_system_call_us/form",
        "component-name": SolarSystemCallUs,
        "route-name": "SolarSystemCallUs"
    },
    {
        "component-path": "/admin-panel/solar_system_call_us/form/:id",
        "component-name": SolarSystemCallUs,
        "route-name": "SolarSystemCallUsEdit"
    },
    {
        "component-path": "/admin-panel/contact_links/form",
        "component-name": ContactLinks,
        "route-name": "ContactLinks"
    },
    {
        "component-path": "/admin-panel/contact_links/form/:id",
        "component-name": ContactLinks,
        "route-name": "ContactLinksEdit"
    }
];
