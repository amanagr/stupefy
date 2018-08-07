define(['jquery', 'core/ajax', 'core/templates', 'core/notification'], function($, ajax, templates, notification) {
    return /** @alias module:local_hackfest/refresh */ {
        /**
         * Refresh the middle of the page!
         *
         * @method refresh
         */
        refresh: function() {
            // Add a click handler to the button.
            $('#refresh').on('click', function() {
                // First - reload the data for the page.
                var promises = ajax.call([{
                    methodname: 'block_clist_get_block_data',
                    args: {}
                }]);
                promises[0].done(function(data) {
                    // We have the data - lets re-render the template with it.
                    templates.render('block_clist/main', data).done(function(html, js) {
                        $('[data-region="clist"]').replaceWith(html);
                        // And execute any JS that was in the template.
                        templates.runTemplateJS(js);
                    }).fail(notification.exception);
                }).fail(notification.exception);
            });
        }
    };
});
