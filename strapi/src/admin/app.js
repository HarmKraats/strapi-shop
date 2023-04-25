import favicon from './extensions/favicon.ico';

const config = {
    locales: [
        // 'ar',
        'fr',
        // 'cs',
        // 'de',
        // 'dk',
        // 'es',
        // 'he',
        // 'id',
        // 'it',
        // 'ja',
        // 'ko',
        // 'ms',
        'nl',
        // 'no',
        // 'pl',
        // 'pt-BR',
        // 'pt',
        // 'ru',
        // 'sk',
        // 'sv',
        // 'th',
        // 'tr',
        // 'uk',
        // 'vi',
        // 'zh-Hans',
        // 'zh',
    ],
};

const bootstrap = (app) => {
    console.log(app);
};

export default {
    config: {
        locales: ['nl'],
        translations: {
            nl: {
                'Auth.form.email.label': 'test',
                // Translate a plugin's key/value pair by adding the plugin's name as a prefix
                // In this case, we translate the "plugin.name" key of plugin "content-type-builder"
                "content-type-builder.plugin.name": "Content-types bewerken",
                'app.components.LeftMenuLinkContainer.collectionTypes': 'Meerdere collecties',
                "content-manager.containers.SettingsPage.Block.contentType.title": "Collecties",
                "app.components.LeftMenu.navbrand.workplace": "Website backend",
                "app.components.LeftMenu.navbrand.title": "Clayco dashboard",
                "global.content-manager": "Website bewerken",
                "global.plugins.content-manager": "Website bewerken",
                "content-manager.HeaderLayout.button.label-add-entry": "Nieuw item",
            },
        },
        head: {
            favicon: favicon,
        },
        tutorials: false,
        notifications: {
            releases: false
        },
    },
    bootstrap,
};
