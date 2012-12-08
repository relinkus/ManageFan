var categories = new Array();

Array.prototype.remove = function(from, to) {
  var rest = this.slice((to || from) + 1 || this.length);
  this.length = from < 0 ? this.length + from : from;
  return this.push.apply(this, rest);
};

function addCategory(id)
{
    var index = categories.indexOf(id);
    if(index == -1)
    {
        categories[categories.length] = id;
        $('#category-' + id).removeClass('removed-from-list');
        $('#category-' + id).addClass('added-to-list');
    }
    else
    {
        categories.remove(index);
        $('#category-' + id).removeClass('added-to-list');
        $('#category-' + id).addClass('removed-from-list');
    }
    $('#calendar').fullCalendar( 'refetchEvents' );
}

$(document).ready(function() {

        $('.show-category').addClass('removed-from-list');

        var date = new Date();
        var d = date.getDate();
        var m = date.getMonth();
        var y = date.getFullYear();

        $('#calendar').fullCalendar({
                theme: true,
                header: {
                        left: 'prev,next today',
                        center: 'title',
                        right: 'month,agendaWeek,agendaDay'
                },
                weekMode: 'liquid',
                aspectRatio: 2,
                editable: true,
                allDaySlot: false,
                eventSources: [
                    {
                        url: SITE_URL + 'admin/calendar/data_feed/',
                        data:
                            {
                                categories : categories
                            }
                    }
                ],
                eventClick: function(calEvent, jsEvent, view){
                    window.location.href = SITE_URL + 'admin/calendar/view/' + calEvent.id;
                },
                eventDrop: function(event, dayDelta, minuteDelta, allDay, revertFunc, jsEvent, ui, view){
                    $.ajax({
                            dataType: 'JSON',
                            type: 'POST',
                            data:
                                {
                                    csrf_hash_name      : $.cookie(pyro.csrf_cookie_name),
                                    event_id            : event.id,
                                    day_delta           : dayDelta,
                                    minute_delta        : minuteDelta,
                                    action              : 'drop'
                                },
                            url:  SITE_URL + 'admin/calendar/ajax',
                            success: function(data) {
                                if(data.status == false)
                                {
                                    alert('Failed to update!');
//                                            $('#calendar').fullCalendar( 'refetchEvents' );
                                }
                            }
                    });
//                            $('#calendar').fullCalendar( 'refetchEvents' );
                },
                eventResize: function(event, dayDelta, minuteDelta, revertFunc, jsEvent, ui, view) {
                    $.ajax({
                            dataType: 'JSON',
                            type: 'POST',
                            data:
                                {
                                    csrf_hash_name      : $.cookie(pyro.csrf_cookie_name),
                                    event_id            : event.id,
                                    day_delta           : dayDelta,
                                    minute_delta        : minuteDelta,
                                    action              : 'resize'
                                },
                            url:  SITE_URL + 'admin/calendar/ajax',
                            success: function(data) {
                                if(data.status == false)
                                {
                                    alert('Failed to update!');
//                                            $('#calendar').fullCalendar( 'refetchEvents' );
                                }
                            }
                    });
//                            $('#calendar').fullCalendar( 'refetchEvents' );
                },
                loading: function( isLoading, view ){
                    if(isLoading)
                    {
                        $("#loader").show();
                    }
                    else
                    {
                        $("#loader").hide();
                    }
                }
        });

});
