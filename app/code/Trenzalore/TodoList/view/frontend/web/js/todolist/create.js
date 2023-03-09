define([
    'uiComponent',
    'ko',
    'mage/url'
], function(Component, ko, urlBuilder) {
    'use strict';
    
    return Component.extend({

        defaults: {
            template: "Trenzalore_TodoList/view/todolist/create",
            urlBack: urlBuilder.build('todolist/index'),
            todoListTitle: ko.observable(''),
            todoList: ko.observableArray(),
            itemTitle: ko.observable(''),
            itemValue: ko.observable(0),
            itemDate: ko.observable(new Date())
        },

        initialize() {
            this._super();
        },

        addItemOnList() {
            // this.todoList.push({
            //     title: this.itemTitle(),
            //     value: this.itemValue(),
            //     date: this.itemDate()
            // });

            console.log({
                title: this.itemTitle(),
                value: this.itemValue(),
                date: this.itemDate()
            });

            this.itemTitle('');
            this.itemValue(0);
            this.itemDate(new Date());
        },

        removeItem(self, item) {
            var asdf = 'asdf';
            this.todoList.remove(item);
        },



    });

});
