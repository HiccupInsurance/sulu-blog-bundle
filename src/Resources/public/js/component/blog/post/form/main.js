define(['text!./form.html'], function(form) {
    'use strict';

    return {

        defaults: {
            templates: {
                form: form,
                url: '/admin/api/hiccup-sulu-blog/posts<% if (!!id) { %>/<%= id %><% } %>'
            }
        },

        header: {
            title: 'Headline',
            toolbar: {
                buttons: {
                    save: {
                        parent: 'saveWithOptions'
                    }
                }
            }
        },

        layout: {
            content: {
                width: 'fixed',
                leftSpace: true,
                rightSpace: true
            }
        },

        initialize: function() {
            this.render();
            this.bindDomEvents();
            this.bindCustomEvents();
        },

        render: function() {
            this.$el.html(this.templates.form());
            this.sandbox.form.create('#post-form');
        },

        bindDomEvents: function() {
            this.$el.find('input, textarea').on('keypress', function() {
                this.sandbox.emit('sulu.header.toolbar.item.enable', 'save');
            }.bind(this));
        },

        bindCustomEvents: function() {
            this.sandbox.on('sulu.toolbar.save', this.save.bind(this));
        },

        save: function(action) {
            if (!this.sandbox.form.validate('#post-form')) {
                return;
            }

            var data = this.sandbox.form.getData('#post-form');

            this.sandbox.util.save(this.templates.url({id:null}), 'POST', data).then(function(response) {
                this.afterSave(response, action);
            }.bind(this));
        },

        afterSave: function(response, action) {
            this.sandbox.emit('sulu.header.toolbar.item.disable', 'save');

            if (action === 'back') {
                this.sandbox.emit('sulu.router.navigate', 'blog/posts');
            } else if (action === 'new') {
                this.sandbox.emit('sulu.router.navigate', 'blog/add-posts');
            } else if (!this.options.id) {
                this.sandbox.emit('sulu.router.navigate', 'blog/posts/:' + response.id);
            }
        }
    };
});