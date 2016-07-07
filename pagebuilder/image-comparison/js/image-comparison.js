!function(e){!function(){if(!e.requestAnimationFrame){if(e.webkitRequestAnimationFrame)return e.requestAnimationFrame=e.webkitRequestAnimationFrame,void(e.cancelAnimationFrame=e.webkitCancelAnimationFrame||e.webkitCancelRequestAnimationFrame);var n=0;e.requestAnimationFrame=function(i){var t=(new Date).getTime(),a=Math.max(0,16-(t-n)),m=e.setTimeout(function(){i(t+a)},a);return n=t+a,m},e.cancelAnimationFrame=function(e){clearTimeout(e)}}}(),"function"==typeof define&&define(function(){return e.requestAnimationFrame})}(window);

;(function ( $, window, document, undefined ) {

    'use strict';

    var pluginName = 'cocoen',
        defaults = {
            dragElementSelector: '.cocoen__drag'
        };

    function Plugin( element, options ) {
        this.options = $.extend( {}, defaults, options);
        this.$element = $(element);

        this.init();
    }

    Plugin.prototype = {

        init: function() {
            this.createElements();
            this.setDimensions();
            this.addEventListeners();
            this.didDrag = false;
        },
        createElements: function(){
            var first_text = this.$element.find('img:first-child').attr('alt');
            var last_text = this.$element.find('img:last-of-type').attr('alt');

            this.$element.append('<span class="'+ this.options.dragElementSelector.replace('.','') +'"></span>');
            this.$element.find('img:first-child').wrap('<div></div>');
            this.$element.find('div:first-child').prepend('<span class="left-label">' + first_text + '</span>')
            this.$element.append('<span class="right-label">' + last_text + '</span>')

            this.$dragElement = this.$element.find(this.options.dragElementSelector);
            this.$before = this.$element.find('div:first-child');
            this.$beforeImg = this.$before.find('img');
        },
        addEventListeners: function(){
            this.$element.on('click', this.onTap.bind(this));
            this.$element.on('mousedown touchstart', this.options.dragElementSelector, this.onDragStart.bind(this));
            this.$element.on('mousemove touchmove', this.onDrag.bind(this));

            $(window).on('mouseup', this.onDragEnd.bind(this));
            $(window).on('resize', this.setDimensions.bind(this));
        },
        onTap: function(e){

            e.preventDefault();
            if (this.didDrag == true) {
                this.didDrag = false;
                return;
            }

            this.leftPos = (e.pageX) ? e.pageX - (this.dragWidth / 2) : e.originalEvent.touches[0].pageX - (this.dragWidth / 2);
            this.requestDrag();
        },
        onDragStart: function(e){
            e.preventDefault();

            this.didDrag = true;
            this.$dragElement.addClass('dragging');
            var startX = (e.pageX) ? e.pageX : e.originalEvent.touches[0].pageX;

            this.posX = this.$dragElement.offset().left + this.dragWidth - startX;
            this.isDragging = true;
        },
        onDragEnd: function(e){
            console.log("Ended!");
            e.preventDefault();
            this.$dragElement.removeClass('dragging');
            this.isDragging = false;
        },
        onDrag: function(e){
            e.preventDefault();

            if(!this.isDragging){
                return;
            }

            console.log("Fired...");
            this.moveX = (e.pageX) ? e.pageX : e.originalEvent.touches[0].pageX;
            this.leftPos = parseInt((this.moveX + this.posX - this.dragWidth), 10);

            this.requestDrag();
        },
        requestDrag: function(){
            requestAnimationFrame(this.drag.bind(this));
        },
        drag: function(){

            if(this.leftPos < this.minLeftPos - 15) {
                this.leftPos = this.minLeftPos;
            } else if(this.leftPos > this.maxLeftPos + 15) {
                this.leftPos = this.maxLeftPos;
            }

            var width = (this.leftPos + (this.dragWidth / 2) - this.containerOffset) * 100 / this.containerWidth + '%';

            console.log("leftPos..." + this.leftPos);
            console.log("dragWidth..." + this.dragWidth);
            console.log("containerOffset..." + this.containerOffset);
            console.log("containerWidth..." + this.containerWidth);
            console.log("Setting width to..." + width);

            this.$dragElement.css('left', width);
            this.$before.css('width', width);
        },
        setDimensions: function(){
            this.$beforeImg.css('width', this.$element.width());

            this.dragWidth = this.$dragElement.outerWidth();

            console.log(this.dragWidth);
            this.containerWidth = this.$element.outerWidth();
            this.containerOffset = this.$element.offset().left;
            this.minLeftPos = this.containerOffset + 10;
            this.maxLeftPos = this.containerOffset + this.containerWidth - this.dragWidth - 10;
            this.isDragging = false;
        }

    };

    $.fn[pluginName] = function ( options ) {
        return this.each(function () {
            if (!$.data(this, 'plugin_' + pluginName)) {
                $.data(this, 'plugin_' + pluginName,
                new Plugin( this, options ));
            }
        });
    };

})( jQuery, window, document );
jQuery(document).ready(function($) {
    $('.cocoen').cocoen();
});