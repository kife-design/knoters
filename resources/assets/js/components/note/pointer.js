module.exports = {
    template: require('./pointer.template.html'),

    ready: function () {
        this.initDrag();
    },

    methods: {
        initDrag: function () {
            var thisObj = this;

            $(this.$el).draggable({
                'containment' : '#note-workspace',
                'stop' : function (event, ui) {
                    thisObj.update(ui.position);
                }
            });
        },

        update: function (position) {
            var position = percentPosition({'x' : position.left, 'y' : position.top});

            this.$http.put('/notes/' + this.note.token, {items: position}, function (response, status, request) {
                if('errors' in response) {
                    this.$parent.showErrors(response.errors);
                    return;
                }
            }).error(function (data, status, request) {
                // TODO: handle error
            });
        }
    }
}