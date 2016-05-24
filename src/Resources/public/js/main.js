require.config({
    paths: {
        hi_sulu_blog: '../../hiccupsulublog/js',
        hi_sulu_blog_css: '../../hiccupsulublog/css'
    }
});

define(function () {
    'use strict';

    return {

        name: "Hiccup Blog Bundle",

        initialize: function (app) {
            app.components.addSource('hi-sulu-blog', '/bundles/hiccupsulublog/js/component');

            app.sandbox.mvc.routes.push({
                route: 'blog/list',
                callback: function () {
                    return '<div data-aura-component="blog/list@hi-sulu-blog" data-aura-name="sulu" />';
                }
            });
        }
    };
});