Vue.filter('synced', function(messages) {
    return _.filter(messages, {
        "isSynced": "true"
    });
})
Vue.filter('unSynced', function(messages) {
    return _.filter(messages, {
        "isSynced": "false"
    });
})



new Vue({

    el: '.app',

    data: {
        total: 0,
        updateContent: '',
        messages: []
    },

    ready: function() {
        this.fetchMessages();
        setInterval(function() {

            _.each(this.messages, function(e) {
                if(e.isSynced=='false'){
                    result = this.$http.post('api/store', e,function(){
                        console.log('success')
                        e.isSynced='true';
                    });
                }
            }.bind(this))
        }.bind(this), 2000)
    },

    methods: {
        submit: function() {
            this.total++;
            this.messages.unshift({
                content: this.updateContent,
                id: this.total,
                isSynced: "false"
            })
            this.updateContent = '';
            Lockr.set('updates', this.messages);
        },

        fetchMessages: function() {
            this.$http.get('api/all', function (data) {
                this.messages = data;
                this.total = data.length;
            }.bind(this))
        }
    }
});