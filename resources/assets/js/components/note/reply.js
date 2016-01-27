module.exports = {
    template: require('./reply.template.html'),

    ready: function () {
        if (this.reply.setFocus) {
            $(this.$el).find('.reply_message').focus();
        }
    },

    methods: {
        update: function () {
            var message = $(this.$el).find('.reply_message').text();

            this.$http.put('/replies/' + this.reply.token, {'message': message}, function (response) {
                if('errors' in response) {
                    this.$parent.showErrors(response.errors);
                    return;
                }
            });
        }
    }
}
