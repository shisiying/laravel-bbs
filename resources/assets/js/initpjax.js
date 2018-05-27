(function($){

    var original_title = document.title;

    var xhz = {
        init: function(){
            var self = this;
            $(document).pjax('a:not(a[target="_blank"])', 'body', {
                timeout: 1600,
                maxCacheLength: 500
            });
            $(document).on('pjax:start', function() {
                NProgress.start();
            });
            $(document).on('pjax:end', function() {
                NProgress.done();
                self.siteBootUp();
                // Fixing popover persist problem
                $('.popover').remove();
            });
            $(document).on('pjax:complete', function() {
                original_title = document.title;
                NProgress.done();
            });
            // Exclude links with a specific class
            $(document).on("pjax:click", "a.no-pjax", false);

            self.siteBootUp();
        },

        /*
         * Things to be execute when normal page load
         * and pjax page load.
         */
        siteBootUp: function(){
            var self = this;
        },


    };
    window.xhz = xhz;
})(jQuery);

$(document).ready(function()
{
    xhz.init();
});