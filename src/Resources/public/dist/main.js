require.config({paths:{hi_sulu_blog:"../../hiccupsulublog/js",hi_sulu_blog_css:"../../hiccupsulublog/css"}}),define(function(){"use strict";return{name:"Hiccup Blog Bundle",initialize:function(a){a.components.addSource("hiccup-sulu-blog","/bundles/hiccupsulublog/js/component"),a.sandbox.mvc.routes.push({route:"blog/posts",callback:function(){return'<div data-aura-component="blog/post/list@hiccup-sulu-blog" data-aura-name="sulu" />'}}),a.sandbox.mvc.routes.push({route:"blog/add-posts",callback:function(){return'<div data-aura-component="blog/post/form@hiccup-sulu-blog" />'}}),a.sandbox.mvc.routes.push({route:"blog/posts::id/edit",callback:function(a){return'<div data-aura-component="blog/post/form@hiccup-sulu-blog" data-aura-id="'+a+'"/>'}})}}});