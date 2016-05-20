require.config({
    paths: {
        hi_sulu_blog: '../../hiccupinsurancesulublogbundle/js',
        hi_sulu_blog_css: '../../hiccupinsurancesulublogbundle/css'
    }
});

define(function() {
    'use strict';

    return {

        name: "Example News Bundle",

        initialize: function(app) {

            app.components.addSource('hi-sulu-blog', '/bundles/hiccupinsurancesulublogbundle/js/component');

            app.sandbox.mvc.routes.push({
                route: 'news',
                callback: function() {
                    return '<div data-aura-component="blog/list@hi-sulu-blog" data-aura-name="sulu" />';
                }
            });
        }
    };
});