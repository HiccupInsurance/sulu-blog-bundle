require.config({
    paths: {
        hi_sulu_blog: '../../hiccupinsurancesulublog/js',
        hi_sulu_blog_css: '../../hiccupinsurancesulublog/css'
    }
});

define(function () {
    'use strict';

    return {

        name: "Hiccup Blog Bundle",

        initialize: function (app) {
            app.components.addSource('hi-sulu-blog', '/bundles/hiccupinsurancesulublog/js/component');

            app.sandbox.mvc.routes.push({
                route: 'blog/list',
                callback: function () {
                    return '<div data-aura-component="blog/list@hi-sulu-blog" data-aura-name="sulu" />';
                }
            });
        }
    };
});