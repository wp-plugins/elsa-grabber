$(document).ready(function() {

    //При загрузке страницы...
    $(".tab_content").hide(); //Скрыть все содержимое
    $("ul.tabs li:first").addClass("active").show(); //Активировать первую вкрадку
    $(".tab_content:first").show(); //Показать контент первой вкладки

    //Событие нажатия кнопки мыши
    $("ul.tabs li").click(function() {

        $("ul.tabs li").removeClass("active"); //Удалить "active" класс старой вкладки
        $(this).addClass("active"); //Добавить "active" класс выбранной вкладки
        $(".tab_content").hide(); //Скрыть весь контент старой вкладки
        var activeTab = $(this).find("a").attr("href"); //Присвоим новой вкладке свою ссылку
        $(activeTab).fadeIn(); //Отобразим все содержимое контента текущей вкладки
return false;
    });
});
