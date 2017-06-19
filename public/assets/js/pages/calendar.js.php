var InitCalendar = function() {
    var Init_Calendar = function(){
        var $date    = new Date();
        var $d       = $date.getDate();
        var $m       = $date.getMonth();
        var $y       = $date.getFullYear();

        jQuery('.js-calendar').fullCalendar({
            firstDay: 1,
            editable: false,
            droppable: false,
            header: {
                left: 'title',
                right: 'prev,next'
            },
            eventRender: function(event, element) {
                element.attr('title', event.tooltip);
            },
            events:
            [
                
            ]
        });
    };

    return {
        init: function () {
            Init_Calendar();
        }
    };
}();
jQuery(function(){ InitCalendar.init(); });