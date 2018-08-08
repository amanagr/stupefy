define(['jquery', 'core/ajax', 'core/templates', 'core/notification'], function($, ajax, templates, notification) {
    return /** @alias module:local_hackfest/refresh */ {
        /**
         * Refresh the middle of the page!
         *
         * @method refresh
         */
        reload: function() {
            $(document).ready(function() {
                var numItems = $('li.fancyTab').length;
                if (numItems == 12) {
                    $("li.fancyTab").width('8.3%');
                }
                if (numItems == 11) {
                    $("li.fancyTab").width('9%');
                }
                if (numItems == 10) {
                    $("li.fancyTab").width('10%');
                }
                if (numItems == 9) {
                    $("li.fancyTab").width('11.1%');
                }
                if (numItems == 8) {
                    $("li.fancyTab").width('12.5%');
                }
                if (numItems == 7) {
                    $("li.fancyTab").width('14.2%');
                }
                if (numItems == 6) {
                    $("li.fancyTab").width('16.666666666666667%');
                }
                if (numItems == 5) {
                    $("li.fancyTab").width('20%');
                }
                if (numItems == 4) {
                    $("li.fancyTab").width('25%');
                }
                if (numItems == 3) {
                    $("li.fancyTab").width('33.3%');
                }
                if (numItems == 2) {
                    $("li.fancyTab").width('50%');
                }
            });
            $('#search_course').keydown(function(e)
            {
                if(e.keyCode==13)
                {
                    $('#search_course_button').trigger('click');
                }
            })
            $('#search_category').keydown(function(e)
            {
                if(e.keyCode==13)
                {
                    $('#search_category_button').trigger('click');
                }
            })
            // Add a click handler to the button.
            $('#search_course_button').on('click', function() {
                // First - reload the data for the page.
                var promises = ajax.call([{
                    methodname: 'block_clist_get_block_data',
                    args: {
                        search_text: $('#search_course').val(),
                        tab: 'course'
                    }
                }]);
                promises[0].done(function(data) {
                    // console.log(data);
                    // We have the data - lets re-render the template with it.
                    templates.render('block_clist/main', data).done(function(html, js) {
                        $('[data-region="clist"]').replaceWith(html);
                        // And execute any JS that was in the template.
                        templates.runTemplateJS(js);
                    }).fail(notification.exception);
                }).fail(notification.exception);
            });
            $('#search_category_button').on('click',function()
            {
                var promises = ajax.call([{
                    methodname: 'block_clist_get_block_data',
                    args: {
                        search_text: $('#search_category').val(),
                        tab: 'category'
                    }
                }]);
                promises[0].done(function(data) {
                    // console.log(data);
                    // We have the data - lets re-render the template with it.
                    templates.render('block_clist/main', data).done(function(html, js) {
                        $('[data-region="clist"]').replaceWith(html);
                        // And execute any JS that was in the template.
                        templates.runTemplateJS(js);
                        $(document).ready(function(){
                            $("#tab1").trigger("click");
                        });
                    }).fail(notification.exception);
                }).fail(notification.exception); 
            })
        }
    };
});
