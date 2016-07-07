jQuery(document).ready(function($) {
    var fixed = $('.fixed-menu');
    var top = fixed.offset().top - parseFloat(fixed.css('margin-top'));

    $(window).scroll(function (event) {
      var y = $(this).scrollTop();
      if (y >= top) {
        fixed.addClass('fixed-menu--active');
      } else {
        fixed.removeClass('fixed-menu--active');
      }
    });

    // Cache selectors
    var topMenu = $(".fixed-menu");
    var topMenuHeight = topMenu.outerHeight() + 15;

    // All list items
    var menuItems = topMenu.find("a");

        // Anchors corresponding to menu items
    var scrollItems = menuItems.map(function(){
        var anchor = $(this).attr("href");
        if (anchor.substring(0, 1) == "#") {
            var item = $(anchor);

            if (item.length) {
                return item;
            }
        }
    });

    // Bind to scroll
    $(window).scroll(function(){
       // Get container scroll position
       var fromTop = $(this).scrollTop() + ($(this).height() / 4);

        // Get id of current scroll item
        var cur = scrollItems.map(function(){
            if ($(this).offset().top < fromTop) {
                console.log($(this).offset().top);
                console.log(fromTop);
                return this;
            }
        });



       // Get the id of the current element
       cur = cur[cur.length-1];
       var id = cur && cur.length ? cur[0].id : "";

       // Set/remove active class
       menuItems.removeClass("fixed-menu__viewing-menu-item");
       $("a[href='#"+id+"']").addClass("fixed-menu__viewing-menu-item");
    });
});