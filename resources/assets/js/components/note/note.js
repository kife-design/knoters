module.exports = {
    template: require('./note.template.html'),

    props: ['note'],

    ready: function () {
        if (this.note.setFocus) {
            $(this.$el).find('.note_message').focus();
        }
    },

    methods: {
        saveMessage: function () {
            var message = $(this.$el).find('.note_message').html();
            this.$http.put('/notes/' + this.note.token, {'message': message}, function (response, status, request) {
                this.note.message = response.data.message;
            }).error(function (data, status, request) {
                this.showError(response.error.message);
            });
        },

        remove: function () {
            this.$http.delete('/notes/' + this.note.token, function (response, status, request) {
                this.$parent.notes.$remove(this.note)
            }).error(function (data, status, request) {
                this.showError(response.error.message);
            });

        },

        setType: function (type) {
            var typeId = this.getTypeId(type);

            this.$http.put('/notes/' + this.note.token, {note_type_id: typeId}, function (response, status, request) {
                this.note.type = type;
            }).error(function (data, status, request) {
                this.showError(response.error.message);
            });
        },

        getTypeId: function (type) {
            var types = {
                'info': 1,
                'success': 2,
                'error': 3
            };

            return types[type];
        },

        reply: function () {
            var index = this.note.replies.data.length;
            this.$http.post('/notes/' + this.note.token + '/replies', {
                'userToken': userinfo.user.token,
                index: index
            }, function (response) {
                if ('errors' in response) {
                    this.$parent.showErrors(response.errors);
                    return;
                }

                var reply = response.data;
                reply.setFocus = true;

                this.note.replies.data.push(reply);
            });
        },

        upload: function () {
            alert('uploading')
        }
    }
}
