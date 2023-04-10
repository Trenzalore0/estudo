define([
    'uiComponent',
    'ko',
    'mage/url',
    'mage/storage'
], function (Component, ko, urlBuilder, storage) {
    'use strict';

    return Component.extend({

        defaults: {
            template: "Trenzalore_TodoList/view/todolist/index",
            lists: ko.observableArray(),
            urlCreateNew: urlBuilder.build('todolist/create')
        },

        initialize() {
            this._super();
            storage.get('rest/default/V1/todo-list')
            .done(
                (result) => {
                    this.lists(JSON.parse(result))
                }
            ).fail(
                (result) => {
                    console.log(result);
                }
            );
        },

    });
});
