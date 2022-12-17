define([
    'uiComponent',
    'ko',
    'jquery'
], function (component, ko, $) {
    'use strict';

    let form = $('#news-letter-form-button-submit');

    form.on('click', function (event) {
        event.preventDefault();
        console.log('enviando rola');
    });

    var str = 'meu template =D testando';

    return component.extend({

        _str: ko.observable('Loading...'),

        i: 0,

        initialize: function () {

            this._super();

            // setInterval(this.updateStr.bind(this), 1000);

        },

        // getString: function () {
        //     return this._str;
        // },

        // updateStr: function () {

        //     this._str(str + this.i.toString());

        //     this.i += 1;

        // }

    });
});
