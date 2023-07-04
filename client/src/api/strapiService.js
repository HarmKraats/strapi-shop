import api from "./api";


export default {
    getPages() {
        return api
            .get(`/api/pages`)
            .then(response => response.data);
    },

    getPageBySlug(slug) {
        return api
        .get(`/api/pages?filters[slug][$eq]=${slug}&populate[Pagebuilder][populate]=*`)
            .then(response => response.data.data[0]);
    }
}
