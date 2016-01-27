var Vue = require('vue');

Vue.use(require('vue-resource'));

Vue.http.headers.common['X-CSRF-TOKEN'] = document.querySelector('#csrf-token').getAttribute('content');

Vue.config.debug = true;

new Vue({
    el: "#editor",

    data: {
        user: undefined,
        project: undefined,
        notes: [],
    },

    components: {
        'note': require('./components/note/note.js'),
        'pointer': require('./components/note/pointer.js'),
        'reply': require('./components/note/reply.js')
    },


    ready: function () {
        var that = this;
        this.getNotes();
        this.initVideo();
        this.initSort();

    },

    methods: {
        initVideo: function () {
            videojs('vid1', {
                // "techOrder": ["youtube"],
                // "src": "http://www.youtube.com/watch?v=xjS6SftYQaQ"
                "techOrder": [userinfo.project.source],
                "src": userinfo.project.url
            }).ready(function () {
                this.one('ended', function () {
                    this.src('http://www.youtube.com/watch?v=jofNR_WkoCE');
                    this.play();
                });
            });
        },

        initSort: function () {
            /*$('#notes-container').sortable({
             axis: "y",
             scrollSensitivity: 50
             });*/
        },

        getNotes: function () {
            this.$http.get('/projects/' + userinfo.project.token + '/notes?embed=replies', function (response) {
                this.notes = response.data;
            }).error(function (response) {
                this.showError(response.error.message);
            });
        },

        addNote: function (event) {
            var index = this.notes.length;
            var position = percentPosition({'x': event.layerX, 'y': event.layerY});
            this.$http.post('/projects/' + userinfo.project.token + '/notes', {
                'userToken': userinfo.user.token,
                'position': position,
                'index': index,
                'embed': 'replies'
            }, function (response, status, request) {
                var note = response.data;

                note.setFocus = true;
                this.notes.push(note);
            }).error(function (data, status, request) {
                //TODO: handle error
            });
        },

        showAdvancedSearch: function (event) {
            event.preventDefault();

            $('#advancedSearchModal').modal('show');
            console.log('ole');
            /*var $form = $(event.target);

            this.$http.get('/projects/' + userinfo.project.token + '/notes/search', {searchvalues: $form.serializeArray()}, function (response) {
                this.notes = response.data;
            }).error(function (response) {
                this.showError(response.error.message);
            });*/
        },

        showError: function (error) {
            $('#errors-container').html('').removeClass('hidden');

            $('#errors-container').html(error);
        }
    }
})
;
