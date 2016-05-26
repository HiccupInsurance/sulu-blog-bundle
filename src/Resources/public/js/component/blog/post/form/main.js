define(['underscore', 'jquery', 'text!./form.html'], function(_, $, form) {

    return {

        defaults: {
            templates: {
                form: form,
                url: '/admin/api/hiccup-sulu-blog/posts<% if (!!id) { %>/<%= id %><% } %>'
            },
            translations: {
                title: 'public.title',
                content: 'news.content'
            }
        },

        header: {
            title: 'news.headline',
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
            this.$el.html(this.templates.form({translations: this.translations}));

            this.form = this.sandbox.form.create('#post-form');
            this.form.initialized.then(function() {
                this.sandbox.form.setData('#post-form', this.data || {});
            }.bind(this));
        },

        bindDomEvents: function() {
            this.$el.find('input, textarea').on('keypress', function() {
                this.sandbox.emit('sulu.header.toolbar.item.enable', 'save');
            }.bind(this));
        },

        bindCustomEvents: function() {
            this.sandbox.on('sulu.toolbar.save', this.save.bind(this));
            this.sandbox.on('sulu.header.back', function() {
                this.sandbox.emit('sulu.router.navigate', 'blog/posts');
            }.bind(this));
        },

        save: function(action) {
            if (!this.sandbox.form.validate('#post-form')) {
                return;
            }

            var data = this.sandbox.form.getData('#post-form'),
                url = this.templates.url({id: this.options.id});

            this.sandbox.util.save(url, !this.options.id ? 'POST' : 'PUT', data).then(function(response) {
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
                this.sandbox.emit('sulu.router.navigate', 'blog/posts:' + response.id + '/edit');
            }
        },

        loadComponentData: function() {
            var promise = $.Deferred();

            if (!this.options.id) {
                promise.resolve();

                return promise;
            }
            this.sandbox.util.load(_.template(this.defaults.templates.url, {id: this.options.id})).done(function(data) {
                promise.resolve(data);
            });

            return promise;
        }
    };
});
