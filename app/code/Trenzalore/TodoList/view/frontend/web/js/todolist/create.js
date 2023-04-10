define([
    'uiComponent',
    'ko',
    'mage/url',
    'mage/storage',
    'jquery',
    'jquery/validate',
    'mage/validation'
], function (Component, ko, urlBuilder, storage, $) {
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

        clearItemData() {
            this.itemTitle('');
            this.itemValue(0);
            this.itemDate(new Date());
        },

        clearData() {
            this.clearItemData();
            this.todoListTitle('');
            this.todoList([]);
        },

        addItemOnList() {
            if (this.validate()) {
                this.todoList.push({
                    title: this.itemTitle(),
                    value: this.itemValue(),
                    date: this.itemDate()
                });

                this.clearItemData();
            } 
        },

        removeItem(item) {
            this.todoList.remove(item);
        },

        save() {
            storage.post(
                'rest/V1/todo-list', 
                JSON.stringify(
                    {
                        todoList: {
                            title: this.todoListTitle(),
                            list: JSON.stringify(this.todoList())
                        }
                    }
                )
            ).done(
                (result) => {
                    this.clearData();
                    console.log(result);
                }
            ).fail(
                (result) => {
                    console.log(result);
                }
            );
        },

        validate: function() {
            const $form = $('#add-item');
            $form.validation()
            return $form.valid()
        }
    });

});
