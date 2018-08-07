define(['jquery', 'core/ajax', 'core/templates', 'core/notification'], function($, ajax, templates, notification) {
    return /** @alias module:local_hackfest/refresh */ {
        /**
         * Refresh the middle of the page!
         *
         * @method refresh
         */
        reload: function() {
            $("document").ready(function() {
                $(".tab-slider--body").hide();
                $(".tab-slider--body:first").show();
            });
            $(".tab-slider--nav li").click(function() {
                $(".tab-slider--body").hide();
                var activeTab = $(this).attr("rel");
                $("#" + activeTab).fadeIn(1);
                if ($(this).attr("rel") == "tab2") {
                    $('.tab-slider--tabs').addClass('slide');
                } else {
                    $('.tab-slider--tabs').removeClass('slide');
                }
                $(".tab-slider--nav li").removeClass("active");
                $(this).addClass("active");
            });
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
