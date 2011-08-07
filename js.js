JQuery(document).ready(function() {


    JQuery(".tab_content").hide();
    JQuery("ul.tabs li:first").addClass("active").show();
    JQuery(".tab_content:first").show();


    JQuery("ul.tabs li").click(function() {

        JQuery("ul.tabs li").removeClass("active");
        JQuery(this).addClass("active");
        JQuery(".tab_content").hide();
        var activeTab = JQuery(this).find("a").attr("href");
        JQuery(activeTab).fadeIn();
return false;
    });
});
