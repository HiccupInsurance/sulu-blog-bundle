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
            app.components.addSource('hiccup-sulu-blog', '/bundles/hiccupsulublog/js/component');

            app.sandbox.mvc.routes.push({
                route: 'blog/posts',
                callback: function () {
                    return '<div data-aura-component="blog/post/list@hiccup-sulu-blog" data-aura-name="sulu" />';
                }
            });

            app.sandbox.mvc.routes.push({
                route: 'blog/add-posts',
                callback: function () {
                    return '<div data-aura-component="blog/post/form@hiccup-sulu-blog" />';
                }
            });

            app.sandbox.mvc.routes.push({
                route: 'blog/posts::id/edit',
                callback: function(id) {
                    return '<div data-aura-component="blog/post/form@hiccup-sulu-blog" data-aura-id="' + id + '"/>';
                }
            });
        }
    };
});