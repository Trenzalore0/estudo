define([
    'uiComponent',
    'ko',
    'mage/url'
], function(Component, ko, urlBuilder) {
    'use strict';
    
    return Component.extend({

        defaults: {
            template: "Trenzalore_TodoList/view/todolist/index",
            lists: ko.observableArray(),
            urlCreateNew: urlBuilder.build('todolist/create')
        },

        initialize() {
            this._super();
            
        },

    });

});
